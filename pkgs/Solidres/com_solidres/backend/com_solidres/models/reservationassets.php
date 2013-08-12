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
 * Reservation Assets model
 *
 * @package     Solidres
 * @subpackage	ReservationAsset
 * @since		0.1.0
 */
class SolidresModelReservationAssets extends JModelList
{
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
				'id', 'a.id',
				'name', 'a.name',
				'alias', 'a.alias',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'state', 'a.state',
				'access', 'a.access', 'access_level',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'ordering', 'a.ordering',
				'featured', 'a.featured',
				'language', 'a.language',
				'hits', 'a.hits',
				'category_name', 'category_name',
                'number_of_roomtype', 'number_of_roomtype'
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

        $countryId = $app->getUserStateFromRequest($this->context.'.filter.country_id', 'filter_country_id', '');
		$this->setState('filter.country_id', $countryId);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_solidres');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.name', 'asc');
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
				'a.*'
				)
		);
		$query->from($db->quoteName('#__sr_reservation_assets').' AS a');

		$query->select('cat.title AS category_name');
		$query->join('LEFT', $db->quoteName('#__sr_categories').' AS cat ON cat.id = a.category_id');
		$query->group('cat.title');

        $query->select('COUNT(rt.id) AS number_of_roomtype');
		$query->join('LEFT', $db->quoteName('#__sr_room_types').' AS rt ON rt.reservation_asset_id = a.id');

        $query->select('cou.name AS country_name');
		$query->join('LEFT', $db->quoteName('#__sr_countries').' AS cou ON cou.id = a.country_id');
		$query->group('cou.name');
		
		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', $db->quoteName('#__users').' AS uc ON uc.id=a.checked_out');
		$query->group('uc.name');

		// Join over the asset groups.
		$query->select('ag.title AS access_level');
		$query->join('LEFT', $db->quoteName('#__viewlevels').' AS ag ON ag.id = a.access');
		$query->group('ag.title');

		// Filter by access level.
		if ($access = $this->getState('filter.access'))
        {
			$query->where('a.access = '.(int) $access);
		}

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published))
        {
			$query->where('a.state = '.(int) $published);
		}
        else if ($published === '')
        {
			$query->where('(a.state IN (0, 1))');
		}

		// Filter by category.
		$categoryId = $this->getState('filter.category_id');
		if (is_numeric($categoryId))
        {
			$query->where('a.category_id = '.(int) $categoryId);
		}

        // Filter by country.
		$countryId = $this->getState('filter.country_id');
		if (is_numeric($countryId))
        {
			$query->where('a.country_id = '.(int) $countryId);
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
        {
			if (stripos($search, 'id:') === 0)
            {
				$query->where('a.id = '.(int) substr($search, 3));
			}
            else
            {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('a.name LIKE '.$search.' OR a.alias LIKE '.$search);
			}
		}

        $query->group('a.id');

		if ($this->getState('list.ordering', 'a.ordering') == 'a.ordering')
        {
			$query->order($db->escape($this->getState('list.ordering', 'a.ordering')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
        else
        {
			// Add the list ordering clause.
			$query->order($db->escape($this->getState('list.ordering', 'a.name')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
		return $query;
	}
}
?>