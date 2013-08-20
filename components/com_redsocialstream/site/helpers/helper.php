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

    public function getTwitterData($twitterProfiles)
    {
        $mainframe = JFactory::getApplication();
        $params = $mainframe->getparams();

        $limit = $params->get('limit');
        $tweetDataList = array();

        if(count($twitterProfiles) > 0)
        {
            $accessToken = RedSocialStreamHelper::getTwitterAccessToken();
            include_once (JPATH_COMPONENT . '/helpers/twitter/statuses.php');

            foreach ($twitterProfiles as $twitterProfile)
            {
                if (isset($accessToken->twitter_access_token) && !empty($accessToken->twitter_access_token))
                {
                    $twitterStatuses = new TwitterStatuses();

                    $tweetList = $twitterStatuses->getUserTimeline($twitterProfile['title'], $accessToken->twitter_access_token, $limit);

                    for ($i = 0; $i < count($tweetList); $i++)
                    {
                        $tweet = $tweetList[$i];

                        $tweetDataList[$i]['data'] = $tweet;

                        $tweetDataList[$i]['profile_id'] = $twitterProfile['id'];
                        $tweetDataList[$i]['title'] = '';
                        $tweetDataList[$i]['type'] = TWITTER;
                        $tweetDataList[$i]['group_id'] = $twitterProfile['group_id'];
                        $tweetDataList[$i]['sorce_link'] = "https://twitter.com/" . $tweet->user->screen_name . "/status" . $tweet->id_str;
                        $tweetDataList[$i]['thumb_uri'] = $tweet->user->profile_image_url;
                        if (isset($tweet->text))
                        {
                            $tweetDataList[$i]['message'] = addslashes($tweet->text);
                        }
                        $tweetDataList[$i]['ext_profile_id'] = $tweet->user->id;
                        $tweetDataList[$i]['ext_post_id'] = $tweet->id_str;
                        $tweetDataList[$i]['ext_post_name'] = $tweet->user->screen_name;

                        $tweetDataList[$i]['duration'] = '';
                        $tweetDataList[$i]['created_time'] = date("Y-m-d H:i:s", strtotime($tweet->created_at));
                        $tweetDataList[$i]['published'] = 1;
                    }
                }
            }
        }

        return $tweetDataList;
    }
}
