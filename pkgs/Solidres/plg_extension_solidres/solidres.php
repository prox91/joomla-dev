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

JLoader::import('joomla.application.component.model');
JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'SolidresModel');

/**
 * Solidres Extension Plugin
 *
 * @package		Solidres
 * @subpackage	Extension.Plugin
 * @since		1.5
 */
class plgExtensionSolidres extends JPlugin
{
    /**
     * Allow to processing of Reservation data after it is saved.
     *
     * @param object    $data
     * @param object    $table
     * @param boolean   $isNew
     * @param object    $model
     *
     * @since    1.6
     */
	function onReservationAfterSave($data, $table, $isNew, $model)
	{
        $dbo 			= JFactory::getDbo();
		$srReservation 	= SRFactory::get('solidres.reservation.reservation');
		$srRoomType 	= SRFactory::get('solidres.roomtype.roomtype');
		$query          = $dbo->getQuery(true);
        $reservationId 	= $table->id;
		$roomTypePricesMapping = $model->getState($model->getName().'.room_type_prices_mapping', NULL);

		$query->clear();
		$query->delete()->from($dbo->quoteName('#__sr_reservation_room_xref'))->where('reservation_id = '.$reservationId);
		$dbo->setQuery($query);
		$dbo->execute();

		// Insert new records
		foreach($data['room_types'] as $room)
        {
			// Find a list of available rooms
			$availableRoomList = $srRoomType->getListAvailableRoom($room['room_type_id'], $data['checkin'], $data['checkout']);

			// Pick the first and assign it
			$pickedRoom = array_shift($availableRoomList);

			$room['room_id'] = $pickedRoom->id;
			$room['room_label'] = $pickedRoom->label;
			$room['room_price'] = $roomTypePricesMapping[$room['room_type_id']]['total_price_tax_excl'];

			$srReservation->storeRoom($reservationId, $room);

            // Insert new records
			if (isset($room['extra']))
			{
				foreach ($room['extra'] as $extras)
				{
					foreach ($extras as $k => $v)
					{
						if (isset($v['quantity']))
						{
							$srReservation->storeExtra($reservationId, $room['room_id'], $room['room_label'], $k, $v['name'], $v['quantity'], $v['price']);
						}
						else
						{
							$srReservation->storeExtra($reservationId, $room['room_id'], $room['room_label'], $k, $v['name'], NULL, $v['price']);
						}
					}
				}
			}
        }
	}

	/*function onReservationAssetBeforeSave($data, $table, $isNew) {}*/

	/**
	 * Allow to processing of ReservationAsset data after it is saved.
	 *
	 * @param    object    $data The data representing the ReservationAsset.
	 * @param    object    $table
	 * @param    boolean   $result
	 * @param    boolean   $isNew True is this is new data, false if it is existing data.
	 *
	 * @throws Exception
	 * @return    boolean
	 * @since    1.6
	 */
	function onReservationAssetAfterSave($data, $table, $result, $isNew)
	{
		$dbo = JFactory::getDbo();
		$query = $dbo->getQuery(true);
		$media = SRFactory::get('solidres.media.media');

		$media->store($data, $table, 0);

        // Process extra fields
        if ($table->id && $result && isset($data['reservationasset_extra_fields']) && (count($data['reservationasset_extra_fields']))) {
			try {

                $query->clear();
                $query->delete()->from($dbo->quoteName('#__sr_reservation_asset_fields'));
                $query->where('reservation_asset_id = '.$table->id);
                $query->where("field_key LIKE 'reservationasset_extra_fields.%'");
				$dbo->setQuery($query);

				if (!$dbo->execute()) {
					throw new Exception($dbo->getErrorMsg());
				}

				$tuples = array();
				$order	= 1;

				foreach ($data['reservationasset_extra_fields'] as $k => $v)
				{
					$tuples[] = '('.$table->id.', '.$dbo->quote('reservationasset_extra_fields.'.$k).', '.$dbo->quote($v).', '.$order++.')';
				}

				$dbo->setQuery('INSERT INTO '.$dbo->quoteName('#__sr_reservation_asset_fields').' VALUES '.implode(', ', $tuples));

				if (!$dbo->execute()) {
					throw new Exception($dbo->getErrorMsg());
				}

			} catch (JException $e) {
				$this->_subject->setError($e->getMessage());
				return false;
			}
		}
        // end of extra field processing
	}

