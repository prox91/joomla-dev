<?php
/**
 * @package     redSocialstream
 * @subpackage  Backend
 *
 * @todo        move this code in the front controller...
 * @todo        make the left menu a template
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

define('FACEBOOK', 1);
define('TWITTER', 2);
define('LINKEDIN', 3);
define('YOUTUBE', 4);
define('DEFAULT_PRODUCT_ORDERING_METHOD', 1);

$controller = JRequest::getCmd('view', 'redsocialstreams');

//set the controller page
if (!file_exists(JPATH_COMPONENT . '/controllers/' . $controller . '.php'))
{
	$controller = 'posts';
	JRequest::setVar('controller', 'profiles');
}
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_redsocialstream/assets/css/com_redsocialstream.css');

//set the controller page
require_once JPATH_COMPONENT . '/controllers/' . $controller . '.php';

// Create the controller
$classname = $controller . 'controller';

//create a new class of classname and set the default task:display
$controller = new $classname(array('default_task' => 'display'));

// Perform the Request task
$controller->execute(JRequest::getVar('task'));

JSubMenuHelper::addEntry(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'), 'index.php?option=com_redsocialstream');
JSubMenuHelper::addEntry(JText::_('COM_REDSOCIALSTREAM_PROFILES'), 'index.php?option=com_redsocialstream&view=profiles');
JSubMenuHelper::addEntry(JText::_('COM_REDSOCIALSTREAM_GROUPS'), 'index.php?option=com_redsocialstream&view=groups');
JSubMenuHelper::addEntry(JText::_('COM_REDSOCIALSTREAM_POSTS'), 'index.php?option=com_redsocialstream&view=posts');
JSubMenuHelper::addEntry(JText::_('COM_REDSOCIALSTREAM_CONFIGURE'), 'index.php?option=com_redsocialstream&view=configure');
JSubMenuHelper::addEntry(JText::_('COM_REDSOCIALSTREAM_ACCESS_TOKEN'), 'index.php?option=com_redsocialstream&view=accesstoken');
JSubMenuHelper::addEntry(JText::_('COM_REDSOCIALSTREAM_POSTFEEDS'), 'index.php?option=com_redsocialstream&view=postfeeds');

// Redirect if set by the controller
$controller->redirect();
