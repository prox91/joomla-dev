<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

include(JPATH_BASE . "/components/com_redtwitter/libs/twitteroauth/OAuth.php");
include(JPATH_BASE . "/components/com_redtwitter/libs/twitteroauth/twitteroauth.php");

/**
 * Class RedtwitterHelper
 */
abstract class RedtwitterHelper
{
	/**
	 * @var
	 */
	public static $connection = null;

	/**
	 * @param $user_list
	 * @param int $order_type
	 * @param int $max_item_displayed
	 *
	 * @return array
	 */
	public static function get_all_twitter_timelines($user_list, $order_type = 0, $max_item_displayed = 20)
	{
		$twitter_timelines = array();

		$twitter_data_list = array();
		$i                 = 0;

		foreach ($user_list as $user)
		{
			if (!empty($user->twitterusername))
			{
				$params = array(
					'screen_name' => $user->twitterusername,
					'include_rts' => 1
				);
				$result = self::get_timeline_twitter($params);

				if (is_array($result))
				{
					$twitter_data_list[$i] = $result;
					$i++;
				}
			}
		}

		$num_real_user = count($twitter_data_list);
		$num_count     = (int) ($max_item_displayed / $num_real_user);

		$num_count_ext = 0;
		$remain        = ($max_item_displayed - ($num_count * $num_real_user));

		if ($remain != 0)
		{
			$num_count_ext = $remain;
		}

		$i     = 0;
		$index = 0;

		foreach ($twitter_data_list as $twitter_data)
		{
			if ($index == ($num_real_user - 1))
			{
				$num_count += $num_count_ext;
			}

			$index++;

			if (count($twitter_data) > 0)
			{
				foreach ($twitter_data as $key => $data)
				{
					$date  = new DateTime($data->created_at);
					$pDate = $date->format("Y-m-d H:i:s");

					$id                = (string) $data->user->id;
					$name              = (string) $data->user->name;
					$screen_name       = (string) $data->user->screen_name;
					$title             = (string) $data->text;
					$profile_image_url = (string) $data->user->profile_image_url;
					$description       = (string) $data->text;
					$link              = (string) 'https://twitter.com/' . $screen_name . '/statuses/' . $data->id_str;
					$pubDate           = (string) $pDate;

					$twitter_timelines[$i++] = array(
						'id'                => $id,
						'name'              => $name,
						'screen_name'       => $screen_name,
						'title'             => $title,
						'profile_image_url' => $profile_image_url,
						'description'       => $description,
						'link'              => $link,
						'pdate'             => $pubDate,
						'pdate_time'       => strtotime($pDate)
					);

					if ($key == ($num_count-1))
					{
						break;
					}
				}
			}
		}

		// Order by date
		if ($order_type == 0)
		{
			self::_sort_by_key($twitter_timelines, 'pdate_time');
			return array_reverse($twitter_timelines);
		}
		else // Order by name
		{
			self::_sort_by_key($twitter_timelines, 'name');
			return $twitter_timelines;
		}
	}

	/**
	 * @param $screen_name
	 * @param int $order_type
	 * @param int $max_item_displayed
	 *
	 * @return array
	 */
	public static function get_timeline_twitter($params)
	{
		if (empty(self::$connection))
		{
			self::$connection = self::get_twitter_connection();
		}

		if (!empty(self::$connection))
		{
			return self::$connection->get('statuses/user_timeline', $params);
		}

		return array();
	}

	/**
	 *
	 */
	public static function get_twitter_connection()
	{
		$oauth_info = self::_get_oauth_info();

		if (is_object($oauth_info))
		{
			return new TwitterOAuth($oauth_info->consumer_key, $oauth_info->consumer_secret, $oauth_info->access_token, $oauth_info->access_token_secret);
		}

		return null;
	}

	/**
	 * @return JException|mixed
	 */
	private static function _get_oauth_info()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('id, consumer_key, consumer_secret, access_token, access_token_secret')
			->from($db->quoteName('#__redtwitter_oauth_info'))
			->where('state = 1');

		// Get the authorize information
		$db->setQuery($query);

		try
		{
			return $db->loadObject();
		}
		catch (RuntimeException $e)
		{
			return new JException(JText::sprintf('COM_USERS_DATABASE_ERROR', $e->getMessage()), 500);
		}
	}

	/**
	 * @param $arr
	 * @param $key
	 *
	 * @return mixed
	 */
	private static function _sort_by_key(&$arr, $key)
	{
		global $key2sort;
		$key2sort = $key;
		usort($arr, "self::_sbk");

		return ($arr);
	}

	/**
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	private static function _sbk($a, $b)
	{
		global $key2sort;

		return (strcasecmp($a[$key2sort], $b[$key2sort]));
	}
}