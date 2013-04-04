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
			$this->msg = "Hello World From Model";
		}
		return $this->msg;
	}
}
?>