<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2012 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * Custom script to hook into installation process
 *
 */
class pkg_solidresInstallerScript {

	function install($parent) {
		//echo '<p>'. JText::_('1.6 Custom install script') . '</p>';
	}

	function uninstall($parent) {
		//echo '<p>'. JText::_('1.6 Custom uninstall script') .'</p>';

		JFactory::getApplication()->enqueueMessage('You should uninstall *Solidres full package* to completely remove Solidres', '');
	}

	function update($parent) {
		//echo '<p>'. JText::_('1.6 Custom update script') .'</p>';
	}

	function preflight($type, $parent) {
		//echo '<p>'. JText::sprintf('1.6 Preflight for %s', $type) .'</p>';
	}

	function postflight($type, $parent, $results) {

	}
}