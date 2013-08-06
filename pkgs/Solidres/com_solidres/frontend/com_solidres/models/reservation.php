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

/**
 * Solidres Component Model
 *
 * @package		Reservation
 * @since		0.1.0
 */
class SolidresModelReservation extends JModelLegacy
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

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->event_after_delete 	= 'onReservationAfterDelete';
		$this->event_after_save 	= 'onReservationAfterSave';
		$this->event_before_delete 	= 'onReservationBeforeDelete';
		$this->event_before_save 	= 'onReservationBeforeSave';
		$this->event_change_state 	= 'onReservationChangeState';
		$this->text_prefix 			= strtoupper($this->option);

		$this->context = 'com_solidres.reservation.process';
	}

	/**
	 * Get data to display check out form
	 *
	 * @return object
	 */
	public function getItem()
	{
		$app = JFactory::getApplication();
		$reservationAssetModel = JModelLegacy::getInstance('ReservationAsset', 'SolidresModel', array('ignore_request' => true));
		$currencyModel = JModelLegacy::getInstance('Currency', 'SolidresModel', array('ignore_request' => true));
		// TODO replace this manual call with autoloading later
		JLoader::register('SRCurrency', SRPATH_LIBRARY . '/currency/currency.php');

		$modelName = $this->getName();
		$reservationAssetId = $this->getState($modelName.'.reservationAssetId');
		$reservationAsset = $reservationAssetModel->getItem($reservationAssetId);
		$currency = $currencyModel->getItem($reservationAsset->currency_id);

		$app->setUserState($this->context . '.countryId', $reservationAsset->country_id);
		$app->setUserState($this->context . '.currency_id', $currency->id);

		$reservation = new stdClass();
		$reservation->room_types = $this->getRoomType();
		$reservation->extras = $this->getExtra();

		$cost = $app->getUserState($this->context.'.cost');
		$currency = new SRCurrency($cost['total_price_tax_excl'], $currency->id);
		$reservation->total_price_tax_excl_formatted = $currency->format();

		return $reservation;
	}

	/**
	 * Get room type information to be display in the reservation confirmation screen
	 *
	 * @return array $ret An array contain room type information
	 */
	public function getRoomType()
	{
		// Construct a simple array of room type ID and its price
		$roomTypePricesMapping = array();

		$app = JFactory::getApplication();
        $srRoomType = SRFactory::get('solidres.roomtype.roomtype');
		$currencyId = $app->getUserState($this->context . '.currency_id');

		$modelName = $this->getName();
		$roomTypes = $this->getState($modelName .'.roomTypes');
		$checkin = $this->getState($modelName .'.checkin');
		$checkout = $this->getState($modelName .'.checkout');
		$reservationAssetId = $this->getState($modelName.'.reservationAssetId');
		$coupon = $app->getUserState($this->context . '.coupon');

        $roomtypeModel = JModelLegacy::getInstance('RoomType', 'SolidresModel', array('ignore_request' => true));
        $extraModel = JModelLegacy::getInstance('Extra', 'SolidresModel', array('ignore_request' => true));

		$totalPriceTaxIncl = 0;
		$totalPriceTaxExcl = 0;

		$totalReservedRoom = 0;
		$ret = array();

        // Get a list of room type based on search conditions
		foreach ($roomTypes as $roomTypeId => $bookedRoomTypeQuantity )
		{
            if ($bookedRoomTypeQuantity == 0)
			{
				continue;
			}
			$r = $roomtypeModel->getItem(array(
                'id' => $roomTypeId,
                'reservation_asset_id' => $reservationAssetId
            ));

			$ret[$roomTypeId]['name'] = $r->name;
			$ret[$roomTypeId]['description'] = $r->description;
			$ret[$roomTypeId]['occupancy_adult'] = $r->occupancy_adult;
			$ret[$roomTypeId]['occupancy_child'] = $r->occupancy_child;

            $currency['default'] = $srRoomType->getPrice($reservationAssetId, $roomTypeId, true, false, $checkin, $checkout, $currencyId, $coupon);
			$currency['custom']  = $srRoomType->getPrice($reservationAssetId, $roomTypeId, false, true, $checkin, $checkout, $currencyId, $coupon);

            if (!empty($currency['custom'])) // if custom tariff available, use it
            {
                $ret[$roomTypeId]['currency'] 	= $currency['custom'];
            }
			else // and use default tariff instead
			{
				$ret[$roomTypeId]['currency'] 	= $currency['default'];
			}

			$totalPriceTaxIncl += $ret[$roomTypeId]['currency']['total_price_tax_incl'] *  $bookedRoomTypeQuantity;
			$totalPriceTaxExcl += $ret[$roomTypeId]['currency']['total_price_tax_excl'] *  $bookedRoomTypeQuantity;

            // Prepare extra data for each room
            $roomTypeExtraIds = $srRoomType->getExtra($roomTypeId);
            if (is_array($roomTypeExtraIds))
            {
                foreach ($roomTypeExtraIds as $roomTypeExtraId)
                {
                    $ret[$roomTypeId]['extras'][$roomTypeExtraId] = $extraModel->getItem($roomTypeExtraId);
                }
            }

			// Calculate number of available rooms
			$ret[$roomTypeId]['totalAvailableRoom'] = count( $srRoomType->getListAvailableRoom($roomTypeId, $checkin, $checkout) );
			$ret[$roomTypeId]['quantity'] = $bookedRoomTypeQuantity;

			$roomTypePricesMapping[$roomTypeId] = array(
				'total_price' => $ret[$roomTypeId]['currency']['total_price'],
				'total_price_tax_incl' => $ret[$roomTypeId]['currency']['total_price_tax_incl'],
				'total_price_tax_excl' => $ret[$roomTypeId]['currency']['total_price_tax_excl']
			);

			// Only allow quantity within quota
			if ($bookedRoomTypeQuantity <= $ret[$roomTypeId]['totalAvailableRoom'])
			{
				$totalReservedRoom += $bookedRoomTypeQuantity;
			}
			else
			{
				return false;
			}
		} // end room type loop

		$this->setState($modelName .'.totalReservedRoom', $totalReservedRoom);
		$app->setUserState($this->context . '.cost',
			array(
				'total_price' => $totalPriceTaxIncl,
				'total_price_tax_incl' => $totalPriceTaxIncl,
				'total_price_tax_excl' => $totalPriceTaxExcl
			)
		);

		$app->setUserState($this->context . '.room_type_prices_mapping', $roomTypePricesMapping);

		return $ret;
	}
	
	/**
	 * Get a list of extras of a Reservation Asset
	 *
	 * @return array
	 */
	public function getExtra()
	{
		$model = JModelLegacy::getInstance('Extras', 'SolidresModel', array('ignore_request' => true));
		$model->setState('list.start', 0);
		$model->setState('list.limit', 0);
		$model->setState('filter.state', 1);
		$model->setState('filter.reservation_asset_id', $this->getName().'.reservationAssetId');
		$model->setState('list.ordering', 'a.name');

		return $model->getItems();
	}

	/**
     * Save the reservation data
     *
     * @param $data
     * 
     * @return bool
     */
    public function save($data)
	{
		$dispatcher = JDispatcher::getInstance();
		$table		= $this->getTable();
		$pk			= (!empty($data['id'])) ? $data['id'] : (int)$this->getState($this->getName().'.id');
		$isNew		= true;
		$app = JFactory::getApplication();
		$roomTypePricesMapping = $app->getUserState($this->context.'.room_type_prices_mapping', NULL);

		// Include the content plugins for the on save events.
		JPluginHelper::importPlugin('extension');

		// Load the row if saving an existing record.
		if ($pk > 0)
        {
			$table->load($pk);
			$isNew = false;
		}

		// Bind the data.
		if (!$table->bind($data))
        {
			$this->setError($table->getError());
			return false;
		}

		// Prepare the row for saving
		//$this->prepareTable($table);

		// Check the data.
		if (!$table->check())
        {
			$this->setError($table->getError());
			return false;
		}

		// Trigger the onContentBeforeSave event.
		$result = $dispatcher->trigger($this->event_before_save, array($data, $table, $isNew, $this));
		if (in_array(false, $result, true))
        {
			return false;
		}

		// Store the data.
		if (!$table->store())
        {
			$this->setError($table->getError());
			return false;
		}

		// Clean the cache.
		$cache = JFactory::getCache($this->option);
		$cache->clean();

		// Trigger the onContentAfterSave event.
		$this->setState($this->getName().'.room_type_prices_mapping', $roomTypePricesMapping);
		$result = $dispatcher->trigger($this->event_after_save, array($data, $table, $isNew, $this));
		if (in_array(false, $result, true))
        {
			return false;
		}

		$pkName = $table->getKeyName();
		if (isset($table->$pkName))
        {
			$this->setState($this->getName().'.id', $table->$pkName);
		}
		$this->setState($this->getName().'.new', $isNew);

		return true;
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
}