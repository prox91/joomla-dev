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

require __DIR__.'/liveupdate.php';

class SolidresLiveUpdate extends LiveUpdate
{
	/**
	 * Loads the translation strings -- this is an internal function, called automatically
	 */
	private static function loadLanguage()
	{
		// Load translations
		$basePath = dirname(__FILE__);
		$jlang = JFactory::getLanguage();
		$jlang->load('liveupdate', $basePath, 'en-GB', true); // Load English (British)
		$jlang->load('liveupdate', $basePath, $jlang->getDefault(), true); // Load the site's default language
		$jlang->load('liveupdate', $basePath, null, true); // Load the currently selected language
	}

	public static function getIcon($config=array())
	{
		// Load language strings
		self::loadLanguage();

		// Initialize the array of button options
		$button = array();

		$defaultConfig = array(
			'option'			=> JRequest::getCmd('option',''),
			'view'				=> 'liveupdate',
			'mediaurl'			=> JURI::base().'components/'.JRequest::getCmd('option','').'/liveupdate/assets/'
		);
		$c = array_merge($defaultConfig, $config);

		$button['link'] = 'index.php?option='.$c['option'].'&view='.$c['view'];
		$button['image'] = $c['mediaurl'];

		$updateInfo = self::getUpdateInformation();
		if(!$updateInfo->supported) {
			// Unsupported
			$button['parent_class'] = 'liveupdate-notsupported';
			$button['class'] = 'liveupdate-icon-notsupported';
			$button['image'] .= 'nosupport-32.png';
			$button['text'] = JText::_('LIVEUPDATE_ICON_UNSUPPORTED');
		} elseif($updateInfo->stuck) {
			// Stuck
			$button['parent_class'] = 'liveupdate-crashed';
			$button['class'] = 'liveupdate-icon-crashed';
			$button['image'] .= 'nosupport-32.png';
			$button['text'] = JText::_('LIVEUPDATE_ICON_CRASHED');
		} elseif($updateInfo->hasUpdates) {
			// Has updates
			$button['parent_class'] = 'liveupdate-hasupdates';
			$button['class'] = 'icon-download';
			$button['image'] .= 'update-32.png';
			$button['text'] = JText::_('SRLIVEUPDATE_HAS_UPDATES');
		} else {
			// Already in the latest release
			$button['parent_class'] = 'liveupdate-noupdates';
			$button['class'] = 'icon-checkmark';
			$button['image'] .= 'current-32.png';
			$button['text'] = JText::_('LIVEUPDATE_ICON_CURRENT');
		}
		if(version_compare(JVERSION, '2.5', 'ge')) {
			return '<div class="'.$button['parent_class'].'">
						<a href="'.$button['link'].'">'.
							'<i class="'.$button['class'].'"></i> '.
							 $button['text'].
						'</a></div>';
		} else {
			return '';
		}
	}
}