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

require_once SRPATH_HELPERS.'/helper.php';

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldCheckboxCoupon extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	public $type = 'CheckboxCoupon';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		$roomtypeId = $this->form->getValue('id', NULL, 0);
		$reservationAssetId = $this->form->getValue('reservation_asset_id');
		$html = '';

		if (!empty($reservationAssetId))
		{
			$model = JModelLegacy::getInstance('Coupons', 'SolidresModel', array('ignore_request' => true));
			$model->setState('filter.reservation_asset_id', $reservationAssetId);
			$model->setState('filter.date_constraint', 1);
			$listCoupons = $model->getItems();
			$listRoomtypeCouponIds = SRFactory::get('solidres.roomtype.roomtype')->getCoupon($roomtypeId);
			if (!empty($listCoupons))
			{
				foreach ($listCoupons as $couponObj)
				{
					$html .= '
	            	<p class="coupons-wrapper-line">
	            		<label class="checkbox">
				    	<input type="checkbox"
								value="'.$couponObj->id.'"
								id="checkbox_coupon_id_'.$couponObj->id.'"
								class="checkbox_coupon_class"
								name="jform[coupon_id][]" '.(in_array($couponObj->id, $listRoomtypeCouponIds) ? 'checked="checked"' : '').'/>
							'.$couponObj->coupon_name.'
						</label>
					</p>';
				}
			}
			else
			{
				$html = JText::_('SR_COUPON_NOT_AVAILABLE_FOR_THIS_RESERVATION_ASSET');
			}
		}
		else
		{
			$html =  JText::_('SR_COUPON_SELECT_RESERVATION_ASSET_FIRST');
		}

		return $html;
	}
}


