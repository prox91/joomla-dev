<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptModelCompositions extends JModelList
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
        $query->select($this->getState('list.select','cs.*, ls.title AS title'));

        // From the composition and lesson table
        $query->from('#__ec_lesson_compositions AS cs');
	    $query->leftJoin('#__ec_lessons ls ON ls.id = cs.lesson_id');
        $query->where('cs.deleted_flg = 0');

        return $query;
    }
}
