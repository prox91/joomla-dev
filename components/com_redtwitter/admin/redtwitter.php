<?php
/**
 * @version     1.0.0
 * @package     com_redtwitter
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ronni K. G. Christiansen <email@redweb.dk> - http://www.redcomponent.com
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_redtwitter')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Redtwitter');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
