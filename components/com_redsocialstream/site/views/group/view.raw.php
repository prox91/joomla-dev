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
class redsocialstreamViewgroup extends JView
{
	function display($tpl = null)
	{
		$mainframe = JFactory::getApplication();
		$params = $mainframe->getparams();
		$groupeid = JRequest::getVar('groupid');
		$profiletypeid = JRequest::getVar('profiletypeid');
		$doc = JFactory::getDocument();
		$doc->addStyleSheet("components/com_redsocialstream/assets/css/redsocialstream_group.css");
		$model = $this->getModel();
		$data = array();

		$limit = JRequest::getVar('limit');
		if ($limit == "")
		{
			$limit = $params->get('feedlimit');
		}


		if (JRequest::getVar('task') == "save")
		{
			$oauth_token = JRequest::getVar('oauth_token');
			$data = $model->getfeeds($groupeid, $profiletypeid, $oauth_token);
			echo "ok";
		}
		if (JRequest::getVar('task') == "getajaxposts")
		{
			if ($groupeid != array())
			{
				$group = $model->getgroupdata($groupeid);

				$this->groupinfo = $group;
			}
			 $limit = JRequest::getVar('limit');
			if ($limit == "")
			{
				$limit = $params->get('feedlimit');
			}
			$this->posts = $model->getposts($groupeid, $profiletypeid, $limit);
			$this->limit = $limit;

			$tpl = "ajaxposts";

			parent::display($tpl);
		}

	}
}
?> 

