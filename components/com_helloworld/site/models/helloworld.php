<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/4/13
 * Time: 11:52 PM
 * To change this template use File | Settings | File Templates.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('legacy.model.item');

class HelloWorldModelHelloWorld extends JModelItem
{
	/**
	 * @var array messages
	 */
	protected $messages;

	public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getMsg()
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}

		if(!isset($this->msg))
		{

			$id = JFactory::getApplication()->input->get('id', 1, 'INT' );

			$table = $this->getTable();
			$table->load($id);

			// Assign the message
			$this->messages[$id] = $table->greeting;
		}
		return $this->messages[$id];
	}
}
?>