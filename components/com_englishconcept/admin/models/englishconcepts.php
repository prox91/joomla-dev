<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 5/11/13
 * Time: 4:12 PM
 * To change this template use File | Settings | File Templates.
 */
// no direct access
defined('_JEXEC') or die;

class EnglishConceptModelEnglishConcepts extends JModelList
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
		$query->select($this->getState('list.select','l.*'));

		// From the hello table
		$query->from('#__lesson AS l');
		$query->where('l.del_flg = 0');

		return $query;
	}
}
