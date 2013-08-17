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
		global $option, $mainframe;
		$mainframe = JFactory::getApplication();
		$params = $mainframe->getparams();
		$groupid = $params->get('groupid');
		$profiletypes = $params->get('multiprofiletypeid');
		if (count($profiletypes) > 0)
		{
			$profiletypeid = implode(",", $profiletypes);
		}
		$limit = $params->get('feedlimit');
		$orderby = $params->get('orderby');
		$headline = $params->get('headline');

		//Get Group Information
		$model = $this->getModel();
		$group = $model->getgroupdata($groupid);
		$this->assignRef('groupinfo', $group);
		//End

		$doc = JFactory::getDocument();
		$doc->addStyleSheet("components/com_redsocialstream/assets/css/redsocialstream_group.css");
		JHTML::Script('jquery.js', 'components/com_redsocialstream/assets/js/', false);
		JHTML::_('behavior.mootools');
		JHTML::_('behavior.framework', true);
		$this->assignRef('groupid', $groupid);
		$this->assignRef('profiletypeid', $profiletypeid);
		$this->assignRef('limit', $limit);
		$this->assignRef('orderby', $orderby);
		$this->assignRef('headline', $headline);
		$fbpost = $model->getposts($groupid, 1, $limit, $orderby);
		$twposts = $model->getposts($groupid, 2, $limit, $orderby);
		$youtubeposts = $model->getposts($groupid, 6, $limit, $orderby);
		$linkedinposts = $model->getposts($groupid, 7, $limit, $orderby);

		if (count($profiletypes) > 0)
		{
			if (in_array('1', $profiletypes))
			{
				$this->assignRef('fbposts', $fbpost);
			}
			if (in_array('2', $profiletypes))
			{
				$this->assignRef('twposts', $twposts);
			}
			if (in_array('6', $profiletypes))
			{
				$this->assignRef('youtubeposts', $youtubeposts);
			}
			if (in_array('7', $profiletypes))
			{
				$this->assignRef('linkedinposts', $linkedinposts);
			}
		}
		parent::display($tpl);
	}
}
?> 

