<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    // установка формата запроса для мобильной версии
    $this->dispatcher->connect('request.filter_parameters', array($this, 'filterRequestParameters'));
    
    // обработка формата
    //$this->dispatcher->connect('view.configure_format', array($this, 'configureIPhoneFormat'));
  }
  
  /**
   * Обработка параметров запроса и проверка, находимся ли мы в мобильной версии
   *
   * @param sfEvent $event
   * @param unknown_type $parameters
   * @return unknown
   */
  public function filterRequestParameters(sfEvent $event, $parameters)
  {
    $request = $event->getSubject();
    
    // установка формата запрос для мобильной версии - mobile   
	if ( sfContext::getInstance()->getConfiguration()->getEnvironment() == 'mobile' ) {
      //$request->setRequestFormat('mobile');
    }    

    return $parameters;
  }
}
