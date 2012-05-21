<?php
/**
 * Класс сначала относился к модели User.
 * Потом модель стала не нужна, и стал использоваться самостоятельно.
 *
 */

class UserPeer extends BaseUserPeer
{
	const SERVERS_FRONTENDS = 'frontends';
	const SERVERS_BACKENDS  = 'backends';

	// языки
	static protected $cultures = array(
	
		'en' => array('name'    			 => 'English',
		              'iso'     			 => 'en',
		              //http://us2.admin.mailchimp.com/lists/settings/?id=428077
		              //'mail_id' 			 => '39719cc12b',
		              // категория Disqus
		              'comments_category_id' => 668704,
		              // язык интерфейса FeedBurner
		              'feedburner_loc' 		 => 'en_US'
		),            
		'ru' => array('name'    			 => 'Русский',
		              'iso'     			 => 'ru',		              
		              //'mail_id' 			 => '25b1a7f858',
		              'comments_category_id' => 686465,
		              'feedburner_loc' 		 => 'ru_RU'
		),
		'cs' => array('name'    			 => 'Čeština',
		              'iso'     			 => 'cz',
		              'comments_category_id' => 686584,
		              'feedburner_loc' 		 => ''
		),
		'hu' => array('name'    			 => 'Magyar',
		              'iso'     			 => 'hu',
		              'comments_category_id' => 686585,
		              'feedburner_loc' 		 => ''
		),
		'pl' => array('name'    			 => 'Polski',
		              'iso'     			 => 'pl',
		              //'mail_id' 			 => '99862a8230',
		              'comments_category_id' => 686580,
		              'feedburner_loc' 		 => ''
		),
		'fr' => array('name'    			 => 'Français',
		              'iso'     			 => 'fr',
		              //'mail_id' 			 => '430d7d6d8b',
		              'comments_category_id' => 686581,
		              'feedburner_loc' 		 => 'fr_FR'
		),
		// Mandarin Chinese (Simplified script) - упрошённый китайский
		'zh_CN'  => array(
					  'name'          		 => '简体中文',
		              'iso'           		 => 'zh-cn',
		              'hieroglyphic'  		 => true,
		              //'mail_id' 	  		 => '33bb475372',
		              'comments_category_id' => 686582,
		              'feedburner_loc' 		 => ''
		),
		'vi' => array('name'    			 => 'Tiếng Việt',
		              'iso'     			 => 'vn',
		              //'mail_id' 			 => '68f2a2996d',
		              'comments_category_id' => 686583,
		              'feedburner_loc' 		 => ''
		),       
		'ja' => array('name'    			 => '日本語',
		              'iso'     			 => 'jp',
		              'hieroglyphic'  		 => true,
		              //'mail_id' 			 => '77a5eb7cd2',
		              'comments_category_id' => 686578,
		              'feedburner_loc' 		 => 'ja_JP',
		),
		'es' => array('name'    			 => 'Español',
		              'iso'     			 => 'es',
		              //'mail_id' 			 => '6f9b50c196',
		              'comments_category_id' => 686579,
		              'feedburner_loc' 		 => 'es_ES',
		              'disqus_culture' 		 => 'es_ES'
		),
		'it' => array('name'    			 => 'Italiano',
		              'iso'     			 => 'it',
		              //'mail_id' 			 => 'ddd87d0746',
		              'comments_category_id' => 686577,
		              'feedburner_loc' 		 => ''
		),
/*		              		              

		'sk' => array('name'    => 'sk - Slovenčina',
		              'iso'     => 'sk'),	

		'uk' => array('name'    => 'ua - Українська',
		              'iso'     => 'ua'),*/
		'et' => array('name'    			 => 'Eesti',
		              'iso'     			 => 'ee',
		              'comments_category_id' => 997486,
		              'feedburner_loc' 		 => ''
		),
		'ne' => array('name'    			 => 'नेाी',
		              'iso'     			 => 'ne',
		              'hieroglyphic'  		 => true,
		              'comments_category_id' => 1102690,
		              //'feedburner_loc' 		 => 'ru_RU'
		              'disqus_culture' 		 => 'en'
		),
		'bn' => array('name'    			 => 'বাংলা',
		              'iso'     			 => 'bn',
		              'hieroglyphic'  		 => true,
		              'large_text'	 		 => true,
		              'comments_category_id' => 1110606,
		              //'feedburner_loc' 		 => 'ru_RU'
					  'disqus_culture' 		 => 'en'
		),
		// Mandarin Chinese (Simplified script) - упрошённый китайский
		'zh_CN'  => array(
					  'name'          		 => '简体中文',
		              'iso'           		 => 'zh-cn',
		              'hieroglyphic'  		 => true,
		              //'mail_id' 	  		 => '33bb475372',
		              'comments_category_id' => 686582,
		              'feedburner_loc' 		 => ''
		),				
		'he' => array(
					  'name'     			 => 'עברית',
                      'iso'      			 => 'he',				
		              'hieroglyphic'  		 => true,
		              'large_text'	 		 => true,
		              'comments_category_id' => 1417916,
		              'feedburner_loc' 		 => '',
		              'direction_rtl' 		 => true
         ),
         // Taiwan / Lee Ming / Traditional Chinese language
		'zh_TW' => array(
					  'name'     			 => '傳統漢字',
                      'iso'      			 => 'zh-tw',				
		              'hieroglyphic'  		 => true,
		              'comments_category_id' => 1417917,
		              'feedburner_loc' 		 => '',
		              'disqus_culture' 		 => 'zh_HANT'
         ),
		'de' => array('name'     			 => 'Deutsch',
                      'iso'      			 => 'de',						             
		              'comments_category_id' => 1456893,
		              'feedburner_loc' 		 => '',
		              'disqus_culture' 		 => 'de_formal'
		),
	);
	
	 
	// список языков по 
	// http://msdn.microsoft.com/en-us/library/ms533052%28v=vs.85%29.aspx
	// http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
	// и имеющихся в симфони
	// в симфони нет:
    //    Array
    //    (
    //        [0] => gd
    //        [1] => rm
    //        [2] => ro-mo
    //        [3] => ru-mo
    //        [4] => sb
    //        [5] => sx
    //        [6] => ts
    //        [7] => ji
    //        [8] => sz
    //        [9] => tn
    //        [10] => ve
    //        [11] => xh
    //    )
    /*
      '' => array('name'     => '',
                  'en'       => '',
                  'iso'      => ''
      ),
    */
    static public $all_cultures = array (
      'af' => array('name'     => 'Afrikaans',
                    'en'       => 'Afrikaans',
                    'iso'      => 'af'
      ),
      'sq' => array('name'     => 'Shqip',
                    'en'       => 'Albanian',
                    'iso'      => 'sq'
      ),
      'ar_IQ' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Iraq)',
                       'iso'      => 'ar'
      ),
      'ar_LY' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Libya)',
                       'iso'      => 'ar'
      ),
      'ar_MA' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Morocco)',
                       'iso'      => 'ar'
      ),
      'ar_OM' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Oman)',
                       'iso'      => 'ar'
      ),
      'ar_SY' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Syria)',
                       'iso'      => 'ar'
      ),
      'ar_LB' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Lebanon)',
                       'iso'      => 'ar'
      ),
      'ar_AE' => array('name'     => 'العربية',
                       'en'       => 'Arabic (U.A.E.)',
                       'iso'      => 'ar'
      ),
      'ar_QA' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Qatar)',
                       'iso'      => 'ar'
      ),
      'ar_SA' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Saudi Arabia)',
                       'iso'      => 'ar'
      ),
      'ar_EG' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Egypt)',
                       'iso'      => 'ar'
      ),
      'ar_DZ' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Algeria)',
                       'iso'      => 'ar'
      ),
      'ar_TN' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Tunisia)',
                       'iso'      => 'ar'
      ),
      'ar_YE' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Yemen)',
                       'iso'      => 'ar'
      ),
      'ar_JO' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Jordan)',
                       'iso'      => 'ar'
      ),
      'ar_KW' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Kuwait)',
                       'iso'      => 'ar'
      ),
      'ar_BH' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Bahrain)',
                       'iso'      => 'ar'
      ),
      'eu' => array('name'     => 'Euskara',
                    'en'       => 'Basque',
                    'iso'      => 'eu'
      ),
      'be' => array('name'     => 'Беларуская',
                    'en'       => 'Belarusian',
                    'iso'      => 'be'
      ),      
	  'bn' => array('name'     => 'বাংলা',
					'en'       => 'Bengali',
                    'iso'      => 'bn'
	  ),
      'bg' => array('name'     => 'Български език',
                    'en'       => 'Bulgarian',
                    'iso'      => 'bg'
      ),
      'ca' => array('name'     => 'Català',
                    'en'       => 'Catalan',
                    'iso'      => 'ca'
      ),
      'zh_CN' => array('name'     => '简体中文',
                       'en'       => 'Chinese (PRC)',
                       'iso'      => 'zh'
      ),
      'zh_SG' => array('name'     => '简体中文',
                       'en'       => 'Chinese (Singapore)',
                       'iso'      => 'zh'
      ),
      'zh_TW' => array('name'     => '简体中文',
                       'en'       => 'Chinese (Taiwan)',
                       'iso'      => 'zh-tw'
      ),
      'zh_HK' => array('name'     => '简体中文',
                       'en'       => 'Chinese (Hong Kong SAR)',
                       'iso'      => 'zh'
      ),        
      'hr' => array('name'     => 'Hrvatski',
                    'en'       => 'Croatian',
                    'iso'      => 'hr'
      ),
      'cs' => array('name'     => 'Čeština',
                    'en'       => 'Czech',
                    'iso'      => 'cs'
      ),   
      'da' => array('name'     => 'Dansk',
                    'en'       => 'Danish',
                    'iso'      => 'da'
      ),
      'nl' => array('name'     => 'Nederlands',
                    'en'       => 'Dutch',
                    'iso'      => 'nl'
      ), 
