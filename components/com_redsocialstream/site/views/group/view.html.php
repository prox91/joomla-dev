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
		global $mainframe;
		$mainframe = JFactory::getApplication();
		$params = $mainframe->getparams();
		$groupeid = JRequest::getVar('groupid');
		$profiletypeid = JRequest::getVar('profiletypeid');

		$doc = JFactory::getDocument();
		$doc->addStyleSheet("components/com_redsocialstream/assets/css/redsocialstream_group.css");
		JHTML::Script('jquery.js', 'components/com_redsocialstream/assets/js/', false);
		JHTML::_('behavior.mootools');
		JHTML::_('behavior.framework', true);

		$model = $this->getModel();


		if ($params->get('groupid') != array())
		{
			$group = $model->getgroupdata($params->get('groupid'));
			$this->assignRef('groupinfo', $group);
		}

		$limit = JRequest::getVar('limit');
		if ($limit == "")
		{
			$limit = $params->get('feedlimit');
		}

		if ($profiletypeid == "")
		{
			if ($params->get('profiletypeid') != "")
			{
				$profiletypeid = $params->get('profiletypeid');
			}
		}

		$feedlists = $model->getfeedslist($groupeid, $profiletypeid);
		$this->feedlists = $feedlists;
		$this->posts = $model->getposts($groupeid, $profiletypeid, $limit);
		$this->profiletypeid = $profiletypeid;
		$this->limit = $limit;

		parent::display($tpl);
	}
}
?> 

