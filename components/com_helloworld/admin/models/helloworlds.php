<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 11:21 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// Import the Joomla modelist from library
jimport('legacy.model.list');

/**
 * Class HelloWorldModelHelloWorlds
 */
class HelloWorldModelHelloWorlds extends JModelList
{
	/**
	 * Method to build a sql to load the list data
	 *
	 * @return   string  An SQL query
	 */
	public function getListQuery()
	{
		// Create a new query object
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);

		// Select some field
		$query->select('id, greeting');
		// From the hello table
		$query->from('#__helloworld');

		return $query;
	}
}
?>