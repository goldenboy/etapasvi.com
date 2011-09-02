<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfSuperCacheFilter.class.php 24554 2009-11-30 10:24:36Z fabien $
 */
class sfSuperCacheFilter extends sfFilter
{
  public function execute ($filterChain)
  {     
    // execute next filter
    $filterChain->execute();
    
    // saynt2day
    // в мобильной версии пока не кэшируем
    //if ( sfContext::getInstance()->getConfiguration()->getEnvironment() == 'mobile' ) {
    //  return;
    //}  
    
    $response = $this->getContext()->getResponse();    

    // execute this filter only if cache is set and no GET or POST parameters
    // execute this filter not in debug mode, only if no_script_name and for 200 response code
    // страницы 404 кэшируем
    if (
      // saynt2day
      // чтобы не было нагрузке при переходе из FeedBurner, который передаёт GET-запрос
      //(!sfConfig::get('sf_cache') || count($_GET) || count($_POST))
      (!sfConfig::get('sf_cache') || count($_POST))
      ||
      (sfConfig::get('sf_debug') || !sfConfig::get('sf_no_script_name') || ($response->getStatusCode() != 200 && $response->getStatusCode() != 404) )
    )
    {
      return;
    }
    
    $pathInfo = $this->getContext()->getRequest()->getPathInfo();
    
    // Если произошла 404 ошибка, подменяем строку запроса т.о., чтобы все страницы сохранялись в один файл
    if ($response->getStatusCode() == 404) {
    	$pathInfo = UserPeer::getError404Url( UserPeer::getCultureFromUrl($pathInfo) );
    }

    // Использование $cacheManager и параметров view отключено для ускорения процесса
    // only if cache is set for the entire page
    //$cacheManager = $this->getContext()->getViewCacheManager();
    //$uri = $this->getContext()->getRouting()->getCurrentInternalUri();
    //if ($cacheManager->isCacheable($uri) && $cacheManager->withLayout($uri))
    //{
        
      // saynt2day
      // определяем будущее расширение файла
      //if ( strstr($response->getHttpHeader('Content-type'), 'application/javascript')) {
      //	$ext = '.js';
      //} else {
      	$ext = '.html';
      //}
      $file =
        sfConfig::get('sf_web_dir').'/'.$this->getParameter('cache_dir', 'cache').
        //($this->getParameter('with_host', true) ? '/'.$request->getHost() : '').
        ($this->getParameter('with_host', true) ? '/'.sfConfig::get('app_domain_name') : '').
        $pathInfo.'i'.$ext.
        ($this->getParameter('check_lifetime', true) ? '.php' : '')
      ;
      $current_umask = umask();
      umask(0000);
      $dir = dirname($file);
      if (is_file($dir))
      {
        unlink($dir);
      }
      if (!is_dir($dir))
      {
        mkdir($dir, 0777, true);
      }
      // check conflicts between directories and files with the same name
      if (!is_dir($file))
      {
        $response = $this->getContext()->getResponse();
        
        // Note: some proxies do cache 302 responses, despite the rfc, so we explicitely ask for no cache
        if ($this->getParameter('check_lifetime', true))
        {
          $uri = $this->getContext()->getRouting()->getCurrentInternalUri();
          $expiryDate = time() + $cacheManager->getLifetime($uri);
          $header = sprintf("<?php if (time() > %d) { unlink(__FILE__); header('Pragma: no-cache'); header('Location: '.\$_SERVER['REQUEST_URI']);  exit; } ?>\n", $expiryDate);
          $header .= sprintf("<?php header('Content-Type: %s') ?>\n", $response->getContentType());
          foreach(array('Cache-Control', 'Pragma', 'Expires') as $key)
          {
            if ($value = $response->getHttpHeader($key))
            {
              $header .= sprintf("<?php header('%s: %s') ?>\n", $key, $value);
            }
          }
        }
        else
        {
          $header = '';
        }
        $content = $response->getContent();
        
        // saynt2day
        //if ($this->getParameter('minify', false)) {    	  
          /*require_once( sfConfig::get('sf_lib_dir') . '/compactor.class.php' );
          $compactor = new Compactor(array( 
            'buffer_echo' => false 
          )); 
          $content = $compactor->squeeze($content); */
          //$content = preg_replace("/\s+/", ' ', $content);
        //}

        if (!$content) {
          // контента нет
          sfContext::getInstance()->getLogger()->err('Could not get content of the page for caching: '.
          	sfConfig::get('app_domain_name').$pathInfo);
        } else {
          // запись контента в файл
	      $write_result = file_put_contents($file, $header.$content);
	      if (!$write_result) {
	        sfContext::getInstance()->getLogger()->err('Could not write to cache file: '.$file);
	      }
	      chmod($file, 0666);
	        
	      sfSuperCache::unlinkDeletedCacheFile($file);
        }
      }
      umask($current_umask);
    //}
  }
}
