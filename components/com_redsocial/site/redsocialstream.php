<?php
defined('_JEXEC') or die;

global $mainframe;
$mainframe = JFactory::getApplication();
jimport('joomla.html.parameter');

$option = JRequest::getCmd('option');
$controller = JRequest::getCmd('view', 'redsocialstream');

//set the default controller page
if (!file_exists(JPATH_COMPONENT . '/controllers/' . $controller . '.php'))
{
	$controller = 'redsocialstream';

}

//set the controller page 
require_once JPATH_COMPONENT . '/controllers/'. $controller . '.php';

// Create the controller
$classname = $controller . 'controller';

//create a new class of classname and set the default task:display
$controller = new $classname(array('default' => 'display'));

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
?>