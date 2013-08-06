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
 * Country list controller class.
 *
 * @package     Solidres
 * @subpackage	Country	
 * @since		0.1.0
 */
class SolidresControllerCountries extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * 
	 * @param String $name the model name
	 * @param String $prefix the model prefix
	 * 
	 */
	public function &getModel($name = 'Country', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}