<?php

# FROZEN_SF_LIB_DIR: /var/www/production/sfweb/www/cache/symfony-for-release/1.2.8/lib

require_once dirname(__FILE__).'/../lib/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    sfYaml::setSpecVersion('1.1');
    // for compatibility / remove and enable only the plugins you want
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
	$this->setWebDir($this->getRootDir() . '/www');
	sfConfig::add(array(
		'sf_upload_dir_name' => 'uploads'
	));
    $this->enablePlugins('sfGuardPlugin');
    $this->enablePlugins('sfThumbnailPlugin');
    $this->enablePlugins('sfImageTransformPlugin');
  }
}
