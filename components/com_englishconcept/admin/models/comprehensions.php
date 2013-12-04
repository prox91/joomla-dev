<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptModelComprehensions extends JModelList
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
        $query->select($this->getState('list.select','cp.*, ls.title AS name, ls.lesson_no AS lesson_no'));

        // From the comprehension and lesson table
        $query->from('#__ec_lessons_comprehensions AS cp');
	    $query->leftJoin('#__ec_lessons ls ON ls.id = cp.lesson_id');
        $query->where('cp.deleted_flg = 0');

        return $query;
    }
}
