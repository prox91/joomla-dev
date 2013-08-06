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
 * States model
 *
 * @package     Solidres
 * @subpackage	State
 * @since		0.1.0
 */
class SolidresModelStates extends JModelList {
	
	/**
	 * Constructor.
	 *
	 * @param	array	$config An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'id',
				'country_id', 'country_id',
				'name', 'name',
				'code_2', 'code_2',
				'code_3', 'code_3',
				'state', 'state',
				'country', 'country'
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

		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);
		
		$country = $app->getUserStateFromRequest($this->context.'.filter.country', 'filter_country', '', 'string');
		$this->setState('filter.country', $country);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_solidres');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('name', 'asc');
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
				'r1.id AS id, r2.name AS country, r1.name AS name, r1.code_2 AS code_2, r1.code_3 AS code_3, r1.state AS state'
				)			
		);
		
		$query->from($db->quoteName('#__sr_geo_states').' AS r1');
		$query->innerJoin($db->quoteName('#__sr_countries').' AS r2 on r1.country_id = r2.id');

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published))
        {
			$query->where('r1.state = '.(int) $published);
		}
        else if ($published === '')
        {
			$query->where('(r1.state IN (0, 1))');
		}
	
		$country = (int)$this->getState('filter.country');

		if ($country != 1 && $country != 0 && isset($country))
        {
			$query->where('r1.country_id = '.$country);
		}
		
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
        {
			if (stripos($search, 'id:') === 0)
            {
				$query->where('r1.id = '.(int) substr($search, 3));
			}
            else
            {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('r1.name LIKE '.$search);
			}
		}
		if($this->getState('list.ordering', 'name') == 'name')
        {
			$query->order($db->escape($this->getState('list.ordering', 'name')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
        else
        {
			// Add the list ordering clause.
			$query->order($db->escape($this->getState('list.ordering', 'country')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
        
		return $query;
	}
}
