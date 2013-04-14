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

/**
 * Class RedtwitterHelper
 */
abstract class HelloWorldHelper
{
	public static $http;

	/**
	 * getcom_twitter
	 *
	 * @param   array $login  Login info
	 *
	 * @return   $tweeters
	 */
	public static function getcom_twitter($login)
	{
		$tweets = "http://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $login;
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
		$tweets = "http://api.twitter.com/1.1/statuses/user_timeline.xml?screen_name=" . $name;
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
