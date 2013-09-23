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
 * Speakers Model
 *
 * @package     Jab.Admin
 * @subpackage  Models
 *
 * @since       1.0.0
 */
class JabModelSpeakers extends RModelList
{
	/**
	 * Context for session
	 *
	 * @var  string
	 */
	protected $context = 'com_jab.speakers';

	/**
	 * Name of the filter form to load
	 *
	 * @var  string
	 */
	protected $filterFormName = 'filter_speakers';

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
				'id', 's.id',
				'name', 's.name',
				'published', 's.published',
				'ordering', 's.ordering',
				'created_date', 's.created_date',
				'modified_date', 's.modified_date',
				'created_by', 's.created_by',
				'modified_by', 's.modified_by'
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
		$app = JFactory::getApplication();

		$limit = $app->getUserStateFromRequest($this->context . '.limit', 'limit', $app->getCfg('list_limit', 0));
		$this->setState('list.limit', $limit);

		$start = $app->getUserStateFromRequest($this->context . '.limitstart', 'limitstart', 0);
		$this->setState('list.start', $start);

		$orderCol = $app->getUserStateFromRequest($this->context . '.filter_order', 'filter_order', 's.name');

		if (!in_array($orderCol, $this->filter_fields))
		{
			$orderCol = 's.name';
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

		$filterPublished = $this->getUserStateFromRequest($this->context . '.filter_published', 'filter_published');
		$this->setState('filter.published', $filterPublished);
	}

	/**
	 * Method to cache the last query constructed.
	 *
	 * This method ensures that the query is constructed only once for a given state of the model.
	 *
	 * @return  JDatabaseQuery  A JDatabaseQuery object
	 */
	public function getListQuery()
	{
		// Required objects
		$db  = JFactory::getDbo();

		// Build the query
		$query = $db->getQuery(true)
			->select('s.*')
			->select('c.name AS country_name')
			->select('st.name AS state_name')
			->from('#__jab_speakers AS s')
			->leftJoin($db->quoteName('#__jab_countries', 'c') . ' ON s.country_id = c.id')
			->leftJoin($db->quoteName('#__jab_states', 'st') . ' ON s.state_id = st.id')
			->where('s.id <> 0');

		// Join over the users for the checked out user.
		$query->select('u.name AS checked_out');
		$query->leftJoin('#__users AS u ON u.id = s.checked_out');

		// Join over the users for the author.
		$query->select('ua.name AS created_by');
		$query->leftJoin('#__users AS ua ON ua.id = s.created_by');

		// Join over the users for the editor.
		$query->select('ub.name AS modified_by');
		$query->leftJoin('#__users AS ub ON ub.id = s.modified_by');

		// Join language
		$query->select('l.title AS language_title');
		$query->join('LEFT', $db->quoteName('#__languages') . ' AS l ON l.lang_code = s.language');

		// Filter on the language.
		if ($language = $this->getState('filter.language'))
		{
			$query->where('s.language = ' . $db->quote($language));
		}

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = '%' . $search . '%';
			$query->where(
				'('
				. 's.name LIKE ' . $db->quote($like)
				. ' OR c.name LIKE ' . $db->quote($like)
				. ' OR st.name LIKE ' . $db->quote($like)
				. ')'
			);
		}

		// Filter: published
		$published = RHelperString::multipleSanitised($this->getState('filter.published'));

		if (!empty($published))
		{
			if (count($published) == 1)
			{
				if (is_numeric($published[0]))
				{
					$query->where('s.published = ' . (int) $published[0]);
				}
			}
			else
			{
				$query->where('s.published IN (' . implode(',', $published) . ')');
			}
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

		$order     = !empty($orderList) ? $orderList : 's.name';
		$direction = !empty($directionList) ? $directionList : 'ASC';
		$query->order($db->escape($order) . ' ' . $db->escape($direction));

		return $query;
	}
}
