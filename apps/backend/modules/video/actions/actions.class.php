<?php

/**
 * video actions.
 *
 * @package    sf_sandbox
 * @subpackage video
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class videoActions extends autovideoActions
{
	public function executeList(sfWebRequest $request)
	{
		$this->getUser()->setCulture(UserPeer::DEFAULT_CULTURE);
		parent::executeList($request);
	}		
}
