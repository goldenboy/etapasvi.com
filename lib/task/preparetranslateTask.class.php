<?php
/**
 * Подготовка файлов переводов symfony.
 * Берутся файлы messages.ru.xml, из них удаляется перевод, затем файлы складываются в /uploads/
 * deprecated директории пропускаем.
 * 
 * Цитаты также помещаются в отдельные файлы.
 *
 */

class preparetranslateTask extends sfBaseTask
{
  // дирекотрия с переподами
  const PREPARED_MESSAGES_DIR            = 'translate';
  // название директории с файлами для перевода на любой язык
  const OTHER_MESSAGES_CODE              = 'other';
  // язык, который берётся за образец
  const ORIGINAL_CULTURE                 = 'ru';
  // расширение конечных файлов переводаы
  const FILE_EXT                         = 'html';
  // файл со списком страниц переводов
  const INDEX_FILE                       = 'index.html';
  // название модуля цитат
  const MODULE_QUOTES                    = 'quotes';
  
  // папка с переводами
  private $translates_path = '';
  // языки, для которых есть хотя бы один файл перевода
  private $translated_cultures = array();
  // список модулей
  private $module_list          = array();
  
    
  protected function configure()
  {
  	// чтобы можно было получить настройки с помощью sfConfig::get() указываем application = frontend  	
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'preparetranslate';
    $this->briefDescription = 'Prepare Translate';
    $this->detailedDescription = <<<EOF
Ping website
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	// чтобы генерировать URL надо создать контекст
  	// http://www.srcnix.com/2010/02/08/symfony-1-2-tasks-the-default-context-does-not-exist/
  	sfContext::createInstance($this->configuration);
  	
    $this->translates_path = realpath( sfConfig::get('sf_upload_dir') . '/' . self::PREPARED_MESSAGES_DIR . '/' );
    
    if (is_dir($this->translates_path)) {
      echo 'Translates directory: ' . $this->translates_path . "\n";
    } else {
      echo 'Translates directory does not exists: ' . $this->translates_path . "\n";
      return;
    }
    
    // удаляем все имеющиеся файлы
    $remove_command = 'rm -rf ' . $this->translates_path . '/*';
    system($remove_command);
    echo "Removed files from translates directory\n";

    // берутся файлы с русским переводом, перевод удаляется и файлы складываются в /uploads/other
    echo "Translation other:\n";    
    $this->findFiles(sfConfig::get('sf_app_dir'), '/messages\.ru\.xml$/', 'procOtherFile');
    
    // messages-файла для цитат нет, поэтому файл создаётся вручную
    $this->createQuotesFile(self::OTHER_MESSAGES_CODE);
    
    // выясняется перечень языков, на которых уже есть хотя бы один файл перевода
    $this->findFiles(sfConfig::get('sf_app_dir'), '/messages\..*\.xml$/', 'getTranslatedCultures');
    
    echo "Cultures with translations:\n";
    print_r( $this->translated_cultures );
    
    // для каждого языка создаётся папка по названию языка
    // в папку копируются файлы из /uploads/other
    // ищутся файлы переводов для языка и кладутся в созданную папку, заменяя файлы, скопированные ранее из /uploads/other
    foreach ($this->translated_cultures as $culture) {
      // для каждого языка создаётся папка по названию языка
      $culture_dir = $this->translates_path . '/' . $culture;
      try {
        mkdir($culture_dir, 0777, true);
      } catch (Exception $e) {
        $log_msg = 'Error occured creating translate directory: ' . $culture_dir;
  	    sfContext::getInstance()->getLogger()->err($log_msg);
  	    echo $log_msg . "\n";
  	    return false;
      }
      
      // в папку копируются файлы из /uploads/other и соответствующим образом переименовываются
      $copy_command = 'cp ' . $this->translates_path . '/' . self::OTHER_MESSAGES_CODE . '/* ' . $this->translates_path . '/' . $culture;      
      system($copy_command);
      // http://superuser.com/questions/8716/rename-a-group-of-files-with-one-command
      $rename_command = "for file in {$this->translates_path}/{$culture}/*; do mv \"\$file\" \"\${file%." . self::OTHER_MESSAGES_CODE . 
      					"." . self::FILE_EXT . "}.{$culture}." 
                        . self::FILE_EXT . "\"; done";
      system($rename_command);      
      
      // ищутся файлы переводов для языка и кладутся в созданную папку, заменяя файлы, скопированные ранее из /uploads/other
      $this->findFiles(sfConfig::get('sf_app_dir'), "/messages\.{$culture}\.xml$/", 'copyTranslatedFile');
      
      // messages-файла для цитат нет, поэтому файл создаётся вручную
      $this->createQuotesFile($culture);
      
      echo "Created translate files in: " . $this->translates_path . '/' . $culture . "\n";
    }
    
    // строится страница со ссылками на страницы переводов
    $this->createIndex();
  }
  
