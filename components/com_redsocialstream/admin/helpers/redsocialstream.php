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
    private static $_facebookAuthorizeUrl = "https://graph.facebook.com/oauth/access_token";
	private static $_twitterAccessTokenUrl = "https://api.twitter.com/oauth2/token";
    private static $_linkedinAccessTokenUrl = "https://www.linkedin.com/uas/oauth2/accessToken";

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

    public static function requestFbAccessToken($appId, $appSecret, $callbackUrl, $code)
    {
        /*
        $callbackUrl = urlencode(JURI::base() ."index.php?option=com_redsocialstream&controller=accesstoken&task=getaccesstoken&view=accesstoken");
        $data = array(
            'client_id' => $appId,
            'redirect_uri' => $callbackUrl,
            'client_secret' => $appSecret,
            'code' => $code
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
        */

        $postData = 'https://graph.facebook.com/oauth/access_token?client_id=' . $appId . '&redirect_uri=' . $callbackUrl . '&client_secret=' . $appSecret . '&code=' . $code;

        $CR = curl_init($postData);

        curl_setopt($CR, CURLOPT_POST, 1);
        curl_setopt($CR, CURLOPT_FAILONERROR, true);
        curl_setopt($CR, CURLOPT_POSTFIELDS, '');
        curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($CR, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($CR, CURLOPT_TIMEOUT, 30);

        $token = curl_exec($CR);

        if ($token)
        {
            $token       = explode("&", $token);
            $accessToken = explode("=", $token[0]);
            $accessToken = $accessToken[1];

            return $accessToken;
        }
        else
        {
            return "";
        }
    }

	public static function requestTwitterAccessToken($consumerKey, $consumerSecret)
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

    public static function requestLinkedinAccessToken($cliendId, $cliendSecret, $callbackUrl, $code)
    {
        $callbackUrl=urlencode("http://localhost.com/");
        $data = array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $callbackUrl,
            'client_id' => $cliendId,
            'client_secret' => $cliendSecret,
        );

        try
        {
            $http = RedHttpFactory::getHttp();
            $response = $http->post(self::$_linkedinAccessTokenUrl, $data);
            $accessData = json_decode($response->body);

            if(isset($accessData->error))
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

    public static function getFacebookAccessToken($facebookProfileId = 0)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from('#__redsocialstream_facebook_accesstoken');
        if($facebookProfileId != 0)
        {
            $query->where('profile_id = ' .$facebookProfileId);
        }

        $db->setQuery($query);

        $result = $db->loadObject();

        return $result;
    }

    public static function getTwitterAccessToken($twitterProfileId = 0)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from('#__redsocialstream_twitter_accesstoken');
        if($twitterProfileId != 0)
        {
            $query->where('profile_id = ' .$twitterProfileId);
        }

        $db->setQuery($query);

        $result = $db->loadObject();

        return $result;
    }

    public static function getLinkinAccessToken($linkedinProfileId = 0)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from('#__redsocialstream_linkedin_accesstoken');
        if($linkedinProfileId != 0)
        {
            $query->where('profile_id = ' .$linkedinProfileId);
        }

        $db->setQuery($query);

        $result = $db->loadObject();

        return $result;
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
