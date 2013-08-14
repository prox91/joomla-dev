<?php
/**
 * @package     redSocialstream
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class AccessTokenController extends JController
{
	function __construct($config = array())
	{
		parent::__construct($config);
	}

    public function getAccessToken()
    {
         /*
         $session = JFactory::getSession();
         $twitter_profile_id = $session->get('twitter_profile_id');
         $linkedin_profile_id = $session->get('linkedin_profile_id');

         $model = $this->getModel('AccessToken');
         $task = JRequest::getVar('task');
         if ($task == 'genearteToken')
         {
             // Load the data to export
             $result = $this->get('Data');
         }
         */

    }

	public function cancel()
	{
		$this->setRedirect('index.php?option=com_redsocialstream');
	}
}
