<?php
/**
 * @package     Jab.Admin
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

/**
 * Countries Model
 *
 * @package     Jab.Admin
 * @subpackage  Models
 *
 * @since       1.0
 */
class JabModelCountries extends RModelList
{
	/**
	 * Context for session
	 *
	 * @var  string
	 */
	protected $context = 'com_jab.countries';

	/**
	 * Name of the filter form to load
	 *
	 * @var  string
	 */
	protected $filterFormName = 'filter_countries';

	/**
	 * Constructor
	 *
	 * @param   array  $config  Configuration array
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'c.id',
				'name', 'c.name',
				'language', 'c.language',
				'published', 'c.state',
				'ordering', 'c.ordering',
				'created_date', 'c.created_date',
				'modified_date', 'c.modified_date',
				'created_by', 'c.created_by',
				'modified_by', 'c.modified_by'
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to populate the state from/to session
	 *
	 * @param   string  $ordering   [description]
	 * @param   string  $direction  [description]
	 *
	 * @return  void
	 */
	protected function populateState($ordering = 'ordering', $direction = 'ASC')
	{
		// Required objects
		$app = JFactory::getApplication();

		$limit = $app->getUserStateFromRequest($this->context . '.limit', 'limit', $app->getCfg('list_limit', 0));
		$this->setState('list.limit', $limit);

		$start = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0);
		$this->setState('list.start', $start);

		$orderCol = $app->getUserStateFromRequest($this->context . '.filter_order', 'filter_order', 'c.name');

		if (!in_array($orderCol, $this->filter_fields))
		{
			$orderCol = 'c.name';
		}

		$this->setState('list.ordering', $orderCol);

		$listOrder = $app->getUserStateFromRequest($this->context . '.filter_order_Dir', 'filter_order_Dir', 'ASC');

		if (!in_array(strtoupper($listOrder), array('ASC', 'DESC', '')))
		{
			$listOrder = 'ASC';
		}

		$this->setState('list.direction', $listOrder);

		// Language filter
		$language = $this->getUserStateFromRequest($this->context . '.filter_language', 'filter_language', '');
		$this->setState('filter.language', $language);

		$filterSearch = $this->getUserStateFromRequest($this->context . '.filter_search', 'filter_search');
		$this->setState('filter.search', $filterSearch);

		$filterState = $this->getUserStateFromRequest($this->context . '.filter_published', 'filter_published');
		$this->setState('filter.published', $filterState);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 *
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select("c.*");
		$query->from('#__jab_countries AS c');

		// Join over the users for the checked out user.
		$query->select('u.name AS checked_out');
		$query->leftJoin('#__users AS u ON u.id = c.checked_out');

		// Join over the users for the author.
		$query->select('ua.name AS created_by');
		$query->leftJoin('#__users AS ua ON ua.id = c.created_by');

		// Join over the users for the editor.
		$query->select('ub.name AS modified_by');
		$query->leftJoin('#__users AS ub ON ub.id = c.modified_by');

		// Join language
		$query->select('l.title AS language_title');
		$query->join('LEFT', $db->quoteName('#__languages') . ' AS l ON l.lang_code = c.language');

		// Filter on the language.
		if ($language = $this->getState('filter.language'))
		{
			$query->where('c.language = ' . $db->quote($language));
		}

		// Filter: state
		$states = RHelperString::multipleSanitised($this->getState('filter.published'));

		if (!empty($states))
		{
			if (count($states) == 1)
			{
				if (is_numeric($states[0]))
				{
					$query->where('c.state = ' . (int) $states[0]);
				}
			}
			else
			{
				$query->where('c.state IN (' . implode(',', $states) . ')');
			}
		}

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = '%' . $search . '%';
			$query->where(
				'('
				. 'c.name LIKE ' . $db->quote($like)
				. ' OR l.title LIKE ' . $db->quote($like)
				. ')'
			);
		}

		// Get the ordering modifiers
		$orderList     = $this->getState('list.ordering');
		$directionList = $this->getState('list.direction');
		$random        = $this->getState('list.random');

		// Random order selected
		if ($orderList == 'random')
		{
			$orderList = 'RAND()';
		}

		$order     = !empty($orderList) ? $orderList : 'c.name';
		$direction = !empty($directionList) ? $directionList : 'ASC';
		$query->order($db->escape($order) . ' ' . $db->escape($direction));

		return $query;
	}
}
