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

class redsocialstreamViewposts extends JView
{
	function display($tpl = null)
	{

		$mainframe = JFactory::getApplication();
		$params = $mainframe->getparams();
		$doc = JFactory::getDocument();
		$doc->addStyleSheet("components/com_redsocialstream/assets/css/redsocialstream_group.css");
		$session = JFactory::getSession();
		$uri = JFactory::getURI();
		$user = JFactory::getUser();
		$model = $this->getModel();
		$groupid = JRequest::getVar('groupid');

		//Get Group Information
		$model = $this->getModel();
		$group = $model->getgroupdata($groupid);
		$this->assignRef('groupinfo', $group);
		//End

		$profiletypeid = JRequest::getVar('profiletypeid');
		$types = explode(",", $profiletypeid);
		if (JRequest::getVar('task') == "save")
		{
			$oauth_token = JRequest::getVar('oauth_token');
			for ($i = 0; $i < count($types); $i++)
			{
				$data = $model->getfeeds($groupid, $types[$i], $oauth_token);
			}
			echo "ok";
		}
		if (JRequest::getVar('task') == "getajaxposts")
		{
			$limit = JRequest::getVar('limit');
			$orderby = JRequest::getVar('orderby');

			if (in_array('1', $types))
			{
				$this->assignRef('fbposts', $model->getposts($groupid, 1, $limit, $orderby));
			}
			if (in_array('2', $types))
			{
				$this->assignRef('twposts', $model->getposts($groupid, 2, $limit, $orderby));
			}
			if (in_array('6', $types))
			{
				$this->assignRef('youtubeposts', $model->getposts($groupid, 6, $limit, $orderby));
			}
			if (in_array('7', $types))
			{
				$this->assignRef('linkedinposts', $model->getposts($groupid, 7, $limit, $orderby));
			}
			$tpl = "ajaxposts";
			parent::display($tpl);
		}
	}
}
?> 

