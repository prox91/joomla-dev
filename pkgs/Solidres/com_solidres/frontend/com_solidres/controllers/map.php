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
 * @subpackage	Reservation
 * @since		0.1.0
 */
class SolidresControllerMap extends JControllerLegacy
{
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
	public function &getModel($name = 'Map', $prefix = 'SolidresModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}

	public function show()
	{
		$model = $this->getModel();
		$modelName = $model->getName();
		$id = $this->input->getUint('id');

		$model->setState($modelName.'.assetId', $id);

		$this->input->set('tmpl', 'component');

		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewName = 'Map';
		$viewLayout = 'default';

		$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));

		$view->setModel($model, true);

		$view->document = $document;

		$view->display();
	}
}