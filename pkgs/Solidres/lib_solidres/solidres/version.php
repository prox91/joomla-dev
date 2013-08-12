<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('JPATH_PLATFORM') or die;

/**
 * Version information class for the Solidres.
 *
 * @package  Solidres
 * @since    0.1.0
 */
final class SRVersion
{
	// Product name.
	const PRODUCT = 'Solidres';
	// Release version.
	const RELEASE = '0.4';
	// Maintenance version.
	const MAINTENANCE = '2';
	// Development STATUS.
	const STATUS = 'Beta';
	// Build number.
	const BUILD = 0;
	// Code name.
	const CODE_NAME = 'Gryllidae';
	// Release date.
	const RELEASE_DATE = '22-May-2013';
	// Release time.
	const RELEASE_TIME = '00:00';
	// Release timezone.
	const RELEASE_TIME_ZONE = 'GMT';
	// Copyright Notice.
	const COPYRIGHT = 'Copyright (C) 2013 Solidres. All rights reserved.';
	// Link text.
	const LINK_TEXT = '';

	/**
	 * Compares two a "PHP standardized" version number against the current Solidres version.
	 *
	 * @param   string  $minimum  The minimum version of the Solidres which is compatible.
	 *
	 * @return  boolean  True if the version is compatible.
	 *
	 * @see     http://www.php.net/version_compare
	 */
	public static function isCompatible($minimum)
	{
		return (version_compare(self::getShortVersion(), $minimum, 'eq') == 1);
	}

	/**
	 * Gets a "PHP standardized" version string
	 *
	 * @return  string  Version string.
	 *
	 * @since   0.1.0
	 */
	public static function getShortVersion()
	{
		return self::RELEASE . '.' . self::MAINTENANCE . '.' . self::STATUS;
	}

	/**
	 * Gets a version string for the current Solidres with all release information.
	 *
	 * @return  string  Complete version string.
	 *
	 * @since   0.1.0
	 */
	public static function getLongVersion()
	{
		return self::PRODUCT . ' ' . self::RELEASE . '.' . self::MAINTENANCE . ' ' . self::STATUS . ' [ ' . self::CODE_NAME . ' ] '
			. self::RELEASE_DATE . ' ' . self::RELEASE_TIME . ' ' . self::RELEASE_TIME_ZONE;
	}
}
