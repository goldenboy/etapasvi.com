<?php

class Item2item extends BaseItem2item
{
  /**
   * Получение названия типа первого элемента
   *
   * @return unknown
   */
  public function getItem1TypeName()
  {
  	return ItemtypesPeer::getItemTypeName( $this->getItem1Type() );
  }
  
  /**
   * Получение названия типа второго элемента
   *
   * @return unknown
   */
  public function getItem2TypeName()
  {
  	return ItemtypesPeer::getItemTypeName( $this->getItem2Type() );
  }  
  
  public function getItem1Title()
  {  	
  	return Item2itemPeer::getItemTitle( $this->getItem1TypeName(), $this->getItem1Id() );
  }
  
  public function getItem2Title()
  {  	
  	return Item2itemPeer::getItemTitle( $this->getItem2TypeName(), $this->getItem2Id() );
  }
}
