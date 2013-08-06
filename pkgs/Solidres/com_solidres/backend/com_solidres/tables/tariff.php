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
 * Tariff table
 *
 * @package     Solidres
 * @subpackage	Tariff
 * @since		0.1.0
 */
class SolidresTableTariff extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__sr_prices', 'id', $_db);
	}
}

