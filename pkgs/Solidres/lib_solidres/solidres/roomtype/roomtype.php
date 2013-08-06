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
 * RoomType handler class
 * 
 * @package 	Solidres
 * @subpackage	RoomType
 */
class SRRoomType
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
	 * Get list of Room is reserved and belong to a RoomType.
     * 
	 * @param int $roomTypeId
	 * @param int $reservationId
     * 
	 * @return array An array of room object
	 */
	public function getListReservedRoom($roomTypeId, $reservationId)
	{
		$query = $this->_dbo->getQuery(true);

		$query->select('r1.id, r1.label, r2.adults_number, r2.children_number');
		$query->from($this->_dbo->quoteName('#__sr_rooms').' r1');
		$query->join('INNER', $this->_dbo->quoteName('#__sr_reservation_room_xref').' r2 ON r1.id = r2.room_id');
		$query->where('r1.room_type_id = '.$this->_dbo->quote($roomTypeId).' AND r2.reservation_id = '.$this->_dbo->quote($reservationId));

		$this->_dbo->setQuery($query);
		$results = $this->_dbo->loadObjectList();
        
		return $results;
	}

	/**
	 * Get list rooms belong to a RoomType
     * 
	 * @param int $roomtypeId
     *
	 * @return array object
	 */
	public function getListRooms($roomtypeId)
	{
		$query = $this->_dbo->getQuery(true);
		
		$query->clear();
		$query->select('id, label, room_type_id');
		$query->from($this->_dbo->quoteName('#__sr_rooms'));
		$query->where('room_type_id = '.$this->_dbo->quote($roomtypeId));
		
		$this->_dbo->setQuery($query);
		$result = $this->_dbo->loadObjectList();
		
		if(empty($result))
        {
			return false;
		}

		return $result;
	}
	
	/**
	 * Method to get a list of available rooms of a RoomType based on check in and check out date
     * 
	 * @param   int     $roomtypeId
	 * @param   int     $checkin
	 * @param   int     $checkout
	 * 
	 * @return  mixed   An array of room object if successfully
     *                  otherwise return false
	 */
	public function getListAvailableRoom($roomtypeId = 0, $checkin, $checkout)
	{

		$srReservation = SRFactory::get('solidres.reservation.reservation');
		$availableRooms = array();

		$query = $this->_dbo->getQuery(true);
		$query->select('id, label')->from($this->_dbo->quoteName('#__sr_rooms'));

        if ($roomtypeId > 0)
		{
            $query->where('room_type_id = '.$this->_dbo->quote($roomtypeId));
        }

		$this->_dbo->setQuery($query);
		$rooms = $this->_dbo->loadObjectList();

		if (empty($rooms))
		{
			return false;
		}

		foreach ($rooms as $room)
		{
			// If this room is available, add it to the returned list
			if ($srReservation->isRoomAvailable($room->id, $checkin, $checkout))
			{
				$availableRooms[] = $room;
			}
		}
		
		return $availableRooms;
	}
	
	/**
	 * Check a room to determine whether it can be deleted or not, if yes then delete it
	 * 
	 * When delete a room, we will need to make sure that all related
	 * Reservation of that room must be removed first 
	 *  
	 * @param 	int 	    $roomId
     * 
	 * @return 	boolean     True if a room is safe to be deleted
     *                      False otherwise
	 */
	public function canDeleteRoom($roomId = 0) {
		$query		= $this->_dbo->getQuery(true);
        
		$query->select('COUNT(*)')->from($this->_dbo->quoteName('#__sr_reservation_room_xref'))->where('room_id = '.$this->_dbo->quote($roomId));
		$this->_dbo->setQuery($query);
		$result = (int) $this->_dbo->loadResult();

		if ($result > 0)
        {
			return false;
		}
        
		$query->clear();
		$query->delete('')->from($this->_dbo->quoteName('#__sr_rooms'))->where('id = '.$this->_dbo->quote($roomId));
		$this->_dbo->setQuery($query);
		$result = $this->_dbo->execute();
        
		if (!$result)
        {
			return false;
		}
        
		return true;
	}
	
	/**
     * @param  int $roomtypeId
     * @param  int $couponId
     * @return bool|mixed
     */
	public function storeCoupon($roomtypeId = 0, $couponId = 0)
	{
		if($roomtypeId <= 0 && $couponId <= 0)
		{
			return false;
		}

        $query = $this->_dbo->getQuery(true);
        $query->insert($this->_dbo->quoteName('#__sr_room_type_coupon_xref'))
              ->columns(array($this->_dbo->quoteName('room_type_id'), $this->_dbo->quoteName('coupon_id')))
              ->values((int) $roomtypeId . ',' . (int)$couponId) ;
		$this->_dbo->setQuery($query);
        
		return $this->_dbo->execute();
	}


    /**
     * @param  int $roomtypeId
     * @param  int $extraId
     * @return bool|mixed
     */
    public function storeExtra($roomtypeId = 0, $extraId = 0)
    {
        if($roomtypeId <= 0 && $extraId <= 0)
        {
            return false;
        }

        $query = $this->_dbo->getQuery(true);
        $query->insert($this->_dbo->quoteName('#__sr_room_type_extra_xref'))
              ->columns( array($this->_dbo->quoteName('room_type_id'), $this->_dbo->quoteName('extra_id')))
              ->values((int) $roomtypeId . ',' . (int)$extraId) ;
        $this->_dbo->setQuery($query);

        return $this->_dbo->execute();
    }
	
    /**
     * Method to store Room information
     *
     * TODO move this function to corresponding model/table
     *
     * @param   int     $roomTypeId
     * @param   string  $roomLabel
     * 
     * @return  boolean
     */
    public function storeRoom($roomTypeId = 0, $roomLabel = '')
    {
        $table = JTable::getInstance('Room', 'SolidresTable');

        $table->room_type_id    = $roomTypeId;
        $table->label           = $roomLabel;

        return $table->store();
    }

    /**
     * Store tariff information
     *
     * TODO move this function to corresponding model/table
     *
     * @param   array $data 
     *
     * @return  boolean True if saving successfully, false otherwise
     */
    public function storeTariff($data)
    {
        $table = JTable::getInstance('Tariff', 'SolidresTable');

        $table->room_type_id        = $data['roomTypeId'];
        $table->currency_id         = $data['currencyId'];
        $table->customer_group_id   = $data['customerGroupId'];
        $table->price               = $data['price'];
        $table->valid_from          = JFactory::getDate($data['validFrom'])->toSql() ;
        $table->valid_to            = JFactory::getDate($data['validTo'])->toSql() ;
		$table->title				= $data['title'];
		$table->description			= $data['description'];
		$table->d_min				= $data['d_min'];
		$table->d_max				= $data['d_max'];
		$table->p_min				= $data['p_min'];
		$table->p_max				= $data['p_max'];
		$table->w_day				= $data['w_day'];

        return $table->store();
    }

    /**
     * Find room type by room id
     *
     * TODO move this function to corresponding model/table
     *
     * @param  int $roomId
     *
     * @return mixed
     */
    public function findByRoomId($roomId)
    {
        $query = $this->_dbo->getQuery(true);
        
        $query->select('*')->from($this->_dbo->quoteName('#__sr_room_types'));
        $query->where('id IN (SELECT room_type_id
                              FROM '.$this->_dbo->quoteName('#__sr_rooms').'
                              WHERE id = '.$this->_dbo->quote($roomId).')');

        $this->_dbo->setQuery($query);

        return $this->_dbo->loadObject();
    }
    
    /**
     * Get list coupon id belong to $roomtypeId
     *
     * @param   int $roomtypeId
     *
     * @return  array
     */
    public function getCoupon($roomtypeId)
    {
    	$query = $this->_dbo->getQuery(true);

    	$query->select('coupon_id')->from($this->_dbo->quoteName('#__sr_room_type_coupon_xref'));
    	$query->where('room_type_id = '.$this->_dbo->quote($roomtypeId));

    	$this->_dbo->setQuery($query);
        
    	return $this->_dbo->loadColumn();
    }

    /**
     * Get list extra id belong to $roomtypeId
     *
     * @param   int $roomtypeId
     *
     * @return  array
     */
    public function getExtra($roomtypeId)
    {
        $query = $this->_dbo->getQuery(true);

        $query->select('extra_id')->from($this->_dbo->quoteName('#__sr_room_type_extra_xref'));
        $query->where('room_type_id = '.$this->_dbo->quote($roomtypeId));

        $this->_dbo->setQuery($query);

        return $this->_dbo->loadColumn();
    }

	/**
	 * Get price of a room type from a list of room type's tariff that matches the conditions:
	 * 		Customer group
	 * 		Checkin && Checkout date
	 *
	 * @param   int      $reservationAssetId
	 * @param   int      $roomTypeId
	 * @param   bool     $defaultPrice
	 * @param   bool     $dateConstraint
	 * @param   string   $checkin
	 * @param   string   $checkout
	 * @param   int      $currencyId The currency id to calculate
	 * @param   array    $coupon An array of coupon information
	 *
	 * @return  array    An array of SRCurrency for Tax and Without Tax
	 */
    public function getPrice($reservationAssetId, $roomTypeId, $defaultPrice = false, $dateConstraint = false, $checkin = '', $checkout = '', $currencyId, $coupon = NULL )
    {
        JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'SolidresModel');
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables', 'SolidresTable');
		// TODO replace this manual call with autoloading later
		JLoader::register('SRCurrency', SRPATH_LIBRARY . '/currency/currency.php');

        $user = JFactory::getUser();
        $customerModel = JModelLegacy::getInstance('Customer', 'SolidresModel', array('ignore_request' => true));
        $tariffModel = JModelLegacy::getInstance('Tariff', 'SolidresModel', array('ignore_request' => true));
		$srCoupon = SRFactory::get('solidres.coupon.coupon');
        $taxesModel	= JModelLegacy::getInstance('Taxes', 'SolidresModel', array('ignore_request' => true));
		$totalBookingCost = 0;

		$taxesModel->setState('filter.reservation_asset_id', $reservationAssetId);
		$imposedTaxTypes = $taxesModel->getItems();

        if (empty($user->id )) // Non-registered/Public/Non-loggedin customer
        {
            $customerGroupId = NULL;
        }
        else
        {
            $customer = $customerModel->getItem(array('user_id' => $user->id));
            $customerGroupId = ($customer) ? $customer->customer_group_id : NULL;
        }

        $tariffModel->setState('filter.room_type_id', $roomTypeId);
        $tariffModel->setState('filter.customer_group_id', $customerGroupId);

		if ($defaultPrice)
		{
			$tariffModel->setState('filter.default_price', 1);
			// If we need to get the default price, set customer group to 'NONE'
			$tariffModel->setState('filter.customer_group_id', NULL);
		}

		$bookWeekDays = $this->calculateWeekDay($checkin, $checkout);

		if ($dateConstraint)
		{
			$tariffModel->setState('filter.date_constraint', 1);
		}

		$isCouponApplicable = false;
		if (isset($coupon) && is_array($coupon))
		{
			$isCouponApplicable = $srCoupon->isApplicable($coupon['coupon_id'], $roomTypeId);
		}

		$nightCount = 1;
		$tariffBreakDown = array();
		foreach ($bookWeekDays as $bookWeekDay)
		{
			$theDay = new DateTime($bookWeekDay);
			$dayInfo = getdate($theDay->format('U'));
			// We calculate per nights, not per day, for example 2011-08-24 to 2012-08-29 is 6 days but only 5 nights
			if ($nightCount < count($bookWeekDays))
			{
				if ($dateConstraint)
				{
					// Reset these state because we may override it in other steps
					$tariffModel->setState('filter.date_constraint', 1);
					$tariffModel->setState('filter.default_price', NULL);
					$tariffModel->setState('filter.customer_group_id', $customerGroupId);
					$tariffModel->setState('filter.bookday',  JFactory::getDate($bookWeekDay)->toSql());
				}

				$bookWeekDayTariffs = $tariffModel->getItems();

				// Advanced / Complex Tariff : each price for each week day
				if (count($bookWeekDayTariffs) > 1)
				{
					$single = false;
				}
				else if (count($bookWeekDayTariffs) == 1) // Simple / Advanced / Complex Tariff : single price for all week
				{
					$single = true;
				}
				else if (count($bookWeekDayTariffs) == 0) // Have no tariff, fall back to default tariff (Simple tariff)
				{
					$tariffModel->setState('filter.date_constraint', NULL);
					$tariffModel->setState('filter.default_price', 1);
					// If we need to get the default price, set customer group to 'NONE'
					$tariffModel->setState('filter.customer_group_id', NULL);
					$bookWeekDayTariffs = $tariffModel->getItems();
					// Advanced / Complex Tariff : each price for each week day
					if (count($bookWeekDayTariffs) > 1)
					{
						$single = false;
					}
					else if (count($bookWeekDayTariffs) == 1) // Simple / Advanced / Complex Tariff : single price for all week
					{
						$single = true;
					}
				}

				// Deal with Coupon
				if ($isCouponApplicable)
				{
					$result = $this->calculateCostPerDay($bookWeekDayTariffs, $dayInfo, $single, $coupon);
				}
				else
				{
					$result = $this->calculateCostPerDay($bookWeekDayTariffs, $dayInfo, $single, NULL);
				}

				$totalBookingCost += $result['total_booking_cost'];
				$tariffBreakDown += $result['tariff_break_down'];
			}
			$nightCount ++;
		}



		if ($totalBookingCost > 0)
		{
			// Calculate the imposed tax amount
			$totalImposedTaxAmount = 0;
			foreach ($imposedTaxTypes as $taxType)
			{
				$totalImposedTaxAmount += $totalBookingCost * $taxType->rate;
			}

			$totalBookingCostTaxed = $totalBookingCost + $totalImposedTaxAmount;

			// Format the number with correct currency
			$totalBookingCostExcludedTaxedFormatted = new SRCurrency($totalBookingCost, $currencyId);

			// Format the number with correct currency
			$totalBookingCostIncludedTaxFormatted = new SRCurrency($totalBookingCostTaxed, $currencyId);

			// Format tariff break down
			$tariffBreakDownFormatted = array();
			foreach ($tariffBreakDown as $day => $priceOfDay)
			{
				$tariffBreakDownFormatted[$day] = new SRCurrency($priceOfDay, $currencyId);
			}

			$response = array(
				'total_price_formatted' => $totalBookingCostIncludedTaxFormatted,
				'total_price_tax_incl_formatted' => $totalBookingCostIncludedTaxFormatted,
				'total_price_tax_excl_formatted' => $totalBookingCostExcludedTaxedFormatted,
				'total_price' => $totalBookingCostTaxed,
				'total_price_tax_incl' => $totalBookingCostTaxed,
				'total_price_tax_excl' => $totalBookingCost,
				'tariff_break_down' => $tariffBreakDownFormatted,
				'is_applied_coupon' => $result['is_applied_coupon']
			);

			return $response;
		}
		else
		{
			return NULL;
		}
    }

	/**
	 * Get an array of week days in the period between $from and $to
	 *
	 * @param    string   From date
	 * @param    string   To date
	 *
	 * @return   array	  An array in format array(0 => 'Y-m-d', 1 => 'Y-m-d')
	 */
	private function calculateWeekDay($from, $to)
	{
		$datetime1 	= new DateTime($from);
		$interval 	= $this->calculateDateDiff($from, $to);
		$weekDays 	= array();

		$weekDays[] = $datetime1->format('Y-m-d');

		for ($i = 1; $i <= (int)$interval; $i++)
		{
			$weekDays[] = $datetime1->modify('+1 day')->format('Y-m-d');
		}

		return $weekDays;
	}

	/**
	 * Calculate the number of day from a given range
	 *
	 * Note: DateTime is PHP 5.3 only
	 *
	 * @param  string  $from   Begin of date range
	 * @param  string  $to     End of date range
	 * @param  string  $format The format indicator
	 *
	 * @return string
	 */
	public function calculateDateDiff($from, $to, $format = '%a')
	{
		$datetime1 = new DateTime($from);
		$datetime2 = new DateTime($to);

		$interval = $datetime1->diff($datetime2);

		return $interval->format($format);
	}

	/**
	 * Calculate booking cost per day and apply the coupon if possible
	 *
	 * @param   array   $bookWeekDayTariffs   An array of tariffs for searching
	 * @param   array   $dayInfo			  The date that we need to find tariff for it from above $bookWeekDayTariffs
	 * @param   bool    $single				  True: sing price for all weeks
	 * @param   array   $coupon 			  An array of coupon information
	 *
	 * @return  array
	 */
	private function calculateCostPerDay($bookWeekDayTariffs, $dayInfo, $single = true, $coupon = NULL)
	{
		$totalBookingCost = 0;
		$tariffBreakDown = array();
		$costPerDay = 0;
		$isAppliedCoupon = false;

		for ($i = 0, $count = count($bookWeekDayTariffs); $i < $count; $i ++)
		{
			if (!$single)
			{
				if ($bookWeekDayTariffs[$i]->w_day == $dayInfo['wday'])
				{
					$costPerDay = $bookWeekDayTariffs[$i]->price;
				}
			}
			else
			{
				if ($bookWeekDayTariffs[0]->w_day == 7)
				{
					$costPerDay = $bookWeekDayTariffs[$i]->price;
				}
			}
		}

		if (isset($coupon) && is_array($coupon))
		{
			if ($coupon['coupon_is_percent'] == 1)
			{
				$deductionAmount = $costPerDay * ( $coupon['coupon_amount'] / 100 );
			}
			else
			{
				$deductionAmount = $coupon['coupon_amount'];
			}
			$costPerDay -= $deductionAmount;
			$isAppliedCoupon = true;
		}

		$totalBookingCost += $costPerDay;
		$tariffBreakDown[$dayInfo['wday']] = $costPerDay;

		return array(
			'total_booking_cost' => $totalBookingCost,
			'tariff_break_down' => $tariffBreakDown,
			'is_applied_coupon' => $isAppliedCoupon
		);
	}
}