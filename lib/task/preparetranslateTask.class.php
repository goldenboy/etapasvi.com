<?php
/**
 * Подготовка файлов переводов symfony.
 * Берутся файлы messages.ru.xml, из них удаляется перевод, затем файлы складываются в /uploads/
 * deprecated директории пропускаем.
 *
 */

class preparetranslateTask extends sfBaseTask
{
  const PREPARED_MESSAGES_DIR            = 'translate';
  const OTHER_MESSAGES_CODE  = 'other';
  // язык, который берётся за образец
  const ORIGINAL_CULTURE                 = 'ru';
  // расширение конечных файлов переводаы
  const FILE_EXT                         = 'html';
  // файл со списком страниц переводов
  const INDEX_FILE                       = 'index.html';
  
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
        $url = $routing->generate('main');
      }
      $url = 'http://' . UserPeer::DOMAIN_NAME_MAIN . $url;
      
      if (!empty($dest_text)) {
        $dest_text .= TextPeer::TRANSLATE_ITEMS_DELIMITER;
$dest_text = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="" />
<title>eTapasvi.com interface translation</title>
<link rel="shortcut icon" type="image/x-icon" href="http://www.etapasvi.com/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.etapasvi.com/css/css.css" /> 
</head>
<body>
<strong>URL: <a href="' . $url . '" target="_blank">' . $url . '</a></strong><br/><br/>
<strong>Tutorial:</strong><br/>
<textarea style="width:95%;font-family:courier" rows="6" readonly="readonly">' . TextPeer::TRANSLATE_ITEMS_DELIMITER . 
'
Here is text to be translated
' . TextPeer::TRANSLATE_BETWEEN_DELIMITER . 
'
Translation should be placed here
' . TextPeer::TRANSLATE_ITEMS_DELIMITER . '</textarea>
<br/><br/>
<strong>Copy text below into any text editor, translate and send to ' . MailPeer::MAIL_ADDRESS . ':<strong><br/>
<textarea style="width:95%;font-family:courier" rows="35" readonly="readonly">' . $dest_text . '</textarea>
<br/><br/>
</body>
</html>';

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
    // /home/saynt2day20/etapasvi.com/apps/frontend/modules/contactus/i18n/messages.ru.xml
    // в
    // /home/saynt2day20/etapasvi.com/www/uploads/translate/other/contactus.xml        
    
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
    // /home/saynt2day20/etapasvi.com/apps/frontend/modules/contactus/i18n/messages.ru.xml
    // в
    // /home/saynt2day20/etapasvi.com/www/uploads/translate/ru/contactus.ru.xml   
     
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
	<strong>Language:</strong> <select onchange="showModules(this)">
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
      $index_html .= '<div id="' . $culture . '_modules" class="' . ($culture != self::OTHER_MESSAGES_CODE ? 'hidden' : '') . ' modules"><strong>Module:</strong> <select onchange="loadTranslate(this)">';
      foreach ($this->module_list as $module) {
    	$index_html .= '<option value="http://' . UserPeer::DOMAIN_NAME_MAIN . '/uploads/' . self::PREPARED_MESSAGES_DIR . '/' .
    					$culture . '/' . $module . '.' . $culture . '.' . self::FILE_EXT . '" target="prepare_translate_iframe">' . 
    					$module . '</option>';
      }
      $index_html .= '</select></div>';
    }

    
	$index_html .= '<br/>
    <iframe frameborder="0" border="0" width="100%" height="740" src="http://' . UserPeer::DOMAIN_NAME_MAIN . '/uploads/' . self::PREPARED_MESSAGES_DIR . '/' .
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