	/**
	 * Allow to processing of unit data after it is saved.
	 *
	 * @param    object    $data The data representing the unit.
	 * @param    object    $table
	 * @param    boolean   $isNew True is this is new data, false if it is existing data.
	 *
	 * @throws Exception
	 * @return  void
	 * @since    1.6
	 */
	function onRoomTypeAfterSave($data, $table, $isNew)
	{
		$dbo 		= JFactory::getDbo();
		$query 		= $dbo->getQuery(true);
        $srRoomType = SRFactory::get('solidres.roomtype.roomtype');
		$nullDate   = $dbo->getNullDate();
		$media = SRFactory::get('solidres.media.media');

		$media->store($data, $table, 1);

		// ==  Processing tariff/prices == //
		// Delete all existing tariffs first
		$query->clear();
		$query->delete('')->from($dbo->quoteName('#__sr_prices'))->where('room_type_id = '.$dbo->quote($table->id));
		$dbo->setQuery($query);
		$result = $dbo->execute();
		if(!$result)
		{
			JError::raiseWarning(-1, 'plgExtensionSolidres::onRoomTypeAfterSave: Delete from '.$dbo->quoteName('#__sr_prices').' '. ($result ? 'success' : 'failure'));
		}

		$dayMapping = array('sun' => 0, 'mon' => 1, 'tue' => 2, 'wed' => 3, 'thu' => '4', 'fri' => 5, 'sat' => 6);

		// Store the default tariff
		if(isset($data['price']))
		{
			if (is_array($data['price'])) // Store price for separated day of week
			{
				foreach ($data['price'] as $day => $priceOfDay)
				{
					$tariffData = array(
						'roomTypeId' 		=> $table->id,
						'currencyId' 		=> !empty($data['currency_id']) ? $data['currency_id'] : 1 , // if no default currency found, load USD
						'customerGroupId' 	=> NULL,
						'price' 			=> $priceOfDay,
						'validFrom' 		=> $nullDate,
						'validTo' 			=> $nullDate,
						'title' 			=> '',
						'description' 		=> '',
						'd_min'				=> 0,
						'd_max'				=> 0,
						'p_min'				=> 0,
						'p_max'				=> 0,
						'w_day'				=> $dayMapping[$day]
					);
					$srRoomType->storeTariff($tariffData);
				}
			}
			else
			{
				$tariffData = array(
					'roomTypeId' 		=> $table->id,
					'currencyId' 		=> !empty($data['currency_id']) ? $data['currency_id'] : 1 , // if no default currency found, load USD
					'customerGroupId' 	=> NULL,
					'price' 			=> $data['price'],
					'validFrom' 		=> $nullDate,
					'validTo' 			=> $nullDate,
					'title' 			=> '',
					'description' 		=> '',
					'd_min'				=> 0,
					'd_max'				=> 0,
					'p_min'				=> 0,
					'p_max'				=> 0,
					'w_day'				=> 7
				);
				$srRoomType->storeTariff($tariffData);
			}

		}

		// Store customized tariff
		if(isset($data['tariff']) && count($data['tariff']))
		{
			foreach($data['tariff'] as $value)
			{
                if (isset($value['price']))
				{
					if (is_array($value['price'])) // Storing price for each day
					{
						foreach ($value['price'] as $day => $priceOfDay)
						{
							$tariffData = array(
								'roomTypeId' 		=> $table->id,
								'currencyId' 		=> !empty($data['currency_id']) ? $data['currency_id'] : 1 , // if no default currency found, load USD
								'customerGroupId' 	=> !empty($value['customer_group_id']) ? $value['customer_group_id'] : NULL, // empty customer_group_id value means it is for General Customer Group
								'price' 			=> $priceOfDay,
								'validFrom' 		=> $value['valid_from'],
								'validTo' 			=> $value['valid_to'],
								'title' 			=> $value['title'],
								'description' 		=> $value['description'],
								'd_min'				=> 0,
								'd_max'				=> 0,
								'p_min'				=> 0,
								'p_max'				=> 0,
								'w_day'				=> $dayMapping[$day]
							);
							$srRoomType->storeTariff($tariffData);
						}
					}
					else
					{
						if(!empty($value['price']))
						{
							$tariffData = array(
								'roomTypeId' 		=> $table->id,
								'currencyId' 		=> !empty($data['currency_id']) ? $data['currency_id'] : 1 , // if no default currency found, load USD
								'customerGroupId' 	=> !empty($value['customer_group_id']) ? $value['customer_group_id'] : NULL, // empty customer_group_id value means it is for General Customer Group
								'price' 			=> $value['price'],
								'validFrom' 		=> $value['valid_from'],
								'validTo' 			=> $value['valid_to'],
								'title' 			=> $value['title'],
								'description' 		=> $value['description'],
								'd_min'				=> 0,
								'd_max'				=> 0,
								'p_min'				=> 0,
								'p_max'				=> 0,
								'w_day'				=> 7 // All day of week
							);
							$srRoomType->storeTariff($tariffData);
						}
					}
				}
			}
		}
		// ==  Processing tariff/prices == //

		$query->clear();
		$query->delete('')->from($dbo->quoteName('#__sr_room_type_coupon_xref'))->where('room_type_id = '.$dbo->quote($table->id));
		$dbo->setQuery($query);
		$result = $dbo->execute();
		if(!$result)
		{
			JError::raiseWarning(-1, 'plgExtensionSolidres::onRoomTypeAfterSave: Delete from '.$dbo->quoteName('#__sr_room_type_coupon_xref').' '. ($result ? 'success' : 'failure'));
		}

		if(isset($data['coupon_id']) && count($data['coupon_id']))
		{
			foreach ($data['coupon_id'] as $value)
			{
				$srRoomType->storeCoupon($table->id, $value);
			}
		}

        $query->clear();
        $query->delete('')->from($dbo->quoteName('#__sr_room_type_extra_xref'))->where('room_type_id = '.$dbo->quote($table->id));
        $dbo->setQuery($query);
        $result = $dbo->execute();
        if(!$result)
        {
            JError::raiseWarning(-1, 'plgExtensionSolidres::onRoomTypeAfterSave: Delete from '.$dbo->quoteName('#__sr_room_type_extra_xref').' '. ($result ? 'success' : 'failure'));
        }

        if(isset($data['extra_id']) && count($data['extra_id']))
        {
            foreach ($data['extra_id'] as $value)
            {
                $srRoomType->storeExtra($table->id, $value);
            }
        }
		
		if(isset($data['rooms']) && count($data['rooms'])) {
			foreach($data['rooms'] as $value) {
				if($value['id'] == 'new' && !empty($value['label']) ) {
	                $srRoomType->storeRoom($table->id, $value['label']);
				}
			}
		}

		// Process extra fields
		if ($table->id && $result && isset($data['roomtype_custom_fields']) && (count($data['roomtype_custom_fields']))) {
			try {

				$query->clear();
				$query->delete()->from($dbo->quoteName('#__sr_room_type_fields'));
				$query->where('room_type_id = '.$table->id);
				$query->where("field_key LIKE 'roomtype_custom_fields.%'");
				$dbo->setQuery($query);

				if (!$dbo->execute()) {
					throw new Exception($dbo->getErrorMsg());
				}

				$tuples = array();
				$order	= 1;

				foreach ($data['roomtype_custom_fields'] as $k => $v)
				{
					$tuples[] = '('.$table->id.', '.$dbo->quote('roomtype_custom_fields.'.$k).', '.$dbo->quote($v).', '.$order++.')';
				}

				$dbo->setQuery('INSERT INTO '.$dbo->quoteName('#__sr_room_type_fields').' VALUES '.implode(', ', $tuples));

				if (!$dbo->execute()) {
					throw new Exception($dbo->getErrorMsg());
				}

			} catch (JException $e) {
				$this->_subject->setError($e->getMessage());
				return false;
			}
		}
		
	}

