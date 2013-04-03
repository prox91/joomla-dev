<?php
/**
 * @version     1.0.0
 * @package     com_redtwitter
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ronni K. G. Christiansen <email@redweb.dk> - http://www.redcomponent.com
 */

defined('_JEXEC') or die;

abstract class RedtwitterHelper
{
	/**
	 * getcom_twitter
	 *
	 * @param   array  $login  Login info
	 *
	 * @return   $tweeters
	 */
	public static function getcom_twitter($login)
	{
		global $no_ofprofiles;

		$tweets = "http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=" . $login;
		$twi    = file_get_contents($tweets);

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
	 * @param   array  $name  Name
	 *
	 * @return   $tweeters
	 */
	public static function getcom_twitter_detail($name)
	{
		global $no_ofprofiles;
		$tweets = "http://api.twitter.com/1/statuses/user_timeline.xml?screen_name=" . $name;
		/*
		$tw = curl_init();
		curl_setopt($tw, CURLOPT_URL, $tweets);
		curl_setopt($tw, CURLOPT_RETURNTRANSFER, TRUE);
		$twi = curl_exec($tw);
		*/

		$tweeters = '';
		$twi      = file_get_contents($tweets);

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
	 * get_alldata
	 *
	 * @param   array  $lists  list paramter
	 * @param   string  $date_format  data format
	 *
	 * @return   $tweeters
	 */
	public static function get_alldata($lists, $order_type, $max_item_displayed)
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

		$coun = count($twitdata);

		$arrmerge = array();
		$dt1      = array();
		$array1   = array();
		$arre     = array();
		$j        = 0;

		$arr_date = array();
		$arr_name = array();

		for ($a = 0; $a < count($twitdata); $a++)
		{
			if (count($twitdata[$a]->channel->item) > 0)
			{
				$r = 1;

				foreach ($twitdata[$a]->channel->item as $twit1)
				{
					$date      = new DateTime($twit1->pubDate);
					$dt1[$j]   = $date->format("Y-m-d H:i:s");

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
		if($order_type == 0)
		{
			ksort($array1);
		} // Order by name
		else
		{
			self::_sort_by_key($array1, 'name');
		}

		return array_reverse($array1);
	}

	private static function _sort_by_key($arr, $key)
	{
		global $key2sort;
		$key2sort = $key;
		uasort($arr, 'self::_sbk');

		return ($arr);
	}

	private static function _sbk($a, $b)
	{
		global $key2sort;

		return (strcasecmp($a[$key2sort], $b[$key2sort]));
	}

}

