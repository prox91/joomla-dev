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
 *
 */
class plgSystemSolidresInstallerScript {

	function install($parent) {
		//echo '<p>'. JText::_('1.6 Custom install script') . '</p>';
	}

	function uninstall($parent) {
		//echo '<p>'. JText::_('1.6 Custom uninstall script') .'</p>';
	}

	function update($parent) {
		//echo '<p>'. JText::_('1.6 Custom update script') .'</p>';
	}

	function preflight($type, $parent) {
		//echo '<p>'. JText::sprintf('1.6 Preflight for %s', $type) .'</p>';
	}

	function postflight($type, $parent) {
		echo '<p>'. JText::_('Solidres - System plugin is installed successfully.') .'</p>';
			
		$dbo = JFactory::getDbo();
		
		$query = $dbo->getQuery(true);
		
		$query->clear();
		$query->update($dbo->quoteName('#__extensions'));
		$query->set('enabled = 1');
		$query->where("element = 'solidres'");
		$query->where("type = 'plugin'");
		$query->where("folder = 'system'");

		$dbo->setQuery($query);
		
		$result = $dbo->execute();
		if(!$result) {
			JError::raiseWarning(-1, 'plgSystemSolidres: publishing failed');
		} else {
			echo '<p>'. JText::_('Solidres - System plugin is published successfully.') .'</p>';
		}
	}
}