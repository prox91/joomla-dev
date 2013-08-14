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

class profilesModelprofiles extends JModel
{
	var $_id = null;
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	var $_table_prefix = null;
	var $_context = null;

	function __construct()
	{
		parent::__construct();
		$mainframe      = JFactory::getApplication();
		$this->_context = "profiles";

		$this->_table_prefix = '#__redsocialstream';

		$limit      = $mainframe->getUserStateFromRequest($this->_context . 'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$limitstart = $mainframe->getUserStateFromRequest($this->_context . 'limitstart', 'limitstart', 0);
		$array      = JRequest::getVar('cid', 0, '', 'array');
		$this->setId((int) $array[0]);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

	function setId($id)
	{
		$this->_id   = $id;
		$this->_data = null;
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
		$orderby = $this->_buildContentOrderBy();
		$query   = '
		SELECT h.*, g.title AS grouptitle , p.title AS profiletypetitle FROM #__redsocialstream_profilereference AS h
		LEFT JOIN  #__redsocialstream_profiletype AS p 
		on h.profiletypeid = p.id
		LEFT JOIN  #__redsocialstream_group AS g
		on h.groupid = g.id ' . $orderby;

		return $query;
	}

	function _buildContentOrderBy()
	{
		$mainframe        = JFactory::getApplication();
		$filter_order_Dir = $mainframe->getUserStateFromRequest($this->_context . 'filter_order_Dir', 'filter_order_Dir', '');
		$filter_order     = $mainframe->getUserStateFromRequest($this->_context . 'filter_order', 'filter_order', 'h.id');

		$orderby = " ORDER BY " . $filter_order . ' ' . $filter_order_Dir;

		return $orderby;
	}

	/**
	 * Reorder fields
	 */
	function saveorder()
	{
		$db    = JFactory::getDBO();
		$cid   = JRequest::getVar('cid');
		$order = JRequest::getVar('order');
		$total = count($cid);
		$row   = $this->getTable('redsocialstream_profile');

		if (empty($cid))
		{
			return JError::raiseWarning(500, JText::_('COM_REDSOCIALSTREAM_NO_ITEM_SELECTED'));
		}
		// update ordering values
		for ($i = 0; $i < $total; $i++)
		{
			$row->load((int) $cid[$i]);
			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store())
				{
					JError::raiseError(500, $db->getErrorMsg());

					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Method to move
	 *
	 * @access  public
	 * @return  boolean True on success
	 * @since 0.9
	 */
	function move($direction)
	{
		$row = $this->getTable('redsocialstream_profile');
		if (!$row->load($this->_id))
		{
			$this->setError($this->_db->getErrorMsg());

			return false;
		}
		if (!$row->move($direction))
		{
			$this->setError($this->_db->getErrorMsg());

			return false;
		}

		return true;
	}
}
