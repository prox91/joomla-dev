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
 * RoomType model
 *
 * @package     Solidres
 * @subpackage	RoomType
 * @since		0.1.0
 */
class SolidresModelRoomTypes extends JModelList
{
	protected $context = 'com_solidres.roomtypes';

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
				'id', 'r.id',
				'reservation_asset_id', 'r.reservation_asset_id',
                'number_of_room', 'number_of_room',
				'occupancy_adult', 'r.occupancy_adult',
				'occupancy_child', 'r.occupancy_child',
				'name', 'r.name',
				'state', 'r.state',
				'ordering', 'r.ordering',
				'reservationasset', 'reservationasset'
			);
		}

		parent::__construct($config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param $ordering
	 * @param $direction
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');

		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		$reservationAssetId = $app->getUserStateFromRequest($this->context.'.filter.reservation_asset_id', 'filter_reservation_asset_id', '');
		$this->setState('filter.reservation_asset_id', $reservationAssetId);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_solidres');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('r.name', 'asc');
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		$query->select(
			$this->getState(
				'list.select',
				'r.*, a.name AS reservationasset,'.
                'COUNT(room.id) as number_of_room'
				)			
		);
		
		$query->from($db->quoteName('#__sr_room_types').' AS r');
		$query->group('a.name');

		// Join over the users for the checked out user.
		$query->select('uc.name AS editor');
		$query->join('LEFT', $db->quoteName('#__users').' AS uc ON uc.id= r.checked_out');
		$query->group('uc.name');

        $query->join('LEFT', $db->quoteName('#__sr_rooms').' AS room ON room.room_type_id = r.id');
		$query->join('INNER', $db->quoteName('#__sr_reservation_assets').' as a On r.reservation_asset_id = a.id');

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published))
        {
			$query->where('r.state = '.(int) $published);
		}
        else if ($published === '')
        {
			$query->where('(r.state IN (0, 1))');
		}

        // Filter by reservation asset.
		$reservationAssetId = $this->getState('filter.reservation_asset_id');
		if (is_numeric($reservationAssetId))
        {
			$query->where('r.reservation_asset_id = '.(int) $reservationAssetId);
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
        {
			if (stripos($search, 'id:') === 0)
            {
				$query->where('r.id = '.(int) substr($search, 3));
			}
            else
            {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('r.name LIKE '.$search.' OR r.alias LIKE '.$search);
			}
		}

        $query->group('r.id');

		if($this->getState('list.ordering', 'r.ordering') == 'r.ordering')
        {
			$query->order($db->escape($this->getState('list.ordering', 'r.ordering')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
        else
        {
			// Add the list ordering clause.
			$query->order($db->escape($this->getState('list.ordering', 'r.name')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
		
		return $query;
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   12.2
	 */
	protected function getStoreId($id = '')
	{
		// Add the list state to the store id.
		$id .= ':' . $this->getState('list.start');
		$id .= ':' . $this->getState('list.limit');
		$id .= ':' . $this->getState('list.ordering');
		$id .= ':' . $this->getState('list.direction');
		$id .= ':' . $this->getState('filter.reservation_asset_id');

		return md5($this->context . ':' . $id);
	}
}
