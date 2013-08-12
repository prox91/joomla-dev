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

JLoader::registerPrefix('Red', dirname(__DIR__) . '/libraries');

/**
 * Redtwitter helper.
 */
class RedtwitterHelper
{
	// Access token url
	public static $access_token_url = "https://api.twitter.com/oauth2/token";

	/**
	 * @param string $vName
	 */
	public static function addSubmenu($vName = '')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_REDTWITTER_TITLE_FOLLOWED_PROFILES'),
			'index.php?option=com_redtwitter&view=followed_profiles',
			$vName == 'followed_profiles'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_REDTWITTER_TITLE_OAUTH_INFO'),
			'index.php?option=com_redtwitter&view=oauth_info',
			$vName == 'oauth_info'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_redtwitter';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}

	/**
	 * @param $consumer_key
	 * @param $consumer_secret
	 */
	public static function getAccessToken($consumer_key, $consumer_secret)
	{
		// Bearer token credentials
		$consumer_key = str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($consumer_key)));
		$consumer_secret = str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($consumer_secret)));

		$header = array(
			'Authorization' => 'Basic ' . base64_encode($consumer_key . ":" . $consumer_secret),
			'Content-type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
		);
		$data = array('grant_type' => 'client_credentials');

		try
		{
			$http = RedHttpFactory::getHttp();
			$response = $http->post(self::$access_token_url, $data, $header);
			$access_data = json_decode($response->body);

			if(isset($access_data->errors))
			{
				return "";
			}

			return $access_data->access_token;
		}
		catch(Exception $e)
		{
			return "";
		}
	}
}
