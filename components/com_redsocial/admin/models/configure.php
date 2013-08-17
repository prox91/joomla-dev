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


class configureModelconfigure extends JModel
{
	var $_id = null;

	function __construct()
	{
		parent::__construct();
		$this->_context = "configure";
        $mainframe       = JFactory::getApplication();

		$this->_table_prefix = '#__redsocialstream';
		$array               = JRequest::getVar('cid', 0, '', 'array');
		$this->setId((int) $array[0]);

        $limit      = $mainframe->getUserStateFromRequest($this->_context . 'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
        $limitstart = $mainframe->getUserStateFromRequest($this->_context . 'limitstart', 'limitstart', 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);

	}

	function setId($id)
	{
		$this->_id   = $id;
		$this->_data = null;
	}

	function _buildQuery()
	{
		$query = '
			SELECT * FROM #__redsocialstream_profiletype 
			ORDER BY ordering
			';

		return $query;
	}

	function getTotal()
	{
		if (empty($this->_total))
		{
			$query        = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	function gettype_list_sorted()
	{
		$db = JFactory::getDBO();
		$q  = "SELECT * FROM #__redsocialstream_profiletype ORDER BY ordering";
		$db->setQuery($q);
		$row = $db->loadObjectList();

		return $row;
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

	/**
	 * Reorder fields
	 */

	function saveorder()
	{
		$db    = JFactory::getDBO();
		$cid   = JRequest::getVar('cid');
		$order = JRequest::getVar('order');
		$total = count($cid);
		$row   = $this->getTable('redsocialstream_types');


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
		$row = $this->getTable('redsocialstream_types');
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






