<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nha.redweb
 * Date: 4/3/13
 * Time: 11:47 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;

jimport('legacy.controller.legacy');

// Get instance of controller frefixed by EnglishConcept
$controller = JControllerLegacy::getInstance('OpenHrm');

// Perform the request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
