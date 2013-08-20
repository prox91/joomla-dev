<?php
/**
 * @package     redSocialstream
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/helper.php');
require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/facebook/facebook.php');
require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/linkedin/linkedin.php');

class PostfeedsController extends JController
{
	function __construct($default = array())
	{
		parent::__construct($default);
	}

	function cancel()
	{
		$this->setRedirect('index.php?option=com_redsocialstream');
	}

	function postFeeds()
	{
		$model    = $this->getModel('postfeeds');
		$post     = JRequest::get('post');
		$option   = JRequest::getVar('option');
		$fb_array = array();
		$tw_array = array();
		$ln_array = array();

		$allfeeds      = $post['all'];
		$fbfeeds       = $post['facebook'];
		$twitterfeeds  = $post['twitter'];
		$linkedinfeeds = $post['linkedin'];

		if (count($allfeeds) > 0)
		{
			$fb_array = $allfeeds;
			$tw_array = $allfeeds;
			$ln_array = $allfeeds;
		}
		if (count($fbfeeds) > 0)
		{
			$fb_union_array = array_merge($fb_array, $fbfeeds);
			$fb_array       = array_unique($fb_union_array);
		}
		if (count($twitterfeeds) > 0)
		{
			$tw_union_array = array_merge($tw_array, $twitterfeeds);
			$tw_array       = array_unique($tw_union_array);
		}
		if (count($linkedinfeeds) > 0)
		{
			$ln_union_array = array_merge($ln_array, $linkedinfeeds);
			$ln_array       = array_unique($ln_union_array);
		}

		// For Repost
		$repostfeeds = $post['repost'];
		for ($r = 0; $r < count($repostfeeds); $r++)
		{
			$article_id = $repostfeeds[$r];
			$rePostData = $model->getPostedFeedData($article_id);

			if ($rePostData[0]->facebook)
			{
				$fb_repost_arr[] = $rePostData[0]->article_id;
			}
			if ($rePostData[0]->twitter)
			{
				$tw_repost_arr[] = $rePostData[0]->article_id;
			}
			if ($rePostData[0]->linkedin)
			{
				$ln_repost_arr[] = $rePostData[0]->article_id;
			}
		}

		if (count($fb_repost_arr) > 0)
		{
			$fb_repost_union_array = array_merge($fb_array, $fb_repost_arr);
			$fb_array              = array_unique($fb_repost_union_array);
		}
		if (count($tw_repost_arr) > 0)
		{
			$tw_repost_union_array = array_merge($tw_array, $tw_repost_arr);
			$tw_array              = array_unique($tw_repost_union_array);
		}
		if (count($ln_repost_arr) > 0)
		{
			$ln_repost_union_array = array_merge($ln_array, $ln_repost_arr);
			$ln_array              = array_unique($ln_repost_union_array);
		}

		// End for Repost
		$redsocialhelper = new redsocialhelper();
		$login           = $redsocialhelper->getsettings();

		// For Facebook Post
		for ($f = 0; $f < count($fb_array); $f++)
		{
			//Get Article Data 
			$article = $model->getArticleData($fb_array[$f]);

			// For Facebook
			$app_id     = $login['app_id'];
			$app_secret = $login['app_secret'];

			$facebook = new Facebook(array(
				'appId'  => $app_id,
				'secret' => $app_secret,
				'cookie' => true,
			));

			$result_fb_token = $redsocialhelper->getFbAccessToken();
			$fb_token        = $result_fb_token[0]->fb_token;
			$profile_id      = $result_fb_token[0]->profile_id; //'413610368700619';

			$profile_name = $redsocialhelper->getProfilename($profile_id);
			$attachment   = array('message' => strip_tags($article[0]->introtext), 'access_token' => $fb_token);
			$userWall     = $facebook->api('/' . $profile_name . '/feed', 'post', $attachment);
			$postedData   = $model->savePostedFeedData($fb_array[$f], "facebook");

			// End for Facebook
		}
		// End
		// For Twitter Post
		for ($t = 0; $t < count($tw_array); $t++)
		{
			//Get Article Data 
			$article = $model->getArticleData($tw_array[$t]);

			//your app's consumer key
			$consumer_key = $login['twitter_consumer_key'];

			//your app's secret key
			$consumer_secret = $login['twitter_consumer_sec'];

			$twitter_token_result = $redsocialhelper->getTwitterAccessToken();
			$twitter_token        = $twitter_token_result[0]->twitter_token;
			$twitter_secret       = $twitter_token_result[0]->twitter_secret;

			$post_feed    = strip_tags(substr($article[0]->introtext, 0, 140));
			$twitteroauth = new TwitterOAuth ($consumer_key, $consumer_secret, $twitter_token, $twitter_secret);
			$twitterpost  = $twitteroauth->post('statuses/update', array('status' => $post_feed));
			$postedData   = $model->savePostedFeedData($tw_array[$t], "twitter");

		}
		// End
		// For LinkedIN

		for ($l = 0; $l < count($ln_array); $l++)
		{
			//Get Article Data 
			$article = $model->getArticleData($ln_array[$l]);

			// LinkedinApi key
			$api_key = $login['linked_api_key'];

			//LinkedinSecret key
			$secret_key = $login['linked_secret_key'];

			$access_tokens = $redsocialhelper->getLinkedinAccessToken();
			$API_CONFIG    = array(
				'appKey'      => $api_key,
				'appSecret'   => $secret_key,
				'callbackUrl' => ""
			);
			$linkedin      = new LinkedIn($API_CONFIG);
			$access_token  = $access_tokens[0]->linkedin_token;
			$access_secret = $access_tokens[0]->linkedin_secret;
			$token         = Array
			(
				"oauth_token"        => $access_token,
				"oauth_token_secret" => $access_secret,
			);
			$linkedin->setTokenAccess($token);
			$response   = $linkedin->updateNetwork(strip_tags(substr($article[0]->introtext, 0, 999)));
			$postedData = $model->savePostedFeedData($ln_array[$l], "linkedin");
		}
		// End for LinkedIN
		$msg  = JText::_("COM_REDSOCIALSTREAM_FEED_POSTED_SUCCESSFULLY");
		$link = 'index.php?option=' . $option . '&view=postfeeds';
		$this->setRedirect($link, $msg);
	}
}
