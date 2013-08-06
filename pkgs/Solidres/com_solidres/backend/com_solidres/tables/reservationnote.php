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
 * ReservationNote table
 *
 * @package     Solidres
 * @subpackage	ReservationNote
 * @since		    0.3.0
 */
class SolidresTableReservationNote extends JTable
{
  	function __construct(&$_db)
  	{
  		parent::__construct('#__sr_reservation_notes', 'id', $_db);
  	}
}

