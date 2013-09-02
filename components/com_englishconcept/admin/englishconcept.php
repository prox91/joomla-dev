<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nha.redweb
 * Date: 4/3/13
 * Time: 11:46 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// require helper file
JLoader::register('EnglishConceptHelper', dirname(__FILE__) . '/helpers/englishconcept.php');
require_once (JPATH_ADMINISTRATOR . '/components/com_englishconcept/classes/ec.view.admin.php');

// Get an instance of the controller
$controller = JControllerLegacy::getInstance('EnglishConcept');

// Get the task
$input = JFactory::getApplication()->input;
$task = $input->get('task', "", 'SRT');

// Perform the Request task
$controller->execute($task);

// Redirect if set by the controller
$controller->redirect();
