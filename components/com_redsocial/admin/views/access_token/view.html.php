<?php
/**
 * @package     redSocialstream
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
class access_tokenViewaccess_token extends JView
{
	function display($tpl = null)
	{
		JToolBarHelper::title(JText::_('COM_REDSOCIALSTREAM_ACCESS_TOKEN'), 'configure.png');
		JToolBarHelper::cancel('cancel', 'COM_REDSOCIALSTREAM_CLOSE');
		//DEVNOTE: set document title
		$document =  JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'));
		$mainframe = JFactory::getApplication();
		$context = "config";
		$session = JFactory::getSession();
		$twitter_profile_id = $session->get('twitter_profile_id');
		$linkedin_profile_id = $session->get('linkedin_profile_id');

		$model = $this->getModel('access_token');
		$task = JRequest::getVar('task');
		if ($task == 'genearteToken')
		{
			/* Load the data to export */
			$result = $this->get('Data');
		}
		$code = JRequest::getVar('code');
		if ($code != "")
		{
			$model->saveFbAcceesToken($code);
		}
		$oauth_verifier = JRequest::getVar('oauth_verifier');
		$oauth_token = JRequest::getVar('oauth_token');
		if ($oauth_verifier != "" && $oauth_token != "" && $twitter_profile_id)
		{
			$model->saveTwitterAcceesToken($oauth_token);
		}
		if ($oauth_verifier != "" && $oauth_token != "" && $linkedin_profile_id)
		{
			$model->saveLinkedinAcceesToken($oauth_token, $oauth_verifier);
		}
		$fbprofiles = $model->getFbProfiles(1);
		$lists['fbprofiles'] = $fbprofiles;

		$twitterprofiles = $model->getTwiterProfiles(2);
		$lists['twitterprofiles'] = $twitterprofiles;

		$linkedinprofiles = $model->getLinkedinProfiles(7);
		$lists['linkedinprofiles'] = $linkedinprofiles;

		JToolBarHelper :: custom('genearteToken', 'redsocialstream_import_generate32', JText::_('COM_REDSOCIALSTREAM_GENERATE_ACCESS_TOKEN'), JText::_('COM_REDSOCIALSTREAM_GENERATE_ACCESS_TOKEN'), false, false);
		$this->assignRef('result', $result);
		$this->assignRef('lists', $lists);
		parent::display($tpl);
	}
}
?> 
