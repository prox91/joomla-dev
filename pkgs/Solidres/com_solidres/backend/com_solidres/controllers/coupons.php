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
 * Coupons list controller class.
 *
 * @package     Solidres
 * @subpackage	Coupon	
 * @since		0.1.0
 */
class SolidresControllerCoupons extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * 
	 * @param String $name the model name
	 * @param String $prefix the model prefix
	 * 
	 */
	public function &getModel($name = 'Coupon', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}