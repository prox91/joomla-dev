<?php
/**
 * @package     redSocialstream
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/helper.php');
include(JPATH_SITE . '/components/com_redsocialstream/helpers/linkedin/linkedin.php');
require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/twitter/OAuth.php');

class access_tokenModelaccess_token extends JModel
{
	function getData()
	{
		$mainframe       = JFactory::getApplication();
		$session         = JFactory::getSession();
		$post            = JRequest::get('post');
		$redsocialhelper = new redsocialhelper();

		$login = $redsocialhelper->getsettings();
		if (!isset($post['generatetoken']))
		{
			return JText::_('PLEASE_SELECT_SECTION');
		}

		switch ($post['generatetoken'])
		{


			case 'twitter':
				$consumer_key       = $login['twitter_consumer_key']; //'8YC0xc4N74h6BSdwWl3zA'; //your app's consumer key
				$consumer_secret    = $login['twitter_consumer_sec']; //'kYVZX4MkOMKDoXtolGCRgPPYbb3oyhUkrUQLT8Jg20'; //your app's secret key
				$twitter_profile_id = $session->set('twitter_profile_id', $post['twitter_profile_id']);

				require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/twitter/twitterOAuth.php');

				$to  = new TwitterOAuth($consumer_key, $consumer_secret);
				$tok = $to->getRequestToken();
				$session->set('oauth_request_token', $tok['oauth_token']);
				$session->set('oauth_request_token_secret', $tok['oauth_token_secret']);

				$request_link = $to->getAuthorizeURL($tok);
				header("location: $request_link");
				break;

			case 'facebook':

				$fb_profile_id = $session->set('fb_profile_id', $post['fb_profile_id']);

				$app_id     = $login['app_id'];
				$app_secret = $login['app_secret'];
				require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/facebook/facebook.php');

				$redirect_url = urlencode(JURI::base() . "index.php?option=com_redsocialstream&view=access_token");

				header("location: https://www.facebook.com/dialog/oauth?client_id=" . $login['app_id'] . "&redirect_uri=" . $redirect_url . "&scope=manage_pages,publish_stream&manage_pages=1&publish_stream=1");
				break;

			case 'linkedin':
				//Linkedin APi Key
				$api_key = $login['linked_api_key'];
				//Linkedin Secret Key
				$secret_key          = $login['linked_secret_key'];
				$redirect_url        = JURI::base() . "index.php?option=com_redsocialstream&view=access_token";
				$linkedin_profile_id = $session->set('linkedin_profile_id', $post['linkedin_profile_id']);
				$API_CONFIG          = array(
					'appKey'      => $api_key,
					'appSecret'   => $secret_key,
					'callbackUrl' => $redirect_url
				);

				$linkedin = new LinkedIn($API_CONFIG);
				$response = $linkedin->retrieveTokenRequest();

				if ($response['success'] === TRUE)
				{
					$session->set('oauthReqToken', $response['linkedin']);
					// redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
					header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
					exit;
				}
				break;
		}
	}


	function saveFbAcceesToken($code)
	{

		$mainframe       = JFactory::getApplication();
		$db              = JFactory::getDBO();
		$session         = JFactory::getSession();
		$redsocialhelper = new redsocialhelper();
		$login           = $redsocialhelper->getsettings();
		//Set the page name or ID
		$app_id     = $login['app_id'];
		$app_secret = $login['app_secret'];

		$fb_profile_id = $session->get('fb_profile_id');
		$return_url    = urlencode(JURI::base() . "index.php?option=com_redsocialstream&view=access_token");
		$post_data     = 'https://graph.facebook.com/oauth/access_token?client_id=' . $app_id . '&redirect_uri=' . $return_url . '&client_secret=' . $app_secret . '&code=' . $code;

		$CR = curl_init($post_data);

		curl_setopt($CR, CURLOPT_POST, 1);
		curl_setopt($CR, CURLOPT_FAILONERROR, true);
		curl_setopt($CR, CURLOPT_POSTFIELDS, '');
		curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($CR, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt($CR, CURLOPT_TIMEOUT, 30);

		$token = curl_exec($CR);
		$error = curl_error($CR);


		if ($token)
		{
			$token        = explode("&", $token);
			$access_token = explode("=", $token[0]);
			$access_token = $access_token[1];
		}

		// Delete Old Token
		$del_old_token = "DELETE from #__redsocialstream_facebook_accesstoken";
		$db->setQuery($del_old_token);
		$db->query();

		// Add New Token
		$sql = "INSERT into #__redsocialstream_facebook_accesstoken (id, profile_id , fb_token, fb_secret, created, updated)
values ('', '$fb_profile_id', '$access_token', '', NOW(), NOW())";
		$db->setQuery($sql);
		$db->query();
		$session->set('fb_profile_id', NULL);
		$msg = JText::_('COM_REDSOCIALSTREAM_FACEBOOK_TOKEN_GENERATED');
		$mainframe->Redirect('index.php?option=com_redsocialstream&view=access_token', $msg);
		exit;
	}

	function saveTwitterAcceesToken($oauth_token)
	{
		$mainframe       = JFactory::getApplication();
		$redsocialhelper = new redsocialhelper();
		$login           = $redsocialhelper->getsettings();


		$db      = JFactory::getDBO();
		$session = JFactory::getSession();

		$consumer_key    = $login['twitter_consumer_key']; //your app's consumer key
		$consumer_secret = $login['twitter_consumer_sec']; //your app's secret key


		$twitter_profile_id = $session->get('twitter_profile_id');
		require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/twitter/twitterOAuth.php');
		require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/twitter/OAuth.php');

		$oauth_request_token        = $session->get('oauth_request_token');
		$oauth_request_token_secret = $session->get('oauth_request_token_secret');
		$oauth_access_token         = $session->get('oauth_access_token');

		if (!$oauth_access_token || $oauth_access_token == '')
		{

			$to  = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_request_token, $oauth_request_token_secret);
			$tok = $to->getAccessToken();


			/* Save tokens for later  - might be wise to
			 * store the oauth_token and secret in a database, and
			 * only store the oauth_token in a cookie or session for security purposes */
			$token  = $tok['oauth_token'];
			$secret = $tok['oauth_token_secret'];
			$session->set('oauth_access_token', $token);
			$session->set('oauth_access_token_secret', $secret);
		}

		// Delete Old Token
		$del_old_token = "DELETE from #__redsocialstream_twitter_accesstoken";
		$db->setQuery($del_old_token);
		$db->query();

		// Add New Token
		$sql = "INSERT into #__redsocialstream_twitter_accesstoken (id, profile_id , twitter_token, twitter_secret, created, updated)
