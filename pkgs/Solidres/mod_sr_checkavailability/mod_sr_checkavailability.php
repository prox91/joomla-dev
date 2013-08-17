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

JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

require_once __DIR__.'/helper.php';
$lang = JFactory::getLanguage();
$app = JFactory::getApplication();
$context = 'com_solidres.reservation.process';
$checkin = $app->getUserState($context.'.checkin');
$checkout = $app->getUserState($context.'.checkout');
JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/tables', 'SolidresTable');
$default = JTable::getInstance('ReservationAsset', 'SolidresTable');
$default->load(array('default' => 1));
require JModuleHelper::getLayoutPath('mod_sr_checkavailability', $params->get('layout', 'default'));
