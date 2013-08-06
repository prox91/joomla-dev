<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * Categories model
 *
 * @package     Solidres
 * @subpackage	Category
 * @since		0.1.0
 */
class SolidresModelCategories extends JModelList {
	
/**
	 * Constructor.
	 *
	 * @param	array	An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'c.id',
				'title', 'c.title',
				'access_level', 'ag.title',
				'state', 'c.state',
				'custom_field_group_name', 'cu.name'
			);
		}

		parent::__construct($config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$accessId = $app->getUserStateFromRequest($this->context.'.filter.access', 'filter_access', null, 'int');
		$this->setState('filter.access', $accessId);

		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		$categoryId = $app->getUserStateFromRequest($this->context.'.filter.category_id', 'filter_category_id', '');
		$this->setState('filter.category_id', $categoryId);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_solidres');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('c.lft', 'asc');
	}
	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'c.id, c.title, c.lft, c.rgt, (COUNT(p.title) - 1) AS depth, c.alias, c.description,'.
				'c.created_date, c.modified_date, c.created_by, c.modified_by,'.
				'c.state, c.checked_out, c.checked_out_time, c.ordering, p.access'
				)			
		);
		$query->from('(#__sr_categories AS c, #__sr_categories AS p)');
		$query->where('c.lft BETWEEN p.lft AND p.rgt');
		
		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', '#__users AS uc ON uc.id = p.checked_out');

		// Join over the asset groups.
		$query->select('ag.title AS access_level');
		$query->join('LEFT', '#__viewlevels AS ag ON ag.id = p.access');
		
		// Filter by access level.
		if ($access = $this->getState('filter.access')) {
			$query->where('c.access = '.(int) $access);
		}

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('c.state = '.(int) $published);
		} else if ($published === '') {
			$query->where('(c.state IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('c.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('c.title LIKE '.$search.' OR c.alias LIKE '.$search);
			}
		}
		$query->group('c.id');
		
		if($this->getState('list.ordering', 'c.title') == 'c.title') {
			$query->order($db->escape($this->getState('list.ordering', 'c.title')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		} else {
			$query->order($db->escape($this->getState('list.ordering', 'c.title')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
		return $query;
	}
	
}
?>