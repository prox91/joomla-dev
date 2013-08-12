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
 * Reservation controller class.
 *
 * @package     Solidres
 * @subpackage	Reservation
 * @since		0.4.0
 */
class SolidresControllerReservation extends JControllerForm
{
	/**
	 * Method override to check if you can add a new record.
	 *
	 * @param	array $data An array of input data.
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowAdd($data = array())
	{
		$allow	= null;

		if ($allow === null)
		{
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd($data);
		} else {
			return $allow;
		}
	}

	/**
	 * Method to check if you can add a new record.
	 *
	 * @param	array $data An array of input data.
	 * @param	string $key The name of the key for the primary key.
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		return parent::allowEdit($data, $key);
	}

	public function save()
	{
		$input = JFactory::getApplication()->input;
		$pk = $input->get('pk', 0);
		$name = $input->get('name', 0, 'string');
		$value = $input->get('value', 0, 'int');

		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_solidres/tables');
		$table = JTable::getInstance('Reservation', 'SolidresTable');

		$table->load($pk);
		$table->$name = $value;
		$result = $table->store();

		echo json_encode(array('success' => $result));
		die(1);
	}
}
