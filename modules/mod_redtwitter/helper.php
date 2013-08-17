<?php
/**
 * @package     RedTwitter.Frontend
 * @subpackage  mod_redtwitter
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

JLoader::register('RedtwitterHelper', JPATH_SITE . '/components/com_redtwitter/helpers/redtwitter.php');

/**
 * Module Redtwitter Helper.
 *
 * @package     RedTwitter.Frontend
 * @subpackage  Modules
 * @since       1.0
 */
abstract class ModRedTwitterHelper
{
	/**
	 *  Get twitter list
	 *
	 * @param   array  $params  parameter to get twitter list
	 *
	 * @return array
	 */
	public static function getTwitterList($params = array())
	{
		JModelLegacy::addIncludePath(JPATH_ROOT . '/components/com_redtwitter/models', 'redtwitterModelfollowedprofiles');
		$model = JModelLegacy::getInstance('followedprofiles', 'redtwitterModel', array('ignore_request' => true));

		$twitterUserList =& $model->getData($params->get('twitter_id'));

		$twitterDataTimelines = RedtwitterHelper::getAllUserTimeline($twitterUserList, $params->get('order_type', 0), $params->get('item_max_display', 10), $params);

		return $twitterDataTimelines;
	}

	/**
	 * Time ago
	 *
	 * @param   string  $time  time to calculator
	 *
	 * @return string
	 */
	public static function ago($time)
	{
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("1", "60", "60", "24", "7", "4.35", "12", "10");

		$now = time();

		$difference = $now - strtotime($time);

		for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++)
		{
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if ($difference != 1)
		{
			$periods[$j] = JText::_('MOD_REDTWITTER_TWITTER_PLURAL_PERIOD' . $j);
		}
		else
		{
			$periods[$j] = JText::_('MOD_REDTWITTER_TWITTER_PERIOD' . $j);
		}

		return "$difference $periods[$j]";
	}
}