//      'nl_BE' => array('name'     => 'Nederlands',
//                       'en'       => 'Dutch (Belgium)',
//                       'iso'      => 'nl'
//      ),
//      'en_US' => array('name'     => 'English',
//                       'en'       => 'English (United States)',
//                       'iso'      => 'en'
//      ),
//      'en_AU' => array('name'     => '',
//                  'en'       => 'English (Australia)',
//                  'iso'      => ''
//      ),
//      'en_NZ' => array('name'     => '',
//                  'en'       => 'English (New Zealand)',
//                  'iso'      => ''
//      ),
//      'en_ZA' => array('name'     => '',
//                  'en'       => 'English (South Africa)',
//                  'iso'      => ''
//      ),
      'en' => array('name'     => 'English',
                    'en'       => 'English',
                    'iso'      => 'en'
      ),
//      'en_TT' => array('name'     => '',
//                  'en'       => 'English (Trinidad)',
//                  'iso'      => ''
//      ),
//      'en_GB' => array('name'     => '',
//                  'en'       => 'English (United Kingdom)',
//                  'iso'      => ''
//      ),
//      'en_CA' => array('name'     => '',
//                  'en'       => 'English (Canada)',
//                  'iso'      => ''
//      ),
//      'en_IE' => array('name'     => '',
//                  'en'       => 'English (Ireland)',
//                  'iso'      => ''
//      ),
//      'en_JM' => array('name'     => '',
//                  'en'       => 'English (Jamaica)',
//                  'iso'      => ''
//      ),
//      'en_BZ' => array('name'     => '',
//                  'en'       => 'English (Belize)',
//                  'iso'      => ''
//      ),
      'et' => array('name'     => 'Eesti',
                    'en'       => 'Estonian',
                    'iso'      => 'et'
      ),
      'fo' => array('name'     => 'Føroyskt',
                    'en'       => 'Faeroese',
                    'iso'      => 'fo'
      ),
      'fa' => array('name'     => 'فارسی',
                    'en'       => 'Farsi',
                    'iso'      => 'fa'
      ),
      'fi' => array('name'     => 'Suomi',
                    'en'       => 'Finnish',
                    'iso'      => 'fi'
      ),
      'fr' => array('name'     => 'Français',
                    'en'       => 'French',
                    'iso'      => 'fr'
      ),