values ('', '$twitter_profile_id', '$token', '$secret', NOW(), NOW())";
		$db->setQuery($sql);
		$db->query();
		$session->set('oauth_request_token', NULL);
		$session->set('oauth_request_token_secret', NULL);
		$session->set('oauth_access_token', NULL);
		$session->set('oauth_access_token_secret', NULL);
		$session->set('twitter_profile_id', NULL);
		$msg = JText::_('COM_REDSOCIALSTREAM_TWITTER_TOKEN_GENERATED');
		$mainframe->Redirect('index.php?option=com_redsocialstream&view=access_token', $msg);
		exit;

	}

	function saveLinkedinAcceesToken($oauth_token, $oauth_verifier)
	{
		$mainframe       = JFactory::getApplication();
		$redsocialhelper = new redsocialhelper();
		$login           = $redsocialhelper->getsettings();
		$db              = JFactory::getDBO();
		$session         = JFactory::getSession();

		$api_key      = $login['linked_api_key']; //Linkedin APi Key
		$secret_key   = $login['linked_secret_key']; //Linkedin Secret Key
		$redirect_url = JURI::base() . "index.php?option=com_redsocialstream&view=access_token";

		$API_CONFIG        = array(
			'appKey'      => $api_key,
			'appSecret'   => $secret_key,
			'callbackUrl' => $redirect_url
		);
		$linkedin          = new LinkedIn($API_CONFIG);
		$oauth_token_array = $session->get('oauthReqToken');


		$oauth_token         = $oauth_token_array['oauth_token'];
		$oauth_token_secret  = $oauth_token_array['oauth_token_secret'];
		$response            = $linkedin->retrieveTokenAccess($oauth_token, $oauth_token_secret, $oauth_verifier);
		$token               = $response['linkedin']['oauth_token'];
		$secret              = $response['linkedin']['oauth_token_secret'];
		$linkedin_profile_id = $session->get('linkedin_profile_id');
		// Delete Old Token
		$del_old_token = "DELETE from #__redsocialstream_linkedin_accesstoken";
		$db->setQuery($del_old_token);
		$db->query();

		// Add New Token
		$sql = "INSERT into #__redsocialstream_linkedin_accesstoken (id, profile_id , linkedin_token, linkedin_secret, created, updated)
values ('', '$linkedin_profile_id', '$token', '$secret', NOW(), NOW())";
		$db->setQuery($sql);
		$db->query();
		$session->set('linkedin_profile_id', NULL);
		$msg = JText::_('COM_REDSOCIALSTREAM_LINKEDIN_TOKEN_GENERATED');
		$mainframe->Redirect('index.php?option=com_redsocialstream&view=access_token', $msg);
		exit;

	}

	function getFbProfiles($profiletype)
	{
		$db          = JFactory::getDBO();
		$sel_profile = "SELECT * from #__redsocialstream_profilereference where profiletypeid ='" . $profiletype . "'";
		$db->setQuery($sel_profile);
		$profiles = $db->loadObjectList();
		$html     = "";
		$html .= '<select name="fb_profile_id">';
		foreach ($profiles as $profile)
		{
			$html .= '<option value="' . $profile->id . '">' . $profile->title . '</option>';

		}
		$html .= '</select>';

		return $html;
	}

	function getTwiterProfiles($profiletype)
	{
		$db          = JFactory::getDBO();
		$sel_profile = "SELECT * from #__redsocialstream_profilereference where profiletypeid ='" . $profiletype . "'";
		$db->setQuery($sel_profile);
		$profiles = $db->loadObjectList();
		$html     = "";
		$html .= '<select name="twitter_profile_id">';
		foreach ($profiles as $profile)
		{
			$html .= '<option value="' . $profile->id . '">' . $profile->title . '</option>';

		}
		$html .= '</select>';

		return $html;
	}

	function getLinkedinProfiles($profiletype)
	{
		$db          = JFactory::getDBO();
		$sel_profile = "SELECT * from #__redsocialstream_profilereference where profiletypeid ='" . $profiletype . "'";
		$db->setQuery($sel_profile);
		$profiles = $db->loadObjectList();

        $html = '';
		$html .= '<select name="linkedin_profile_id">';
		foreach ($profiles as $profile)
		{
			$html .= '<option value="' . $profile->id . '">' . $profile->title . '</option>';

		}
		$html .= '</select>';

		return $html;
	}

}






