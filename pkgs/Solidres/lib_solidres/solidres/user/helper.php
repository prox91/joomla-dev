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
 * User handler class
 * 
 * @package 	Solidres
 * @subpackage	User
 */
class SRUserHelper
{
	/**
	 * The database object
	 * 
	 * @var object
	 */
	protected $_dbo = null;
	
	public function __construct()
	{
		$this->_dbo = JFactory::getDbo();
	}

	/**
	 * Returns a list of available Joomla user groups
	 *
	 * @return array an array of user group object
	 */
	public function getUserGroups()
	{
		$model = JModelLegacy::getInstance('CustomerGroups', 'SolidresModel', array('ignore_request' => true));
		$model->setState('list.start', 0);
		$model->setState('list.limit', 0);
		$model->setState('filter.state', 1);
		$model->setState('list.ordering', 'a.name');
		$results = $model->getItems();

		$generalCustomerGroup = new stdClass();
		$generalCustomerGroup->id = null;
		$generalCustomerGroup->name = JText::_('SR_GENERAL_CUSTOMER_GROUP');

		array_unshift($results, $generalCustomerGroup);

		return $results;
	}
}