<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 5/11/13
 * Time: 4:37 PM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.controlleradmin');

class EnglishConceptControllerEnglishConcepts extends JControllerAdmin
{
	public function getModel($name = 'Lessons', $prefix = 'EnglishConeptModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
