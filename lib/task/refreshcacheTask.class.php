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
  	// чтобы можно было получить настройки с помощью sfConfig::get() указываем application = frontend
  	
    $this->addOptions(array(
      new sfCommandOption('domain_name', null, sfCommandOption::PARAMETER_OPTIONAL, 'Domain to refresh cache'),
      new sfCommandOption('multi_process', null, sfCommandOption::PARAMETER_OPTIONAL, 1),
      new sfCommandOption('console', null, sfCommandOption::PARAMETER_OPTIONAL, 1),
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
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
    $result = sfSuperCache::refreshCache(
      $options['multi_process'], 
      sfSuperCache::REFRESH_CACHE_THREADS_COUNT, 
      $options['domain_name'], 
      $options['console']
    );		
    print_r( $result );
  }
  
}
