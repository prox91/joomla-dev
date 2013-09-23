<?php
/**
 * @package     Jab.Admin
 * @subpackage  Helpers
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

/**
 * Main Helper
 *
 * @package     Jab.Admin
 * @subpackage  Helpers
 *
 * @since       2.5
 */
class JabHelper
{
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   int  $categoryId  The category ID.
	 *
	 * @return	JObject
	 *
	 * @since	2.5
	 */
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_jab';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_jab.category.' . (int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_jab', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}

	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return	void
	 *
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_JAB_SPEAKERS'),
			'index.php?option=com_jab&view=speakers',
			$vName == 'speakers'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAB_COUNTRIES'),
			'index.php?option=com_jab&view=countries',
			$vName == 'countries'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_JAB_STATES'),
			'index.php?option=com_jab&view=states',
			$vName == 'states'
		);
	}

}