//      'fr_CA' => array('name'     => '',
//                       'en'       => 'French (Canada)',
//                       'iso'      => ''
//      ),
//      'fr_LU' => array('name'     => '',
//                  'en'       => 'French (Luxembourg)',
//                  'iso'      => ''
//      ),
//      'fr_BE' => array('name'     => '',
//                       'en'       => 'French (Belgium)',
//                       'iso'      => ''
//      ),
//      'fr_CH' => array('name'     => '',
//                  'en'       => 'French (Switzerland)',
//                  'iso'      => ''
//      ),
      'gd' => array('name'     => 'Gàidhlig',
                    'en'       => 'Gaelic (Scotland)',
                    'iso'      => 'gd'
      ),            
      'de' => array('name'     => 'Deutsch',
                    'en'       => 'German',
                    'iso'      => 'de'
      ),
//      'de_CH' => array('name'     => '',
//                  'en'       => 'German (Switzerland)',
//                  'iso'      => ''
//      ),
//      'de_LU' => array('name'     => '',
//                  'en'       => 'German (Luxembourg)',
//                  'iso'      => ''
//      ),
//      'de_AT' => array('name'     => '',
//                       'en'       => 'German (Austria)',
//                       'iso'      => ''
//      ),
//      'de_LI' => array('name'     => '',
//                  'en'       => 'German (Liechtenstein)',
//                  'iso'      => ''
//      ),
      'el' => array('name'     => 'Ελληνικά',
                    'en'       => 'Greek',
                    'iso'      => 'el'
      ),
      'he' => array('name'     => 'עברית',
                    'en'       => 'Hebrew',
                    'iso'      => 'he'
      ),
      'hi' => array('name'     => 'हिन्दी',
                    'en'       => 'Hindi',
                    'iso'      => 'hi'
      ),
      'hu' => array('name'     => 'Magyar',
                    'en'       => 'Hungarian',
                    'iso'      => 'hu'
      ),
      'is' => array('name'     => 'Íslenska',
                    'en'       => 'Icelandic',
                    'iso'      => 'is'
      ),
      'id' => array('name'     => 'Bahasa Indonesia',
                    'en'       => 'Indonesian',
                    'iso'      => 'id'
      ),
      'ga' => array('name'     => 'Gaeilge',
                    'en'       => 'Irish',
                    'iso'      => 'ga'
      ),
      'it' => array('name'     => 'Italiano',
                    'en'       => 'Italian',
                    'iso'      => 'it'
      ),
//      'it_CH' => array('name'     => 'Italiano',
//                       'en'       => 'Italian (Switzerland)',
//                       'iso'      => 'it'
//      ),
      'ja' => array('name'     => '日本語',
                    'en'       => 'Japanese',
                    'iso'      => 'ja'
      ),
      'ko' => array('name'     => '한국어 (韓國語)',
                    'en'       => 'Korean (Johab)',
                    'iso'      => 'ko'
      ),
      'lv' => array('name'     => 'Latviešu valoda',
                    'en'       => 'Latvian',
                    'iso'      => 'lv'
      ),
      'lt' => array('name'     => 'Lietuvių kalba',
                    'en'       => 'Lithuanian',
                    'iso'      => 'lt'
      ),
      'mk' => array('name'     => 'Македонски јазик',
                    'en'       => 'Macedonian (FYROM)',
                    'iso'      => 'mk'
      ),
      'ms' => array('name'     => 'Bahasa Melayu, بهاس ملايو',
                    'en'       => 'Malay',
                    'iso'      => 'ms'
      ),
      'mt' => array('name'     => 'Malti',
                    'en'       => 'Maltese',
                    'iso'      => 'mt'
      ),
      'ne' => array('name'     => 'नेपाली',
                    'en'       => 'Nepali',
                    'iso'      => 'ne'
      ),
      'no' => array('name'     => 'Norsk bokmål',
                    'en'       => 'Norwegian (Bokmal)',
                    'iso'      => 'nb'
      ),
      'pl' => array('name'     => 'Polski',
                    'en'       => 'Polish',
                    'iso'      => 'pl'
      ),
      'pt' => array('name'     => 'Português',
                    'en'       => 'Portuguese (Portugal)',
                    'iso'      => 'pt',
                    'disqus_culture' => 'pt_EU',
      ),
//      'pt_BR' => array('name'     => 'Português',
//                       'en'       => 'Portuguese (Brazil)',
//                       'iso'      => 'pt'
//      ),
      'ro' => array('name'     => 'Română',
                    'en'       => 'Romanian',
                    'iso'      => 'ro'
      ),
//      'ro_MO' => array('name'     => 'Română',
//                       'en'       => 'Romanian (Republic of Moldova)',
//                       'iso'      => 'ro'
//      ),
      'rm' => array('name'     => 'Rumantsch grischun',
                    'en'       => 'Romansh',
                    'iso'      => 'rm'
      ),
      'ru' => array('name'     => 'Русский',
                    'en'       => 'Russian',
                    'iso'      => 'ru'
      ),
