<?php

class PhotoalbumPeer extends BasePhotoalbumPeer
{
  const ITEMS_PER_PAGE 			= 12;
  
  /**
   * Добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addVisibleCriteria($c)
  {  
    
  }
}
