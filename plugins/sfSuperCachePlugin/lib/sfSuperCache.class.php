<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfSuperCache base class.
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfSuperCache.class.php 8446 2008-04-14 14:31:09Z fabien $
 */
class sfSuperCache
{
  /**
   * Clears the super cache by listening to the task.cache.clear event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function clearCacheFull(sfEvent $event)
  {
    $config = sfFilterConfigHandler::getConfiguration($event['app']->getConfigPaths('config/filters.yml'));

    $event->getSubject()->logSection('cache', 'Clearing super cache');

    // find super cache configuration
    $found = false;
    $cacheDir = 'cache';
    foreach ($config as $value)
    {
      if ('sfSuperCacheFilter' == $value['class'])
      {
        $found = true;
        if (isset($value['param']['cache_dir']))
        {
          $cacheDir = $value['param']['cache_dir'];
        }

        break;
      }
    }

    if ($found)
    {
      // clear the cache
      $cacheDir = sfConfig::get('sf_web_dir').'/'.$cacheDir;
      if (is_dir($cacheDir))
      {
        // remove cache files
        //$event->getSubject()->getFilesystem()->remove(sfFinder::type('file')->ignore_version_control()->discard('.sf')->in($cacheDir));
      }
    }
  }
   
  /**
   * Очистка кэша по пути:
   * *
   * http://www.etapasvi.com/ru/
   * http://www.etapasvi.com/ru/photo/show/id/586/title/*
   * /en/text/disqusembed
   *
   * @param unknown_type $request
   */
  public static function clearCacheByPath($path = '', $all_cultures = true)
  {
  	$result = array();
  	
	// предварительная обработка пути
	$path 		= str_replace('..', '', $path);
	$parse_url  = parse_url($path);
	$path 		= $parse_url['path'];				
	
	if ($all_cultures ) {
		// удаляем для всех языков
		$culture_list = UserPeer::getCultures();
		$path 		= '/sf_culture/' . substr($path, 4, strlen($path));		
	} else {
		$culture_list = array('fake');
	}
	
	$full_path = sfConfig::get('sf_web_dir').'/cache/'.$path;
	$full_path = preg_replace("/\/+/", '/', $full_path);
	
	foreach ($culture_list as $culture ) { 		
		$path_translated = str_replace('sf_culture', $culture, $full_path);
 			
		if (substr($path_translated, strlen($path_translated)-1, 1) == '*') {
			system('rm -rf ' . $path_translated);  			
			$result[] = $path_translated;			
		} else {  				
			system('rm -f ' . $path_translated . 'i.html');
			//system('rm -f ' . $path_translated . 'i.js');  	
			$result[] = $path_translated . 'i.html';		
		}		
	}
	return $result;
  }
}
