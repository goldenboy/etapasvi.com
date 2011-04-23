<?php
/**
 * Text actions.
 *
 * @package    sf_sandbox
 * @subpackage idea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class textActions extends sfActions
{
 
  public function executeJs(sfWebRequest $request)
  {
  	$this->getResponse()->setHttpHeader('Content-type', 'application/javascript; charset=utf-8');
  	
    // получаем список Цитат
    $c = new Criteria();
    $c->add(QuoteI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
  	$this->quote_list = QuotePeer::doSelectWithI18n($c);
  	
    // получаем список Аудио
    $c = new Criteria();
    $c->add(AudioI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
    $c->add(AudioI18nPeer::REMOTE, '', Criteria::NOT_EQUAL);
  	$this->audio_list = AudioPeer::doSelectWithI18n($c);
  }    
  
  public function executeDisqusembed(sfWebRequest $request)
  {
  	$this->getResponse()->setHttpHeader('Content-type', 'application/javascript; charset=utf-8');
  	
    $this->embed = file_get_contents( CommentsPeer::DISQUS_EMBED );
    
    if ($this->embed) {
    	$this->embed = base64_encode(str_replace(
    		'if(DISQUS.config.language){if(DISQUS.config.language!="en")', 
    		'if(typeof disqus_language!="undefined"){DISQUS.config.language=disqus_language;}if(DISQUS.config.language){if(DISQUS.config.language!="en")',
    		$this->embed
    	));

    }
  }
  
}