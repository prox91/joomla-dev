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

JLoader::register('SolidresHelper', JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php');

/**
 * Controller to handle one-page reservation form
 *
 * @package     Solidres
 * @subpackage	Reservation
 * @since		0.1.0
 */
class SolidresControllerReservation extends JControllerLegacy
{
	public function __construct($config = array())
	{
		$this->app = JFactory::getApplication();
		$this->context = 'com_solidres.reservation.process';
		parent::__construct($config);
	}

	/*
	 * Prepare the reservation data, store them into user session so that it can be saved into the db later
	 *
	 * @params string $type Type of data to process
	 *
	 * @return json
	 */
	public function process()
	{
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		$data = $this->input->post->get('jform', array(), 'array');
		$step = $this->input->get('step', '', 'string');

		$this->addModelPath(JPATH_COMPONENT_ADMINISTRATOR.'/models');

		if (!empty($step))
		{
			switch ($step)
			{
				case 'room':
					$this->processRoom($data);
					break;
				case 'guest':
					$this->processGuest($data);
					break;
				case 'payment':
					$this->processPayment($data);
					break;
				default:
					break;
			}
		}
	}

	public function progress()
	{
		$next	= $this->input->get('next', '', 'string');
		if (!empty($next))
		{
			switch($next)
			{
				case 'guest':
					$this->getHtmlGuest();
					break;
				case 'payment':
					$this->getHtmlPayment();
					break;
				case 'confirmation':
					$this->getHtmlConfirmation();
					break;
				default:
					$response = array('status' => 1, 'message' => '', 'next' => '');
					echo json_encode($response);die(1);
					break;
			}
		}
	}

	public function processRoom($data)
	{
		// Get the extra price to display in the confirmmation screen
		$extraModel = $this->getModel('Extra', 	'SolidresModel') ;
		$totalRoomTypeExtraCost = 0;

		for($i = 1; $i <= count($data['room_types']); $i++)
		{
			if (isset($data['room_types'][$i]['extra']))
			{
				foreach ($data['room_types'][$i]['extra'] as $extraArrayKey => $extraArrayVal)
				{
					foreach ($data['room_types'][$i]['extra'][$extraArrayKey] as $extraId => $extraDetail)
					{
						$extra = $extraModel->getItem($extraId);
						$data['room_types'][$i]['extra'][$extraArrayKey][$extraId]['price'] = $extra->price;
						if (isset($extraDetail['quantity']))
						{
							$totalRoomTypeExtraCost += $data['room_types'][$i]['extra'][$extraArrayKey][$extraId]['price'] * $extraDetail['quantity'];
						}
						else
						{
							$totalRoomTypeExtraCost += $data['room_types'][$i]['extra'][$extraArrayKey][$extraId]['price'];
						}
					}
				}
			}
		}

		$data['total_extra_price'] = $totalRoomTypeExtraCost;
		$data['total_extra_price_tax_incl'] = $totalRoomTypeExtraCost;
		$data['total_extra_price_tax_excl'] = $totalRoomTypeExtraCost;

		$this->app->setUserState($this->context.'.room', $data);

		// If error happened, output correct error message in json format so that we can handle in the front end
		$response = array('status' => 1, 'message' => '', 'next' => $data['next_step']);

		echo json_encode($response);die(1);
	}

	public function processGuest($data)
	{
		$countryModel 	= $this->getModel('Country', 	'SolidresModel');
		$geostateModel 	= $this->getModel('State', 		'SolidresModel');
		$country 	= $countryModel->getItem($data['customer_country_id']);

		if (isset($data['customer_geo_state_id']))
		{
			$geoState 	= $geostateModel->getItem($data['customer_geo_state_id']);
			$data['geo_state_name'] = $geoState->name;
		}

		// Process customer group
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables', 'SolidresTable');
		$customerTable = JTable::getInstance('Customer', 'SolidresTable');
		$user = JFactory::getUser();
		$customerTable->load(array('user_id' => $user->get('id')));
		$data['customer_id'] = !empty($customerTable->id) ? $customerTable->id : NULL;

		$data['country_name'] 	= $country->name;
		$this->app->setUserState($this->context.'.guest', $data);

		// If the payment method is already selected, skip the payment selection form
		$currentPaymentMethod = $this->app->getUserState($this->context . '.payment');
		if ($currentPaymentMethod['payment_method'] == 'paypalexpresscheckout')
		{
			$data['next_step'] = 'confirmation';
		}

		// If error happened, output correct error message in json format so that we can handle in the front end
		$response = array('status' => 1, 'message' => '', 'next' => $data['next_step']);

		echo json_encode($response);die(1);
	}

	public function processPayment($data)
	{
		$this->app->setUserState($this->context.'.payment', $data);
		// If error happened, output correct error message in json format so that we can handle in the front end
		$response = array('status' => 1, 'message' => '', 'next' => $data['next_step']);

		echo json_encode($response);die(1);
	}

	public function getModel($name = 'Reservation', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	/**
	 * Return html to display guest form in one-page reservation, data is retrieved from user session
	 *
	 * @return string HTML
	 */
	public function getHtmlGuest()
	{
		$this->countries = SolidresHelper::getCountryOptions();
		$this->reservationDetails = $this->app->getUserState($this->context);

		// Try to get the customer information if he/she logged in
		if (!isset($this->reservationDetails->guest))
		{
			// Process customer group
			JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables', 'SolidresTable');
			$customerTable = JTable::getInstance('Customer', 'SolidresTable');
			$user = JFactory::getUser();
			$customerTable->load(array('user_id' => $user->get('id')));

			if (!empty($customerTable->id))
			{
				$this->reservationDetails->guest["customer_firstname"] = $customerTable->firstname;
				$this->reservationDetails->guest["customer_middlename"] = $customerTable->middlename;
				$this->reservationDetails->guest["customer_lastname"] = $customerTable->lastname;
				$this->reservationDetails->guest["customer_email"] = $user->get('email');
			}
		}

		$selectedCountryId = isset($this->reservationDetails->guest["customer_country_id"]) ? $this->reservationDetails->guest["customer_country_id"] : 0;
		$options = array();
		$options[] = JHTML::_('select.option', NULL, JText::_('SR_SELECT') );
		$this->geoStates = $selectedCountryId > 0 ? SolidresHelper::getGeoStateOptions($selectedCountryId) : $options;

		$html = '
			<div class="reservation-box-inner">
				<form enctype="multipart/form-data"
					  id="sr-reservation-form-guest"
					  class="sr-reservation-form form-stacked sr-validate"
					  action="'. JRoute::_("index.php?option=com_solidres&task=reservation.process&step=guest&format=json") .'"
					  method="POST">
					<div class="row-fluid">
						<div class="span6">
							<fieldset>
								<label for="firstname">
									'. JText::_("SR_FIRSTNAME").'
								</label>
								<input id="firstname"
									   required
									   name="jform[customer_firstname]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_firstname"]) ? $this->reservationDetails->guest["customer_firstname"] : "") .'" />

								<label for="middlename">
									'. JText::_("SR_MIDDLENAME").'
								</label>
								<input id="middlename"
									   name="jform[customer_middlename]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_middlename"]) ? $this->reservationDetails->guest["customer_middlename"] : "") .'" />

								<label for="lastname">
									'. JText::_("SR_LASTNAME").'
								</label>
								<input id="lastname"
									   required
									   name="jform[customer_lastname]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_lastname"]) ? $this->reservationDetails->guest["customer_lastname"] : "") .'" />

								<label for="email">
									'. JText::_("SR_EMAIL").'
								</label>
								<input id="email"
									   required
									   name="jform[customer_email]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_email"]) ? $this->reservationDetails->guest["customer_email"] : "") .'" />

								<label for="phonenumber">
									'. JText::_("SR_PHONENUMBER").'
								</label>
								<input id="phonenumber"
									   required
									   name="jform[customer_phonenumber]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_phonenumber"]) ? $this->reservationDetails->guest["customer_phonenumber"] : "") .'" />

								<label for="company">
									'. JText::_("SR_COMPANY").'
								</label>
								<input id="company"
									   name="jform[customer_company]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_company"]) ? $this->reservationDetails->guest["customer_company"] : "") .'" />
							</fieldset>
						</div>

						<div class="span6">
							<fieldset>
								<label for="address_1">
									'. JText::_("SR_ADDRESS_1").'
								</label>
								<input id="address_1"
									   required
									   name="jform[customer_address1]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_address1"]) ? $this->reservationDetails->guest["customer_address1"] : "") .'" />

								<label for="address_2">
									'. JText::_("SR_ADDRESS_2").'
								</label>
								<input id="address_2"
									   name="jform[customer_address2]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_address2"]) ? $this->reservationDetails->guest["customer_address2"] : "") .'" />

								<label for="city">'. JText::_("SR_CITY").'</label>
								<input id="city"
									   required
									   name="jform[customer_city]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_city"]) ? $this->reservationDetails->guest["customer_city"] : "") .'" />

								<label for="zip">'. JText::_("SR_ZIP").'</label>
								<input id="zip"
									   name="jform[customer_zipcode]"
									   type="text"
									   class="inputbox"
									   value="'. (isset($this->reservationDetails->guest["customer_zipcode"]) ? $this->reservationDetails->guest["customer_zipcode"] : "") .'" />

								<label for="jform[country_id]">'. JText::_("SR_COUNTRY").'</label>';


			$selectedCountryId = isset($this->reservationDetails->guest["customer_country_id"]) ? $this->reservationDetails->guest["customer_country_id"] : 0;
			$html .= JHtml::_("select.genericlist", $this->countries, "jform[customer_country_id]", array("class" => "country_select inputbox", 'required'), "value", "text", $selectedCountryId, "country");

			$html .= '
								<label for="jform[customer_geo_state_id]">'. JText::_("SR_STATE").'</label>';

			$selectedGeoStateId = isset($this->reservationDetails->guest["customer_geo_state_id"]) ? $this->reservationDetails->guest["customer_geo_state_id"] : 0;

			$html .= JHtml::_("select.genericlist", $this->geoStates, "jform[customer_geo_state_id]", array("class" => "state_select inputbox"), "value", "text", $selectedGeoStateId, "state");

			$html .= '<label for="note">'. JText::_("SR_NOTE").'</label>
										<textarea id="note" name="jform[note]" rows="10" cols="30">'. (isset($this->reservationDetails->guest["note"]) ? $this->reservationDetails->guest["note"] : "") .'</textarea>
								<p class="help-block">'. JText::_("SR_RESERVATION_NOTE").'</p>
							</fieldset>
						</div>
					</div>
					<div class="processing-indicator nodisplay"></div>
					<button class="btn btn-primary" id="" type="submit">
						'. JText::_("SR_BUTTON_RESERVATION_PARTIAL_SUBMIT") .'
					</button>
					'. JHtml::_("form.token") .'
					<input type="hidden" name="jform[next_step]" value="payment" />
				</form>
			</div>
		';

		echo $html;die(1);
	}

	/**
	 * Return html to display payment form in one-page reservation, data is retrieved from user session
	 *
	 * @return string HTML
	 */
	public function getHtmlPayment()
	{
		$this->reservationDetails = $this->app->getUserState($this->context);
		$checkCheque = "";
		$checkPaypal = "";
		if (isset($this->reservationDetails->payment["payment_method"])) :
			if ($this->reservationDetails->payment["payment_method"] == "chequemoney" ) :
				$checkCheque = "checked";
			elseif ($this->reservationDetails->payment["payment_method"] == "paypal") :
				$checkPaypal = "checked";
			endif;
		endif;
		$html = '
			<div class="reservation-box-inner">
				<form
				  	id="sr-reservation-form-payment"
				  	action="'. JRoute::_("index.php?option=com_solidres&task=reservation.process&step=payment&format=json") .'"
				  	method="POST"
				  	class="sr-reservation-form sr-validate">

					<label for="payment_method_cheque">
						<input id="payment_method_cheque" type="radio" name="jform[payment_method]" value="chequemoney" '. $checkCheque .' validate="required:true" />
							'. JText::_("SR_PAYMENT_METHOD_CHEQUE_MONEY") .'
					</label>
					<!--
					<label for="payment_method_paypal">
						<input id="payment_method_paypal" type="radio" name="jform[payment_method]" value="paypal" '. $checkPaypal .' />
							'. JText::_("SR_PAYMENT_METHOD_PAYPAL") .'
					</label>
					-->

					<label for="jform[payment_method]" class="error">Please select a payment method</label>

					<div class="processing-indicator nodisplay"></div>
					<button class="btn btn-primary" id="" type="submit">
						'. JText::_("SR_BUTTON_RESERVATION_PARTIAL_SUBMIT") .'
					</button>
					'. JHtml::_("form.token") .'
					<input type="hidden" name="jform[next_step]" 	value="confirmation" />
					<input type="hidden" name="jform[checkin]" 		value="'. $this->reservationDetails->room['checkin']  .'" />
					<input type="hidden" name="jform[checkout]" 	value="'. $this->reservationDetails->room['checkout'] .'" />
				</form>
			</div>
		';

		echo $html;die(1);
	}

	/**
	 * Return html to display confirmation form in one-page reservation, data is retrieved from user session
	 *
	 * @return string HTML
	 */
	public function getHtmlConfirmation()
	{
		JLoader::register('ContentHelperRoute', JPATH_SITE.'/components/com_content/helpers/route.php');
		// TODO replace this manual call with autoloading later
		JLoader::register('SRCurrency', SRPATH_LIBRARY . '/currency/currency.php');

		$this->reservationDetails = $this->app->getUserState($this->context);

		$model = $this->getModel();

		$modelName = $model->getName();
		$checkin = $this->reservationDetails->room['checkin'];
		$checkout = $this->reservationDetails->room['checkout'];
		$raId = $this->reservationDetails->room['raid'];
		$roomTypeObj = SRFactory::get('solidres.roomtype.roomtype');
		$currency = new SRCurrency(0, $this->reservationDetails->currency_id);
		$totalRoomTypeExtraCost = $this->reservationDetails->room['total_extra_price'];
		$numberOfNights = $roomTypeObj->calculateDateDiff($checkin, $checkout);
		$cost = $this->app->getUserState($this->context.'.cost');

		$model->setState($modelName.'.roomTypes', $this->reservationDetails->selected_room_types);
		$model->setState($modelName.'.checkin',  $checkin);
		$model->setState($modelName.'.checkout', $checkout);
		$model->setState($modelName.'.reservationAssetId',  $raId);

		$task = 'reservation.save';
		if ($this->reservationDetails->payment['payment_method'] == 'paypalexpresscheckout')
		{
			$task = 'reservationppec.save';
		}

		$roomTypes = $model->getRoomType();
		$html = '
			<div class="reservation-box-inner">
				<form
				    id="sr-reservation-form-confirmation"
				    class=""
					action="'. JRoute::_("index.php?option=com_solidres&task=" . $task) .'"
					method="POST">

					<p>
						'. JText::_("SR_RESERVATION_NOTICE_CONFIRMATION") .'
					</p>

					<div id="reservation-confirmation-box">
						<table class="table">
							<tbody>';
		// Room cost
		foreach ($roomTypes as $roomTypeId => $roomTypeDetail) :
			if ($roomTypeDetail["quantity"] > 0) :
				$tempValue = $roomTypeDetail['currency']['total_price_tax_excl_formatted']->getValue();
				$currency->setValue($tempValue * $roomTypeDetail["quantity"]);
				$html .= '
								<tr>
									<td>
										'. $roomTypeDetail["name"] .'
									</td>
									<td>
										'. $roomTypeDetail["quantity"] .'
									</td>
									<td>
										'. JText::plural("SR_NIGHTS", $numberOfNights) .'
									</td>
									<td class="align-right">
										'.  $currency->format()  .'
									</td>
								</tr>';
			endif;
		endforeach;

		// Total room cost
		$totalRoomCost = new SRCurrency($cost['total_price_tax_excl'], $this->reservationDetails->currency_id);
		$html .= '
								<tr>
									<td colspan="3">
										'. JText::_("SR_TOTAL_ROOM_COST") .'
									</td>
									<td class="align-right">
										'. $totalRoomCost->format() .'
									</td>
								</tr>';

		// Imposed taxes
		$taxesModel	= JModelLegacy::getInstance('Taxes', 'SolidresModel', array('ignore_request' => true));
		$taxesModel->setState('filter.reservation_asset_id', $this->reservationDetails->room['raid']);
		$imposedTaxTypes = $taxesModel->getItems();

		$totalImposedTax = 0;
		foreach ($imposedTaxTypes as $taxType) :
			$imposedAmount = $taxType->rate * $cost['total_price_tax_excl'];
			$totalImposedTax += $imposedAmount;
			$currency->setValue( $imposedAmount );
			$taxItem = new SRCurrency($imposedAmount, $this->reservationDetails->currency_id);
			$html .= '
								<tr>
									<td colspan="3">
										'. $taxType->name .'
									</td>
									<td class="align-right">
										 '. $taxItem->format() .'
									</td>
								</tr>';
		endforeach;

		// Extra cost
		$totalExtraCost = new SRCurrency($totalRoomTypeExtraCost, $this->reservationDetails->currency_id);
		$html .='
								<tr>
									<td colspan="3">
										'. JText::_("SR_TOTAL_EXTRA_COST") .'
									</td>
									<td id="total-extra-cost" class="align-right">
										'.$totalExtraCost->format().'
									</td>
								</tr>';

		// Grand total cost
		$grandTotal = new SRCurrency($cost['total_price_tax_incl'] + $totalRoomTypeExtraCost, $this->reservationDetails->currency_id);
		$html .= '
								<tr>
									<td colspan="3">
									<strong>'. JText::_("SR_GRAND_TOTAL") .'</strong>
									</td>
									<td class="align-right gra">
										'.$grandTotal->format().'
									</td>
								</tr>';

		// Terms and conditions
		$bookingConditionsLink = JRoute::_(ContentHelperRoute::getArticleRoute($this->reservationDetails->booking_conditions));
		$privacyPolicyLink = JRoute::_(ContentHelperRoute::getArticleRoute($this->reservationDetails->privacy_policy));
		$html .= '
								<tr>
									<td colspan="4">
										<p>
											<input type="checkbox" id="termsandconditions" data-target="finalbutton" />
											I agree with the
											<a target="_blank" href="'.$bookingConditionsLink.'">Booking conditions</a> and
											<a target="_blank" href="'.$privacyPolicyLink.'">Privacy Policy</a>
										</p>
									</td>
								</tr>';

		$button_data = '';
		if ($this->reservationDetails->payment["payment_method"] == "chequemoney" ) :
			$button_data = "chequemoney";
		elseif ($this->reservationDetails->payment["payment_method"] == "paypal") :
			$button_data = "paypal";
		endif;
		$html .= '
							</tbody>
						</table>
					</div>
					<input type="hidden" name="id" value="'.$raId.'"/>

					<button id="finalbutton" data-payment="'.$button_data.'" class="btn btn-large btn-primary" id="" type="submit" disabled="disabled">
						<i class="icon-checkmark"></i>
						'. JText::_("SR_BUTTON_RESERVATION_FINAL_SUBMIT") .'
					</button>
					'. JHtml::_("form.token") .'
				</form>
			</div>
		';

		echo $html ;die(1);
	}

	public function removeCoupon()
	{
		$app = JFactory::getApplication();
		$context = 'com_solidres.reservation.process';
		$status = false;

		$currentAppliedCoupon = $app->getUserState($context.'.coupon');

		if ($currentAppliedCoupon['coupon_id'] == $app->input->get('id', 0, 'int'))
		{
			$app->setUserState($context.'.coupon', NULL);
			$status = true;
		}

		$response = array('status' => $status, 'message' => '');

		echo json_encode($response);die(1);
	}
}