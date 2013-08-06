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
 * @subpackage	ReservationAsset
 * @since		0.1.0
 */
class SolidresControllerReservationAsset extends JControllerLegacy
{
	public function __construct($config = array())
	{
		$config['model_path'] = JPATH_COMPONENT_ADMINISTRATOR . '/models';
		parent::__construct($config);
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
	public function &getModel($name = 'ReservationAsset', $prefix = 'SolidresModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

	public function checkavailability()
	{
		$model = $this->getModel();
		$app = JFactory::getApplication();
		$context = 'com_solidres.reservation.process';

		$id = $this->input->getUint('id', 0, 'int');

		$model->setState('id', $id);
		$model->setState('checkin',	$this->input->get('checkin', '', 'string'));
		$model->setState('checkout', $this->input->get('checkout', '', 'string'));
		$model->setState('adults', $this->input->get('adults', 0, 'int'));
		$model->setState('children', $this->input->get('children', 0, 'int'));
		$model->setState('country_id', $this->input->get('country_id', 0, 'int'));
		$model->setState('geo_state_id', $this->input->get('geo_state_id', 0, 'int'));

		$app->setUserState($context.'.checkin', $this->input->get('checkin', '', 'string'));
		$app->setUserState($context.'.checkout', $this->input->get('checkout', '', 'string'));

		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewName = 'ReservationAsset';
		$viewLayout = 'default';

		$this->hit($id);

		$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
		$view->setModel($model, true);
		$view->document = $document;
		$view->display();
	}

	/**
	 * Increase the hit counter
	 *
	 * @param $pk
	 *
	 * @return void
	 */
	public function hit($pk)
	{
		$table = JTable::getInstance('ReservationAsset', 'SolidresTable');
		$table->hit($pk);
	}


	/**
	 * Typical view method for MVC based architecture
	 *
	 * This function is provide as a default implementation, in most cases
	 * you will need to override it in your own controllers.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy  A JControllerLegacy object to support chaining.
	 *
	 * @since   12.2
	 */
	public function display($cachable = false, $urlparams = array())
	{
		$model = $this->getModel('ReservationAsset', 'SolidresModel', array('ignore_request' => true));
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/tables', 'SolidresTable');
		$default = JTable::getInstance('ReservationAsset', 'SolidresTable');
		$default->load(array('default' => 1));

		$model->setState('reservationasset.id', $default->id);

		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewName = 'ReservationAsset';
		$viewLayout = 'default';

		$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
		$view->setModel($model, true);
		$view->document = $document;
		$view->display();

		return $this;
	}
}