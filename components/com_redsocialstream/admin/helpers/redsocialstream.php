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
    private static $_facebookAuthorizeUrl = "https://graph.facebook.com/oauth/access_token"; //"https://www.facebook.com/oauth/access_token";
	private static $_twitterAccessTokenUrl = "https://api.twitter.com/oauth2/token";
    private $linkedinAuthorizeUrl = "https://www.facebook.com/dialog/oauth";

    public static function getSettingData()
    {
        $loginData = array();
        $db = JFactory::getDbo();
        $q = "SELECT * FROM #__redsocialstream_settings";
        $db->setQuery($q);
        $rows = $db->loadObjectList();

        foreach($rows as $row)
        {
            $loginData[$row->dataname] = $row->data;
        }

        return $loginData;
    }

    public static function getFacebookAccessToken($appId, $appSecret, $callbackUrl)
    {
        $data = array(
            'client_id' => $appId,
            'client_secret' => $appSecret,
            'redirect_uri' => $callbackUrl,
            'grant_type' => 'client_credentials',

            'scope' => 'manage_pages',
            'manage_pages' => 1,
            'publish_stream' => 1,
        );

        $url = self::toUrl(self::$_facebookAuthorizeUrl, $data);

        try
        {
            $http = RedHttpFactory::getHttp();
            $response = $http->get($url);
            $accessData = json_decode($response->body);

            if(isset($accessData->error))
            {
                return "";
            }
            else
            {
                $accessData = explode('=', $response->body);

                return $accessData[1];
            }
        }
        catch(Exception $e)
        {
            return "";
        }
    }

	public static function getTwitterAccessToken($consumerKey, $consumerSecret)
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
			$response = $http->post(self::$_twitterAccessTokenUrl, $data, $header);
			$accessData = json_decode($response->body);

			if(isset($accessData->errors))
			{
				return "";
			}

			return 'Bearer ' . $accessData->access_token;
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

    public static function toUrl($url, $parameters)
    {
        foreach ($parameters as $key => $value)
        {
            if (is_array($value))
            {
                foreach ($value as $k => $v)
                {
                    if (strpos($url, '?') === false)
                    {
                        $url .= '?' . $key . '=' . $v;
                    }
                    else
                    {
                        $url .= '&' . $key . '=' . $v;
                    }
                }
            }
            else
            {
                if (strpos($value, ' ') !== false)
                {
                    $value = self::safeEncode($value);
                }

                if (strpos($url, '?') === false)
                {
                    $url .= '?' . $key . '=' . $value;
                }
                else
                {
                    $url .= '&' . $key . '=' . $value;
                }
            }
        }

        return $url;
    }

    public static function safeEncode($data)
    {
        if (is_array($data))
        {
            return array_map(array(self, 'safeEncode'), $data);
        }
        elseif (is_scalar($data))
        {
            return str_ireplace(
                array('+', '%7E'),
                array(' ', '~'),
                rawurlencode($data)
            );
        }
        else
        {
            return '';
        }
    }
}
