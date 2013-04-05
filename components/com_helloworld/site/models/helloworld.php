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
	protected $msg;

	public function getMsg()
	{
		if(!isset($this->msg))
		{

			$id = JFactory::getApplication()->input->get('id', 1, 'INT' );
			switch($id)
			{
				case 2:
					$this->msg = "Good bye World";
					break;
				case 1:
				default:
					$this->msg = "Hello world from request in menu type";
					break;
			}
		}
		return $this->msg;
	}
}
?>