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
 * Coupon handler class
 * 
 * @package 	Solidres
 * @subpackage	Coupon
 *
 * @since 		0.1.0
 */
class SRCoupon
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
	 * Check a coupon code to see if it is valid to use.
	 *
	 * @param   string $couponCode      The coupon code to check
	 * @param   int    $raId            The reservation asset id
	 * @param   int    $dateOfChecking  The date of checking
	 * @param   int    $checkin 		The checkin date
	 * @param   int    $customerGroupId The customer group id
	 *
	 * @since   0.1.0
	 *
	 * @return  boolean
	 */
	public function isValid($couponCode, $raId, $dateOfChecking, $checkin, $customerGroupId = NULL)
	{
		JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'SolidresModel');
		$model = JModelLegacy::getInstance('Coupon', 'SolidresModel', array('ignore_request' => true));
		$coupon = $model->getItem(array('coupon_code' => $couponCode));
		$response = true;

		if (
			$coupon->state != 1
			|| !($coupon->valid_from <= $dateOfChecking && $dateOfChecking <= $coupon->valid_to)
			|| $coupon->reservation_asset_id != $raId
			|| !($coupon->valid_from_checkin <= $checkin && $checkin <= $coupon->valid_to_checkin)
			|| $coupon->customer_group_id != $customerGroupId
		)
		{
			$response = false;
		}

		return $response;
	}

	/**
	 * Check to see if the given coupon is applicable to the given room type
	 *
	 * @param   $couponId
	 * @param   $roomTypeId
	 *
	 * @since   0.1.0
	 *
	 * @return  bool
	 */
	public function isApplicable($couponId, $roomTypeId)
	{
		$query = $this->_dbo->getQuery(true);
		$response = false;
		$query->select('COUNT(*)')->from($this->_dbo->quoteName('#__sr_room_type_coupon_xref'))
			  ->where('room_type_id = '.(int) $roomTypeId)
		      ->where('coupon_id = '. (int) $couponId);
		$count = $this->_dbo->setQuery($query)->loadResult();

		if ($count > 0)
		{
			$response = true;
		}

		return $response;
	}
}