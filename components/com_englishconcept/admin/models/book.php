<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 5/11/13
 * Time: 4:12 PM
 * To change this template use File | Settings | File Templates.
 */
// no direct access
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptModelBook extends JModelAdmin
{
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_englishconcept.book',
			'book',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	public function getTable($name = 'book', $prefix = 'EnglishConceptTable', $options = array())
	{
		return parent::getTable($name, $prefix, $options);
	}
}
