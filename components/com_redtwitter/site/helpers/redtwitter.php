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
	public static $http;

	/**
	 * @var
	 */
	public static $connection = null;

	/**
	 * @param $user_list
	 * @param int $order_type
	 * @param int $max_item_displayed
	 * @return array
	 */
	public static function get_all_twitter_timelines($user_list, $order_type = 0, $max_item_displayed = 20)
	{
		$twitter_timelines = array();

		$num_user  = count($user_list);
		$num_count = (int) ($max_item_displayed / $num_user);

		$num_count_ext = 0;
		if ($remain = ($max_item_displayed - ($num_count * $num_user)) != 0)
		{
			$num_count_ext = $remain;
		}

		$twitter_data_list = array();
		for ($i = 0; $i < $num_user; $i++)
		{
			if (!empty($user_list[$i]->twitterusername))
			{
				if ($num_count_ext != 0 && $i == $num_user - 1)
				{
					$num_count = $num_count_ext;
				}
				$params                = array(
					'screen_name' => $user_list[$i]->twitterusername,
					'count'       => $num_count
				);
				$twitter_data_list[$i] = self::get_timeline_twitter($params);
			}
		}

		foreach ($twitter_data_list as $twitter_data)
		{
			if (count($twitter_data) > 0)
			{
				foreach ($twitter_data as $data)
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

					$twitter_timelines[time()] = array(
						'id'                => $id,
						'name'              => $name,
						'screen_name'       => $screen_name,
						'title'             => $title,
						'profile_image_url' => $profile_image_url,
						'description'       => $description,
						'link'              => $link,
						'pdate'             => $pubDate,
					);
				}
			}
		}

		// Order by date
		if ($order_type == 0)
		{
			self::_sort_by_key($twitter_timelines, 'pdate');
		}
		else // Order by name
		{
			self::_sort_by_key($twitter_timelines, 'name');
		}

		return array_reverse($twitter_timelines);
	}

	/**
	 * @param $screen_name
	 * @param int $order_type
	 * @param int $max_item_displayed
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
		} catch (RuntimeException $e)
		{
			return new JException(JText::sprintf('COM_USERS_DATABASE_ERROR', $e->getMessage()), 500);
		}
	}

	/**
	 * getcom_twitter
	 *
	 * @param   array $login  Login info
	 *
	 * @return   $tweeters
	 */
	public static function getcom_twitter($login)
	{
		$tweets = "http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=" . $login;
		$twi    = self::_get_response_content($tweets);

		if ($twi != "")
		{
			try
			{
				$tweeters = new SimpleXMLElement($twi);
			} catch (exception $e)
			{
				$tweeters = '';
			}
		}
		else
		{
			$tweeters = '';
		}

		return $tweeters;
	}

	/**
	 * getcom_twitter_detail
	 *
	 * @param   array $name  Name
	 *
	 * @return   $tweeters
	 */
	public static function getcom_twitter_detail($name)
	{
		$tweets = "http://api.twitter.com/1/statuses/user_timeline.xml?screen_name=" . $name;
		$twi    = self::_get_response_content($tweets);

		$tweeters = '';

		if ($twi != "")
		{
			try
			{
				$tweeters = new SimpleXMLElement($twi);
			} catch (exception $e)
			{
				$tweeters = '';
			}
		}

		return $tweeters;
	}

	/**
	 * @param $lists
	 * @param $order_type
	 * @param $max_item_displayed
	 *
	 * @return array
	 */
	public static function get_alldata($lists, $order_type = 0, $max_item_displayed = 20)
	{
		$twitdata   = array();
		$twiterdata = array();
		$twitusers  = $lists;

		for ($i = 0; $i < count($twitusers); $i++)
		{
			if (isset($twitusers[$i]->twitterusername))
			{
				if ($twitusers[$i]->twitterusername != "")
				{
					$twitdata[$i]   = self::getcom_twitter($twitusers[$i]->twitterusername);
					$twiterdata[$i] = self::getcom_twitter_detail($twitusers[$i]->twitterusername);
				}
			}
		}

		$dt1    = array();
		$array1 = array();
		$j      = 0;

		for ($a = 0; $a < count($twitdata); $a++)
		{
			if (count($twitdata[$a]->channel->item) > 0)
			{
				$r = 1;

				foreach ($twitdata[$a]->channel->item as $twit1)
				{
					$date    = new DateTime($twit1->pubDate);
					$dt1[$j] = $date->format("Y-m-d H:i:s");

					$id = (string) $twiterdata[$a]->status[$r]->user->id;

					$name              = (string) $twiterdata[$a]->status[$r]->user->name;
					$screen_name       = (string) $twiterdata[$a]->screen_name
						? (string) $twiterdata[$a]->screen_name : str_replace('http://twitter.com/', '', $twitdata[$a]->channel->link);
					$title             = (string) $twit1->title;
					$profile_image_url = (string) $twiterdata[$a]->status[$r]->user->profile_image_url;
					$description       = (string) $twit1->description;
					$link              = (string) $twit1->link;
					$pubDate           = (string) $twit1->pubDate;

					$array1[strtotime($dt1[$j])] = array(
						'id'                => $id,
						'name'              => $name,
						'screen_name'       => $screen_name,
						'title'             => $title,
						'profile_image_url' => $profile_image_url,
						'description'       => $description,
						'link'              => $link,
						'pdate'             => $pubDate,
					);
					$j++;

					if ($r == (int) ($max_item_displayed / count($lists)))
					{
						break;
					}

					$r++;
				}
			}
		}

		// Order by date
		if ($order_type == 0)
		{
			ksort($array1);
		}
		else // Order by name
		{
			self::_sort_by_key($array1, 'name');
		}

		return array_reverse($array1);
	}

	/**
	 * @param $arr
	 * @param $key
	 *
	 * @return mixed
	 */
	private static function _sort_by_key($arr, $key)
	{
		global $key2sort;
		$key2sort = $key;
		uasort($arr, 'self::_sbk');

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

	/**
	 * @param $host
	 *
	 * @return array
	 */
	private static function _get_response_content($host)
	{
		if (empty(self::$http))
		{
			$options = new JRegistry;

			try
			{
				$transport  = new JHttpTransportStream($options);
				self::$http = new JHttp($options, $transport);
			} catch (RuntimeException $e)
			{
				try
				{
					$transport  = new JHttpTransportCurl($options);
					self::$http = new JHttp($options, $transport);
				} catch (RuntimeException $e)
				{
					try
					{
						$transport  = new JHttpTransportSocket($options);
						self::$http = new JHttp($options, $transport);
					} catch (RuntimeException $e)
					{
					}
				}
			}
		}

		try
		{
			$response_content = self::$http->get($host)->body;
		} catch (RuntimeException $e)
		{
			$response_content = array();
		}

		return $response_content;
	}
}
