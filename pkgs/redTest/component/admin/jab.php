<?php
/**
 * @package     Jab.Admin
 * @subpackage  Entry
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

// Register component prefix
JLoader::registerPrefix('Jab', __DIR__);
RLoader::registerPrefix('Jab', JPATH_LIBRARIES . '/jab');

// Require redRAD
require_once JPATH_LIBRARIES . '/redrad/bootstrap.php';

$app = JFactory::getApplication();

// Check access.
if (!JFactory::getUser()->authorise('core.manage', 'com_redtest'))
{
	$app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');

	return false;
}

// Instanciate and execute the front controller.
$controller = JControllerLegacy::getInstance('Jab');
$controller->execute($app->input->get('task'));
$controller->redirect();
