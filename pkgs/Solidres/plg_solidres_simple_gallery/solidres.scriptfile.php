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
 * Custom script to hook into installation process
 */
class plgSolidresSimple_GalleryInstallerScript
{
	function install($parent)
	{
		// Copy files in case of fresh installation
		$source = $parent->getParent()->getPath('source');
		JFolder::copy($source . '/components/', JPATH_SITE . '/components/', '', true);
	}

	function uninstall($parent)
	{
		if (file_exists(JPATH_SITE . '/components/com_solidres/views/reservationasset/tmpl/default_simple_gallery.php'))
		{
			JFile::delete(JPATH_SITE . '/components/com_solidres/views/reservationasset/tmpl/default_simple_gallery.php');
		}
	}

	function update($parent)
	{
		// Copy files in case of update
		$source = $parent->getParent()->getPath('source');
		JFolder::copy($source . '/components/', JPATH_SITE . '/components/', '', true);
	}

	function preflight($type, $parent)
	{
	}

	function postflight($type, $parent)
	{
	}
}