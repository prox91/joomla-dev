<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Categories Model
 *
 * @package     Redsource.Admin
 * @subpackage  Models
 * @since       1.0
 */
class RedsourceModelCategories extends RModelList
{
	/**
	 * Name of the filter form to load
	 *
	 * @var  string
	 */
	protected $filterFormName = 'filter_categories';

	/**
	 * Context for session
	 *
	 * @var  string
	 */
	protected $context = 'com_redsource.categories';

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
				'state', 'c.state',
				'parent_name', 'p.name',
				'c.lft', 'lft',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$state = $this->getUserStateFromRequest($this->context . '.filter_state', 'filter_state');
		$this->setState('filter.state', $state);

		$filter = $this->getUserStateFromRequest($this->context . '.filter_access', 'filter_access');
		$this->setState('filter.access', $filter);

		$filter = $this->getUserStateFromRequest($this->context . '.filter_language', 'filter_language');
		$this->setState('filter.language', $filter);

		parent::populateState('c.lft', 'asc');
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 */
	protected function getListQuery()
	{
		$db   = $this->getDbo();
		$user = JFactory::getUser();

		$query = $db->getQuery(true)
			->select('c.*')
			->select('CASE WHEN p.id > 1 THEN p.name ELSE NULL END AS parent_name')
			->from('#__redsource_category AS c')
			->join('LEFT', '#__redsource_category AS p ON p.id = c.parent_id');

		// Join over the language
		$query->select('l.title AS language_title')
			->join('LEFT', $db->quoteName('#__languages') . ' AS l ON l.lang_code = c.language');

		// Join over the users for the checked out user.
		$query->select('uc.name AS editor')
			->join('LEFT', '#__users AS uc ON uc.id = c.checked_out');

		// Join over the asset groups.
		$query->select('ag.title AS access_level')
			->join('LEFT', '#__viewlevels AS ag ON ag.id = c.access');

		// Don't list the root category
		$query->where('c.id > 1');

		// Filter by state
		$state = $this->getState('filter.state');

		if (is_numeric($state))
		{
			$query->where('c.state = ' . (int) $state);
		}

		// Filter search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = $db->quote('%' . $db->escape($search, true) . '%');
			$query->where('(c.name LIKE ' . $search . ')');
		}

		if ($filter = $this->getState('filter.parent_id'))
		{
			// Need to find sub category along the tree
			$sub = $db->getQuery(true);
			$sub->select('lft, rgt')
				->from('#__redsource_category')
				->where('id = ' . (int) $filter);

			$db->setQuery($sub);
			$res = $db->loadObject();

			if ($res)
			{
				$query->where('lft <= ' . $res->lft);
				$query->where('rgt >= ' . $res->lft);
			}
		}

		// Filter on the level.
		if ($level = $this->getState('filter.level'))
		{
			$query->where('c.level <= ' . (int) $level);
		}

		// Filter by access level.
		if ($access = $this->getState('filter.access'))
		{
			$query->where('c.access = ' . (int) $access);
		}

		// Implement View Level Access
		if (!$user->authorise('core.admin', 'com_redsource'))
		{
			$groups = implode(',', $user->getAuthorisedViewLevels());
			$query->where('c.access IN (' . $groups . ')');
		}

		// Filter on the language.
		if ($language = $this->getState('filter.language'))
		{
			$query->where('c.language = ' . $db->quote($language));
		}

		// Add the list ordering clause
		$listOrdering = $this->getState('list.ordering', 'c.lft');
		$listDirn = $db->escape($this->getState('list.direction', 'ASC'));

		if ($listOrdering == 'c.access')
		{
			$query->order('c.access ' . $listDirn . ', c.lft ' . $listDirn);
		}
		else
		{
			$query->order($db->escape($listOrdering) . ' ' . $listDirn);
		}

		return $query;
	}
}
