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
 * State list controller class.
 *
 * @package     Solidres
 * @subpackage	State
 * @since		0.1.0
 */
class SolidresControllerStates extends JControllerAdmin
{
	public function __construct($config = array())
	{
		$config['model_path'] = JPATH_COMPONENT_ADMINISTRATOR . '/models';
		parent::__construct($config);
	}

	public function &getModel($name = 'States', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	public function find()
	{
		$countryId = JFactory::getApplication()->input->get('id', 0, 'int');
		$states = SolidresHelper::getGeoStateOptions($countryId);
		$html = '';
		foreach ($states as $state)
		{
			$html .= '<option value="'.$state->value.'">'.$state->text.'</option>';
		}
		echo $html;
		die(1);
	}
}