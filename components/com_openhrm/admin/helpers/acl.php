<?php
defined('_JEXEC') or die;

class OpenHrmHelpersAcl
{
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   int  $categoryId  The category ID.
	 *
	 * @return	JObject
	 */
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_openhrm';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_openhrm.category.' . (int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_openhrm', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}
