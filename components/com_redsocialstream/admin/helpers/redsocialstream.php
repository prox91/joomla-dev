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
	private static $_accessTokenUrl = "https://api.twitter.com/oauth2/token";

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
			$response = $http->post(self::$_accessTokenUrl, $data, $header);
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

    public static function getFacebookProfilesOptions()
    {
        $options = array();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('id as value, title as text')
            ->from('#__redsocialstream_profilereference')
            ->where('profiletypeid=' . $db->quote(FACEBOOK));
        $db->setQuery($query);

        try
        {
            $profiles = $db->loadObjectList();
        }
        catch (RuntimeException $e)
        {
            JError::raiseWarning(500, $e->getMessage());
        }

        foreach ($profiles as $profile)
        {
            $options[]	= JHtml::_('select.option', $profile->value, $profile->text);
        }

        return $options;
    }

    public static function getTwitterProfilesOptions()
    {
        $options = array();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('id as value, title as text')
              ->from('#__redsocialstream_profilereference')
              ->where('profiletypeid=' . $db->quote(TWITTER));
        $db->setQuery($query);

        try
        {
            $profiles = $db->loadObjectList();
        }
        catch (RuntimeException $e)
        {
            JError::raiseWarning(500, $e->getMessage());
        }

        foreach ($profiles as $profile)
        {
            $options[]	= JHtml::_('select.option', $profile->value, $profile->text);
        }

        return $options;
    }

    public static function getLinkedinProfilesOptions()
    {
        $options = array();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('id as value, title as text')
              ->from('#__redsocialstream_profilereference')
              ->where('profiletypeid=' . $db->quote(LINKEDIN));
        $db->setQuery($query);

        try
        {
            $profiles = $db->loadObjectList();
        }
        catch (RuntimeException $e)
        {
            JError::raiseWarning(500, $e->getMessage());
        }

        foreach ($profiles as $profile)
        {
            $options[]	= JHtml::_('select.option', $profile->value, $profile->text);
        }

        return $options;
    }
}
