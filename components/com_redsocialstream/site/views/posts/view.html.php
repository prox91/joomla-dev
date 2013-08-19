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
		$this->groupinfo= $group;
		//End

		$doc = JFactory::getDocument();
		$doc->addStyleSheet("components/com_redsocialstream/assets/css/redsocialstream_group.css");
		JHTML::Script('jquery.js', 'components/com_redsocialstream/assets/js/', false);
		JHTML::_('behavior.mootools');
		JHTML::_('behavior.framework', true);

        $this->groupid = $groupid;
		$this->profiletypeid = $profiletypeid;
		$this->limit = $limit;
		$this->orderby = $orderby;
		$this->headline = $headline;

		$fbpost = $model->getposts($groupid, FACEBOOK, $limit, $orderby);
		$twposts = $model->getposts($groupid, TWITTER, $limit, $orderby);
		$youtubeposts = $model->getposts($groupid, YOUTUBE, $limit, $orderby);
		$linkedinposts = $model->getposts($groupid, LINKEDIN, $limit, $orderby);

		if (count($profiletypes) > 0)
		{
			if (in_array(FACEBOOK, $profiletypes))
			{
				$this->fbposts = $fbpost;
			}
			if (in_array(TWITTER, $profiletypes))
			{
				$this->twposts = $twposts;
			}
			if (in_array(YOUTUBE, $profiletypes))
			{
				$this->youtubeposts = $youtubeposts;
			}
			if (in_array(LINKEDIN, $profiletypes))
			{
				$this->linkedinposts = $linkedinposts;
			}
		}
		parent::display($tpl);
	}
}
?> 

