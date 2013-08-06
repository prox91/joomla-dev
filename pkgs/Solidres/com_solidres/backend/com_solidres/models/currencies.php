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
 * Currencies model
 *
 * @package     Solidres
 * @subpackage	Currencies
 * @since		0.1.0
 */
class SolidresModelCurrencies extends JModelList
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
				'id', 			 'u.id',
				'currency_name', 'u.currency_name',
				'currency_code', 'u.currency_code',
				'state', 		 'u.state',
				'exchange_rate', 'u.exchange_rate'
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

		// Load the parameters.
		$params = JComponentHelper::getParams('com_solidres');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('u.currency_name', 'asc');
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

		$query->select(	$this->getState( 'list.select', 'u.*') );
		
		$query->from($db->quoteName('#__sr_currencies').' AS u');

		$published = $this->getState('filter.state');
		if (is_numeric($published))
		{
			$query->where('u.state = '.(int) $published);
		}
		else if ($published === '')
		{
			$query->where('(u.state IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('u.id = '.(int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('u.currency_name LIKE '.$search.' OR u.currency_code LIKE'.$search);
			}
		}

		if($this->getState('list.ordering', 'u.currency_name') == 'u.currency_name')
		{
			$query->order($db->escape($this->getState('list.ordering', 'u.currency_name')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
		else
		{
			$query->order($db->escape($this->getState('list.ordering', 'u.currency_name')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		}
		return $query;
	}
}