<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die;

class OpenHrmModelStates extends RModelList
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
        $query->select($this->getState('list.select','s.*, c.name AS country_name'));

        $query->from('#__openhrm_states AS s')
              ->leftJoin('#__openhrm_countries AS c ON c.id = s.country_id');

        return $query;
    }
}
