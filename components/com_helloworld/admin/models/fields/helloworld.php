<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nha.redweb
 * Date: 4/5/13
 * Time: 10:31 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;

// Import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormlFieldHelloWorld extends JFormFieldList
{
	protected $type = "Hello World";

	protected function getOptions()
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);
		$query->select('id, greeting');
		$query->from('#__helloworld');
		$db->setQuery((string)$query);

		$messages = $db->loadObjectList();

		$options = array();
		if($messages)
		{
			foreach($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->greeting);
			}
		}
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}

?>