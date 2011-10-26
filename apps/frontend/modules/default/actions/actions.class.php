<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * defaultActions module.
 *
 * @package    symfony
 * @subpackage action
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
  
  /**
   * Error page for page not found (404) error
   *
   */
  public function executeError404()
  {
    // http://bsds.etapasvi.com/issues/65
    // получаем файл 404 ошибки из кэша
    
    // Выводим закэшированную 404 страницу, если 
    // - находимся на основном вебе
    if (UserPeer::isMainBack()) {
        sfSuperCache::showError404();
    }
     	
  }

}
