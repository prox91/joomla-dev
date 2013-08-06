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
 * Currency table
 *
 * @package     Solidres
 * @subpackage	Currency
 * @since		0.1.0
 */
class SolidresTableCurrency extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__sr_currencies', 'id', $_db);
	}

	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param	mixed	An optional array of primary key values to update.  If not
	 *					set the instance property value is used.
	 * @param	integer The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param	integer The user id of the user performing the operation.
	 * @return	boolean	True on success.
	 * @since	1.0.4
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
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k.'='.implode(' OR '.$k.'=', $pks);

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE `'.$this->_tbl.'`' .
			' SET state = '.(int) $state .
			' WHERE ('.$where.')'
		);
		$this->_db->execute();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// If checkin is supported and all rows were adjusted, check them in.
		if ((count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin the rows.
			foreach($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks)) {
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
	 * @since	1.0
	 * @link	http://docs.joomla.org/JTable/delete
	 */
	public function delete($pk = null)
	{
		// Check for relationship with price table
		$query = $this->_db->getQuery(true);
		$query->select('count(*)')
			->from($this->_db->quoteName('#__sr_prices'))
			->where($this->_db->quoteName('currency_id' ) . '=' . (int) $this->id);
		$this->_db->setQuery($query);

		if ($this->_db->loadResult() >= 1)
		{
			$this->setError(JText::_('SR_ERROR_CURRENCY_HAS_RELATIONSHIP_WITH_PRICE_TABLE'));
			return false;
		}

		// Check for relationshop with Asset
		$query->clear();
		$query->select('count(*)')
			->from($this->_db->quoteName('#__sr_reservation_assets'))
			->where($this->_db->quoteName('currency_id' ) . '=' . (int) $this->id);
		$this->_db->setQuery($query);

		if ($this->_db->loadResult() >= 1)
		{
			$this->setError(JText::_('SR_ERROR_CURRENCY_HAS_RELATIONSHIP_WITH_RESERVATION_ASSET_TABLE'));
			return false;
		}

		// Set all foreign key to NULL in table reservation
		$query->clear();
		$query->update($this->_db->quoteName('#__sr_reservations'))
			->set($this->_db->quoteName('currency_id') . ' = NULL' )
			->where($this->_db->quoteName('currency_id') .' = ' . (int) $this->id);
		$this->_db->setQuery($query)->execute();

		return parent::delete($pk);
	}
}

