<?php
/**
 * @package     redSocialstream
 * @subpackage  Helpers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(JPATH_ADMINISTRATOR . '/components/com_redsocialstream/helpers/redsocialstream.php');

class redsocialHelper
{
	var $_table_prefix = null;
	var $_db = null;

	function __construct()
	{
		$this->_table_prefix = '#__redsocialstream_';
		$this->_db = JFactory::getDBO();
	}

	function getsettings()
	{

		$db = JFactory::getDbo();
		$q = "SELECT * FROM " . $this->_table_prefix . "settings where dataname = 'app_id'";
		$db->setQuery($q);
		$rows = $db->loadObjectList();

		$logindata['app_id'] = $rows[0]->data;

		$q = "SELECT * FROM " . $this->_table_prefix . "settings where dataname = 'app_secret'";
		$db->setQuery($q);
		$rows = $db->loadObjectList();

		$logindata['app_secret'] = $rows[0]->data;

		// FOr Twitter

		$q = "SELECT * FROM " . $this->_table_prefix . "settings where dataname = 'twitter_consumer_key'";
		$db->setQuery($q);
		$rows = $db->loadObjectList();

		$logindata['twitter_consumer_key'] = $rows[0]->data;

		$q = "SELECT * FROM " . $this->_table_prefix . "settings where dataname = 'twitter_consumer_sec'";
		$db->setQuery($q);
		$rows = $db->loadObjectList();
		$logindata['twitter_consumer_sec'] = $rows[0]->data;

		// FOr LinkedIN

		$q = "SELECT * FROM " . $this->_table_prefix . "settings where dataname = 'linked_api_key'";
		$db->setQuery($q);
		$rows = $db->loadObjectList();

		$logindata['linked_api_key'] = $rows[0]->data;

		$q = "SELECT * FROM " . $this->_table_prefix . "settings where dataname = 'linked_secret_key'";
		$db->setQuery($q);
		$rows = $db->loadObjectList();

		$logindata['linked_secret_key'] = $rows[0]->data;


		return $logindata;
	}

	function getFbAccessToken()
	{
		$db = JFactory::getDbo();
		$query = "SELECT * FROM #__redsocialstream_facebook_accesstoken";
		$db->setQuery($query);
		$row = $db->loadObjectList();
		return $row;
	}

	function getLinkedinAccessToken()
	{

		$db = JFactory::getDbo();
		$query = "SELECT * FROM #__redsocialstream_linkedin_accesstoken";
		$db->setQuery($query);
		$row = $db->loadObjectList();
		return $row;
	}

	function getProfilename($profile_id)
	{
		$db = JFactory::getDbo();
		$query = "SELECT profilename FROM #__redsocialstream_profilereference where id='" . $profile_id . "'";
		$db->setQuery($query);
		$profilename = $db->loadResult();
		return $profilename;

	}

    public function getFacebookData($fbProfiles)
    {
        if(count($fbProfiles) > 0)
        {
            $accessTokenData = RedSocialStreamHelper::getFacebookAccessToken();
            include_once (JPATH_COMPONENT . '/helpers/facebook/user.php');
            $fbUser = new FacebookUser();

            $fbDataList = array();

            foreach ($fbProfiles AS $key => $profile)
            {
                if (isset($accessTokenData->access_token) && !empty($accessTokenData->access_token))
                {
                    $fbFeedList = $fbUser->getFeeds($profile['title'], $accessTokenData->access_token);

                    if(!empty($fbFeedList->data) && count($fbFeedList->data) > 0)
                    {
                        foreach($fbFeedList->data as $feed)
                        {
                            $fbDataList[$profile['id']]['data'] = $feed;
                            $fbDataList[$profile['id']]['created_time'] = strtotime($feed->created_time);
                            $fbDataList[$profile['id']]['type'] = FACEBOOK;
                            $fbDataList[$profile['id']]['ext_post_name'] = addslashes($feed->from->name);
                            $fbDataList[$profile['id']]['ext_profile_id'] = addslashes($feed->from->id);
                            $fbDataList[$profile['id']]['ext_post_id'] = addslashes($feed->id);
                            $fbDataList[$profile['id']]['message'] = "";

                            if (isset($feed->message))
                            {
                                $fbDataList[$profile['id']]['message'] = $feed->message;
                            }

                            if (isset($feed->story))
                            {
                                $fbDataList[$profile['id']]['message'] .= $feed->story;
                            }

                            if (isset($fbDataList[$profile['id']]['message']))
                            {
                                preg_match_all('/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}[^<]*/', str_replace("\n", "<br />", $fbDataList[$profile['id']]['message']), $out, PREG_PATTERN_ORDER);

                                foreach ($out[0] as $link)
                                {
                                    $fbDataList[$profile['id']]['message'] = str_replace($link, "<a href=\"" . $link . "\">" . $link . "</a>", $fbDataList[$profile['id']]['message']);
                                }
                            }

                            if (isset($feed->picture))
                            {
                                $fbDataList[$profile['id']]['message'] .= "<div class=\"description_image facebook\">";
                                $fbDataList[$profile['id']]['message'] .= "<img src=\"" . $feed->picture . "\">";
                                $fbDataList[$profile['id']]['message'] .= "</div>";
                            }
                            $fbDataList[$profile['id']]['message'] = addslashes($fbDataList[$profile['id']]['message']);
                            $fbDataList[$profile['id']]['title'] = '';
                            $fbDataList[$profile['id']]['source_link'] = "kildelink";
                            $fbDataList[$profile['id']]['created_time'] = date("Y-m-d H:i:s", strtotime($feed->created_time));
                            $fbDataList[$profile['id']]['duration'] = '';
                            $fbDataList[$profile['id']]['profile_id'] = $key;
                            $fbDataList[$profile['id']]['group_id'] = $profile['group_id'];
                            $fbDataList[$profile['id']]['published'] = 1;
                            $fbDataList[$profile['id']]['thumb_uri'] = '';
                        }
                    }
                }

            }

            return $fbDataList;
        }
    }

    public function getTwitterData($twitterProfiles)
    {
        $mainframe = JFactory::getApplication();
        $params = $mainframe->getparams();

        $limit = $params->get('limit');
        $tweetDataList = array();

        if(count($twitterProfiles) > 0)
        {
            $accessTokenData = RedSocialStreamHelper::getTwitterAccessToken();
            include_once (JPATH_COMPONENT . '/helpers/twitter/statuses.php');

            $twitterStatuses = new TwitterStatuses();

            foreach ($twitterProfiles as $twitterProfile)
            {
                if (isset($accessTokenData->access_token) && !empty($accessTokenData->access_token))
                {
                    $tweetList = $twitterStatuses->getUserTimeline($twitterProfile['title'], $accessTokenData->access_token, $limit);

                    for ($i = 0; $i < count($tweetList); $i++)
                    {
                        $tweet = $tweetList[$i];

                        $tweetDataList[$twitterProfile['id']]['data'] = $tweet;

                        $tweetDataList[$twitterProfile['id']]['profile_id'] = $twitterProfile['id'];
                        $tweetDataList[$twitterProfile['id']]['title'] = '';
                        $tweetDataList[$twitterProfile['id']]['type'] = TWITTER;
                        $tweetDataList[$twitterProfile['id']]['group_id'] = $twitterProfile['group_id'];
                        $tweetDataList[$twitterProfile['id']]['source_link'] = "https://twitter.com/" . $tweet->user->screen_name . "/status" . $tweet->id_str;
                        $tweetDataList[$twitterProfile['id']]['thumb_uri'] = $tweet->user->profile_image_url;
                        if (isset($tweet->text))
                        {
                            $tweetDataList[$twitterProfile['id']]['message'] = addslashes($tweet->text);
                        }
                        $tweetDataList[$twitterProfile['id']]['ext_profile_id'] = $tweet->user->id;
                        $tweetDataList[$twitterProfile['id']]['ext_post_id'] = $tweet->id_str;
                        $tweetDataList[$twitterProfile['id']]['ext_post_name'] = $tweet->user->screen_name;

                        $tweetDataList[$twitterProfile['id']]['duration'] = '';
                        $tweetDataList[$twitterProfile['id']]['created_time'] = date("Y-m-d H:i:s", strtotime($tweet->created_at));
                        $tweetDataList[$twitterProfile['id']]['published'] = 1;
                    }
                }
            }
        }

        return $tweetDataList;
    }
}
