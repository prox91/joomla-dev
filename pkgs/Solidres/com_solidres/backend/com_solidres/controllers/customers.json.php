<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * Customer list controller class (JSON format).
 *
 * @package     Solidres
 * @subpackage	Customer
 * @since		0.1.0
 */
class SolidresControllerCustomers extends JControllerAdmin
{
	/**
     * Method to find customers based on customer code
     * Used with AJAX and JSON
     *
     * @return json object
     */
    public function find()
    {
        $customerCode 	= JFactory::getApplication()->input->get('term', '', 'string');
        $model = JModelLegacy::getInstance('Customers', 'SolidresModel', array('ignore_request' => true));
        $model->setState('list.select', 'a.id, CONCAT(u.name, " (", a.customer_code, " - " , g.name, ") ") as label, 
                                         CONCAT(u.name, " (", a.customer_code, " - " , g.name, ") ") as value');
        $model->setState('filter.customer_code', $customerCode );
        
        echo json_encode($model->getItems());
        die(1);
    }
}