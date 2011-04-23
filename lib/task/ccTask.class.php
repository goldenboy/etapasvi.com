<?php
/**
 * Очистка Super кэша
 * 
 * Запуск: 
 * ./symfony project:cc http://www.etapasvi.com/ru/contactus
 * 
 * 20110320
 *
 */

class ccTask extends sfBaseTask
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
    $this->name             = 'cc';
    $this->briefDescription = 'Clear Cache';
    $this->detailedDescription = <<<EOF
Clear Super Cache
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $result = sfSuperCache::clearCacheByPath($options['path']);		
    print_r( $result );
  }
  
}