    /**
     * Allow to processing of category data before it is saved.
     *
     * @param $data
     * @param $table
     * @param $isNew
     *
     * @return  void
     */
	function onCategoryBeforeSave($data, $table, $isNew)
	{
		$dbo 		= JFactory::getDbo();
		$srNode		= SRFactory::getNode();
		
		$dbo->setQuery('LOCK TABLES '.$dbo->quoteName('#__sr_categories').' WRITE, '.$dbo->quoteName('#__assets').' WRITE');
		if(!$dbo->execute()) {
			$e = new JException(JText::sprintf('plgExtensionSolidres::onCategoryAfterSave Lock table failed', get_class($this), $dbo->getErrorMsg()));
			$this->setError($e);
			return false;
		}

		if($isNew) {
			$srNode->saveNode($data['parent_id']);
		} else { 
			$srNode->updateNode($data);
		}
	}

    /**
     * Allow to processing of category data before it is saved.
     *
     * @param $data
     * @param $table
     * @param $isNew
     *
     * @return bool
     */
	function onCategoryAfterSave($data, $table, $isNew)
	{
		// Create a new query object.
		$context 	= 'com_solidres.edit.category';
		$dbo 		= JFactory::getDbo();
		$query 		= $dbo->getQuery(true);
		$app		= JFactory::getApplication();
		$parentLft 	= $app->getUserState($context.'.parentlft');

		if($isNew) {
			// Update the lft and rgt value for recent insert category
			$query->clear();
			$query->update($dbo->quoteName('#__sr_categories'))->set('lft = '.$parentLft.' + 1, rgt = '.$parentLft.' + 2');
			$query->where('id = '.$table->id);
            
			$dbo->setQuery($query);
			if (!$dbo->execute()) {
				$e = new JException(JText::sprintf('plgExtensionSolidres::onCategoryAfterSave Update failed', get_class($this), $dbo->getErrorMsg()));
				$this->setError($e);
				$dbo->setQuery('UNLOCK TABLES');
                
				if(!$dbo->execute()) 	{
					$e = new JException(JText::sprintf('plgExtensionSolidres::onCategoryAfterSave Unlock table failed', get_class($this), $dbo->getErrorMsg()));
					$this->setError($e);
					return false;
				}
				return false;
			}
		} else {
			$doUpdate 	= $app->getUserState($context.'.doupdate');
				
			if($doUpdate == 1) {
				$newLft 	= $app->getUserState($context.'.newlft');
				$newRgt 	= $app->getUserState($context.'.newrgt');

				$query->clear();
				$query->update($dbo->quoteName('#__sr_categories'))->set('lft = '.$newLft.', rgt = '.$newRgt)->where('id = '.$table->id);
                
				$dbo->setQuery($query);
                
				if (!$dbo->execute()) {
					$e = new JException(JText::sprintf('plgExtensionSolidres::onCategoryAfterSave Update failed', get_class($this), $dbo->getErrorMsg()));
					$this->setError($e);
					$dbo->setQuery('UNLOCK TABLES');
                    
					if(!$dbo->execute()) {
						$e = new JException(JText::sprintf('plgExtensionSolidres::onCategoryAfterSave Unlock table failed', get_class($this), $dbo->getErrorMsg()));
						$this->setError($e);
						return false;
					}
					return false;
				}
			}
		}

		$dbo->setQuery('UNLOCK TABLES');
		if(!$dbo->execute()) {
			$e = new JException(JText::sprintf('plgExtensionSolidres::onCategoryAfterSave Unlock table failed', get_class($this), $dbo->getErrorMsg()));
			$this->setError($e);
			return false;
		}

		// Do not needed anymore
		$app->setUserState($context.'.parentlft', null);
		$app->setUserState($context.'.newlft', null);
		$app->setUserState($context.'.newrgt', null);
		$app->setUserState($context.'.doupdate', null);
	}

