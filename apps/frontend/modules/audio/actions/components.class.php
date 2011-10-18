<?php
 
class audioComponents extends sfComponents
{
/*
  public function executeRandom()  
  {
  	$this->audio = AudioPeer::getRandom();
  }*/

  /**
   * Последние Аудио
   *
   */
  public function executeLatest()
  {
  	$c = new Criteria();
    $c->add( AudioPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( AudioPeer::ORDER );    
    $c->setLimit(AudioPeer::LATEST_COUNT);
    
    $this->audio_list = AudioPeer::doSelectWithI18n($c); 
  }
  
  /**
   * Встраивание отдельного Аудио
   *
   */
  public function executeShowShort()
  {
    if (empty($this->audio)) {
  	  $this->audio = AudioPeer::retrieveByPk( $this->id );
    }
  }
  
}