//      'ru_MO' => array('name'     => '',
//                  'en'       => 'Russian (Republic of Moldova)',
//                  'iso'      => ''
//      ),
     'sz' => array('name'     => 'Davvisámegiella',
                    'en'       => 'Sami (Lappish)',
                    'iso'      => 'se'
      ),
      'sr' => array('name'     => 'Српски језик',
                    'en'       => 'Serbian (Latin)',
                    'iso'      => 'sr',
                    'disqus_culture'      => 'sr_LATIN'
      ),
      'sk' => array('name'     => 'Slovenčina',
                    'en'       => 'Slovak',
                    'iso'      => 'sk'
      ),
      'sl' => array('name'     => 'Slovenščina',
                    'en'       => 'Slovenian',
                    'iso'      => 'sl'
      ),
      'sb' => array('name'     => 'Serbsce',
                    'en'       => 'Sorbian',
                    'iso'      => 'sb' // не найдено
      ),
      'es' => array('name'     => 'Español',
                    'en'       => 'Spanish (Spain)',
                    'iso'      => 'es'
      ),
//      'es_GT' => array('name'     => '',
//                  'en'       => 'Spanish (Guatemala)',
//                  'iso'      => ''
//      ),
//      'es_PA' => array('name'     => '',
//                  'en'       => 'Spanish (Panama)',
//                  'iso'      => ''
//      ),
//      'es_VE' => array('name'     => '',
//                  'en'       => 'Spanish (Venezuela)',
//                  'iso'      => ''
//      ),
//      'es_PE' => array('name'     => '',
//                  'en'       => 'Spanish (Peru)',
//                  'iso'      => ''
//      ),
//      'es_EC' => array('name'     => '',
//                  'en'       => 'Spanish (Ecuador)',
//                  'iso'      => ''
//      ),
//      'es_UY' => array('name'     => '',
//                  'en'       => 'Spanish (Uruguay)',
//                  'iso'      => ''
//      ),
//      'es_BO' => array('name'     => '',
//                  'en'       => 'Spanish (Bolivia)',
//                  'iso'      => ''
//      ),
//      'es_HN' => array('name'     => '',
//                  'en'       => 'Spanish (Honduras)',
//                  'iso'      => ''
//      ),
//      'es_PR' => array('name'     => '',
//                  'en'       => 'Spanish (Puerto Rico)',
//                  'iso'      => ''
//      ),
//      'es_MX' => array('name'     => '',
//                  'en'       => 'Spanish (Mexico)',
//                  'iso'      => ''
//      ),
//      'es_CR' => array('name'     => '',
//                  'en'       => 'Spanish (Costa Rica)',
//                  'iso'      => ''
//      ),
//      'es_DO' => array('name'     => '',
//                  'en'       => 'Spanish (Dominican Republic)',
//                  'iso'      => ''
//      ),
//      'es_CO' => array('name'     => '',
//                  'en'       => 'Spanish (Colombia)',
//                  'iso'      => ''
//      ),
//      'es_AR' => array('name'     => '',
//                  'en'       => 'Spanish (Argentina)',
//                  'iso'      => ''
//      ),
//      'es_CL' => array('name'     => '',
//                  'en'       => 'Spanish (Chile)',
//                  'iso'      => ''
//      ),
//      'es_PY' => array('name'     => '',
//                  'en'       => 'Spanish (Paraguay)',
//                  'iso'      => ''
//      ),
//      'es_SV' => array('name'     => '',
//                  'en'       => 'Spanish (El Salvador)',
//                  'iso'      => ''
//      ),
//      'es_NI' => array('name'     => '',
//                  'en'       => 'Spanish (Nicaragua)',
//                  'iso'      => ''
//      ),
      'sv' => array('name'     => 'Svenska',
                    'en'       => 'Swedish',
                    'iso'      => 'sv',
                    'disqus_culture' => 'sv_SE',
      ),

      // неизвестный
