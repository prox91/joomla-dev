<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nha.redweb
 * Date: 4/5/13
 * Time: 11:27 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Helloworld class table
 */
class HelloWorldTableHelloWorld extends JTable
{
	/**
	 * Constructor
	 */
	function __construct(&$db)
	{
		parent::__construct('#__helloworld', 'id', $db);
	}
}