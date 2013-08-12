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

JLoader::registerPrefix('Red', JPATH_BASE . '/administrator/components/com_redtwitter/libraries');

/**
 * Class RedtwitterHelper
 */
class RedtwitterHelper
{
	/**
	 * @var
	 */
	public static $oauthInfo;

	/**
	 * @var
	 */
	public static $params;

	/**
	 * @param     $userList
	 * @param int $orderType
	 * @param int $maxItemDisplayed
	 *
	 * @return array
	 */
	public static function getAllUserTimeline($userList, $orderType = 0, $maxItemDisplayed = 20, $params = array())
	{

		self::$params = $params;

		// Get authentication info
		self::_getOauthInfo();
		if(empty(self::$oauthInfo))
		{
			return array();
		}

		$cacheTime = 60;
		if (!empty($params) && $params->get('cache') == 1)
		{
			// Fetch cache time from module parameters and convert to seconds
			$cacheTime = $params->get('cache_time', 15);
			$cacheTime = $cacheTime * 60;
		}

		$twitterTimelines = array();
		$twitterDataList = array();
		$i = 0;

		foreach ($userList as $user)
		{
			if (!empty($user->twitterusername))
			{
				$cacheTweets = JPATH_CACHE . '/' . $user->twitterusername . '_tweets.json';
				if(file_exists($cacheTweets) && time() - @filemtime($cacheTweets) < $cacheTime)
				{
					$result = self::getCachedUserTimeline($cacheTweets);
				}
				else
				{
					$result = self::getUserTimeline($user->twitterusername, $cacheTweets);
				}

				if (is_array($result))
				{
					$twitterDataList[$i] = $result;
					$i++;
				}
			}
		}

		$numRealUser = count($twitterDataList);

		if ($numRealUser != 0)
		{
			$numCount = (int) ($maxItemDisplayed / $numRealUser);
		}
		else
		{
			$numCount = 1;
		}

		$numCountExt = 0;
		$remain = ($maxItemDisplayed - ($numCount * $numRealUser));

		if ($remain != 0)
		{
			$numCountExt = $remain;
		}

		$i = 0;
		$index = 0;

		foreach ($twitterDataList as $twitterData)
		{
			if ($index == ($numRealUser - 1))
			{
				$numCount += $numCountExt;
			}

			$index++;

			if (count($twitterData) > 0)
			{
				foreach ($twitterData as $key => $data)
				{
					$date = new DateTime($data->created_at);
					$pDate = $date->format("Y-m-d H:i:s");

					$id = (string) $data->user->id;
					$name = (string) $data->user->name;
					$screen_name = (string) $data->user->screen_name;
					$title = (string) $data->text;
					$profile_image_url = (string) $data->user->profile_image_url;
					$description = (string) $data->text;
					$link = (string) 'https://twitter.com/' . $screen_name . '/statuses/' . $data->id_str;
					$pubDate = (string) $pDate;

					$twitterTimelines[$i++] = array(
						'id' => $id,
						'name' => $name,
						'screen_name' => $screen_name,
						'title' => $title,
						'profile_image_url' => $profile_image_url,
						'description' => $description,
						'link' => $link,
						'pdate' => $pubDate,
						'pdate_time' => strtotime($pDate)
					);

					if ($key == ($numCount - 1))
					{
						break;
					}
				}
			}
		}

		// Order by date
		if ($orderType == 0)
		{
			self::_sortByKey($twitterTimelines, 'pdate_time');
			return array_reverse($twitterTimelines);
		}
		else // Order by name
		{
			self::_sortByKey($twitterTimelines, 'name');
			return $twitterTimelines;
		}
	}

	public static function getUserTimeline($username, $cacheTweets, $count = 20)
	{
		$url = "https://api.twitter.com/1.1/statuses/user_timeline.json?include_rts=1&screen_name=" . $username . "&count=" . $count;
		$header = array('Authorization' => self::$oauthInfo->access_token,);

		$http = RedHttpFactory::getHttp();
		$response = $http->get($url, $header);

		if(!empty(self::$params) && self::$params->get('cache') == 1)
		{
			try
			{
				file_put_contents($cacheTweets, $response->body);
			}
			catch (Exception $e)
			{}
		}

		return json_decode($response->body);;
	}

	public static function getCachedUserTimeline($cacheTweets)
	{
		$result = file_get_contents($cacheTweets);

		return json_decode($result);
	}

	/**
	 * @return JException|mixed
	 */
	private static function _getOauthInfo()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('id, consumer_key, consumer_secret, access_token')
			->from($db->quoteName('#__redtwitter_oauth_info'))
			->where('state = 1');

		// Get the authorize information
		$db->setQuery($query);

		try
		{
			$result = $db->loadObject();
			if(empty($result))
			{
				return array();
			}
			self::$oauthInfo = $result;
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
	private static function _sortByKey(&$arr, $key)
	{
		global $key2sort;
		$key2sort = $key;
		usort($arr, "self::_subSort");

		return ($arr);
	}

	/**
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	private static function _subSort($a, $b)
	{
		global $key2sort;
		return (strcasecmp($a[$key2sort], $b[$key2sort]));
	}
}