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
 * Taxes model
 *
 * @package     Solidres
 * @subpackage	Tax
 * @since		0.1.0
 */
class SolidresModelTaxes extends JModelList {
	
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
				'id', 'r.id',
				'name', 'r.name',
				'state', 'r.state'
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
	 *
	 * @since   11.1
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication('administrator');

		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		$params = JComponentHelper::getParams('com_solidres');
		$this->setState('params', $params);

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
		$db	= $this->getDbo();
		$query = $db->getQuery(true);

		$query->select($this->getState('list.select', 'r.*'));
		
		$query->from($db->quoteName('#__sr_taxes').' AS r');

		$published = $this->getState('filter.state');
		if (is_numeric($published))
		{
			$query->where('r.state = '.(int) $published);
		}
		else if ($published === '')
		{
			$query->where('(r.state IN (0, 1))');
		}

		$countryId = $this->getState('filter.country_id');
		if (is_numeric($countryId))
		{
			$query->where('r.country_id = '. (int) $countryId);
		}

		$reservationAssetID = $this->getState('filter.reservation_asset_id');
		if (is_numeric($reservationAssetID))
		{
			$query->where('r.country_id IN (SELECT country_id FROM '.$db->quoteName('#__sr_reservation_assets').' WHERE id = '.(int) $reservationAssetID.')');
		}

		$geoStateId = $this->getState('filter.geo_state_id');
		if (is_numeric($geoStateId))
		{
			$query->where('r.geo_state_id = '. (int) $geoStateId);
		}

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
				$query->where('r.name LIKE '.$search);
			}
		}

		return $query;
	}
}