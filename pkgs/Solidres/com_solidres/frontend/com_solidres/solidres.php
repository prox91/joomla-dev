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

require_once JPATH_COMPONENT.'/helpers/route.php';

JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');

$controller	= JControllerLegacy::getInstance('Solidres');
$controller->execute(JFactory::getApplication()->input->get('task', '', 'cmd'));
$controller->redirect();