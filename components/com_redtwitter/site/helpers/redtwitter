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

	public static function get_twitter_connection()
	{
		$oauth_info = self::_get_oauth_info();
		if(is_object($oauth_info))
		{
			self::$connection = new TwitterOAuth($oauth_info->consumer_key, $oauth_info->consumer_secret, $oauth_info->access_token, $oauth_info->access_token_secret);
		}
	}

	public static function get_timeline_twitter($screen_name, $order_type = 0, $max_item_displayed = 20)
	{
		self::get_twitter_connection();
		$param = array(
					'screen_name' => $screen_name,
					);

		$info_list = array();
		if(!empty(self::$connection))
		{
			$info_list = self::$connection->get('statuses/user_timeline', $param);
		}

		$twitter_data = array();
		if(count($info_list) > 0)
		{
			foreach ($info_list as $key => $info)
			{
				$date  = new DateTime($info->created_at);
				$pDate = $date->format("Y-m-d H:i:s");

				$id = (string) $info->user->id;

				$name              = (string) $info->user->name;
				$screen_name       = (string) $info->user->screen_name;
				$title             = (string) $info->text;
				$profile_image_url = (string) $info->user->profile_image_url;
				$description       = (string) $info->text;
				$link              = (string) 'https://twitter.com/amazon/statuses/' . $info->id_str;
				$pubDate           = (string) $pDate;

				$twitter_data[strtotime($pDate)] = array(
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
		// Order by date
		if ($order_type == 0)
		{
			ksort($twitter_data);
		}
		else // Order by name
		{
			self::_sort_by_key($twitter_data, 'name');
		}

		return array_reverse($twitter_data);
	}

	private static function _get_oauth_info()
	{
		$db = JFactory::getDbo();
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
			}
			catch (exception $e)
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
			}
			catch (exception $e)
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

		$dt1      = array();
		$array1   = array();
		$j        = 0;

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
			}
			catch (RuntimeException $e)
			{
				try
				{
					$transport  = new JHttpTransportCurl($options);
					self::$http = new JHttp($options, $transport);
				}
				catch (RuntimeException $e)
				{
					try
					{
						$transport  = new JHttpTransportSocket($options);
						self::$http = new JHttp($options, $transport);
					}
					catch (RuntimeException $e)
					{
					}
				}
			}
		}

		try
		{
			$response_content = self::$http->get($host)->body;
		}
		catch (RuntimeException $e)
		{
			$response_content = array();
		}

		return $response_content;
	}
}
