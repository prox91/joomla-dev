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
 * Reservation Asset model.
 *
 * @package     Solidres
 * @subpackage	ReservationAsset
 * @since		0.1.0
 */
class SolidresModelReservationAsset extends JModelAdmin
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
	 * @param	array An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->event_after_delete 	= 'onReservationAssetAfterDelete';
		$this->event_after_save 	= 'onReservationAssetAfterSave';
		$this->event_before_delete 	= 'onReservationAssetBeforeDelete';
		$this->event_before_save 	= 'onReservationAssetBeforeSave';
		$this->event_change_state 	= 'onReservationAssetChangeState';
		$this->text_prefix 			= strtoupper($this->option);
	}

	protected function populateState()
	{
		$app = JFactory::getApplication('site');

		// Load state from the request.
		$pk = $app->input->getInt('id');
		$this->setState('reservationasset.id', $pk);
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	A record object.
	 * @return	boolean	True if allowed to delete the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canDelete($record)
	{
		$user = JFactory::getUser();
		
		return $user->authorise('core.delete', 'com_solidres.reservationasset.'.(int) $record->id);
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	A record object.
	 * @return	boolean	True if allowed to change the state of the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		return $user->authorise('core.edit.state', 'com_solidres.reservationasset.'.(int) $record->id);
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	string	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'ReservationAsset', $prefix = 'SolidresTable', $config = array())
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
		$form = $this->loadForm('com_solidres.reservationasset',
                                'reservationasset',
                                array('control' => 'jform', 'load_data' => $loadData));
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
		$data = JFactory::getApplication()->getUserState('com_solidres.edit.reservationasset.data', array());

		if (empty($data))
        {
			$data = $this->getItem();
		}

        // Get the dispatcher and load the users plugins.
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('solidres');

        // Trigger the data preparation event.
		$results = $dispatcher->trigger('onReservationAssetPrepareData', array('com_solidres.reservationasset', $data));

        // Check for errors encountered while preparing the data.
		if (count($results) && in_array(false, $results, true))
        {
			$this->setError($dispatcher->getError());
		}

		return $data;
	}

	/**
	 * Method to allow derived classes to preprocess the form.
	 *
	 * @param   JForm   $form   A JForm object.
	 * @param   mixed   $data   The data expected for the form.
	 * @param   string  $group  The name of the plugin group to import (defaults to "content").
	 *
	 * @return  void
	 *
	 * @see     JFormField
	 * @since   12.2
	 * @throws  Exception if there is an error in the form event.
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'extension')
	{
		// Import the appropriate plugin group.
		JPluginHelper::importPlugin($group);
		// Import the solidres plugin group. TODO: consolidate these plugin groups
		JPluginHelper::importPlugin('solidres');

		// Get the dispatcher.
		$dispatcher = JEventDispatcher::getInstance();

		// Trigger the form preparation event.
		$results = $dispatcher->trigger('onReservationAssetPrepareForm', array($form, $data));

		// Check for errors encountered while preparing the form.
		if (count($results) && in_array(false, $results, true))
		{
			// Get the last error.
			$error = $dispatcher->getError();

			if (!($error instanceof Exception))
			{
				throw new Exception($error);
			}
		}
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	int	$pk The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * 
	 * @since	0.1.0
	 */
	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('reservationasset.id');

		$item = parent::getItem($pk);
		$dispatcher	= JDispatcher::getInstance();

		if ($item->id)
		{
			// Convert the params field to an array.
			$registry = new JRegistry;
			$registry->loadString($item->metadata, 'JSON');
			$item->metadata = $registry->toArray();

			// Get the dispatcher and load the extension plugins.
			JPluginHelper::importPlugin('extension');
			// Import the solidres plugin group. TODO: consolidate these plugin groups
			JPluginHelper::importPlugin('solidres');

			$roomtypesModel = JModelLegacy::getInstance('RoomTypes', 'SolidresModel', array('ignore_request' => true));
			$extrasModel = JModelLegacy::getInstance('Extras', 'SolidresModel', array('ignore_request' => true));
			$customerModel = JModelLegacy::getInstance('Customer', 'SolidresModel', array('ignore_request' => true));
			$mediaListModel = JModelLegacy::getInstance('MediaList', 'SolidresModel', array('ignore_request' => true));

			$roomtypesModel->setState('filter.reservation_asset_id', $item->id);
			$roomtypesModel->setState('filter.state', '1');
			$item->roomTypes = $roomtypesModel->getItems();

			$extrasModel->setState('filter.reservation_asset_id', $item->id);
			$item->extras = $extrasModel->getItems();

			$partner = $customerModel->getItem($item->partner_id);
			$item->partnerName	= $partner->firstname ." " . $partner->middlename . " " . $partner->lastname;

			$mediaListModel->setState('filter.reservation_asset_id', $item->id);
			$mediaListModel->setState('filter.room_type_id', NULL);
			$item->media = $mediaListModel->getItems();

			//  ** For front end tasks ** //
			$srRoomType = SRFactory::get('solidres.roomtype.roomtype');

			$checkin = $this->getState('checkin');
			$checkout = $this->getState('checkout');

			if (!empty($checkin) && !empty($checkout))
			{
				$app = JFactory::getApplication();
				$context = 'com_solidres.reservation.process';
				$coupon  = $app->getUserState($context.'.coupon');

				for ($i = 0, $n = count($item->roomTypes); $i < $n; $i++)
				{
					$mediaListModel->setState('filter.reservation_asset_id', NULL);
					$mediaListModel->setState('filter.room_type_id', $item->roomTypes[$i]->id);
					$item->roomTypes[$i]->media = $mediaListModel->getItems();

					// Get the default tariff
					$defaultTariff = $srRoomType->getPrice($pk, $item->roomTypes[$i]->id, true, false, $checkin, $checkout, $item->currency_id, $coupon);
					$item->roomTypes[$i]->defaultTariff = $defaultTariff['total_price_tax_excl_formatted'];
					$item->roomTypes[$i]->defaultTariffIsAppliedCoupon = $defaultTariff['is_applied_coupon'];

					// Get complex tariff
					$complexTariff = $srRoomType->getPrice($pk, $item->roomTypes[$i]->id, false, true, $checkin, $checkout, $item->currency_id, $coupon);
					$item->roomTypes[$i]->complexTariff = $complexTariff['total_price_tax_excl_formatted'];
					$item->roomTypes[$i]->complexTariffIsAppliedCoupon = $complexTariff['is_applied_coupon'];

					$item->roomTypes[$i]->totalAvailableRoom = is_array($srRoomType->getListAvailableRoom($item->roomTypes[$i]->id, $checkin, $checkout))
																? count($srRoomType->getListAvailableRoom($item->roomTypes[$i]->id, $checkin, $checkout))
																: 0 ;
					$item->roomTypes[$i]->tariffBreakDown = $complexTariff['tariff_break_down'];

					// Get custom fields
					$results = $dispatcher->trigger('onRoomTypePrepareData', array('com_solidres.roomtype', $item->roomTypes[$i]));

					if (count($results) && in_array(false, $results, true)) {
						$this->setError($dispatcher->getError());
						$item->roomTypes[$i] = false;
					}
				}
			}
		}

        // Trigger the data preparation event.
        $results = $dispatcher->trigger('onReservationAssetPrepareData', array('com_solidres.reservationasset', $item));

		if (count($results) && in_array(false, $results, true)) {
			$this->setError($dispatcher->getError());
			$item = false;
		}

		return $item;
	}
	
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');

		$table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
		$table->alias = JApplication::stringURLSafe($table->alias);

		if (empty ($table->alias))
        {
			$table->alias = JApplication::stringURLSafe($table->name);
		}

        if (empty ($table->geo_state_id))
        {
            $table->geo_state_id = NULL;
        }

		if (empty ($table->partner_id))
		{
			$table->partner_id = NULL;
		}

		if (empty ($table->category_id))
		{
			$table->category_id = NULL;
		}

		if (empty($table->id))
        {
			// Set ordering to the last item if not set
			if (empty($table->ordering))
            {
				$db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $query->clear();
                $query->select('MAX(ordering)')->from( $db->quoteName('#__sr_reservation_assets'));
				$db->setQuery($query);
				$max = $db->loadResult();

				$table->ordering = $max+1;
			}
		}
	}

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param	object	A record object.
	 * @return	array	An array of conditions to add to add to ordering queries.
	 * @since	1.6
	 */
	protected function getReorderConditions($table = null)
	{
		$condition = array();
		$condition[] = 'category_id = '.(int) $table->category_id;
		return $condition;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array	The form data.
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	public function save($data)
	{
		
		// Initialise variables;
		$dispatcher = JDispatcher::getInstance();
		$table		= $this->getTable();
		$pk			= (!empty($data['id'])) ? $data['id'] : (int)$this->getState($this->getName().'.id');
		$isNew		= true;

		// Include the content plugins for the on save events.
		JPluginHelper::importPlugin('extension');
		// Import the solidres plugin group. TODO: consolidate these plugin groups
		JPluginHelper::importPlugin('solidres');

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
		$this->prepareTable($table);

		// Check the data.
		if (!$table->check())
        {
			$this->setError($table->getError());
			return false;
		}

		// Trigger the onContentBeforeSave event.
		$result = $dispatcher->trigger($this->event_before_save, array($data, $table, $isNew));
		if (in_array(false, $result, true))
        {
			$this->setError($this->getError());
			return false;
		}

		// Store the data.
		if (!($result = $table->store(true))) // cause apache to crash
        {
			$this->setError($table->getError());
			return false;
		}

		// Clean the cache.
		$cache = JFactory::getCache($this->option);
		$cache->clean();

		// Trigger the onContentAfterSave event.
		$dispatcher->trigger($this->event_after_save, array($data, $table, $result,  $isNew));

		$pkName = $table->getKeyName();
		if (isset($table->$pkName))
        {
			$this->setState($this->getName().'.id', $table->$pkName);
		}
		$this->setState($this->getName().'.new', $isNew);

		return true;
	}
}