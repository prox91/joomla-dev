<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

if (!JFactory::getUser()->authorise('core.manage', 'com_solidres'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

require_once JPATH_COMPONENT_ADMINISTRATOR.'/liveupdate/solidresliveupdate.php';
if( JFactory::getApplication()->input->get('view', '', 'cmd') == 'liveupdate') {
	LiveUpdate::handleRequest();
	return;
}

require_once JPATH_COMPONENT.'/helpers/sidenavigation.php';
require_once JPATH_COMPONENT.'/helpers/helper.php';

$controller	= JControllerLegacy::getInstance('Solidres');
$controller->execute(JFactory::getApplication()->input->get('task', '', 'cmd'));
$controller->redirect();