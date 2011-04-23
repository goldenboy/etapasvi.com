<?php

class IdeaI18n extends BaseIdeaI18n
{
	public function getTitle() {
		return $this->getBodyAsTitle();
	}
	
	public function getBodyAsTitle() {

		$body = trim( $this->getBody() );			
		$source_len = strlen($body);
		if ( sfContext::getInstance()->getUser()->getCulture() == 'ru' ) {
			$body = iconv( 'UTF8', 'CP1251', $body );
		}
		$body = mb_substr($body, 0, 70);	
		if ( sfContext::getInstance()->getUser()->getCulture() == 'ru' ) {
			$body = iconv( 'CP1251', 'UTF8', $body );
		}
		//if ($source_len > 80) {
		$body = trim($body) . '... ';
		//}		
		
		return $body;
	}		
}
