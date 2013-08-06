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
 * Customer table class
 *
 * @package     Solidres
 * @subpackage	Customer
 * @since		0.1.0
 */
class SolidresTableCustomer extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__sr_customers', 'id', $_db);
	}

	/**
	 * Validation and filtering
	 *
	 * @return  boolean  True if satisfactory
	 *
	 * @since   11.1
	 */
	public function check()
	{
		if (trim($this->firstname) == '')
		{
			$this->setError(JText::_('JLIB_DATABASE_ERROR_PLEASE_ENTER_YOUR_FIRSTNAME'));
			return false;
		}

		return true;
	}

	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param   mixed    $pk      An optional array of primary key values to update.  If not
	 *                            set the instance property value is used.
	 * @param   integer  $state   The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param   integer  $userId  The user id of the user performing the operation.
	 *
	 * @return  boolean  True on success.
	 *
	 * @link    http://docs.joomla.org/JTable/publish
	 * @since   11.1
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
		if (empty($pks)) {
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$e = new JException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				$this->setError($e);

				return false;
			}
		}
		if($state == -2) {
			//get list user from table user of joomla
			$id = 'id';
			$query = $this->_db->getQuery(true);
			$query->select('id');
			$query->from($this->_db->quoteName('#__users'));
			$query->where('id IN (
					select user_id
					from '.$this->_tbl.'
					where '.($id.' = '.implode(' OR '.$id.' = ', $pks)).'
			)');
			$this->_db->setQuery($query);
			$listUserIds = $this->_db->loadColumn();

			//delete customer field first
			$query->clear();
			$query->delete();
			$query->from($this->_db->quoteName('#__sr_customer_fields'));
			$query->where('user_id = '.implode(' OR user_id = ', $pks));
			$this->_db->setQuery($query);
			if (!$this->_db->execute()) {
				$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
				$this->setError($e);
				return false;
			}

			//delete child first
			// Update the publishing state for rows with the given primary keys.
			$query->clear();
			$query->delete();
			$query->from($this->_tbl);
			// Build the WHERE clause for the primary keys.
			$query->where($k.' = '.implode(' OR '.$k.' = ', $pks));
			$this->_db->setQuery($query);
			// Check for a database error.
			if (!$this->_db->execute()) {
				$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
				$this->setError($e);
				return false;
			}

			$query->clear();
			$query->update($this->_db->quoteName('#__sr_reservations'));
			$query->set('customer_id = NULL');
			$query->where('customer_id = '.implode(' OR customer_id = ', $pks));
			$this->_db->setQuery($query);
			if (!$this->_db->execute()) {
				$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
				$this->setError($e);
				return false;
			}

			/*$query->clear();
			$query->update('#__sr_feedbacks');
			$query->set('customer_id = NULL');
			$query->where('customer_id = '.implode(' OR customer_id = ', $pks));
			$this->_db->setQuery($query);
			if (!$this->_db->execute()) {
				$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
				$this->setError($e);
				return false;
			}*/

			if(!empty($listUserIds)) {
				//delete father later
				$query->clear();
				$query->delete();
				$query->from($this->_db->quoteName('#__users'));
				$query->where($id.' = '.implode(' OR '.$id.' = ', $listUserIds));
				$this->_db->setQuery($query);
				// Check for a database error.
				if (!$this->_db->execute()) {
					$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
					$this->setError($e);
					return false;
				}
			}
		}
		return true;
	}

	/**
	 * Method to delete a row from the database table by primary key value.
	 *
	 * @param   mixed    $pk  An optional primary key value to delete.  If not set the
	 *                        instance property value is used.
	 *
	 * @return  boolean  True on success.
	 */
	public function delete($pk = null)
	{
		$k = $this->_tbl_key;
		$pk = (is_null($pk)) ? $this->$k : $pk;
		$query = $this->_db->getQuery(true);
		JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_users/models', 'UsersModel');

		// If no primary key is given, return false.
		if ($pk === null)
		{
			return false;
		}

		// Take care of Reservation
		$query->update($this->_db->quoteName('#__sr_reservations'))
			->set('customer_id = NULL')
			->where('customer_id = '.$this->_db->quote($pk));
		$this->_db->setQuery($query)->execute();

		// Take care of Customer Fields
		$query->clear();
		$query->delete()->from($this->_db->quoteName('#__sr_customer_fields'))
			  ->where('user_id = '.$this->_db->quote($pk));
		$this->_db->setQuery($query)->execute();

		// Also remove corresponding Joomla users
		$userModel = JModelLegacy::getInstance('User', 'UsersModel', array('ignore_request' => true));
		$userModel->delete($this->user_id);

		/*$query->clear();
		$query->update('#__sr_feedbacks');
		$query->set('customer_id = NULL');
		$query->where('customer_id = '.$this->_db->quote($pk));
		$this->_db->setQuery($query);
		if (!$this->_db->execute()) {
			$e = new JException(JText::sprintf('JLIB_DATABASE_ERROR_PUBLISH_FAILED', get_class($this), $this->_db->getErrorMsg()));
			$this->setError($e);
			return false;
		}*/

		// Delete it
		return parent::delete($pk);
	}
}

