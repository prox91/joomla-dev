<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptModelPrecises extends JModelList
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
        $query->select($this->getState('list.select','pr.*, ls.title AS title'));

        // From the precies and lesson table
        $query->from('#__ec_lessons_precises AS pr');
	    $query->leftJoin('#__ec_lessons ls ON ls.id = pr.lesson_id');
        $query->where('pr.deleted_flg = 0');

        return $query;
    }
}
