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
 * Categories list controller class.
 *
 * @package     Solidres
 * @subpackage	Category	
 * @since		0.1.0
 */
class SolidresControllerCategories extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * 
	 * @param string $name The model name
	 * @param string $name The model prefix
	 */
	public function &getModel($name = 'Category', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}