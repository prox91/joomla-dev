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
 * Reservation view class
 *
 * @package     Solidres
 * @since		0.1.0
 */
class SolidresViewReservation extends JViewLegacy
{
	protected $extras;
	protected $countries;
	protected $geostates;
	protected $defaultRa;
	protected $model;
	protected $modelName;
	protected $context;
	
    function display($tpl = null)
	{
		$this->context = 'com_solidres.reservation.process';
		$this->config = JComponentHelper::getParams('com_solidres');
		$this->showPoweredByLink = $this->config->get('show_solidres_copyright', '1');

		if ($this->_layout == 'default')
		{
			$model = $this->getModel();
			$modelName = $model->getName();

			$this->reservation = $model->getItem();
			$this->app = JFactory::getApplication();
			$this->checkin = $model->getState($modelName.'.checkin');
			$this->checkout = $model->getState($modelName.'.checkout');
			$this->totalReservedRoom = $model->getState($modelName.'.totalReservedRoom');
			$this->countries = SolidresHelper::getCountryOptions();
			$this->geoStates = SolidresHelper::getGeoStateOptions($model->getState($modelName.'.countryId'));
			$this->userState = $this->app->getUserState($this->context);
			$this->raid	= $model->getState($modelName.'.reservationAssetId');
			$this->uri = JURI::getInstance()->__toString();
			$this->roomTypeObj = SRFactory::get('solidres.roomtype.roomtype');
			$this->numberOfNights = $this->roomTypeObj->calculateDateDiff($this->checkin, $this->checkout);
			JHtml::_('jquery.framework');
		}

		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		parent::display($tpl);
    }
}
