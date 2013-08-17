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

class postModelpost extends JModel
{
	var $_posts = null;
	var $_data = null;
	var $_id = null;

	function __construct()
	{
		parent::__construct();
		$array = JRequest::getVar('cid', 0, '', 'array');
		$this->setId((int) $array[0]);
	}

	function store($data)
	{
		$row = $this->getTable('redsocialstream_posts');
		if (!$row->bind($data))
		{

			$this->setError($this->_db->getErrorMsg());

			return false;
		}
		if (!$row->store())
		{

			$this->setError($this->_db->getErrorMsg());

			return false;
		}

		return true;
	}

	function setId($id)
	{
		// posts_detail id and wipe data
		$this->_id   = $id;
		$this->_data = null;
	}

	function getData()
	{
		if ($this->_loadData())
		{
			return $this->_data;
		}
		else $this->_initData();

		return $this->_data;
	}

	function checkout($uid = null)
	{
		if ($this->_id)
		{
			// Make sure we have a user id to checkout the article with
			if (is_null($uid))
			{

				$user = JFactory::getUser();
				$uid  = $user->get('id');
			}
			// Lets get to it and checkout the thing...
			$posts_detail = $this->getTable('redsocialstream_posts');


			if (!$posts_detail->checkout($uid, $this->_id))
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}

			return true;
		}

		return false;
	}

	function checkin()
	{
		if ($this->_id)
		{
			$posts_detail = $this->getTable('redsocialstream_posts');
			if (!$posts_detail->checkin($this->_id))
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}
		}

		return false;
	}

	function _loadData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = 'SELECT * FROM #__redsocialstream_posts WHERE id = ' . $this->_id;
			$this->_db->setQuery($query);
			$this->_data = $this->_db->loadObject();

			return (boolean) $this->_data;
		}

		return true;
	}

	function delete($cid = array())
	{
		if (count($cid))
		{
			$cids  = implode(',', $cid);
			$query = 'DELETE FROM #__redsocialstream_posts WHERE id IN ( ' . $cids . ' )';
			$this->_db->setQuery($query);
			if (!$this->_db->query())
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}
		}

		return true;
	}

	function publish($cid = array(), $publish = 1)
	{
		$user = JFactory::getUser();
		if (count($cid))
		{
			$cids = implode(',', $cid);

			$query = 'UPDATE #__redsocialstream_posts'
				. ' SET published = ' . intval($publish)
				. ' WHERE id IN ( ' . $cids . ' )';
			$this->_db->setQuery($query);
			if (!$this->_db->query())
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}
		}

		return true;
	}

	function getgroups()
	{
		$db    = JFactory::getDbo();
		$query = "SELECT * FROM #__redsocialstream_group";
		$db->setQuery($query);
		$row = $db->loadObjectList();

		return $row;
	}

	function getprofiletypes()
	{
		$db    = JFactory::getDbo();
		$query = "SELECT * FROM #__redsocialstream_profiletype";
		$db->setQuery($query);
		$row = $db->loadObjectList();

		return $row;
	}

	function getprofiles()
	{
		$db = JFactory::getDbo();
		$q  = "SELECT * FROM #__redsocialstream_profilereference";
		$db->setQuery($q);
		$row = $db->loadObjectList();

		return $row;
	}
}






