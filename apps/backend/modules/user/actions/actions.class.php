<?php

/**
 * user actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class userActions extends autouserActions
{
	
  protected function updateUserFromRequest()
  {
    $user = $this->getRequestParameter('user');

    if (isset($user['created_at']))
    {
      if ($user['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($user['created_at']))
          {
            $value = $dateFormat->format($user['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $user['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->user->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->user->setCreatedAt(null);
      }
    }
    if (isset($user['timezone_id']))
    {
    $this->user->setTimezoneId($user['timezone_id'] ? $user['timezone_id'] : null);
    }
    if (isset($user['name']))
    {
      $this->user->setName($user['name']);
    }
    if (isset($user['email']))
    {
      $this->user->setEmail($user['email']);
    }
    if (isset($user['password']) && isset($user['update_password']) )
    {
      $this->user->setPasswordEncoded($user['password']);
    }
    if (isset($user['profile']))
    {
      $this->user->setProfile($user['profile']);
    }
    $this->user->setIsActive(isset($user['is_active']) ? $user['is_active'] : 0);
    if (isset($user['remember_me_code']))
    {
      $this->user->setRememberMeCode($user['remember_me_code']);
    }
    if (isset($user['ip']))
    {
      $this->user->setIp($user['ip']);
    }
    if (isset($user['last_login']))
    {
      if ($user['last_login'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($user['last_login']))
          {
            $value = $dateFormat->format($user['last_login'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $user['last_login'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->user->setLastLogin($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->user->setLastLogin(null);
      }
    }
    if (isset($user['lang']))
    {
      $this->user->setLang($user['lang']);
    }
    if (isset($user['phpbb_id']))
    {
      $this->user->setPhpbbId($user['phpbb_id']);
    }
    if (isset($user['remind_code']))
    {
      $this->user->setRemindCode($user['remind_code']);
    }    
    $this->user->setSubscribeNews(isset($user['subscribe_news']) ? $user['subscribe_news'] : 0);
    $this->user->setSubscribePhoto(isset($user['subscribe_photo']) ? $user['subscribe_photo'] : 0);
    $this->user->setSubscribeVideo(isset($user['subscribe_video']) ? $user['subscribe_video'] : 0);    
    if (isset($user['notes']))
    {
      $this->user->setNotes($user['notes']);
    }    
  }
  	
}
