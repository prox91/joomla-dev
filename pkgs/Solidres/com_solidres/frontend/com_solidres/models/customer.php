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

JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'SolidresModel');
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'SolidresTable');

/**
 * Solidres Component Model
 *
 * @package		Reservation
 * @since		0.3.0
 */
class SolidresModelCustomer extends JModelLegacy
{
	public function getReservations()
	{
		$model = JModelLegacy::getInstance('Reservations', 'SolidresModel', array('ignore_request' => true));
		$customerTable = JTable::getInstance('Customer', 'SolidresTable');
		$user = JFactory::getUser();
		$customerTable->load(array('user_id' => $user->get('id')));
		$model->setState('filter.customer_id', $customerTable->id);
		$results = $model->getItems();

		return $results;
	}
}