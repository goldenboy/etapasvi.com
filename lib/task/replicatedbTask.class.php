<?php
/**
 * Task for replicating DB to all slaves.
 * 
 * 2011-10-25
 */

// Class for permorming replication
require_once(dirname(__FILE__).'/../../lib/replicate_db.class.php');

class replicatedbTask extends sfBaseTask
{   
	
  // master DB parameters
  public static $master_params = array(
	'server' 	=> '',
	'port' 		=> '3306',
	'username' 	=> '',
	'password' 	=> '',
	'db' 		=> ''
  );
  
  // slaves DB parameters
  // read from Google Docs
  public static $slaves_params = array(); 
	
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
    $this->name             = 'replicatedb';
    $this->briefDescription = 'Replicate DB';
    $this->detailedDescription = <<<EOF
Replicate DB
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	
	try {
		$backend_list = UserPeer::getServers(UserPeer::SERVERS_BACKENDS);
	} catch (Exception $e) {
		// error occured
		UserPeer::adminNotify($e->getMessage(), "etapasvi: replicate db error");
		return;
	}
	
	foreach ($backend_list as $backend) {

	  if (!$backend['replicate_db']) {
	  	continue;
	  }
	  self::$slaves_params[] = array(
		'server' 	=> $backend['db_server'],
		'port' 		=> $backend['db_port'],
		'username' 	=> $backend['db_username'],
		'password' 	=> $backend['db_password'],
		'db' 		=> $backend['db_name']
	  );
	}

	// Получение параметров мастера
	$master_db_params = sfYaml::load(dirname(__FILE__).'/../../config/databases.yml');
	
	$master_params['username'] = $master_db_params['all']['propel']['param']['username'];
	$master_params['password'] = $master_db_params['all']['propel']['param']['password'];
	
	$master_pass_port = '';
	preg_match("/mysql:dbname=([^;]+);host=(.*)/", $master_db_params['all']['propel']['param']['dsn'], $master_pass_port);
	$master_params['server'] = $master_pass_port[2];
	$master_params['db']     = $master_pass_port[1];
	
	// Run replication
	replicateDb::run($master_params, self::$slaves_params, sfConfig::get('admin_email'), 'etapasvi: replicate_db');
  }
}
