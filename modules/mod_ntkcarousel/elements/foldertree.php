<?php
/**
 * @package     Mod_NtkCarousel.Frontend
 * @subpackage  mod_nktcarousel
 *
 * @copyright   Copyright (C) 2013 ntksoft.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('JPATH_BASE') or die();
jimport('joomla.form.formfield');
jimport( 'joomla.filesystem.folder' );

class JFormFieldFolderTree extends JFormField
{
	protected $type = 'FolderTree';

	protected function getInput()
	{
		$options = array();
		// path to images directory
		$path		= JPATH_ROOT."/".$this->element['directory'];
		$filter		= $this->element['filter'];
		$folders	= JFolder::listFolderTree($path, $filter);

		foreach ($folders as $folder)
		{
			$options[] = JHtml::_('select.option', str_replace("/","/",$folder['relname']), str_replace("/","/",substr($folder['relname'], 1)));
		}
		return JHtml::_('select.genericlist', $options, $this->name, '', 'value', 'text', $this->value);
	}
}
