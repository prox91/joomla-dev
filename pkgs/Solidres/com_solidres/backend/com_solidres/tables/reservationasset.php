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
 * Reservation Asset table
 *
 * @package     Solidres
 * @subpackage	ReservationAsset
 * @since		0.1.0
 */
class SolidresTableReservationAsset extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__sr_reservation_assets', 'id', $_db);
	}

	/**
	 * Overloaded check function
	 *
	 * @return boolean
	 * @see JTable::check
	 * @since 1.5
	 */
	public function check()
	{
		// Check to make sure that only 1 default reservation asset
		if ($this->default == 1)
		{
			$dbo = JFactory::getDbo();
			$query = $dbo->getQuery(true);
			$query->select('count(*)')
				  ->from($dbo->quoteName('#__sr_reservation_assets'))
				  ->where($dbo->quoteName('default').' = 1 AND id != '. (int) $this->id);
			$dbo->setQuery($query);

			if ($dbo->loadResult() >= 1)
			{
				$this->setError(JText::_('SR_ERROR_ONLY_ONE_DEFAULT_RESERVATION_ASSET'));
				return false;
			}
		}
		
		return true;
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param	array		$array Named array
	 * @param   string 		$ignore
	 * @return	null|string	null is operation was satisfactory, otherwise returns an error
	 * @see		JTable:bind
	 * @since	1.5
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
        {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = (string)$registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
        {
			$registry = new JRegistry();
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string)$registry;
		}
		
		if(!isset($array['lat']) && !isset($array['lng']))
		{
			$options = array(0 => $array['address_1'], 
							 1 => $array['city'], 
							 2 => isset($array['geo_state_id'])? $array['geo_state_id'] : null, 
							 3 => $array['country_id']);
			$coords = SRFactory::getGeoCoder($options)->process();
	
			if(is_array($coords))
			{
				$array['lat'] = $coords['lat'];
				$array['lng'] = $coords['lng'];
			}
			
		}
		
		// Bind the rules.
		if (isset($array['rules']) && is_array($array['rules'])) {
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		}
		return parent::bind($array, $ignore);
	}
	
	/**
	 * Method to delete a row from the database table by primary key value.
	 *
	 * @param	mixed	$pk An optional primary key value to delete.  If not set the
	 *					instance property value is used.
	 * @return	boolean	True on success.
	 * @since	1.0
	 * @link	http://docs.joomla.org/JTable/delete
	 */
	public function delete($pk = null)
	{
		JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/models', 'SolidresModel');

		// Check to see if it contains any Room Types, if yes then notify user to delete all of its Room Type first
		$query = $this->_db->getQuery(true);
		$query->select('name')->from($this->_db->quoteName('#__sr_reservation_assets'))->where('id = '.$pk);
		$this->_db->setQuery($query);
		$assetName = $this->_db->loadResult();
		
		$query->clear();
		$query->select('COUNT(id)')->from($this->_db->quoteName('#__sr_room_types'))->where('reservation_asset_id = '.$pk);
		$this->_db->setQuery($query);
		$result = (int) $this->_db->loadResult();
		if($result > 0)
		{
			$e = new JException(JText::sprintf('SR_ERROR_RESERVATION_CONTAIN_ROOM_TYPE', $assetName));
			$this->setError($e);
			return false;
		}
		
		// Take care of Reservation
		$query->clear();
		$query->update($this->_db->quoteName('#__sr_reservations'))
			  ->set($this->_db->quoteName('reservation_asset_id') . ' = NULL')
			  ->where($this->_db->quoteName('reservation_asset_id') .' = '.(int) $pk );
		$this->_db->setQuery($query)->execute();

		// Take care of media, if it has any, remove all of them
		$query->clear();
		$query->delete('')->from($this->_db->quoteName('#__sr_media_reservation_assets_xref'))->where('reservation_asset_id = '.$pk);
		$this->_db->setQuery($query)->execute();

		// Take care of Extra
		$extrasModel = JModelLegacy::getInstance('Extras', 'SolidresModel', array('ignore_request' => true));
		$extraModel = JModelLegacy::getInstance('Extra', 'SolidresModel', array('ignore_request' => true));
		$extrasModel->setState('filter.reservation_asset_id', $pk);
		$extras = $extrasModel->getItems();

		foreach ($extras as $extra)
		{
			$extraModel->delete($extra->id);
		}

		// Take care of Coupon
		$couponsModel = JModelLegacy::getInstance('Coupons', 'SolidresModel', array('ignore_request' => true));
		$couponModel = JModelLegacy::getInstance('Coupon', 'SolidresModel', array('ignore_request' => true));
		$couponsModel->setState('filter.reservation_asset_id', $pk);
		$coupons = $couponsModel->getItems();

		foreach ($coupons as $coupon)
		{
			$couponModel->delete($coupon->id);
		}

		// Take care of Custom Fields
		$query->clear();
		$query->delete('')->from($this->_db->quoteName('#__sr_reservation_asset_fields'))->where('reservation_asset_id = '.$pk);
		$this->_db->setQuery($query)->execute();

		// Delete itself, finally
		return parent::delete($pk);
	}

	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param	mixed	$pks An optional array of primary key values to update.  If not
	 *					set the instance property value is used.
	 * @param	integer $state The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param	integer $userId The user id of the user performing the operation.
	 * @return	boolean	True on success.
	 * @since	1.0.4
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k) {
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k.'='.implode(' OR '.$k.'=', $pks);

		// Determine if there is checkin support for the table.
		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time')) {
			$checkin = '';
		}
		else {
			$checkin = ' AND (checked_out = 0 OR checked_out = '.(int) $userId.')';
		}

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE `'.$this->_tbl.'`' .
			' SET state = '.(int) $state .
			' WHERE ('.$where.')' .
			$checkin
		);
		$this->_db->execute();

		// Check for a database error.
		if ($this->_db->getErrorNum()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin the rows.
			foreach($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks)) {
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}

	/**
	 * Method to compute the default name of the asset.
	 * The default name is in the form `table_name.id`
	 * where id is the value of the primary key of the table.
	 *
	 * @return	string
	 * @since	1.6
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_solidres.reservationasset.'.(int) $this->$k;
	}

	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return	string
	 * @since	1.6
	 */
	protected function _getAssetTitle()
	{
		return $this->name;
	}

	/**
	 * Get the parent asset id for the record
	 *
	 * @return	int
	 * @since	1.6
	 */
	protected function _getAssetParentId($table = null, $id = null)
	{
		// Initialise variables.
		$assetId = null;
		$db = $this->getDbo();

		// This is a reservation asset under a category.
		if ($this->category_id) {
			// Build the query to get the asset id for the parent category.
			$query	= $db->getQuery(true);
			$query->select('asset_id')->from($db->quoteName('#__sr_categories'))->where('id = '.(int) $this->category_id);

			// Get the asset id from the database.
			$this->_db->setQuery($query);
			if ($result = $this->_db->loadResult()) {
				$assetId = (int) $result;
			}
		}
		// This is an uncategorized article that needs to parent with the extension.
		elseif ($assetId === null) {
			// Build the query to get the asset id for the parent category.
			$query	= $db->getQuery(true);
			$query->select('id')->from($db->quoteName('#__assets'))->where('name = '.$db->quote('com_solidres'));

			// Get the asset id from the database.
			$this->_db->setQuery($query);
			if ($result = $this->_db->loadResult()) {
				$assetId = (int) $result;
			}
		}

		// Return the asset id.
		if ($assetId) {
			return $assetId;
		} else {
			return parent::_getAssetParentId($table, $id);
		}
	}
	/**
	 * Method to store a row in the database from the JTable instance properties.
	 * If a primary key value is set the row with that primary key value will be
	 * updated with the instance property values.  If no primary key value is set
	 * a new row will be inserted into the database with the properties from the
	 * JTable instance.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @link    http://docs.joomla.org/JTable/store
	 * @since   11.1
	 */
	public function store($updateNulls = false)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		if ($this->id)
		{
			// Existing item
			$this->modified_date = $date->toSql();
			$this->modified_by = $user->get('id');
		}
		else
		{
			// New article. An article created and created_by field can be set by the user,
			// so we don't touch either of these if they are set.
			if (!intval($this->created_date))
			{
				$this->created_date = $date->toSql();
			}

			if (empty($this->created_by))
			{
				$this->created_by = $user->get('id');
			}
		}
		// Initialise variables.
		$k = $this->_tbl_key;

		// The asset id field is managed privately by this class.
		if ($this->_trackAssets)
		{
			unset($this->asset_id);
		}

		// If a primary key exists update the object, otherwise insert it.
		if ($this->$k)
		{
			$this->_db->updateObject($this->_tbl, $this, $this->_tbl_key, $updateNulls);
		}
		else
		{
			$this->_db->insertObject($this->_tbl, $this, $this->_tbl_key);
		}

		// If the table is not set to track assets return true.
		if (!$this->_trackAssets)
		{
			return true;
		}

		if ($this->_locked)
		{
			$this->_unlock();
		}

		/*
		 * Asset Tracking
		 */

		$parentId = $this->_getAssetParentId();
		$name = $this->_getAssetName();
		$title = $this->_getAssetTitle();

		$asset = self::getInstance('Asset', 'JTable', array('dbo' => $this->getDbo()));
		$asset->loadByName($name);

		// Re-inject the asset id.
		$this->asset_id = $asset->id;

		// Check for an error.
		$error = $asset->getError();
		if ($error)
		{
			$this->setError($error);
			return false;
		}

		// Specify how a new or moved node asset is inserted into the tree.
		if (empty($this->asset_id) || $asset->parent_id != $parentId)
		{
			$asset->setLocation($parentId, 'last-child');
		}

		// Prepare the asset to be stored.
		$asset->parent_id = $parentId;
		$asset->name = $name;
		$asset->title = $title;

		// Custom fix to fix the NULL storage bug
		unset($asset->alias);

		if ($this->_rules instanceof JAccessRules)
		{
			$asset->rules = (string) $this->_rules;
		}
		else
		{
			$asset->rules = '{}';
		}

		if (!$asset->check() || !$asset->store($updateNulls))
		{
			$this->setError($asset->getError());
			return false;
		}

		if (empty($this->asset_id))
		{
			// Update the asset_id field in this table.
			$this->asset_id = (int) $asset->id;

			$query = $this->_db->getQuery(true);
			$query->update($this->_db->quoteName($this->_tbl));
			$query->set('asset_id = ' . (int) $this->asset_id);
			$query->where($this->_db->quoteName($k) . ' = ' . (int) $this->$k);
			$this->_db->setQuery($query);

			$this->_db->execute();
		}

		return true;
	}
}

