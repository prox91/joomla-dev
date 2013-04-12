<?php
/**
 * @version    Id: helper.php
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */
defined('_JEXEC') or die('Restricted access');

JLoader::register('RedtwitterHelper', JPATH_SITE . '/components/com_redtwitter/helpers/redtwitter.php');

/**
 * Class modRedTwitterHelper
 */
abstract class modRedTwitterHelper
{
	/**
	 * @param array $twitter_id
	 * @param $order_type
	 * @param $max_item_displayed
	 * @return array
	 */
	public static function getTwitterList($twitter_id = array(), $order_type = 0, $max_item_displayed = 10)
	{
		JModelLegacy::addIncludePath(JPATH_ROOT . '/components/com_redtwitter/models', 'redtwitterModelfollowedprofiles');
		$model = JModelLegacy::getInstance('followedprofiles', 'redtwitterModel', array('ignore_request' => true));

		$twitter_user_list =& $model->getData($twitter_id);

		$twitter_data_timelines = RedtwitterHelper::get_all_twitter_timelines($twitter_user_list, $order_type, $max_item_displayed);
		return $twitter_data_timelines;
	}

	/**
	 * @param $time
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