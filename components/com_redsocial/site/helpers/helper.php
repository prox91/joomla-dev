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

class redsocialhelper
{
	var $_table_prefix = null;
	var $_db = null;

	function __construct()
	{
		global $mainframe, $context;
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

	function getTwitterAccessToken()
	{

		$db = JFactory::getDbo();
		$query = "SELECT * FROM #__redsocialstream_twitter_accesstoken";
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
}