    /**
	 * @param	JForm	$form	The form to be altered.
	 * @param	array	$data	The associated data for the form.
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	public function onReservationAssetPrepareForm($form, $data)
	{
		// Load solidres plugin language
		$lang = JFactory::getLanguage();
		$lang->load('plg_extension_solidres', JPATH_ADMINISTRATOR);

		if (!($form instanceof JForm)) {
			$this->_subject->setError('JERROR_NOT_A_FORM');
			return false;
		}

		// Check we are manipulating a valid form.
		if (!in_array($form->getName(), array('com_solidres.reservationasset'))) {
			return true;
		}

		// Add the registration fields to the form.
		JForm::addFormPath(__DIR__.'/fields');
		$form->loadFile('reservationasset', false);

		// Toggle whether the checkin time field is required.
		if ($this->params->get('param_reservation_asset_checkin_time', 1) > 0) {
			$form->setFieldAttribute('checkin_time', 'required', $this->params->get('param_reservation_asset_checkin_time') == 2, 'reservationasset_extra_fields');
		} else {
			$form->removeField('checkin_time', 'reservationasset_extra_fields');
		}
        
        // Toggle whether the checkout time field is required.
		if ($this->params->get('param_reservation_asset_checkout_time', 1) > 0) {
			$form->setFieldAttribute('checkout_time', 'required', $this->params->get('param_reservation_asset_checkout_time') == 2, 'reservationasset_extra_fields');
		} else {
			$form->removeField('checkout_time', 'reservationasset_extra_fields');
		}

        // Toggle whether the cancellation prepayment field is required.
		if ($this->params->get('param_reservation_asset_cancellation_prepayment', 1) > 0) {
			$form->setFieldAttribute('cancellation_prepayment', 'required', $this->params->get('param_reservation_asset_cancellation_prepayment') == 2, 'reservationasset_extra_fields');
		} else {
			$form->removeField('cancellation_prepayment', 'reservationasset_extra_fields');
		}

        // Toggle whether the children and extra beds field is required.
		if ($this->params->get('param_reservation_asset_children_and_extra_beds', 1) > 0) {
			$form->setFieldAttribute('children_and_extra_beds', 'required', $this->params->get('param_reservation_asset_children_and_extra_beds') == 2, 'reservationasset_extra_fields');
		} else {
			$form->removeField('children_and_extra_beds', 'reservationasset_extra_fields');
		}

        // Toggle whether the children and extra beds field is required.
		if ($this->params->get('param_reservation_asset_pets', 1) > 0) {
			$form->setFieldAttribute('pets', 'required', $this->params->get('param_reservation_asset_pets') == 2, 'reservationasset_extra_fields');
		} else {
			$form->removeField('pets', 'reservationasset_extra_fields');
		}

        // Toggle whether the facebook field is required.
		if ($this->params->get('param_reservation_asset_facebook', 1) > 0) {
			$form->setFieldAttribute('facebook', 'required', $this->params->get('param_reservation_asset_facebook') == 2, 'reservationasset_extra_fields');
		} else {
			$form->removeField('facebook', 'reservationasset_extra_fields');
		}

        // Toggle whether the twitter field is required.
		if ($this->params->get('param_reservation_asset_twitter', 1) > 0) {
			$form->setFieldAttribute('twitter', 'required', $this->params->get('param_reservation_asset_twitter') == 2, 'reservationasset_extra_fields');
		} else {
			$form->removeField('twitter', 'reservationasset_extra_fields');
		}


		return true;
	}

    /**
	 * @param	string	$context	The context for the data
	 * @param	int		$data		The user id
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	public function onReservationAssetPrepareData($context, $data)
	{
		// Check we are manipulating a valid form.
		if (!in_array($context, array('com_solidres.reservationasset'))) {
			return true;
		}

		if (is_object($data)) {
			$reservationAssetId = isset($data->id) ? $data->id : 0;

			// Load the profile data from the database.
			$db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('field_key, field_value')->from($db->quoteName('#__sr_reservation_asset_fields'));
            $query->where('reservation_asset_id = '.(int) $reservationAssetId);
            $query->where("field_key LIKE 'reservationasset_extra_fields.%'");
			$db->setQuery($query);

			try
			{
				$results = $db->loadRowList();
			}
			catch (RuntimeException $e)
			{
				$this->_subject->setError($e->getMessage());
				return false;
			}

			// Merge the profile data.
			$data->reservationasset_extra_fields = array();

			foreach ($results as $v) {
				$k = str_replace('reservationasset_extra_fields.', '', $v[0]);
				$data->reservationasset_extra_fields[$k] = $v[1];
			}
		}

		return true;
	}

	/**
	 * @param	JForm	$form	The form to be altered.
	 * @param	array	$data	The associated data for the form.
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	public function onRoomTypePrepareForm($form, $data)
	{
		// Load solidres plugin language
		$lang = JFactory::getLanguage();
		$lang->load('plg_extension_solidres', JPATH_ADMINISTRATOR);

		if (!($form instanceof JForm)) {
			$this->_subject->setError('JERROR_NOT_A_FORM');
			return false;
		}

		// Check we are manipulating a valid form.
		if (!in_array($form->getName(), array('com_solidres.roomtype'))) {
			return true;
		}

		// Add the registration fields to the form.
		JForm::addFormPath(__DIR__.'/fields');
		$form->loadFile('roomtype', false);

		// Toggle whether the checkin time field is required.
		if ($this->params->get('param_roomtype_room_facilities', 1) > 0) {
			$form->setFieldAttribute('room_facilities', 'required', $this->params->get('param_roomtype_room_facilities') == 2, 'roomtype_custom_fields');
		} else {
			$form->removeField('room_facilities', 'roomtype_custom_fields');
		}

		// Toggle whether the checkout time field is required.
		if ($this->params->get('param_roomtype_room_size', 1) > 0) {
			$form->setFieldAttribute('room_size', 'required', $this->params->get('param_roomtype_room_size') == 2, 'roomtype_custom_fields');
		} else {
			$form->removeField('room_size', 'roomtype_custom_fields');
		}

		// Toggle whether the cancellation prepayment field is required.
		if ($this->params->get('param_roomtype_bed_size', 1) > 0) {
			$form->setFieldAttribute('bed_size', 'required', $this->params->get('param_roomtype_bed_size') == 2, 'roomtype_custom_fields');
		} else {
			$form->removeField('bed_size', 'roomtype_custom_fields');
		}

		return true;
	}

	/**
	 * @param	string	$context	The context for the data
	 * @param	int		$data		The user id
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	public function onRoomTypePrepareData($context, $data)
	{
		// Check we are manipulating a valid form.
		if (!in_array($context, array('com_solidres.roomtype')))
		{
			return true;
		}

		if (is_object($data))
		{
			$roomTypeId = isset($data->id) ? $data->id : 0;

			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('field_key, field_value')->from($db->quoteName('#__sr_room_type_fields'));
			$query->where('room_type_id = '.(int) $roomTypeId);
			$query->where("field_key LIKE 'roomtype_custom_fields.%'");
			$db->setQuery($query);

			try
			{
				$results = $db->loadRowList();
			}
			catch (RuntimeException $e)
			{
				$this->_subject->setError($e->getMessage());
				return false;
			}

			// Merge the profile data.
			$data->roomtype_custom_fields = array();

			foreach ($results as $v)
			{
				$k = str_replace('roomtype_custom_fields.', '', $v[0]);
				$data->roomtype_custom_fields[$k] = $v[1];
			}
		}

		return true;
	}

	/**
	 * Create a new Joomla user before we create a new Solidres's customer
	 *
	 * TODO: save new user using joomla user model to be above to run some plugin event for User
	 *
	 * @param $data
	 * @param $table
	 * @param $isNew
	 * @param $response
	 *
	 * @return bool
	 */
	public function onCustomerBeforeSave($data, $table, $isNew, &$response)
    {
        jimport('solidres.user.user');
        // Rebuild user data
        $userData = array(
            'id'        => $data['user_id'],
            'name'      => $data['firstname'] .' '. $data['middlename'] .' '. $data['lastname'] ,
            'username'  => $data['username'],
            'password'  => $data['password'],
            'password2' => $data['password2'],
            'email'     => $data['email'],
            'groups'    => array('2') // Hard coded joomla user group id here, 2 = Registered group
        );

        $pk	    = (!empty($userData['id'])) ? $userData['id'] : 0;
        $srUser = SRUser::getInstance($pk);

		if (!$srUser->bind($userData))
		{
			$table->setError($srUser->getError());
			return false;
		}
		$result = $srUser->save();
		if (!$result)
		{
			$table->setError($srUser->getError());
			return false;
		}

		// Assign the recent insert joomla user id
		$response = $srUser->id;

        return true;
    }
}
