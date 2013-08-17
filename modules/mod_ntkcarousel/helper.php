<?php
/**
 * @package     Mod_NtkCarousel.Frontend
 * @subpackage  mod_nktcarousel
 *
 * @copyright   Copyright (C) 2013 ntksoft.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Module NtkCarousel Helper.
 *
 * @package     Mod_NtkCarousel.Frontend
 * @subpackage  Modules
 * @since       1.0
 */
class modNtkCarouselHelper
{
	public static function getImageList($params = array())
	{
		jimport( 'joomla.filesystem.folder' );
		$filter = '\.png$|\.gif$|\.jpg$|\.jpeg$|\.bmp$';
		$path		= $params->get('path');
		$files 		= JFolder::files(JPATH_BASE.$path,$filter);

		$i=0;
		$lists = array();
		foreach ($files as $file) {
			$lists[$i] = new stdClass;
			$lists[$i]->image	= JURI::base().str_replace('\\','/',substr($path,1)).'/'.$file;
			$lists[$i]->link	= 'javascript:;';
			$i++;
		}
		return $lists;
	}
}
