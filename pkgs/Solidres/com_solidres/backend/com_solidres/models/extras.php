<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

/**
 * Extras model
 *
 * @package     Solidres
 * @subpackage	Extra
 * @since		0.1.0
 */
class SolidresModelExtras extends JModelList
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
				'state', 'a.state',
				'created_date', 'a.created_date',
				'created_by', 'a.created_by',
				'ordering', 'a.ordering',
				'price', 'a.price',
				'ordering', 'a.ordering',
				'reservation_asset_id', 'a.reservation_asset_id',
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

		$reservationAssetId = $app->getUserStateFromRequest($this->context.'.filter.reservation_asset_id', 'filter_reservation_asset_id', '');
		$this->setState('filter.reservation_asset_id', $reservationAssetId);
		
		// List state information.
		parent::populateState('a.name', 'asc');
	}

	public function getItems()
	{
		$items = parent::getItems();

		if (!empty($items))
		{
			// TODO replace this manual call with autoloading later
			JLoader::register('SRCurrency', SRPATH_LIBRARY . '/currency/currency.php');

			$assetTable = JTable::getInstance('ReservationAsset', 'SolidresTable');

			foreach ($items as $item)
			{
				$assetTable->load($item->reservation_asset_id);
				$item->currency = new SRCurrency($item->price, $assetTable->currency_id);
			}
		}
		
		return $items;
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

		$query->select($this->getState('list.select','a.*'));
		$query->from($db->quoteName('#__sr_extras').' AS a');

		$query->select('r.name AS reservationasset');
		$query->join('INNER', $db->quoteName('#__sr_reservation_assets').'as r On a.reservation_asset_id = r.id');

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

		// Filter by reservation asset.
		$reservationAssetId = $this->getState('filter.reservation_asset_id');
		if (is_numeric($reservationAssetId))
        {
			$query->where('a.reservation_asset_id = '.(int) $reservationAssetId);
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
				$query->where('a.name LIKE '.$search);
			}
		}

		if($this->getState('list.ordering', 'a.ordering') == 'a.ordering')
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