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
 * Reservation list controller class.
 *
 * @package     Solidres
 * @subpackage	Reservation	
 * @since		0.1.0
 */
class SolidresControllerReservations extends JControllerAdmin
{
	public function getModel($name = 'Reservation', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}