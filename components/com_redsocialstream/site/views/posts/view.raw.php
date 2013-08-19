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
		$this->groupinfo= $group;
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

			if (in_array(FACEBOOK, $types))
			{
				$this->fbposts = $model->getposts($groupid, FACEBOOK, $limit, $orderby);
			}
			if (in_array(TWITTER, $types))
			{
				$this->twposts = $model->getposts($groupid, TWITTER, $limit, $orderby);
			}
			if (in_array(YOUTUBE, $types))
			{
				$this->youtubeposts = $model->getposts($groupid, YOUTUBE, $limit, $orderby);
			}
			if (in_array(LINKEDIN, $types))
			{
				$this->linkedinposts = $model->getposts($groupid, LINKEDIN, $limit, $orderby);
			}
			$tpl = "ajaxposts";

			parent::display($tpl);
		}
	}
}
?> 

