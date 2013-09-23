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
 * Channels Model
 *
 * @package     Redsource.Admin
 * @subpackage  Models
 * @since       1.0
 */
class RedsourceModelChannels extends RModelList
{
	/**
	 * Name of the filter form to load
	 *
	 * @var  string
	 */
	protected $filterFormName = 'filter_channels';

	/**
	 * Context for session
	 *
	 * @var  string
	 */
	protected $context = 'com_redsource.channels';

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
				'ordering', 'c.ordering',
				'state', 'c.state',
				'type', 'c.type'
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

		$type = $this->getUserStateFromRequest($this->context . '.filter_type', 'filter_type');
		$this->setState('filter.type', $type);

		parent::populateState('c.name', 'asc');
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 */
	protected function getListQuery()
	{
		$db	= $this->getDbo();

		$query = $db->getQuery(true)
			->select('c.*')
			->from('#__redsource_channel AS c');

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

		// Filter by type
		if ($type = $this->getState('filter.type'))
		{
			$query->where('c.type = ' . $db->quote($type));
		}

		// Ordering
		$orderList = $this->getState('list.ordering');
		$directionList = $this->getState('list.direction');

		$order = !empty($orderList) ? $orderList : 'c.name';
		$direction = !empty($directionList) ? $directionList : 'ASC';
		$query->order($db->escape($order) . ' ' . $db->escape($direction));

		return $query;
	}
}