//      'sx' => array('name'     => '',
//                  'en'       => 'Sutu',
//                  'iso'      => ''
//      ),
//      'sv_FI' => array('name'     => '',
//                  'en'       => 'Swedish (Finland)',
//                  'iso'      => ''
//      ),
      'th' => array('name'     => 'ไทย',
                    'en'       => 'Thai',
                    'iso'      => 'th'
      ),
      'ts' => array('name'     => 'Xitsonga',
                    'en'       => 'Tsonga',
                    'iso'      => 'ts'
      ),
      'tn' => array('name'     => 'Setswana',
                    'en'       => 'Tswana',
                    'iso'      => 'tn'
      ),
      'tr' => array('name'     => 'Türkçe',
                    'en'       => 'Turkish',
                    'iso'      => 'tr'
      ),
      'uk' => array('name'     => 'українська',
                    'en'       => 'Ukrainian',
                    'iso'      => 'uk'
      ),
      'ur' => array('name'     => 'اردو',
                    'en'       => 'Urdu',
                    'iso'      => 'ur'
      ),
      've' => array('name'     => 'Tshivenḓa',
                    'en'       => 'Venda',
                    'iso'      => 've'
      ),
      'vi' => array('name'     => 'Tiếng Việt',
                    'en'       => 'Vietnamese',
                    'iso'      => 'vi'
      ),
      'xh' => array('name'     => 'isiXhosa',
                    'en'       => 'Xhosa',
                    'iso'      => 'xh'
      ),      
      'ji' => array('name'     => 'ייִדיש',
                    'en'       => 'Yiddish',
                    'iso'      => 'yi'
      ),            
      'zu' => array('name'     => 'isiZulu',
                    'en'       => 'Zulu',
                    'iso'      => 'zu'
      )
    );
	
	//const DEFAULT_CULTURE = 'en';
	
	// доменное имя, которое используется по умолчанию вне приложения
	const DOMAIN_NAME_MAIN   		 = 'www.etapasvi.com';
	
	const FORUM_URL   		 		 = 'http://forum.etapasvi.com';
	// список доменных имён
	public static $domain_name_list  = array('www.etapasvi.com', 'm.etapasvi.com');
	
	//const SITE_NAME       = 'eTapasvi';
	//const SITE_PROTOCOL   = 'http';
		
	// имена cookie
	//const REMEMBER_ME_COOKIE = 'sdfgjlk';
	//const CULTURE_COOKIE	 = '307c73fdf6de7';
	
	// указатели что добавляем при добавления комментариев
	// Не делать нулевыми, т.к. идёт проверка
	/*const FROM_IDEA 			= 1; // добавляем идею
	const FROM_IDEA_COMMENT 	= 2; // комментарий к идее
	const FROM_IDEA_VOTE		= 3; // голос к идее
	const FROM_IDEA_ABUSE		= 4; // жалоба на идею
	const FROM_NEWS_COMMENT		= 5; // комментарий к новости
	const FROM_PHOTO_COMMENT	= 6; // комментарий к фото
	const FROM_VIDEO_COMMENT	= 7; // комментарий к видео*/
	
	//const ADMIN_MAIL 	   = 'saynt2day@gmail.com';
	//const ADMIN_NAME 	   = 'eTapasvi';
	
	// PHPBB
	//const PHPBB_SECRET = 'f6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fdf6de7e7537acc69fc9072bef307c73fd';	
	//const USER_ADD_URL = 'http://www.etapasvi.com/forum/phpbb_user.php';
	
		
	/**
	 * Вся информация о языках
	 *
	 * @return unknown
	 */
	public static function getCulturesData()
	{
		return self::$cultures;
	}	
	
	/**
	 * Список языков
	 *
	 * @return unknown
	 */
	public static function getCultures()
	{
		return array_keys( self::$cultures );
	}
	
	/**
	 * Названия языков
	 *
	 * @return unknown
	 */
	public static function getCultureNames()
	{
	    $result = array();
	    foreach (self::$cultures as $culture => $culture_data) {
	       $result[$culture] = $culture_data['name'];	        
	    }	    
		return $result;
	}
	
	/**
	 * ISO-код языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureIso( $culture )
	{
		return self::$cultures[ $culture ][ 'iso' ];
	}	
	
	/**
	 * Основная часть языка.
	 * Для zh_CN вернёт zh
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureMain( $culture )
	{
		return substr( sfContext::getInstance()->getUser()->getCulture(), 0, 2 );
	}
	
	/**
	 * Get Diqus ISO culture code
	 * http://docs.disqus.com/help/97/
	 * 
	 * ISO 639-1 two-letter code exceptions
	 * Most languages can be set using their standard two-letter ISO 639-1 code (full list). Exceptions are:
	 * 
	 * Chinese (Traditional) = zh_HANT
	 * German (Formal) = de_formal
	 * German (Informal) = de_inf
	 * Portuguese (Brazil) = pt_BR
	 * Portuguese (European) = pt_EU
	 * Serbian (Cyrillic) = sr_CYRL
	 * Serbian (Latin) = sr_LATIN
	 * Spanish (Argentina) = es_AR
	 * Spanish (Mexico) = es_MX
	 * Spanish (Spain) = es_ES
	 * Swedish = sv_SE
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getDisqusCulture( $culture )
	{	
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		
		if (self::$cultures[ $culture ]['disqus_culture']) {
			return self::$cultures[ $culture ]['disqus_culture'];
		} else {
			return self::getCultureMain($culture);	
		}		
	}	
	
	/**
	 * Название языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureName( $culture )
	{
		return self::$cultures[ $culture ][ 'name' ];
	}
	
	/**
	 * Название языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	/*public static function getCultureMailId( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'mail_id' ];
	}*/
	
	/**
	 * Полученеи языка в формате MSDS: http://msdn.microsoft.com/en-us/library/ms533052%28v=vs.85%29.aspx
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
    public static function getCultureMsdn( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return strtolower( str_replace("_", "-", $culture) );
	}
	
	/**
	 * Категория для системы комментирования
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureCommentsCategoryId( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'comments_category_id' ];
	}
	
	/**
	 * Получение языка интерфейса FeedBurner для языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureFeedburderLoc( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		$loc = self::$cultures[ $culture ][ 'feedburner_loc' ];
		if (!$loc) {
			$loc = self::$cultures[ sfConfig::get('sf_default_culture') ][ 'feedburner_loc' ];
		}
		return $loc;
	}
	
	/**
	 * Используются ли в языке иероглифы
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function isCultureHieroglyphic( $culture = '' )
	{
	    if (!$culture) {
	        $culture = sfContext::getInstance()->getUser()->getCulture();
	    }
	    if (!empty(self::$cultures[ $culture ][ 'hieroglyphic' ])) {
			return (bool)self::$cultures[ $culture ][ 'hieroglyphic' ];
	    } else {
	    	return false;
	    }
	}
	
	/**
	 * Используется ли для языка увеличенный размер текста
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function isCultureLargeText( $culture = '' )
	{
	    if (!$culture) {
	        $culture = sfContext::getInstance()->getUser()->getCulture();
	    }
	    if (!empty(self::$cultures[ $culture ][ 'large_text' ])) {
			return (bool)self::$cultures[ $culture ][ 'large_text' ];
	    } else {
	    	return false;
	    }
	}
	
	/**
	 * Направление текста - справа налево.
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function isCultureDirectionRtl( $culture = '' )
	{
	    if (!$culture) {
	        $culture = sfContext::getInstance()->getUser()->getCulture();
	    }
	    if (!empty(self::$cultures[ $culture ][ 'direction_rtl' ])) {
			return (bool)self::$cultures[ $culture ][ 'direction_rtl' ];
	    } else {
	    	return false;
	    }
	}
	
	/**
	 * Полное название языка, пример: Afrikaans [af] &nbsp;&nbsp;-&nbsp;&nbsp; Afrikaans
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureFullName( $culture = '' )
	{
		if (!$culture || empty(self::$all_cultures[$culture])) {
			return '';
		}
	    return self::$all_cultures[$culture]['en'] .' [' . $culture . '] &nbsp;&nbsp;-&nbsp;&nbsp; ' . self::$all_cultures[$culture]['name'];
	}
	
	/**
	 * Проверка, является ли страница главной
	 *
	 * @param string $url адрес для проверки
	 * @return unknown
	 */
	public static function isHomePage( $url = '' )
	{
	    if (!$url) {
	        $url = sfContext::getInstance()->getRequest()->getUri();
	    }
	    // если в адресе только 2 слэша, значит мы на главной
	    $parse_url = parse_url($url);
	    if ( in_array( str_replace('/' , '', $parse_url['path']), UserPeer::getCultures()) ) {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	/**
	 * Переключение адреса на мобильную версию и обратно
	 *
	 * @param string $url адрес
	 * @return string
	 */
	public static function switchUrlMobile( $url = '' )
	{
	    if (!$url) {
	        $url = sfContext::getInstance()->getRequest()->getUri();
	    }

	    if (strstr($url, sfConfig::get('app_domain_name_full'))) {
	        // переключаем на мобильную версию
	        $result_url = str_replace(sfConfig::get('app_domain_name_full'), sfConfig::get('app_domain_name_mobile'), $url);
	        
	        // удаление "version/full" из адреса
	        $result_url = str_replace('version/full', '', $result_url);
	    } else {
	        // переключение на полную версию
	        $result_url = str_replace(sfConfig::get('app_domain_name_mobile'), sfConfig::get('app_domain_name_full'), $url);
	    }
	    
	    // убираем название скрипта
	    //if (sfConfig::get('sf_no_script_name') || sfConfig::get('sf_environment') == 'prod') {
	    $parse_url = parse_url($url);
	    $result_url = str_replace('/' . UserPeer::getApplicationScript($parse_url['host'], sfConfig::get('sf_environment')), '', $result_url);
	    //}
	    
	    return $result_url;
	}
	
	/**
	 * Получение названия скрипта по Доменному имени и окружению
	 *
	 * @param unknown_type $domain_name
	 * @return unknown
	 */
	public static function getApplicationScript( $domain_name )
	{
	  return 'frontend_' . str_replace('.', '_', $domain_name) . '.php';
	}
	
	/**
	 * Получение языка из URL
	 * url:
	 * http://www.etapasvi.com/zh_CN/biography
	 * /zh_CN/biography
	 */
	public static function getCultureFromUrl( $url )
	{
		preg_match("/(?:http:\/\/[^\/]+)?\/([^\/]+)\/.*/", $url, $matches);
		return $matches[1];
	}
		
	/**
	 * Получение относительного адреса страницы 404
	 */
	public static function getError404Url($culture = '')
	{
		if (empty($culture )) {
		  $culture = sfContext::getInstance()->getUser()->getCulture();
		}
		// если передан URL /abrakadabra, язык неопределён
		if (empty($culture)) {
			$culture = sfConfig::get('sf_default_culture');
		}
		$url = '/' . $culture . '/default/errors';
		return $url;
	}
	
	/**
	 * Получение доменного имени веба
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getWebDomain($web, $mobile = false)
	{
		$web = (int)$web;
		if ($web == 0) {
			return '';
		}
		$web_domain = 'web' . $web . '.';
		if ($mobile) {
			$web_domain .= sfConfig::get('app_domain_name_mobile');
		} else {
		    $web_domain .= sfConfig::get('app_domain_name_full');
		}
		return $web_domain;
	}
	
//	/**
//	 * Проверка и авторизация пользователя
//	 * Не делаем static, чтобы можно было устанавливать куки
//	 */
//	public function authLogin( $name, $password, $remember_me = false ) {
//  		
//  		$c = new Criteria();
//  		
//  		$c->add( UserPeer::NAME, trim($name) );
//  		$c->add( UserPeer::PASSWORD, sha1(md5(trim($password))) );
//  		$c->add( UserPeer::IS_ACTIVE, 1 );
//  		$user_records = UserPeer::doSelect($c);
//  		
//  		if ( count($user_records) == 1 ) {
//  			// успешный вход
//  			$user = $user_records[0];
//  			self::authCacheUser( $user );  			
//  		
//  			if ($remember_me) {
//  				self::authSetCookies();
//  			}
//  			// запоминаем время входа
//  			$user->saveLastLogin();
//  			// вход в PHPBB
//  			//$user->phpbbLogin();
//  			return true;
//  		} else {
//  			self::authUnsetCookies();	  			
//  			return false;  			
//  		}  	
//	}
//	
//	/**
//	 * Сохранение пользователя
//	 *
//	 * @param unknown_type $user
//	 */
//	public function authCacheUser( $user ) {		
//		unset($_SESSION['user_cached']);			
//  		$_SESSION['user_cached'] = $user;
//	}
//	
//	/**
//	 * Авторизуем пользователя
//	 */
//	public function authForcedLogin( $user, $remember_me ) {		
//  		if ( $user->getId() ) {  			  			
//  			self::authCacheUser( $user ); 
//  			if ($remember_me) {
//  				self::authSetCookies();
//  			}
//  			// запоминаем время входа
//  			//$user = UserPeer::retrieveByPk( $user_id );
//  			//if ($user) {
//  			$user->saveLastLogin();
//  			// вход в PHPBB
//  			//$user->phpbbLogin();
//  			//}
//  		}
//	}	
//	
//	/**
//	 * Проверка, авторизован ли пользователь
//	 *
//	 * @return unknown
//	 */
//	public static function authIsLoggedIn() {
//  		// проверка Remember me
//  		if ( ( !self::authUserId() ) 
//  		     && isset($_COOKIE[self::REMEMBER_ME_COOKIE]) && $_COOKIE[self::REMEMBER_ME_COOKIE] != '') 
//  		{
//	  		$c = new Criteria();
//	  		$c->add( UserPeer::REMEMBER_ME_CODE, $_COOKIE[self::REMEMBER_ME_COOKIE] );
//	  		$c->add( UserPeer::IS_ACTIVE, 1 );
//	  		$user_records = UserPeer::doSelect($c);
//	  		
//	  		if ( count($user_records) == 1 ) {
//	  			
//	  			self::authCacheUser( $user_records[0] ); 
//	  			
//	  			// переход на язык, сохранённый в cookie только если открыли морду
//	  			/*$culture = substr($_SERVER['REQUEST_URI'], 1, 2);
//	  			if ( in_array($_COOKIE[self::CULTURE_COOKIE], array('en', 'ru')) 
//	  			     && $culture != $_COOKIE[self::CULTURE_COOKIE] ) 
//	  			{
//	  				$uri 	= $_SERVER['REQUEST_URI'];
//					$params = str_replace( array('/ru','/ru/', '/en', '/en/'), '', $uri);
//					//$this->redirect( '/' . $_COOKIE[self::CULTURE_COOKIE] . $params);
//					header( 'Location: http://' . $_SERVER['SERVER_NAME'] . '/' . $_COOKIE[self::CULTURE_COOKIE] . $params  );
//	  				exit();
//	  			}*/
//	  			
//	  			// отключён 2010.08.27, т.к. при если язык URL отличался от языка пользователя
//	  			// при открытии http://www.etapasvi.com/en/news/show/id/49 кидало на главную на языке пользователя
//	  			/*  			
//	  			$uri 	 = $_SERVER['REQUEST_URI'];
//	  			$culture = substr($uri, 1, 2);
//	  			
//	  			if ( $_SERVER['PATH_INFO'] < 4 && !empty($_COOKIE[self::CULTURE_COOKIE]) && $culture != $_COOKIE[self::CULTURE_COOKIE] ) {
//					header( 'Location: http://' . $_SERVER['SERVER_NAME'] . '/' . $_COOKIE[self::CULTURE_COOKIE] );
//	  				exit();	  				
//	  			}*/
//	  		} else {
//	  			self::authUnsetCookies();
//	  		}
//  		}  		
//  		return self::authUserId();  		
//	}
//	
//	/**
//	 * Получение ID пользователя
//	 *
//	 * @return unknown
//	 */
//	public static function authUserId() {
//		if ( !empty($_SESSION['user_cached']) ) {
//			return $_SESSION['user_cached']->getId();
//		} else {
//  			return '';
//		}
//	}	
//	
//	/**
//	 * Получение логина пользователя
//	 *
//	 * @return unknown
//	 */
//	public static function authUserName() {
//		$user = self::authGetUser();
//		if ($user) {
//			return $user->getName();
//		}
//		return '';
//	}	
//	
//	/**
//	 * Получение текущего пользователя
//	 *
//	 * @return unknown
//	 */
//	public static function authGetUser() {	  		
//  		return $_SESSION['user_cached'];
//	}		
//	
//	/**
//	 * Выход
//	 *
//	 */
//	public static function authLogout() {
//		self::authUnsetCookies();
//		session_unset();
//		@session_destroy();
//		@session_start();
//		$_SESSION = array();
//		session_commit();		
//	}
//	
//	/**
//	 * Установка кук посла авторизации
//	 *
//	 */
//	public static function authSetCookies() {
//
//		$remember_me_code = md5( time() );
//
//  		$c = new Criteria();
//  		$c->add( UserPeer::ID, self::authUserId() );
//  		$c->add( UserPeer::IS_ACTIVE, 1 );
//  		$user_records = UserPeer::doSelect($c);
//
//  		if (count($user_records)) {
//  			$user = $user_records[0];
//  			$user->setRememberMeCode( $remember_me_code );
//  			$user->save();  			
//  			// remember me
//  			setcookie( self::REMEMBER_ME_COOKIE, $remember_me_code, time() + 3600 * 24 * 365, '/' );  			
//  			// язык
//  			setcookie( self::CULTURE_COOKIE, sfContext::getInstance()->getUser()->getCulture(), time() + 3600 * 24 * 365, '/' );
//  		}
//	}
//	
//	/**
//	 * Удаление кук
//	 *
//	 */
//	public static function authUnsetCookies() {
//  		setcookie( self::REMEMBER_ME_COOKIE, "", time() - 3600, '/');
//  		setcookie( self::CULTURE_COOKIE, "", time() - 3600, '/');  		
//	}		
//	
//	/**
//	 * Валидация e-mail
//	 *
//	 * @param unknown_type $email
//	 * @return unknown
//	 */
//	public static function validateEmail($email)
//	{
//	   $isValid = true;
//	   $atIndex = strrpos($email, "@");
//	   if (is_bool($atIndex) && !$atIndex)
//	   {
//	      $isValid = false;
//	   }
//	   else
//	   {
//	      $domain = substr($email, $atIndex+1);
//	      $local = substr($email, 0, $atIndex);
//	      $localLen = strlen($local);
//	      $domainLen = strlen($domain);
//	      if ($localLen < 1 || $localLen > 64)
//	      {
//	         // local part length exceeded
//	         $isValid = false;
//	      }
//	      else if ($domainLen < 1 || $domainLen > 255)
//	      {
//	         // domain part length exceeded
//	         $isValid = false;
//	      }
//	      else if ($local[0] == '.' || $local[$localLen-1] == '.')
//	      {
//	         // local part starts or ends with '.'
//	         $isValid = false;
//	      }
//	      else if (preg_match('/\\.\\./', $local))
//	      {
//	         // local part has two consecutive dots
//	         $isValid = false;
//	      }
//	      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
//	      {
//	         // character not valid in domain part
//	         $isValid = false;
//	      }
//	      else if (preg_match('/\\.\\./', $domain))
//	      {
//	         // domain part has two consecutive dots
//	         $isValid = false;
//	      }
//	      else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
//	                 str_replace("\\\\","",$local)))
//	      {
//	         // character not valid in local part unless 
//	         // local part is quoted
//	         if (!preg_match('/^"(\\\\"|[^"])+"$/',
//	             str_replace("\\\\","",$local)))
//	         {
//	            $isValid = false;
//	         }
//	      }
//	      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
//	      {
//	         // domain not found in DNS
//	         $isValid = false;
//	      }
//	   }
//	   return $isValid;
//	}			

	/**
	 * Отправка уведомления администратору
	 *
	 * @param unknown_type $msg
	 * @param unknown_type $subject
	 */
	public static function adminNotify( $msg, $subject = 'mailer' ) 
	{			
		mail(sfConfig::get('app_admin_email'), $subject . ' (' . sfConfig::get('app_domain_name') . ')', $msg );	
	}
	
	/**
	 * Проверка, находимся ли мы на основном бэкенде
	 *
	 * @return unknown
	 */
	public static function isMainBack()
	{
	   return file_exists(sfConfig::get('sf_web_dir') . '/main_back.conf');
	}
	
	/*
	public static function getUserPhpbbUrl( $user_phpbb_id ) {	
		return 'http://' . $_SERVER['SERVER_NAME'] . '/forum/memberlist.php?mode=viewprofile&u=' 
				. $user_phpbb_id . '&lang=' . sfContext::getInstance()->getUser()->getCulture();
	}*/

//	/**
//	 * Получение администратора
//	 *
//	 * @return unknown
//	 */
//	public static function getAdminUser()
//	{
//		$c = new Criteria();
//		$c->add(UserPeer::NAME, UserPeer::ADMIN_NAME);
//		return UserPeer::doSelectOne($c);
//	}
//	
//	/**
//	 * Проверка e-mail на уникальность
//	 *
//	 * @param unknown_type $email
//	 * @return unknown
//	 */
//	public static function isEmailUnique($email) {
//  		$c = new Criteria();
//  		$c->add(UserPeer::EMAIL, $email);
//  		$c->add(UserPeer::ID, self::authUserId(), Criteria::NOT_EQUAL);
//  		if (UserPeer::doCount($c)) {
//  			return false;
//  		} else {
//  			return true;
//  		}
//	}
	
	/**
	 * Управление кэшированием
	 *
	 * @param unknown_type $email
	 * @return unknown
	 */
	/*
	public static function cacheControl() {
  		if (UserPeer::authIsLoggedIn()) {
			// если пользователь авторизован, не кэшируем страницы
			//header('Cache-Control: no-cache, must-revalidate');
			//header('Pragma: no-cache');
		    header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
	        header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	        header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	        header( 'Cache-Control: post-check=0, pre-check=0', false );
	        header( 'Pragma: no-cache' );
			echo 123;
		} else {
			// для неавторизованных - кэшируем
			$cache_time = 60*60*24;
			header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_time) . ' GMT');
			header('Cache-Control:max-age=' . $cache_time . ', must-revalidate');
			header('Last-Modified: ' . gmdate("D, d M Y H:i:s", time()-60) . ' GMT');
			//exit();
		}
	}*/
	
  /**
   * Получение объекта для генерации путей.
   * Берётся из файла routing.yml фронтенда.
   *
   */
  public static function getRouting()
  {
  	// подготовка путей для поиска файлов  
  	// http://www.symfony-project.org/cookbook/1_2/en/cross-application-links
  	$config = new sfRoutingConfigHandler();
	$routes = $config->evaluate(array(sfConfig::get('sf_apps_dir') . '/frontend/config/routing.yml'));
	$routing = new sfPatternRouting(new sfEventDispatcher());
	$routing->setRoutes($routes);
	
	return $routing;
  }
  
  /**
   * Получение информации о серверах.
   *
   */
  public static function getServers($servers)
  {
  	// получение списка серверов из Google Docs
  	$servers_array = array();
  	
  	if (!$servers) {
  		return array();
  	}
  	
	$config = self::getToolsConfig();
  	
  	switch ($servers) {
  	  case self::SERVERS_BACKENDS:
  		$servers_array = TextPeer::getGoogleDocAsArray($config['google_docs']['backends']);
  		break;
  	  case self::SERVERS_FRONTENDS:
  		$servers_array = TextPeer::getGoogleDocAsArray($config['google_docs']['frontends']);
  		break;
  	}

  	// цикл по строкам
  	foreach ($servers_array as $row) {

	  switch ($servers) {
	  	case self::SERVERS_BACKENDS:
	  	  $servers_item = array(
			'number'      	=> $row[0],
			'host'	  	  	=> $row[1],
			'owner'	  	  	=> $row[2],
			'user'	      	=> $row[3],
			'web_dir' 	  	=> $row[4],
			'owner_email' 	=> $row[5],
			'hosting'     	=> $row[6],
			'db_server'   	=> $row[7],
			'db_port'     	=> $row[8],
			'db_username' 	=> $row[9],
			'db_password' 	=> $row[10],
			'db_name'     	=> $row[11],
			'git_remote'    => $row[12],
			'replicate_db'  => $row[13],
			'active'     	=> $row[14],
			'comment'     	=> $row[15]
	  	  );
	  	  break;
	  	  
	  	case self::SERVERS_FRONTENDS:
	  	  $servers_item = array(
			'number'      => $row[0],
			'host'	  	  => $row[1],
			'owner'	  	  => $row[2],
			'user'	      => $row[3],
			'web_dir' 	  => $row[4],
			'owner_email' => $row[5],
			'hosting'     => $row[6],
			'rsync_www'   => $row[7],
			'active'      => $row[8],
			'comment'     => $row[9]
	  	  );
	  	  break;
	  }  	
  	  
  	  // названия полей и сервера, у которых не указн путь на сервере пропускаем
  	  if ($servers_item['active'] == 1) {
  	  	// проверяем не добавлен ли ещё сервер с таким IP
  	  	$server_added = false;
  	  	foreach ($servers_list as $server_info) {
  	  	  if ($server_info['host'] == $servers_item['host']) {
  	  		$server_added = true;
  	  		break;
  	      }
  	  	}
  	  	if (!$server_added) {
  	      $servers_list[] = $servers_item;
  	  	}
      }
  	}

  	return $servers_list;
  }
  
  /**
   * Get config from tools/config/config.yml
   *
   */
  public static function getToolsConfig()
  {	
	$config = sfYaml::load(sfConfig::get('sf_root_dir') . '/tools/config/config.yml');	
	return $config;	
  }
}
