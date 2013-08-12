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
 * Customer group list controller class.
 *
 * @package     Solidres
 * @subpackage	CustomerGroups
 * @since		0.1.0
 */
class SolidresControllerCustomerGroups extends JControllerAdmin
{
	public function getModel($name = 'CustomerGroup', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}