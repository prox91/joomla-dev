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
 * @package     Solidres
 * @subpackage	Reservation
 * @since		0.1.0
 */
class SolidresControllerReservation extends JControllerLegacy
{
	protected $reservationData = array();

	protected $selectedRoomTypes = array();

	protected $reservationAssetId = array();

	protected $bookingConditionsArticleId = 0;

	protected $privacyPolicyArticleId = 0;

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->app = JFactory::getApplication();
		$this->context = 'com_solidres.reservation.process';
		set_include_path(get_include_path() . PATH_SEPARATOR . SRPATH_LIBRARY . '/payment/paypal/lib');
		$this->reservationAssetId = $this->input->getUint('id');

		// Get the default currency
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/tables', 'SolidresTable');
		$reservationAssetTable = JTable::getInstance('ReservationAsset', 'SolidresTable');
		$currencyTable = JTable::getInstance('Currency', 'SolidresTable');
		$reservationAssetTable->load($this->reservationAssetId);
		$currencyTable->load($reservationAssetTable->currency_id);
		$this->reservationData['currency_id'] = $currencyTable->id;
		$this->reservationData['currency_code'] = $currencyTable->currency_code;

	}

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param	string	$name The model name. Optional.
	 * @param	string	$prefix The class prefix. Optional.
	 * @param	array	$config Configuration array for model. Optional.
	 *
	 * @return	object	The model.
	 * @since	1.5
	 */
	public function &getModel($name = 'Reservation', $prefix = 'SolidresModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	/**
	 * Build a correct data structure for the saving
	 *
	 * @since 0.3.0
	 */
	protected function prepareSavingData()
	{
		if (is_array($this->app->getUserState($this->context.'.room')))
		{
			$this->reservationData = array_merge($this->reservationData, $this->app->getUserState($this->context.'.room'));
		}

		if (is_array($this->app->getUserState($this->context.'.guest')))
		{
			$this->reservationData = array_merge($this->reservationData, $this->app->getUserState($this->context.'.guest'));
		}

		if (is_array($this->app->getUserState($this->context.'.payment')))
		{
			$this->reservationData = array_merge($this->reservationData, $this->app->getUserState($this->context.'.payment'));
		}

		if (is_array($this->app->getUserState($this->context.'.cost')))
		{
			$this->reservationData = array_merge($this->reservationData, $this->app->getUserState($this->context.'.cost'));
		}

		if (is_array($this->app->getUserState($this->context.'.discount')))
		{
			$this->reservationData = array_merge($this->reservationData, $this->app->getUserState($this->context.'.discount'));
		}

		if (is_array($this->app->getUserState($this->context.'.coupon')))
		{
			$this->reservationData = array_merge($this->reservationData, $this->app->getUserState($this->context.'.coupon'));
		}

		$raTable = JTable::getInstance('ReservationAsset', 'SolidresTable');
		$raTable->load($this->reservationData['raid']);
		$this->reservationData['reservation_asset_name'] = $raTable->name;
		$this->reservationData['reservation_asset_id'] = $this->reservationData['raid'];
	}

	public function start()
	{
		// This is an intermediate step to reset the previous selected payment method
		$this->app->setUserState($this->context . '.payment', NULL);
		$this->showForm();
	}

	/**
	 * Display reservation form based on availability search results
	 *
	 * @since 0.2.0
	 */
	public function showForm()
	{
		$this->prepareReservationData();

		$model = $this->getModel();
		$modelName = $model->getName();
		$model->setState($modelName.'.roomTypes', $this->selectedRoomTypes);
		$model->setState($modelName.'.checkin', $this->input->getString('checkin'));
		$model->setState($modelName.'.checkout', $this->input->getString('checkout'));
		$model->setState($modelName.'.reservationAssetId', $this->reservationAssetId);

		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewName = 'Reservation';
		$viewLayout = 'default';
		$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
		$view->setModel($model, true);
		$view->document = $document;
		$view->display();
	}

	/**
	 * Save the reservation data
	 *
	 * @since  0.1.0
	 * 
	 * @return void
	 */
	public function save()
	{
		$model = $this->getModel();
		$resTable = JTable::getInstance('Reservation', 'SolidresTable');

		// Get the data from user state and build a correct array that is ready to be stored
		$this->prepareSavingData();

		if(!$model->save($this->reservationData))
		{
			// Fail, turn back and correct
			$msg = JText::_('SR_RESERVATION_SAVE_ERROR');
			$this->setRedirect($this->reservationData['returnurl'], $msg);
		}
		else
		{
			// Prepare some data for final layout
			$savedReservationId = $model->getState($model->getName().'.id');
			$resTable->load($savedReservationId);
			$this->app->setUserState($this->context.'.savedReservationId', $savedReservationId);
			$this->app->setUserState($this->context.'.code', $resTable->code);
			$this->app->setUserState($this->context.'.customeremail', $this->reservationData['customer_email']);

			$this->finalize();
		}
	}

	/**
	 * Send email when reservation is completed
	 *
	 * @since  0.1.0
	 *
	 * @return boolean Error message or True if email sending completed successfully
	 */
	private function sendEmail()
	{
		require_once SRPATH_LIBRARY.'/swift/swift_required.php';
		$messageTemplatePath = array();
		$subject = array();
		$body = array();

		$raTable = JTable::getInstance('ReservationAsset', 'SolidresTable');
		$raTable->load($this->reservationData['raid']);
		$hotelEmail = $raTable->email;
		$hotelName = $raTable->name;
		$customerEmail = $this->reservationData['customer_email'];
		$messageTemplatePath[$customerEmail] = SRPATH_LIBRARY.'/mail/en-GB/reservation_complete.html';
		$subject[$customerEmail] = JText::_('SR_EMAIL_RESERVATION_COMPLETE');
		$messageTemplatePath[$hotelEmail] = SRPATH_LIBRARY.'/mail/en-GB/new_reservation_notification.html';
		$subject[$hotelEmail] = JText::_('SR_EMAIL_NEW_RESERVATION_NOTIFICATION');

		// Send to the customer
		if (file_exists($messageTemplatePath[$customerEmail]))
		{
			$body[$customerEmail] = file_get_contents($messageTemplatePath[$customerEmail]);
		}

		$replacements[$customerEmail] = array(
			'{hotel_name}' => $hotelName,
			'{hotel_url}' => $raTable->website,
			'{customer_firstname}' => $this->reservationData['customer_firstname'],
			'{customer_middlename}' => $this->reservationData['customer_middlename'],
			'{customer_lastname}' => $this->reservationData['customer_lastname'],
			'{code}' => $this->app->getUserState($this->context.'.code'),
			'{website}' => $raTable->website,
			'{email}' => $raTable->email,
			'{phone}' => $raTable->phone
		);

		$mail = SRFactory::get('solidres.mail.mail');
		$mail->mailFrom = array($hotelEmail => $hotelName);
		$mail->mailTo = $customerEmail;
		$mail->replacements = $replacements;
		$mail->subject = $subject[$customerEmail];
		$mail->body = $body[$customerEmail];

		if (!$mail->send())
		{
			return false;
		}

		// Send to the hotel owner
		if (file_exists($messageTemplatePath[$hotelEmail]))
		{
			$body[$hotelEmail] = file_get_contents($messageTemplatePath[$hotelEmail]);
		}

		$replacements[$hotelEmail] = array(
			'{hotel_name}' => $hotelName,
			'{hotel_url}' => $raTable->website,
			'{code}' => $this->app->getUserState($this->context.'.code'),
			'{reservation_edit_link}' => JUri::base() . 'administrator/index.php?option=com_solidres&view=reservation&layout=edit&id='.$this->app->getUserState($this->context.'.savedReservationId')
		);

		$mail2 = SRFactory::get('solidres.mail.mail');
		$mail2->mailFrom = array($hotelEmail => $hotelName);
		$mail2->mailTo = $hotelEmail;
		$mail2->replacements = $replacements;
		$mail2->subject = $subject[$hotelEmail];
		$mail2->body = $body[$hotelEmail];

		if (!$mail2->send())
		{
			return false;
		}

		return true;
	}

	/**
	 * Finalize the reservation process
	 *
	 * @since  0.3.0
	 *
	 * @return void
	 */
	protected function finalize()
	{
		$msg = $this->sendEmail();

		if (!is_string($msg))
		{
			$msg = NULL;
		}

		// Done, we do not need these data, wipe them !!!
		$this->app->setUserState($this->context . '.room', NULL);
		$this->app->setUserState($this->context . '.extra', NULL);
		$this->app->setUserState($this->context . '.guest', NULL);
		$this->app->setUserState($this->context . '.payment', NULL);
		$this->app->setUserState($this->context . '.discount', NULL);
		$this->app->setUserState($this->context . '.coupon', NULL);
		$this->app->setUserState($this->context . '.token', NULL);
		$this->app->setUserState($this->context . '.cost', NULL);
		$this->app->setUserState($this->context . '.room_type_prices_mapping', NULL);
		$this->app->setUserState($this->context . '.get_express_checkout_response', NULL);
		$this->app->setUserState($this->context . '.selected_room_types', NULL);
		$this->app->setUserState($this->context . '.reservation_asset_id', NULL);
		$this->app->setUserState($this->context . '.get_express_checkout_response', NULL);

		$link = JRoute::_('index.php?option=com_solidres&view=reservation&layout=final', false);
		$this->setRedirect($link, $msg);
	}

	/**
	 * Prepare reservation data for reservation form or for payment gateways
	 *
	 * @since  0.3.0
	 *
	 * @return void
	 */
	protected function prepareReservationData()
	{
		$queryUri = JURI::getInstance()->getQuery(true) ;

		$queryUri['task'] = 'reservation.showForm';

		$returnUri = JUri::getInstance();
		$returnUri->setQuery($queryUri);

		$this->app->setUserState($this->context . '.return_url', $returnUri->__toString());

		$this->bookingConditionsArticleId = $this->input->getUint('bookingconditions', NULL);
		$this->privacyPolicyArticleId = $this->input->getUint('privacypolicy', NULL);

		foreach ($queryUri as $key => $value)
		{
			if (substr($key, 0, 2) === 'rt')
			{
				$exploded = explode("_", $key);
				$this->selectedRoomTypes[$exploded[2]] = $value;
			}
		}

		$this->app->setUserState($this->context . '.selected_room_types', $this->selectedRoomTypes);
		$this->app->setUserState($this->context . '.reservation_asset_id', $this->reservationAssetId);

		// Process article links
		if (!isset($this->bookingConditionsArticleId) && !isset($this->privacyPolicyArticleId))
		{
			JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/models', 'SolidresModel');
			$raModel = JModelLegacy::getInstance('ReservationAsset', 'SolidresModel', array('ignore_request' => true));
			$result = $raModel->getItem($this->reservationAssetId);

			$this->bookingConditionsArticleId = $result->params['termsofuse'];
			$this->privacyPolicyArticleId = $result->params['privacypolicy'];
		}
		$this->app->setUserState($this->context . '.booking_conditions', $this->bookingConditionsArticleId);
		$this->app->setUserState($this->context . '.privacy_policy', $this->privacyPolicyArticleId);

		$currentCurrencyId = $this->app->getUserState('current_currency_id', 1);
		if (!isset($currentCurrencyId))
		{
			$currentCurrencyId = $this->input->cookie->get('solidres_currency', 0, 'int');
			$this->app->setUserState('current_currency_id', $currentCurrencyId);
		}
	}
}