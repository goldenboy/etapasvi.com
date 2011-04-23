<?php

/**
 * upload actions.
 *
 * @package    sf_sandbox
 * @subpackage upload
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class uploadActions extends autouploadActions
{
protected function updateUploadFromRequest()
  {
    $upload = $this->getRequestParameter('upload');

    if (isset($upload['title']))
    {
      $this->upload->setTitle($upload['title']);
    }
    $currentFile = sfConfig::get('sf_upload_dir')."/all/".$this->upload->getUrl();
    if (!$this->getRequest()->hasErrors() && isset($upload['url_remove']))
    {
      $this->upload->setUrl('');
      if (is_file($currentFile))
      {
        unlink($currentFile);
      }
    }

    if (!$this->getRequest()->hasErrors() && $this->getRequest()->getFileSize('upload[url]'))
    {
      //$fileName = md5($this->getRequest()->getFileName('upload[url]').time().rand(0, 99999));
      $fileName = $this->getRequest()->getFileName('upload[url]');
      $ext = $this->getRequest()->getFileExtension('upload[url]');
      if (is_file($currentFile))
      {
        unlink($currentFile);
      }
      //$this->getRequest()->moveFile('upload[url]', sfConfig::get('sf_upload_dir')."/all/".$fileName.$ext);
      $this->getRequest()->moveFile('upload[url]', sfConfig::get('sf_upload_dir')."/all/".$fileName);
      //$this->upload->setUrl($fileName.$ext);
      $this->upload->setUrl($fileName);
    }
    if (isset($upload['preview']))
    {
      $this->upload->setPreview($upload['preview']);
    }
  }	
}
