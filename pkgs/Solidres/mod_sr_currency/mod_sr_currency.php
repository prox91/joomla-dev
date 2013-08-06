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

require_once __DIR__.'/helper.php';

$lang = JFactory::getLanguage();

JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);
JLoader::import('joomla.application.component.model');
JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/models', 'SolidresModel');
$currencyModel = JModelLegacy::getInstance('Currencies', 'SolidresModel', array('ignore_request' => true));
$currencyModel->setState('list.start', 0);
$currencyModel->setState('list.limit', 0);
$currencyModel->setState('filter.state', 1);
$currencyModel->setState('list.ordering', 'u.currency_name');
$currencyList = $currencyModel->getItems();
require JModuleHelper::getLayoutPath('mod_sr_currency', $params->get('layout', 'default'));
