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

class PostfeedsModelPostfeeds extends JModel
{
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;

	function __construct()
	{
		parent::__construct();

		$mainframe = JFactory::getApplication();
		$context   = "postfeeds";

		$this->_table_prefix = '#__redsocialstream';

		$limit      = $mainframe->getUserStateFromRequest($context . 'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest($context . 'limitstart', 'limitstart', 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	function getData()
	{
		//DEVNOTE: Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query       = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}

		return $this->_data;
	}

	function getTotal()
	{
		//DEVNOTE: Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query        = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
		}

		return $this->_pagination;
	}

	function _buildQuery()
	{
		$query = ' SELECT *  FROM #__content WHERE state=1';

		return $query;
	}

	function getArticleData($article_id)
	{
		$db    = JFactory::getDBO();
		$query = ' SELECT *  FROM #__content WHERE state=1 and id=' . $article_id;
		$db->setQuery($query);
		$list = $db->loadObjectlist();

		return $list;
	}

	function getPostedFeedData($article_id)
	{
		$db  = JFactory::getDBO();
		$sql = ' SELECT * FROM #__redsocialstream_postfeeds where article_id=' . $article_id;
		$db->setQuery($sql);
		$posteData = $db->loadObjectlist();

		return $posteData;
	}

	function savePostedFeedData($article_id, $type)
	{
		$db  = JFactory::getDBO();
		$sql = ' SELECT id FROM #__redsocialstream_postfeeds where article_id=' . $article_id;
		$db->setQuery($sql);
		$posteData = $db->loadObjectlist();
		$row       = $this->getTable('redsocialstream_postfeeds');
		if (count($posteData) > 0)
		{
			$row->id = $posteData[0]->id;
		}
		else
		{
			$row->id = 0;
		}
		$row->article_id = $article_id;
		if ($type == "facebook") $row->facebook = 1;
		if ($type == "twitter") $row->twitter = 1;
		if ($type == "linkedin") $row->linkedin = 1;
		if (!$row->store())
		{
			$db->getErrorMsg();
			JError::raiseError(500, $db->getErrorMsg());

			return false;
		}

		return true;
	}
}






