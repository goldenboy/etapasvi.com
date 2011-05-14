<?php

class TextPeer extends BaseTextPeer
{
	
  const LINK_MAX_LENGTH = 70;

  public static function urlTranslit($text, $culture = '')
  {
    if (!$culture) {
        $culture = sfContext::getInstance()->getUser()->getCulture();
    }
      
  	//$text = str_replace( " ", "-", trim($text) );
	$tr = array(
		"ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
		" "=>"-", "039"=>"", "\""=>"", "&quot;"=>""
	);	  	
  	$text = strtr($text,$tr);
  	
	// транслитерация для русского из массива
	// английский транслитирируется регулярными выражениями
	if (!UserPeer::isCultureHieroglyphic($culture)) {
      	if ($culture == 'ru') {
    	  $tr = array(
    			"Ґ"=>"G","Ё"=>"Yo","Є"=>"E","Ї"=>"Yi","І"=>"I",
    			"і"=>"i","ґ"=>"g","ё"=>"yo","№"=>"#","є"=>"e",
    			"ї"=>"yi","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
    			"Д"=>"D","Е"=>"E","Ж"=>"Zh","З"=>"Z","�?"=>"I","И"=>"I",
    			"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
    			"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
    			"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"Ch",
    			"Ш"=>"Sh","Щ"=>"Sch","Ъ"=>"'","Ы"=>"Y","Ь"=>"",
    			"Э"=>"E","Ю"=>"Yu","Я"=>"Ya","а"=>"a","б"=>"b",
    			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"zh",
    			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
    			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
    			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
    			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"'",
    			"ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
    	  );			
    	  $text = strtr($text,$tr);  
      	} elseif( $culture != 'en') {
      	  $text = self::transliteration_process($text);
      	}
	}
	$text = strtolower($text);
	$text = preg_replace( '/[^A-z0-9_-]/', '', $text );
	$text = preg_replace( '/-+/', '-', $text );
	
	return $text;
  }
  	
