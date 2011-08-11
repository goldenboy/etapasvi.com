<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfError404Exception is thrown when a 404 error occurs in an action.
 *
 * @package    symfony
 * @subpackage exception
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfError404Exception.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfError404Exception extends sfException
{
  /**
   * Forwards to the 404 action.
   */
  public function printStackTrace()
  {
    $exception = null === $this->wrappedException ? $this : $this->wrappedException;

    if (sfConfig::get('sf_debug'))
    {
      $response = sfContext::getInstance()->getResponse();
      if (null === $response)
      {
        $response = new sfWebResponse(sfContext::getInstance()->getEventDispatcher());
        sfContext::getInstance()->setResponse($response);
      }

      $response->setStatusCode(404);

      return parent::printStackTrace();
    }
    else
    {
      // log all exceptions in php log
      if (!sfConfig::get('sf_test'))
      {
        error_log($this->getMessage());
      }

      // http://bsds.etapasvi.com/issues/65
      // получаем файл 404 ошибки из кэша
      $cache_file = sfSuperCache::getError404Content();
            
      if ($cache_file) {      	
      	$response = sfContext::getInstance()->getResponse();
      	$response->setStatusCode('404');
      	$response->setContent($cache_file);
      	$response->send();
      } else {
      	// отображение страницы 404
      	sfContext::getInstance()->getController()->forward(sfConfig::get('sf_error_404_module'), sfConfig::get('sf_error_404_action'));
      }            
    }
  }
}
