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
 * Tariff model
 *
 * @package     Solidres
 * @subpackage	Tariff
 * @since		0.1.0
 */
class SolidresModelTariff extends JModelList
{
    /**
     * Constructor.
     *
     * @param	array	$config An optional associative array of configuration settings.
     * @see		JController
     * @since	1.6
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    /**
     * Method to get a store id based on the model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * Override the default function since we need to generate different store id for
     * different data set depended on room type id
     *
     * @see     \components\com_solidres\models\reservation.php (181 ~ 186)
     *
     * @param   string  $id  An identifier string to generate the store id.
     *
     * @return  string  A store id.
     *
     * @since   11.1
     */
    protected function getStoreId($id = '')
    {
        // Add the list state to the store id.
		$id .= ':' . $this->getState('filter.room_type_id');
		$id .= ':' . $this->getState('filter.bookday');
		$id .= ':' . $this->getState('filter.date_constraint');
		$id .= ':' . $this->getState('filter.default_price');

        return md5($this->context . ':' . $id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery()
    {
        $dbo = $this->getDbo();
        $query = $dbo->getQuery(true);
		$nullDate = $dbo->getNullDate();

        $query->select( $this->getState('list.select', 't.*' ));

        $query->from($dbo->quoteName('#__sr_prices').' AS t');

        if ($room_type_id = $this->getState('filter.room_type_id'))
        {
            $query->where('t.room_type_id = '.(int) $room_type_id);
        }

		$customer_group_id = $this->getState('filter.customer_group_id');
        $query->where('t.customer_group_id '.($customer_group_id === NULL ? 'IS NULL' : '= ' .(int) $customer_group_id));

        if ($date_constraint = $this->getState('filter.date_constraint'))
        {
			$query->where('t.valid_from <= '.$dbo->quote($this->getState('filter.bookday'))) ;
			$query->where('t.valid_to >= '.$dbo->quote($this->getState('filter.bookday')));
        }

		/* Get the default (fixed) price. Default price is a price which has no date constraint and
		   is available for all customer group */
		if ($defaultPrice = $this->getState('filter.default_price'))
		{
			$query->where('t.valid_from = '.$dbo->quote($nullDate) ) ;
			$query->where('t.valid_to = '.$dbo->quote($nullDate) );
		}
        
        return $query;
    }
}
