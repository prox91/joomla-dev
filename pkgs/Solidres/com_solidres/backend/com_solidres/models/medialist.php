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
 * Media model
 *
 * @package     Solidres
 * @subpackage	Media
 * @since		0.1.0
 */
class SolidresModelMediaList extends JModelList {

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
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$this->setState('list.limit', 10);
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   12.2
	 */
	protected function getStoreId($id = '')
	{
		// Add the list state to the store id.
		$id .= ':' . $this->getState('filter.reservation_asset_id');
		$id .= ':' . $this->getState('filter.room_type_id');

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
		$db	= $this->getDbo();
		$query = $db->getQuery(true);

		$query->select( $this->getState( 'list.select', 'a.*' ));

		$query->from($db->quoteName('#__sr_media').' AS a');

		$filterReservationAssetId = $this->getState('filter.reservation_asset_id');

		if (is_numeric($filterReservationAssetId))
		{
			$query->select('x.weight as weight');
			$query->join('left', $db->quoteName('#__sr_media_reservation_assets_xref').'as x ON a.id = x.media_id');
			$query->where('x.reservation_asset_id = '.$db->quote($filterReservationAssetId));
			$query->order('x.weight ASC');
		}

		$filterRoomTypeId = $this->getState('filter.room_type_id');

		if (is_numeric($filterRoomTypeId))
		{
			$query->select('x.weight as weight');
			$query->join('left', $db->quoteName('#__sr_media_roomtype_xref').'as x ON a.id = x.media_id');
			$query->where('x.room_type_id = '.$db->quote($filterRoomTypeId));
			$query->order('x.weight ASC');
		}

		return $query;
	}
}
