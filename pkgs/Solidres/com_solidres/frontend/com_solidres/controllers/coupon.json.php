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
 * @subpackage	Coupon
 * @since		0.1.0
 */
class SolidresControllerCoupon extends JControllerLegacy
{
	public function __construct($config = array())
	{
		$config['model_path'] = JPATH_COMPONENT_ADMINISTRATOR . '/models';
		parent::__construct($config);

		$this->couponCode = $this->input->get('coupon_code', 0, 'string');
		$this->raId = $this->input->get('raid', 0, 'int');
		$this->coupon = SRFactory::get('solidres.coupon.coupon');
		$this->jconfig = JFactory::getConfig();
		$this->tzoffset = $this->jconfig->get('offset');
		$this->reservationData = $this->getReservationData();
		$this->customerGroupId = $this->getCustomerGroupId();
		$this->currentDate = JFactory::getDate(date('Y-M-d'), $this->tzoffset)->toUnix();
		$this->checkin  = JFactory::getDate(date('Y-M-d', strtotime($this->reservationData->checkin)), $this->tzoffset)->toUnix();
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
	public function &getModel($name = 'Coupon', $prefix = 'SolidresModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

	/**
	 * Check a coupon code to see if it is valid to use.
	 *
	 * Valid conditions
	 *
	 *  - The coupon must belong to the current reservation asset
	 *  - The coupon must be enabled
	 *  - The date of making reservation must be between the coupon valid date range
	 *  - The checkin date must be between the Valid from checkin/Valid to checkin period
	 *  - Belong to correct customer group
	 */
	public function isValid()
	{
		$status = $this->coupon->isValid($this->couponCode, $this->raId, $this->currentDate, $this->checkin, $this->customerGroupId);

		if ($status)
		{
			$msg = '<span class="help-inline accepted">'.JText::_('SR_COUPON_ACCEPTED').'
			        <a href="javascript:void(0)" id="apply-coupon">'.JText::_('SR_APPLY_COUPON').'</a></span>';
		}
		else
		{
			$msg = '<span class="help-inline rejected">'.JText::_('SR_COUPON_REJECTED').'</span>';
		}

		$response = array('status' => $status, 'message' => $msg);

		echo json_encode($response);die(1);
	}

	public function applyCoupon()
	{
		$couponModel = $this->getModel();
		$app = JFactory::getApplication();
		$context = 'com_solidres.reservation.process';

		$isValid = $this->coupon->isValid($this->couponCode, $this->raId, $this->currentDate, $this->checkin, $this->customerGroupId);

		if ($isValid)
		{
			$couponData = array();
			$coupon = $couponModel->getItem(array('coupon_code' => $this->couponCode, 'state' => 1));
			$couponData['coupon_id'] = $coupon->id;
			$couponData['coupon_name'] = $coupon->coupon_name;
			$couponData['coupon_code'] = $coupon->coupon_code;
			$couponData['coupon_amount'] = $coupon->amount;
			$couponData['coupon_is_percent'] = $coupon->is_percent;
			$couponData['valid_from'] = $coupon->valid_from;
			$couponData['valid_to'] = $coupon->valid_to;
			$couponData['valid_from_checkin'] = $coupon->valid_from_checkin;
			$couponData['valid_to_checkin'] = $coupon->valid_to_checkin;
			$couponData['customer_group_id'] = $coupon->customer_group_id;
			$app->setUserState($context.'.coupon', $couponData);
			$response = array('status' => true, 'message' => '');
		}
		else
		{
			$app->setUserState($context.'.coupon', NULL);
			$response = array('status' => false, 'message' => '');
		}
		echo json_encode($response);die(1);
	}

	private function getReservationData()
	{
		$context = 'com_solidres.reservation.process';

		return JFactory::getApplication()->getUserState($context);
	}

	private function getCustomerGroupId()
	{
		JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'SolidresModel');
		$user = JFactory::getUser();
		$customerModel = JModelLegacy::getInstance('Customer', 'SolidresModel', array('ignore_request' => true));
		// Get the customer info
		if (empty($user->id ))
		{
			$customerGroupId = NULL;
		}
		else
		{
			$customer = $customerModel->getItem(array('user_id' => $user->id));
			$customerGroupId = ($customer) ? $customer->customer_group_id : NULL;
		}

		return $customerGroupId;
	}
}