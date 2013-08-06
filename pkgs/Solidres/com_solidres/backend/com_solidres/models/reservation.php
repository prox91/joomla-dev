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
 * Reservation model.
 *
 * @package     Solidres
 * @subpackage	Reservation
 * @since		0.1.0
 */
class SolidresModelReservation extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = null;

	/**
	 * @var		string	The event to trigger after deleting the data.
	 * @since	1.6
	 */
	protected $event_after_delete = null;

	/**
	 * @var		string	The event to trigger after saving the data.
	 * @since	1.6
	 */
	protected $event_after_save = null;

	/**
	 * @var		string	The event to trigger after deleting the data.
	 * @since	1.6
	 */
	protected $event_before_delete = null;

	/**
	 * @var		string	The event to trigger after saving the data.
	 * @since	1.6
	 */
	protected $event_before_save = null;

	/**
	 * @var		string	The event to trigger after changing the published state of the data.
	 * @since	1.6
	 */
	protected $event_change_state = null;

	/**
	 * Constructor.
	 *
	 * @param	array $config An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->event_after_delete 	= 'onReservationAfterDelete';
		$this->event_after_save 	= 'onReservationAfterSave';
		$this->event_before_delete 	= 'onReservationBeforeDelete';
		$this->event_before_save 	= 'onReservationBeforeSave';
		$this->event_change_state 	= 'onReservationChangeState';
		$this->text_prefix 			= strtoupper($this->option);
	}
	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	$record A record object.
	 * @return	boolean	True if allowed to delete the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canDelete($record)
	{
		$user = JFactory::getUser();
		
		return $user->authorise('core.delete', 'com_solidres.reservation.'.(int) $record->id);
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	$record A record object.
	 * @return	boolean	True if allowed to change the state of the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		return $user->authorise('core.edit.state', 'com_solidres.reservation.'.(int) $record->id);
	}
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	string	$type The table type to instantiate
	 * @param	string	$prefix A prefix for the table class name. Optional.
	 * @param	array	$config Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Reservation', $prefix = 'SolidresTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_solidres.reservation', 'reservation', array('control' => 'jform', 'load_data' => $loadData));
        
		if (empty($form))
        {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_solidres.edit.reservation.data', array());

		if (empty($data))
        {
			$data = $this->getItem();
		}

		return $data;
	}

    /**
	 * Method to get a single record.
	 *
	 * @param	integer	$pk The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);
		if ($item->id)
        {
			$modelCoupon = JModelLegacy::getInstance('Coupon', 'SolidresModel', array('ignore_request' => true));
			$notesModel = JModelLegacy::getInstance('ReservationNotes', 'SolidresModel', array('ignore_request' => true));
			$item->coupon_code = empty($item->coupon_id) ? '' : $modelCoupon->getItem($item->coupon_id)->coupon_code;

            if(!empty($item->customer_id))
            {
                $query = $this->_db->getQuery(true);
                $query->select('CONCAT(u.name, " (", c.customer_code, " - ", cg.name, ")" )');
                $query->from($this->_db->quoteName('#__sr_customers').'as c');
                $query->join('LEFT', $this->_db->quoteName('#__sr_customer_groups').' as cg ON cg.id = c.customer_group_id');
                $query->join('LEFT', $this->_db->quoteName('#__users').' as u ON u.id = c.user_id');
                $query->where('c.id = '. (int) $item->customer_id);
                $this->_db->setQuery($query);
                $item->customer_code = $this->_db->loadResult();
            }

            $query = $this->_db->getQuery(true);
            $query->select('x.*, rtype.name as room_type_name, room.label as room_label')
				  ->from($this->_db->quoteName('#__sr_reservation_room_xref'). 'as x')
				  ->join('INNER', $this->_db->quoteName('#__sr_rooms').' as room ON room.id = x.room_id')
				  ->join('INNER', $this->_db->quoteName('#__sr_room_types').' as rtype ON rtype.id = room.room_type_id')
				  ->where('reservation_id = '.$this->_db->quote($item->id));

            $this->_db->setQuery($query);
            $item->reserved_room_details = $this->_db->loadObjectList();

			$reservedRoom = array();
			foreach($item->reserved_room_details as $room)
			{
				$query->clear();
				$query->select('x.*, extra.name as extra_name')->from($this->_db->quoteName('#__sr_reservation_room_extra_xref').' as x')
					->join('INNER', $this->_db->quoteName('#__sr_extras').' as extra ON extra.id = x.extra_id')
					->where('reservation_id = '.$this->_db->quote($item->id))
					->where('room_id = '. (int) $room->room_id);

				$this->_db->setQuery($query);
				$result = $this->_db->loadObjectList();

				if (!empty($result))
				{
					$room->extras =  $result;
				}

			}

			// Get all notes
			$item->notes = NULL;
			$notesModel->setState('filter.reservation_id', $item->id);
			$notes = $notesModel->getItems();

			if (!empty($notes))
			{
				$item->notes = $notes;
			}
		}
        
		return $item;
	}
	
}