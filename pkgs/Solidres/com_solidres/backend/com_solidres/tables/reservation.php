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
 * Reservation table
 *
 * @package     Solidres
 * @subpackage	Reservation
 * @since		0.1.0
 */
class SolidresTableReservation extends JTable
{
    function __construct(&$_db)
	{
		parent::__construct('#__sr_reservations', 'id', $_db);
	}

	/**
	 * Overload the store method
	 *
	 * @param	boolean	$updateNulls Toggle whether null values should be updated.
	 * @return	boolean	True on success, false on failure.
	 * @since	1.6
	 */
	public function store($updateNulls = false)
	{
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();

		if ($this->id)
		{
			$this->modified_date	= $date->toSql();
			$this->modified_by		= $user->get('id');
		}
		else
		{
			if (!intval($this->created_date))
			{
				$this->created_date = $date->toSql();
			}
			if (empty($this->created_by))
			{
				$this->created_by = $user->get('id');
			}
			$this->code = SRFactory::get('solidres.reservation.reservation')->getCode($this->created_date);
		}

		// Prepare some NULL value
		if (empty($this->coupon_id))
		{
			$this->coupon_id = NULL;
		}

		if (empty($this->customer_id))
		{
			$this->customer_id = NULL;
		}

		$this->checkin 	= JFactory::getDate($this->checkin)->toSql();
		$this->checkout = JFactory::getDate($this->checkout)->toSql();
				
		// Attempt to store the user data.
		return parent::store($updateNulls);
	}

	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param	mixed	$pks An optional array of primary key values to update.  If not
	 *					set the instance property value is used.
	 * @param	integer $state The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param	integer $userId The user id of the user performing the operation.
	 * @return	boolean	True on success.
	 * @since	1.0.4
	 * @link	http://docs.joomla.org/JTable/publish
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k)
			{
				$pks = array($this->$k);
			}
			else // Nothing to set publishing state on, return false.
			{
				$e = new JException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				$this->setError($e);

				return false;
			}
		}

		// Update the publishing state for rows with the given primary keys.
		$query = $this->_db->getQuery(true);
		$query->update($this->_tbl)->set('state = '.(int) $state);

		// Determine if there is checkin support for the table.
		if (property_exists($this, 'checked_out') || property_exists($this, 'checked_out_time'))
		{
			$query->where('(checked_out = 0 OR checked_out = '.(int) $userId.')');
			$checkin = true;
		}
		else
		{
			$checkin = false;
		}

		// Build the WHERE clause for the primary keys.
		$query->where($k.' = '.implode(' OR '.$k.' = ', $pks));

		$this->_db->setQuery($query);

		// Check for a database error.
		if (!$this->_db->execute())
		{
			$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
			$this->setError($e);

			return false;
		}

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin the rows.
			foreach($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks))
		{
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}

	/**
	 * Method to delete a row from the database table by primary key value.
	 *
	 * @param	mixed	$pk An optional primary key value to delete.  If not set the
	 *					instance property value is used.
	 * @return	boolean	True on success.
	 * @since	0.1.0
	 * @link	http://docs.joomla.org/JTable/delete
	 */
	public function delete($pk = null)
	{
		// Take care of relationship with Room in Reservation
		$query = $this->_db->getQuery(true);
		$query->delete($this->_db->quoteName('#__sr_reservation_room_xref'))->where('reservation_id = '.$this->_db->quote($pk));
		$this->_db->setQuery($query)->execute();

		// Take care of relationship with Room and Extra in Reservation
		$query->clear();
		$query->delete($this->_db->quoteName('#__sr_reservation_room_extra_xref'))->where('reservation_id = '.$this->_db->quote($pk));
		$this->_db->setQuery($query)->execute();

		// Take care of Reservation Notes
		$query->clear();
		$query->delete($this->_db->quoteName('#__sr_reservation_notes'))->where('reservation_id = '.$this->_db->quote($pk));
		$this->_db->setQuery($query)->execute();

		// Delete itself
		return parent::delete($pk);
	}
}

