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
 * Reservation handler class
 * 
 * @package 	Solidres
 * @subpackage	Reservation
 */

class SRReservation
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
	 * Generate unique string for Reservation
     *
     * @param string $srcString The string that need to be calculate checksum
     *
     * @return string The unique string for each Reservation
	 */	
	public function getCode($srcString)
	{
		return hash('crc32', (string) $srcString.uniqid());
	}

    /**
     * Check a room to see if it is allowed to be booked in the period from $checkin -> $checkout
	 *
     * @param int       $roomId
     * @param string    $checkin
     * @param string    $checkout
     * 
     * @return boolean  True if the room is ready to be booked, False otherwise
     */
    public function isRoomAvailable($roomId = 0, $checkin, $checkout)
    {
        $checkin    = JFactory::getDate($checkin)->toUnix();
        $checkout  = JFactory::getDate($checkout)->toUnix();

        $query = $this->_dbo->getQuery(true);
        $query->select('checkin, checkout');
        $query->from($this->_dbo->quoteName('#__sr_reservations').' as res');

		$query->join('INNER', $this->_dbo->quoteName('#__sr_reservation_room_xref').' as room
									ON res.id = room.reservation_id
									AND room.room_id = '.$this->_dbo->quote($roomId));
        $query->where('res.checkout > NOW()');
		// TODO: pay attention to the state here, all reservation made in front-end should be set to Pending, Pending is not the same with Unpublished / Disabled
        //$query->where('res.state != 0');
        $query->order('res.checkin');

        $this->_dbo->setQuery($query);
        // Get all current reservations and their checkin/checkout date
		$result = $this->_dbo->loadObjectList();

    	if(is_array($result))
		{
			foreach($result as $currentReservation)
			{
				$currentCheckin = JFactory::getDate($currentReservation->checkin)->toUnix();
				$currentCheckout = JFactory::getDate($currentReservation->checkout)->toUnix();

				if
				(
					($checkin <= $currentCheckin && $checkout > $currentCheckin) ||
					($checkin >= $currentCheckin && $checkout <= $currentCheckout) ||
					($checkin < $currentCheckout && $checkout >= $currentCheckout)
				)
				{
					return false;
				}
			}
		}

        return true;
    }

 	/**
	 * Store reservation data
	 * 
	 * @param   int 	$reservationId
	 * @param   array 	$room Room information
	 *
	 * @return void
	 */
	public function storeRoom($reservationId, $room)
	{
		$query = $this->_dbo->getQuery(true);

		$query->insert($this->_dbo->quoteName('#__sr_reservation_room_xref'));
		$query->columns(array(
			$this->_dbo->quoteName('reservation_id'),
			$this->_dbo->quoteName('room_id'),
			$this->_dbo->quoteName('room_label'),
			$this->_dbo->quoteName('adults_number'),
			$this->_dbo->quoteName('children_number'),
			$this->_dbo->quoteName('guest_fullname'),
			$this->_dbo->quoteName('room_price')
		));
		$query->values(
			(int) $reservationId . ',' .
			$this->_dbo->quote($room['room_id']) . ',' .
			$this->_dbo->quote($room['room_label']) . ',' .
			$this->_dbo->quote($room['adults_number']) . ',' .
			$this->_dbo->quote($room['children_number']) . ',' .
			$this->_dbo->quote($room['guest_fullname']) . ',' .
			$this->_dbo->quote($room['room_price'])
		);

		$this->_dbo->setQuery($query);
		$this->_dbo->execute();
	}

	/**
	 * Store extra information
	 *
 	 * @param  int      $reservationId
     * @param  int      $roomId
	 * @param  string   $roomLabel
	 * @param  int      $extraId
	 * @param  string   $extraName
	 * @param  int      $extraQuantity The extra quantity or NULL if extra does not have quantity
	 * @param  int      $price
	 *
	 * @return void
	 */
	public function storeExtra($reservationId, $roomId, $roomLabel, $extraId, $extraName, $extraQuantity = NULL, $price = 0)
	{
		$query = $this->_dbo->getQuery(true);
		$query->insert($this->_dbo->quoteName('#__sr_reservation_room_extra_xref'));
		$query->columns(array(
			$this->_dbo->quoteName('reservation_id'),
			$this->_dbo->quoteName('room_id'),
			$this->_dbo->quoteName('room_label'),
			$this->_dbo->quoteName('extra_id'),
			$this->_dbo->quoteName('extra_name'),
			$this->_dbo->quoteName('extra_quantity'),
			$this->_dbo->quoteName('extra_price')
		));
		$query->values(
			$this->_dbo->quote($reservationId) . ',' .
			$this->_dbo->quote($roomId) . ',' .
			$this->_dbo->quote($roomLabel) . ',' .
			$this->_dbo->quote($extraId) . ',' .
			$this->_dbo->quote($extraName) . ',' .
			($extraQuantity === NULL ? NULL : $this->_dbo->quote($extraQuantity) ) . ',' .
			$this->_dbo->quote($price)
		);
		$this->_dbo->setQuery($query);
		$this->_dbo->execute();
	}
}