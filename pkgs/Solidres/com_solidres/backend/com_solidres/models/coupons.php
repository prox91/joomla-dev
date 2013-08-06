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
 * Coupons Fields model
 *
 * @package     Solidres
 * @subpackage	Coupon
 * @since		0.1.0
 */
class SolidresModelCoupons extends JModelList {

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
				'id', 'u.id',
				'state', 'u.state',
				'name', 'u.coupon_name',
				'label', 'u.coupon_code',
				'amount', 'u.amount',
				'is_percent', 'u.is_percent',
				'valid_from', 'u.valid_from',
				'valid_to', 'u.valid_to'
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
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context.'.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		$customerGroupId = $app->getUserStateFromRequest($this->context.'.filter.customer_group_id', 'filter_customer_group_id', '', 'string');
		$this->setState('filter.customer_group_id', $customerGroupId);

		$params = JComponentHelper::getParams('com_solidres');
		$this->setState('params', $params);

		parent::populateState('u.coupon_name', 'asc');
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		$dbo		= $this->getDbo();
		$query	    = $dbo->getQuery(true);
        $nowDate	= $dbo->quote(JFactory::getDate()->toSQL());

		$query->select(
            $this->getState('list.select', 'u.*')
        );
		$query->from($dbo->quoteName('#__sr_coupons').' AS u');

		// Filter by state
		$published = $this->getState('filter.state');
		if (is_numeric($published))
        {
			$query->where('u.state = '.(int) $published);
		}
        else if ($published === '')
        {
			$query->where('(u.state IN (0, 1))');
		}

		// Filter by customer group
		$customerGroupId = $this->getState('filter.customer_group_id', NULL);
		if ($customerGroupId != '')
		{
			$query->where('u.customer_group_id '.($customerGroupId === NULL ? 'IS NULL' : '= ' .(int) $customerGroupId));
		}

		// Filter by name
		$search = $this->getState('filter.search');
		if (!empty($search))
        {
			if (stripos($search, 'id:') === 0)
            {
				$query->where('u.id = '.(int) substr($search, 3));
			}
            else
            {
				$search = $dbo->Quote('%'.$dbo->escape($search, true).'%');
				$query->where('u.coupon_name LIKE '.$search);
			}
		}

        // Filter by valid date constraint
		if ($this->getState('filter.date_constraint'))
        {
            $query->where('u.valid_from < '.$nowDate);
            $query->where('u.valid_to > '.$nowDate);
        }

        // Filter by reservation asset id
		if ($reservationAssetId = $this->getState('filter.reservation_asset_id'))
        {
            $query->where('u.reservation_asset_id = '.(int)$reservationAssetId);
        }

		if($this->getState('list.ordering', 'u.coupon_name') == 'u.coupon_name')
        {
			$query->order($dbo->escape($this->getState('list.ordering', 'u.coupon_name')).' '.$dbo->escape($this->getState('list.direction', 'ASC')));
		}
        else
        {
			// Add the list ordering clause.
			$query->order($dbo->escape($this->getState('list.ordering', 'u.coupon_name')).' '.$dbo->escape($this->getState('list.direction', 'ASC')));
		}

		return $query;
	}
}