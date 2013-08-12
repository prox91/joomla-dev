<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 5/11/13
 * Time: 4:37 PM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

// Import Joomla admin controller from the library
jimport('joomla.application.component.controlleradmin');

/**
 * HelloWorlds Controller
 */
class EnglishConceptControllerEnglishConcept extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since       2.5
	 */
	public function getModel($name = 'Lessons', $prefix = 'EnglishConeptModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}