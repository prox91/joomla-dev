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
 * Solidres Component Model
 *
 * @package		Reservation
 * @since		0.1.0
 */
class SolidresModelMap extends JModelLegacy
{
	public function getMapInfo()
	{
		JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables', 'SolidresTable');
		$assetTable = JTable::getInstance('ReservationAsset', 'SolidresTable');
		$assetTable->load($this->getState($this->getName().'.assetId'));

		return $assetTable;
	}
}