	/**
	 * Transliterate UTF-8 input to plain ASCII.
	 *
	 * Based on Mediawiki's UtfNormal::quickIsNFCVerify().
	 *
	 * @param string $string
	 *   UTF-8 text input.
	 * @param string $unknown
	 *   Replacement for unknown characters and illegal UTF-8 sequences.
	 * @param string $langcode
	 *   Optional ISO 639 language code used to import language specific
	 *   replacements. Defaults to the current display language.
	 *
	 * @return string
	 *   Plain ASCII output.
	 * @see transliteration_get()
	 */
	private static function transliteration_process($string, $unknown = '', $langcode = NULL) {
	  // Screen out some characters that eg won't be allowed in XML.
	  $string = preg_replace('/[\x00-\x08\x0b\x0c\x0e-\x1f]/', $unknown, $string);
	
	  // ASCII is always valid NFC!
	  // If we're only ever given plain ASCII, we can avoid the overhead
	  // of initializing the decomposition tables by skipping out early.
	  if (!preg_match('/[\x80-\xff]/', $string)) {
	    return $string;
	  }
	
	  static $tailBytes;
	
	  if (!isset($tailBytes)) {
	    // Each UTF-8 head byte is followed by a certain
	    // number of tail bytes.
	    $tailBytes = array();
	    for ($n = 0; $n < 256; $n++) {
	      if ($n < 0xc0) {
	        $remaining = 0;
	      }
	      elseif ($n < 0xe0) {
	        $remaining = 1;
	      }
	      elseif ($n < 0xf0) {
	        $remaining = 2;
	      }
	      elseif ($n < 0xf8) {
	        $remaining = 3;
	      }
	      elseif ($n < 0xfc) {
	        $remaining = 4;
	      }
	      elseif ($n < 0xfe) {
	        $remaining = 5;
	      }
	      else {
	        $remaining = 0;
	      }
	      $tailBytes[chr($n)] = $remaining;
	    }
	  }
	
	  // Chop the text into pure-ASCII and non-ASCII areas;
	  // large ASCII parts can be handled much more quickly.
	  // Don't chop up Unicode areas for punctuation, though,
	  // that wastes energy.
	  preg_match_all('/[\x00-\x7f]+|[\x80-\xff][\x00-\x40\x5b-\x5f\x7b-\xff]*/', $string, $matches);
	
	  $result = '';
	  foreach ($matches[0] as $str) {
	    if ($str{0} < "\x80") {
	      // ASCII chunk: guaranteed to be valid UTF-8
	      // and in normal form C, so skip over it.
	      $result .= $str;
	      continue;
	    }
	
	    // We'll have to examine the chunk byte by byte to ensure
	    // that it consists of valid UTF-8 sequences, and to see
	    // if any of them might not be normalized.
	    //
	    // Since PHP is not the fastest language on earth, some of
	    // this code is a little ugly with inner loop optimizations.
	
	    $head = '';
	    $chunk = strlen($str);
	    // Counting down is faster. I'm *so* sorry.
	    $len = $chunk + 1;
	
	    for ($i = -1; --$len; ) {
	      $c = $str{++$i};
	      if ($remaining = $tailBytes[$c]) {
	        // UTF-8 head byte!
	        $sequence = $head = $c;
	        do {
	          // Look for the defined number of tail bytes...
	          if (--$len && ($c = $str{++$i}) >= "\x80" && $c < "\xc0") {
	            // Legal tail bytes are nice.
	            $sequence .= $c;
	          }
	          else {
	            if ($len == 0) {
	              // Premature end of string!
	              // Drop a replacement character into output to
	              // represent the invalid UTF-8 sequence.
	              $result .= $unknown;
	              break 2;
	            }
	            else {
	              // Illegal tail byte; abandon the sequence.
	              $result .= $unknown;
	              // Back up and reprocess this byte; it may itself
	              // be a legal ASCII or UTF-8 sequence head.
	              --$i;
	              ++$len;
	              continue 2;
	            }
	          }
	        } while (--$remaining);
	
	        $n = ord($head);
	        if ($n <= 0xdf) {
	          $ord = ($n - 192) * 64 + (ord($sequence{1}) - 128);
	        }
	        else if ($n <= 0xef) {
	          $ord = ($n - 224) * 4096 + (ord($sequence{1}) - 128) * 64 + (ord($sequence{2}) - 128);
	        }
	        else if ($n <= 0xf7) {
	          $ord = ($n - 240) * 262144 + (ord($sequence{1}) - 128) * 4096 + (ord($sequence{2}) - 128) * 64 + (ord($sequence{3}) - 128);
	        }
	        else if ($n <= 0xfb) {
	          $ord = ($n - 248) * 16777216 + (ord($sequence{1}) - 128) * 262144 + (ord($sequence{2}) - 128) * 4096 + (ord($sequence{3}) - 128) * 64 + (ord($sequence{4}) - 128);
	        }
	        else if ($n <= 0xfd) {
	          $ord = ($n - 252) * 1073741824 + (ord($sequence{1}) - 128) * 16777216 + (ord($sequence{2}) - 128) * 262144 + (ord($sequence{3}) - 128) * 4096 + (ord($sequence{4}) - 128) * 64 + (ord($sequence{5}) - 128);
	        }
	        $result .= self::_transliteration_replace($ord, $unknown, $langcode);
	        $head = '';
	      }
	      elseif ($c < "\x80") {
	        // ASCII byte.
	        $result .= $c;
	        $head = '';
	      }
	      elseif ($c < "\xc0") {
	        // Illegal tail bytes.
	        if ($head == '') {
	          $result .= $unknown;
	        }
	      }
	      else {
	        // Miscellaneous freaks.
	        $result .= $unknown;
	        $head = '';
	      }
	    }
	  }
	  return $result;
	}
	
