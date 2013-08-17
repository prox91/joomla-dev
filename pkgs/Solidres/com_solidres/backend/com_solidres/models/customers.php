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
 * @package     Solidres
 * @subpackage	Customer
 * @since		0.1.0
 */
class SolidresModelCustomers extends JModelList
{
    /**
     * @param       array $config
     * @since       1.6
     */
	public function __construct($config = array())
	{
    	parent::__construct($config);
	}

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since    1.6
     * @param null $ordering
     * @param null $direction
     */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		$state = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state');
		$this->setState('filter.state', $state);

		$groupId = $this->getUserStateFromRequest($this->context.'.filter.group', 'filter_group_id', null, 'int');
		$this->setState('filter.customer_group_id', $groupId);

		$search = $app->getUserStateFromRequest($this->context.'.filter.customer_code', 'filter_customer_code');
		$this->setState('filter.customer_code', $search);

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
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState('list.select','a.*'	)
		);
		$query->from($db->quoteName('#__sr_customers').' AS a');

		$query->select($db->quoteName('g.name') . ' AS group_name');
		$query->join('LEFT', $db->quoteName('#__sr_customer_groups') .' AS g ON g.id = a.customer_group_id');

		// LEFT JOIN with joomla user table
		$query->select('u.id as juid, u.name as jname, u.username as jusername, u.email as jemail, u.block as jblock');
        $query->select($db->quoteName('u') . '.' . $db->quoteName('registerDate') .' as ' . $db->quoteName('jregisterDate'));
		$query->select($db->quoteName('u') . '.' . $db->quoteName('lastvisitDate') .' as ' . $db->quoteName('jlastvisitDate'));
		$query->join('LEFT', $db->quoteName('#__users') .' AS u ON u.id = a.user_id');

    	// Filter by customer group.
		$groupId = $this->getState('filter.customer_group_id');
		if (is_numeric($groupId))
        {
			$query->where('a.customer_group_id = '.(int) $groupId);
		}

		// Filter by customer code
		$customerCode = $this->getState('filter.customer_code');
		if (!empty($customerCode)) 
		{
			$query->where('a.customer_code LIKE "%'.$db->escape($customerCode).'%"');
		}

		// Filter by published state
		$state = $this->getState('filter.state');
		if (is_numeric($state))
		{
			$query->where('a.block = '.(int) $state);
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

		return $query;
	}
}