  /**
   * Перемещение файла перевода из симфони в директорию переводов.
   * Если надо выполняется удаление перевода из файла.
   *
   * @param unknown_type $source
   * @param unknown_type $dest
   */
  protected function prepareFile($source, $dest, $remove_translation = false) {
      
  	try {
      // если надо создаётся директория
  	  $dir = dirname($dest);
      if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
      }

  	  // чтение файла, удаление перевода и сохранение
  	  $source_text = file_get_contents($source);
  	  $dest_text   = '';
  	  if ($remove_translation) {
        $dest_text   = preg_replace("/<target>([^<]+)<\/target>/m", "<target></target>", $source_text);  	    
  	  } else {
  	    $dest_text = $source_text;
  	  }
  	  
  	  // Подготовка HTML с переводом
  	  // Превращает
  	  // <trans-unit id="1">
      //     <source>Family and Childhood</source>
      //     <target>Perekond ja lapsepõlv</target>
      // </trans-unit>
      // в 
      // ================1================
      // Family and Childhood
      // =
      // Perekond ja lapsepõlv

      // начало
      $dest_text = preg_replace("/<\?xml((?!<trans\-unit).)+/s", "", $dest_text);
      // конец
      $dest_text = preg_replace("/<\/trans\-unit>((?!<trans\-unit).)+/s", "</trans-unit>", $dest_text);
      // начало исходного текста
      $dest_text = preg_replace("/<trans\-unit((?!<source>).)+<source>/s", TextPeer::TRANSLATE_ITEMS_DELIMITER . "\r\n", $dest_text);
      // разделитесь между текстом и переводом
      $dest_text = preg_replace("/<\/source>[^<]+<target>/m", "\r\n" . TextPeer::TRANSLATE_BETWEEN_DELIMITER . "\r\n", $dest_text);
      // остатки target
      $dest_text = preg_replace("/<\/target>((?!" . TextPeer::TRANSLATE_ITEMS_DELIMITER .  ").)+<\/trans\-unit>/s", "\r\n", $dest_text);
  	  
      // модуль
      $module = $this->getModuleFromPath($source);
      
      // язык
      $culture = $this->getCultureFromPath($source);
      $language = UserPeer::$all_cultures[ $culture ]['en'];
      
      // URL  
      $routing = $this->getRouting();
      try {
      	if ($remove_translation) {
      	  $culture = sfConfig::get('sf_default_culture');
      	}
        $url = $routing->generate($module, array('sf_culture' => $culture));
      } catch (Exception $e) {}
      if (empty($url)) {
        $url = $routing->generate('main', array('sf_culture' => $culture));
      }
      $url = 'http://' . UserPeer::DOMAIN_NAME_MAIN . $url;
      
      if (!empty($dest_text)) {
        $dest_text .= TextPeer::TRANSLATE_ITEMS_DELIMITER;
        $dest_text = $this->getTranslateFileHtml($url, $module, $culture, $dest_text);
  	    file_put_contents($dest, $dest_text);
  	    
        // запоминаем модуль
        if (!in_array($module, $this->module_list)) {
      	  $this->module_list[] = $module;
        }
  	  }
  	} catch (Exception $e) {
  	  $log_msg = 'Error occured preparing translation file: ' . $dest;
  	  sfContext::getInstance()->getLogger()->err($log_msg);
  	  echo $log_msg . "\n";
  	  return false;
  	}
  	return true;
  }
  
  /**
   * Создание файла перевода Цитат
   *
   * @param unknown_type $culture
   * @return unknown
   */
  protected function createQuotesFile($culture) {
          
  	try {
      // предполагается, что все директории уже созданы
      $result_file_path = $this->translates_path . '/' . $culture . '/' . self::MODULE_QUOTES . '.' . $culture . '.' . self::FILE_EXT;     
      
      // получаем список Цитат на языке по умолчанию
      $c = new Criteria();
      $c->add(QuoteI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
      $c->addAscendingOrderByColumn(QuotePeer::ID);      
  	  $quote_list = QuotePeer::doSelectWithI18n($c);
  	  
      if ($culture == self::OTHER_MESSAGES_CODE) {
        //$c->add(QuoteI18nPeer::CULTURE, $culture );
        //sfContext::getInstance()->getUser()->setCulture($culture);
        $translation_culture = sfConfig::get('sf_default_culture');
      } else {
        //$c->add(QuoteI18nPeer::CULTURE, sfConfig::get('sf_default_culture') );
        //sfContext::getInstance()->getUser()->setCulture($default_culture);
        $translation_culture = $culture;
      }
      
      // URL  
      $routing = $this->getRouting();
      $url     = 'http://' . UserPeer::DOMAIN_NAME_MAIN . $routing->generate('main', array('sf_culture' => $translation_culture));
  	  
  	  // подготовка массива для построения отформатированного текста
  	  foreach ($quote_list as $quote) {
  	      
  	    $source_text = $quote->getTitle();  	    
  	    $translation = $quote->getTitle($translation_culture);
  	    
  	    if ($source_text == $translation) {
  	      $translation = '';
  	    }
  	      
  	    $quote_items[] = array(  	    
  	      'source_text' => $source_text,
  	      'translation' => $translation
  	    );
  	  }
  	  
  	  $formatted_text = $this->generateFormattedText($quote_items);
      
      // получение HTML и сохранение в файл
      if (!empty($formatted_text)) {
        $dest_html = $this->getTranslateFileHtml($url, self::MODULE_QUOTES, $culture, $formatted_text);
  	    file_put_contents($result_file_path, $dest_html);
  	  } else {
  	    throw new Exception('Quote translation text is empty');
  	  }

  	} catch (Exception $e) {
  	  $log_msg = 'Error occured preparing quotes translation file ' . $dest . ': ' . $e->getMessage();
  	  sfContext::getInstance()->getLogger()->err($log_msg);
  	  echo $log_msg . "\n";
  	  return false;
  	}
  	return true;
  }
  
  /**
   * Получение отформатированного текста для перевода
   *
   * @param unknown_type $items
   */
  protected function generateFormattedText($items)
  {
    $formatted_text = '';
    foreach ($items as $item) {
      $formatted_text .= 
        TextPeer::TRANSLATE_ITEMS_DELIMITER . "\r\n" 
        . $item['source_text'] . "\r\n"
        . TextPeer::TRANSLATE_BETWEEN_DELIMITER . "\r\n"
        . $item['translation'] . "\r\n" ;
    }
    $formatted_text .= TextPeer::TRANSLATE_ITEMS_DELIMITER;
    
    return $formatted_text;
  }
  
  /**
   * Получение HTML файла перевода.
   *
   * @param unknown_type $url
   * @param unknown_type $module
   * @param unknown_type $culture
   * @param unknown_type $text
   * @return unknown
   */
  protected function getTranslateFileHtml($url, $module, $culture, $text)
  {
    if (empty($url) || empty($module) || empty($culture) || empty($text)) {
  	  $log_msg = 'Error creating HTML: one of the parameters passed to ' . __FILE__ . ' is empty';
  	  sfContext::getInstance()->getLogger()->err($log_msg);
  	  echo $log_msg . "\n";
  	  return false;
    }
      
    $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="" />
<title>eTapasvi.com interface translation</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.etapasvi.com/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.etapasvi.com/css/css.css" /> 
</head>
<body>
URL: <a href="' . $url . '" target="_blank">' . $url . '</a><br/><br/>
Tutorial:<br/>
<textarea style="width:98%;font-family:courier" rows="6" readonly="readonly">' . TextPeer::TRANSLATE_ITEMS_DELIMITER . 
'
Here is text to be translated
' . TextPeer::TRANSLATE_BETWEEN_DELIMITER . 
'
Translation should be placed here
' . TextPeer::TRANSLATE_ITEMS_DELIMITER . '</textarea>
<br/><br/>
Copy text below into any text editor (be careful with encoding, it should be UTF-8 without BOM), 
translate and send to <a href="mailto:' . MailPeer::MAIL_ADDRESS . '">' . MailPeer::MAIL_ADDRESS . '</a> 
or translate directly in the area below and click "Send" button to send:<br/><br/>
<form action="' . TextPeer::GOOGLE_DOC_OFFER_TRANSLATE . '" method="POST" id="offer_tr_form" >
<input type="hidden" name="entry.5.single" value="' . $url .'" id="offer_tr_uri"/>
<input type="hidden" name="entry.6.single" value="' . $module . '" />
<input type="hidden" name="entry.4.single" value="' . $culture . '" />
<textarea style="width:98%;font-family:courier" rows="25" name="entry.1.single">' . $text . '</textarea>
<br/><br/>
<table cellspacing="0" cellpadding="0" class="form_table">
    <tr>
        <td>Email: </td><td><input type="text" name="entry.2.single" value="" /> (optional)</td>
    </tr>
    <tr>
        <td>Translated by: </td><td><input type="text" name="entry.3.single" value="" /> (optional)</td>
    </tr>
    <tr>
        <td>Comment: </td><td><input type="text" name="entry.9.single" value="" /> (optional)</td>
    </tr>
</table>
<input type="hidden" name="pageNumber" value="0" />
<input type="hidden" name="backupCache" value="" />
<p class="center_text">
    <input type="submit" name="submit" value="Send" id="offer_tr_submit"/>
</p>
</form>

</body>
</html>';
    return $html;
  }
  
  /**
   * Получение названия модуля из пути к файлу
   *
   * @param unknown_type $filename
   * @return unknown
   */
  protected function getModuleFromPath($filename) {
  	$filename_parts = explode('/', $filename);
  	return $filename_parts[ count($filename_parts) - 3];
  }
  
  /**
   * Получение язка из пути к файлу
   *
   * @param unknown_type $filename
   * @return unknown
   */
  protected function getCultureFromPath($filename) {
    preg_match("/.*\.([^.]+)\.xml/", $filename, $matches);
    return $matches[1]; 
  }  
  
  /**
   * Выясняется перечень языков, на которых уже есть хотя бы один файл перевода
   *
   * @param unknown_type $filename
   * @return unknown
   */
  protected function getTranslatedCultures($filename) {
  	// из пути вытаскивается язык
  	$culture = $this->getCultureFromPath($filename);   
    if (!empty($culture) && !in_array($culture, $this->translated_cultures)) {
      $this->translated_cultures[] = $culture;
    }
  }
  
  /**
   * Обработка и сохранение файла
   *
   * @param unknown_type $filename
   */
  protected function procOtherFile($filename) {
    
    // deprecated директории пропускаем
    if (strstr($filename, 'deprecated')) {
      return;
    }    
    
    // преобразование 
    // /home/user/etapasvi.com/apps/frontend/modules/contactus/i18n/messages.ru.xml
    // в
    // /home/user/etapasvi.com/www/uploads/translate/other/contactus.xml        
    
    // обрабатывается образцовый язык
    $result_file_name = $this->getModuleFromPath($filename) . '.' . self::OTHER_MESSAGES_CODE . '.' . self::FILE_EXT;    
    $result_file_path = $this->translates_path . '/' . self::OTHER_MESSAGES_CODE . '/' . $result_file_name;      
    echo $result_file_path . "\n";
    return $this->prepareFile($filename, $result_file_path, true);
  }
  
  /**
   * Файл перевода копируется из симфони в папку /uploads/translate/culture
   * Файл переименовывается в соответствии с модулем, в котором находится
   *
   * @param unknown_type $filename
   */
  protected function copyTranslatedFile($filename) 
  {
    // deprecated директории пропускаем
    if (strstr($filename, 'deprecated')) {
      return;
    }    
    
    // преобразование 
    // /home/user/etapasvi.com/apps/frontend/modules/contactus/i18n/messages.ru.xml
    // в
    // /home/user/etapasvi.com/www/uploads/translate/ru/contactus.ru.xml   
     
    // по имени исходного файла определяем язык
    $culture = $this->getCultureFromPath($filename);         

    $result_file_name = $this->getModuleFromPath($filename) . '.' . $culture . '.' . self::FILE_EXT;
      
    $result_file_path = $this->translates_path . '/' . $culture . '/' . $result_file_name;      
    return $this->prepareFile($filename, $result_file_path, false); 
  }
  
  /**
   * Страница со списком страниц переводов
   *
   * @param unknown_type $filename
   * @return unknown
   */
  protected function createIndex() 
  {
    $index_html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="" />
<title>eTapasvi.com interface translation</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script> 
<link rel="shortcut icon" type="image/x-icon" href="http://www.etapasvi.com/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.etapasvi.com/css/css.css" /> 
</head>
<body>
	<script type="text/javascript">
	function showModules(select)
	{
		$(".modules").hide();
		var culture = $(select).val();
		$("#"+culture+"_modules").show();
		$("#"+culture+"_modules select").change();
	}
	function loadTranslate(select)
	{	    
		$("#prepare_translate_iframe").attr("src", $(select).val() );
	}
	</script>
	Language: <select onchange="showModules(this)">
		<option value="' . self::OTHER_MESSAGES_CODE . '">' . self::OTHER_MESSAGES_CODE . '</option>';
    // список языков
    foreach ($this->translated_cultures as $culture) {
	  $index_html .= '<option value="' . $culture . '">' . UserPeer::getCultureFullName($culture) . '</option>';
    }
    $index_html .= '</select><br/><br/>';

    // список модулей языков
    $cultures_list = $this->translated_cultures;
    $cultures_list[] = self::OTHER_MESSAGES_CODE;
    foreach ( $cultures_list as $culture) {
      $index_html .= '<div id="' . $culture . '_modules" class="' . ($culture != self::OTHER_MESSAGES_CODE ? 'hidden' : '') . ' modules">Module: <select onchange="loadTranslate(this)">';
      $module_list_updated   = $this->module_list;
      $module_list_updated[] = self::MODULE_QUOTES;
      foreach ($module_list_updated as $module) {
    	$index_html .= '<option value="http://' . UserPeer::DOMAIN_NAME_MAIN . '/uploads/' . self::PREPARED_MESSAGES_DIR . '/' .
    					$culture . '/' . $module . '.' . $culture . '.' . self::FILE_EXT . '" target="prepare_translate_iframe">' . 
    					$module . '</option>';
      }
      $index_html .= '</select></div>';
    }

    
	$index_html .= '<br/>
    <iframe frameborder="0" border="0" width="100%" height="720" src="http://' . UserPeer::DOMAIN_NAME_MAIN . '/uploads/' . self::PREPARED_MESSAGES_DIR . '/' .
    					self::OTHER_MESSAGES_CODE . '/' . $this->module_list[0] . '.' . self::OTHER_MESSAGES_CODE . '.' . self::FILE_EXT . '" id="prepare_translate_iframe"></iframe>
</doby>
</html>';
    
	$index_file_path = $this->translates_path . '/' . self::INDEX_FILE;
    file_put_contents($index_file_path, $index_html);
    echo "Index file ready: " . $index_file_path . "\n";
  }
  
  
  /**
   * Рекурсивный поиск файлов и вызов коллбэк-функции.
   *
   * @param unknown_type $path
   * @param unknown_type $pattern
   * @param unknown_type $callback
   */
  protected function findFiles($path, $pattern, $callback) {
    $path = rtrim(str_replace("\\", "/", $path), '/') . '/';
    $matches = Array();
    $entries = Array();
    $dir = dir($path);
    while (false !== ($entry = $dir->read())) {
      $entries[] = $entry;
    }
    $dir->close();
    foreach ($entries as $entry) {
      $fullname = $path . $entry;
      if ($entry != '.' && $entry != '..' && is_dir($fullname)) {
        $this->findFiles($fullname, $pattern, $callback);
      } else if (is_file($fullname) && preg_match($pattern, $entry)) {
        $this->$callback( $fullname );
      }
    }
  }
  
}
