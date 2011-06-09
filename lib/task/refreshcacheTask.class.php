<?php
/**
 * Обновление кэша: удаление файлов кэша и открытие страниц сайта, чтобы создался новый файл
 * 
 * Запуск: 
 * ./symfony project:refreshcache
 * 
 * 20110320
 *
 */

class refreshcacheTask extends sfBaseTask
{
  
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('path', null, sfCommandOption::PARAMETER_OPTIONAL, 'Path'),
      //new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      //new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      //new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'refreshcache';
    $this->briefDescription = 'Refresh Cache';
    $this->detailedDescription = <<<EOF
Refresh Cache
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $result = sfSuperCache::refreshCache();		
    print_r( $result );
  }
  
}
