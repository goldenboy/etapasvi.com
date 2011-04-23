<?php
 
class textComponents extends sfComponents
{
  public function executeShow()
  {
  	$text = TextPeer::retrieveByPk( $this->id );
    //$this->forward404Unless($text);  
    if ($text) {
      $this->text = $text->getBody();
    }
  }
  
  public function executeJs(sfWebRequest $request)
  {
    // получаем список Цитат
    $c = new Criteria();
    $c->add(QuoteI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
  	$this->quote_list = QuotePeer::doSelectWithI18n($c);
  	
    // получаем список Аудио
    $c = new Criteria();
    $c->add(AudioI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
    $c->add(AudioPeer::REMOTE, '', Criteria::NOT_EQUAL);
  	$this->audio_list = AudioPeer::doSelectWithI18n($c);
  }
}