	/**
	 * Lookup and replace a character from the transliteration database.
	 *
	 * @param integer $ord
	 *   A unicode ordinal character code.
	 * @param string $unknown
	 *   Replacement for unknown characters.
	 * @param string $langcode
	 *   Optional ISO 639 language code used to import language specific
	 *   replacements. Defaults to the current display language.
	 *
	 * @return string
	 *   Plain ASCII replacement character.
	 * @see transliteration_get()
	 */
	private static function _transliteration_replace($ord, $unknown = '', $langcode = NULL) {
	  /*if (!isset($langcode)) {
	    global $language;
	    $langcode = $language->language;
	  }*/
	  static $map = array(), $template = array();
	
	  $bank = $ord >> 8;
	
	  // Check if we need to load a new bank
	  if (!isset($template[$bank])) {
	    $file = sfConfig::get('sf_lib_dir') . '/utf8_to_ascii/' . sprintf('x%02x', $bank) . '.php';
	    if (file_exists($file)) {
	      $template[$bank] = require_once($file);
	    }
	    else {
	      $template[$bank] = array('en' => array());
	    }

	  }
	
	  // Check if we need to create new mappings with language specific alterations
	  if (!isset($map[$bank][$langcode])) {
	    /*if ($langcode != 'en' && isset($template[$bank][$langcode])) {
	      // Merge language specific mappings with the default transliteration table
	      $map[$bank][$langcode] = $template[$bank][$langcode] + $template[$bank]['en'];
	    }
	    else {*/
	    $map[$bank][$langcode] = $template[$bank]['en'];
	    //}
	  }
	
	  $ord = $ord & 255;
	
	  return isset($map[$bank][$langcode][$ord]) ? $map[$bank][$langcode][$ord] : $unknown;
	}
	
	/**
	 * Подготавливает текст, введённый в админке, к выводу.
	 * 
	 * Если в тексте содержится ссылка на Google Docs, возвращается текст документа
	 *
	 * @param текст $text
	 * @param кол-во переводов строк <br/> $br_count
	 * @return unknown
	 */
	public static function prepareText($text, $br_count = 2) {
		
		if (preg_match("/^https\:\/\/docs.google.com/", $text)) {
			
			// выводим Google-Документ
			
			$text = '<iframe width="100%" id="gd" style="border:0;height:600px" border="0" frameBorder="0" src="' 
					. $text . '" class="autoHeight" ></iframe>';
			
			/*
			// получаем документ Google Docs
			$text = file_get_contents($text . '&t=' . time());
			
			// вырезаем лишние теги
			$text = preg_replace("/(<\/?html>|<\/?head>|<meta [^>]+>|<title>[^<]+<\/title>|<\/?body[^>]*>)/", '', $text);
			// удаляем стили body и заголовков, обычно идут в конце
			$text = preg_replace("/<\/?body[^>]*>|body{[^>]+<\/style>/", '</style>', $text);
			$text = preg_replace("/(font-family:[^;]+;|font-size:[^;]+;|p{margin\:0})/", '', $text);*/
		} else {
			$text = nl2br($text);
			$br_repeated = str_repeat('<br />', $br_count);
			$text = str_ireplace( '<br />', $br_repeated, $text );
		}		

		return $text;
	}
	
	/**
	 * Обрезает длинные ссылки
	 *
	 * @param unknown_type $link
	 * @return unknown
	 */
	public static function cropLink($link) {
		if (strlen($link) > self::LINK_MAX_LENGTH) {
			$link = substr($link, 0, self::LINK_MAX_LENGTH) . '...';
		}
		return $link;
	}
	
	public static function subStr($text, $length, $start = 0 )
	{
		if ($text) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
			if ( $culture == 'ru' ) {
				$text = iconv( 'UTF8', 'CP1251', $text );
			}
			$text = mb_substr($text, $start, $length);	
			if ( $culture == 'ru' ) {
				$text = iconv( 'CP1251', 'UTF8', $text );					
			}
			return $text;
		} else {
			return '';
		}		
	}
	
  
}