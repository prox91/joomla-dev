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

class PostsModelPosts extends JModel
{
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;
	var $_context = null;

	function __construct()
	{
		parent::__construct();

		$mainframe      = JFactory::getApplication();
		$this->_context = "posts";

		$this->_table_prefix = '#__redsocialstream';

		$limit      = $mainframe->getUserStateFromRequest($this->_context . 'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest($this->_context . 'limitstart', 'limitstart', 0);
		$keyword    = $mainframe->getUserStateFromRequest($this->_context . 'keyword', 'keyword', '');
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		$this->setState('keyword', $keyword);
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
		$keyword = $this->getState('keyword');
		$keyword = addslashes($keyword);
		$where   = "WHERE 1 = 1";
		if ($keyword != "")
		{
			$where .= " AND ( po.ext_post_name LIKE '%$keyword%' OR po.message LIKE '%$keyword%') ";
		}
		$orderby = $this->_buildContentOrderBy();
		$query   = ' SELECT po.*,g.title AS grouptitle , p.title AS typetitle, r.title as profiletitle FROM #__redsocialstream_posts as po
		LEFT JOIN  #__redsocialstream_profilereference AS r 
		on po.profile_id  = r.id
		LEFT JOIN  #__redsocialstream_profiletype AS p 
		on po.type  = p.id
		LEFT JOIN  #__redsocialstream_group AS g
		on po.group_id = g.id  ' . $where . '' . $orderby;

		return $query;
	}

	function _buildContentOrderBy()
	{
		$mainframe        = JFactory::getApplication();
		$filter_order_Dir = $mainframe->getUserStateFromRequest($this->_context . 'filter_order_Dir', 'filter_order_Dir', '');
		$filter_order     = $mainframe->getUserStateFromRequest($this->_context . 'filter_order', 'filter_order', 'po.id');

		$orderby = " ORDER BY " . $filter_order . ' ' . $filter_order_Dir;

		return $orderby;
	}
}






