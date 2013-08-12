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

JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/models', 'SolidresModel');

/**
 * Solidres Helper class
 *
 * @since		0.1.0
 */
class SolidresHelper {
	
	public static $extention = 'com_solidres';

	/**
	 * Gets a list of the actions that can be performed
	 *
	 * @param	int	$categoryId 			The category ID.
	 * @param   int $reservation_asset_id 	The reservation asset_id
	 * @return	JObject
	 */
	public static function getActions($categoryId = 0, $reservation_asset_id = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($reservation_asset_id) && empty($categoryId))
        {
			$assetName = 'com_solidres';
		}
		else if (empty($reservation_asset_id) && !empty($categoryId))
        {
			$assetName = 'com_solidres.category.'.(int) $categoryId;
		}
		else if (!empty($reservation_asset_id) && empty($categoryId))
        {
			$assetName = 'com_solidres.reservationasset.'.(int) $reservation_asset_id;
		}

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
        {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
	
	public static function getCouponOptions()
	{
		$options 	= array();
		$model      = JModelLegacy::getInstance('Coupons', 'SolidresModel', array('ignore_request' => true));
		$model->setState('filter.state', 1);
        $results 	= $model->getItems();
		$options[] 	= JHTML::_('select.option', '', JText::_('- Select a coupon -') );
		
		if (!empty($results))
        {
			foreach($results as $item)
            {
				$options[] = JHTML::_('select.option', $item->id, $item->coupon_name);
			}
		}
		
		return $options;
	}
	
	/**
	 * Get list currency option
     * 
     * @return string
	 */
	public static function getCurrencyOptions()
	{
		$options 	= array();
        $model      = JModelLegacy::getInstance('Currencies', 'SolidresModel', array('ignore_request' => true));

        $model->setState('filter.state', 1);
        $model->setState('list.ordering', 'u.currency_name');
		$results 	= $model->getItems();
		
		if (!empty($results))
        {
			foreach($results as $item)
            {
				$options[] = JHTML::_('select.option', $item->id, $item->currency_name);
			}
		}
		
		return $options;
	}

    /**
	 * Get list currency option
	 *
     * @return string
	 */
	public static function getCustomerGroupOptions()
	{
		$options 	= array();
        $model = JModelLegacy::getInstance('CustomerGroups', 'SolidresModel', array('ignore_request' => true));
        $model->setState('list.start', 0);
        $model->setState('list.limit', 0);
        $model->setState('filter.state', 1);
        $model->setState('list.ordering', 'a.name');
        $results = $model->getItems();

		$options[] = JHTML::_('select.option', NULL, JText::_('SR_GENERAL_CUSTOMER_GROUP'));

		if (!empty($results))
        {
			foreach($results as $item)
            {
				$options[] = JHTML::_('select.option', $item->id, $item->name);
			}
		}

		return $options;
	}

	/**
	 * Get category <option> to build <select>
	 * 
	 * @param int $currentId The ID of category that is editing
	 * @see /administrator/components/com_solidres/models/fields/categories.php
	 * 
	 * @return array $option The array of all <option>
	 */
	public static function getCategoryOptions($currentId = 0)
	{
		$options 	= array();
		$categoriesModel = JModelLegacy::getInstance('Categories', 'SolidresModel', array('ignore_request' => true));
		$categoriesModel->setState('list.start', 0);
		$categoriesModel->setState('list.limit', 0);
		$categoriesModel->setState('filter.state', 1);
		$categoriesModel->setState('list.ordering', 'c.lft');
		$results 		= $categoriesModel->getItems();
		
		if (!empty($results))
        {
			foreach($results as $item)
            {
				// if we are editing a category, hide it in the parent_id category select list except root category case
				if($currentId > 0 && $item->id == $currentId)
                {
					$options[] = JHTML::_('select.option', $item->id, str_repeat(' - ', $item->depth).$item->title, 'value', 'text', true );
				}
                else
                {
					$options[] = JHTML::_('select.option', $item->id, str_repeat(' - ', $item->depth).$item->title, 'value', 'text', false );
				}
			}
		}
		return $options;
	}
	
	/**
	 * Get asset <option> to build <select>
	 * 
	 * @return array $options An array of <option>
	 */
	public static function getReservationAssetOptions()
	{
		// TODO need to check for ACL when retrieving list here
		$options 	= array();
		$raModel = JModelLegacy::getInstance('ReservationAssets', 'SolidresModel', array('ignore_request' => true));
		$raModel->setState('list.start', 0);
		$raModel->setState('list.limit', 0);
		$raModel->setState('filter.state', 1);
		$raModel->setState('list.ordering', 'a.name');

		$results 		= $raModel->getItems();

		$options[] = JHTML::_('select.option', '', '&nbsp;' );

		if (!empty($results))
        {
			foreach($results as $item)
            {
				$options[] = JHTML::_('select.option', $item->id, $item->name );
			}
		}
		return $options;
	}

	/**
	 * Get country select <option>
	 * 
	 * @return array $option An array of country <option>
	 */
	public static function getCountryOptions()
	{
		$options 		= array();
		$countriesModel = JModelLegacy::getInstance('Countries', 'SolidresModel', array('ignore_request' => true));

		$countriesModel->setState('list.start', 0);
		$countriesModel->setState('list.limit', 0);
		$countriesModel->setState('filter.state', 1);
		$countriesModel->setState('list.ordering', 'r.name');
		$results 		= $countriesModel->getItems();

		$options[] = JHTML::_('select.option', '', '&nbsp;' );
		
		if (!empty($results))
        {
			foreach($results as $item)
            {
				$options[] = JHTML::_('select.option', $item->id, $item->name );
			}
		}
		
		return $options;
	}

	public static function getTaxOptions()
	{
		$options 		= array();
		$model = JModelLegacy::getInstance('Taxes', 'SolidresModel', array('ignore_request' => true));

		$model->setState('list.start', 0);
		$model->setState('list.limit', 0);
		$model->setState('filter.state', 1);
		$model->setState('list.ordering', 'r.name');
		$results = $model->getItems();

		$options[] = JHTML::_('select.option', '', '&nbsp;' );

		if (!empty($results))
		{
			foreach($results as $item)
			{
				$options[] = JHTML::_('select.option', $item->id, $item->name );
			}
		}

		return $options;
	}

	/**
	 * Get all state of a specific country
	 * 
	 * @param 	int 	$country_id The country ID
	 * @return 	array 	An array of country <option> 
	 */
	public static function getGeoStateOptions($country_id)
	{
		$options 		= array();
		$geoStatesModel = JModelLegacy::getInstance('States', 'SolidresModel', array('ignore_request' => true));
		$geoStatesModel->setState('list.start', 0);
		$geoStatesModel->setState('list.limit', 0);
		$geoStatesModel->setState('filter.state', 1);
		$geoStatesModel->setState('list.ordering', 'name');

		if ($country_id > 1)
		{
			$geoStatesModel->setState('filter.country', $country_id);
		}

		$results 		= $geoStatesModel->getItems();

		if (!empty($results))
        {
            $options[] = JHTML::_('select.option', NULL, JText::_('SR_SELECT') );
			foreach($results as $item)
            {
				$options[] = JHTML::_('select.option', $item->id, $item->name );
			}
		}
		return $options;
	}

	public static function getGalleryOptions()
	{
		$dbo = JFactory::getDbo();
		$options 		= array();
		$query = $dbo->getQuery(true);
		$query->select('*')
			->from($dbo->quoteName('#__extensions'))
			->where($dbo->quoteName('folder') .' = '.$dbo->quote('solidres'))
			->where($dbo->quoteName('element') .' LIKE '.$dbo->quote('%gallery%'));

		$dbo->setQuery($query);

		$results = $dbo->loadObjectList();

		if (!empty($results))
		{
			$options[] = JHTML::_('select.option', NULL, JText::_('SR_SELECT_DEFAULT_GALLERY') );
			foreach($results as $item)
			{
				$options[] = JHTML::_('select.option', $item->element, $item->name );
			}
		}
		return $options;
	}
}