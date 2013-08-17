<?php
/**
 * @version    1.0.0
 * @package    Com_RedSocialStream
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

JLoader::registerPrefix('Red', dirname(__DIR__) . '/libraries');

/**
 * Class RedSocialStreamHelper
 */
class RedSocialStreamHelper
{
	// Access token url
	public static $accessTokenUrl = "https://api.twitter.com/oauth2/token";

	/**
	 * @param $consumerKey
	 * @param $consumerSecret
     *
     * @return string access token
	 */
	public static function getAccessToken($consumerKey, $consumerSecret)
	{
		// Bearer token credentials
		$consumerKey = str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($consumerKey)));
		$consumerSecret = str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($consumerSecret)));

		$header = array(
			'Authorization' => 'Basic ' . base64_encode($consumerKey . ":" . $consumerSecret),
			'Content-type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
		);
		$data = array('grant_type' => 'client_credentials');

		try
		{
			$http = RedHttpFactory::getHttp();
			$response = $http->post(self::$accessTokenUrl, $data, $header);
			$accessData = json_decode($response->body);

			if(isset($accessData->errors))
			{
				return "";
			}

			return $accessData->access_token;
		}
		catch(Exception $e)
		{
			return "";
		}
	}
}
