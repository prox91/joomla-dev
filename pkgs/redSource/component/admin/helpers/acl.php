<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Helpers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Acl helper.
 *
 * @package     Redsource.Admin
 * @subpackage  Helpers
 * @since       1.0
 */
final class RedsourceHelpersAcl
{
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   string  $section    The section.
	 * @param   mixed   $assetName  The asset name.
	 *
	 * @return  JObject
	 */
	public static function getActions($section = 'component', $assetName = 'com_redsource')
	{
		$user = JFactory::getUser();
		$result	= new JObject;
		$actions = JAccess::getActions('com_redsource', $section);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}
