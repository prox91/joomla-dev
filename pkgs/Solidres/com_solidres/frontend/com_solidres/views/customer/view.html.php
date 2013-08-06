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
 * HTML View class for the Solidres component
 *
 * @package     Customer
 * @since		0.3.0
 */
class SolidresViewCustomer extends JViewLegacy
{
	protected $reservations;

	function display($tpl = null)
	{
		$model = $this->getModel();

		$this->reservations = $model->getReservations();

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document like adding meta tags/site name per ReservationAsset
	 *
	 * @return void
	 */
	protected function _prepareDocument()
	{
	}
}
