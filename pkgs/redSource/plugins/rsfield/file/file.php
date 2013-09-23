<?php
/**
 * @package     Redsource.Plugins
 * @subpackage  Rsfield
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('JPATH_BASE') or die;

/**
 * File field type plugin for redSOURCE
 *
 * @package     Redsource.Plugin
 * @subpackage  Rsfield
 * @since       1.0
 */
class PlgRsfieldFile extends RedsourcePluginField
{
	/**
	 * Name of the plugin
	 */
	protected $_name = 'file';

	/**
	 * Event to get all supported field types.
	 *
	 * @param   array  &$types  List of field type names.
	 *
	 * @return  void
	 */
	public function onGetFieldTypesList(array &$types)
	{
		$types[] = $this->_name;
	}

	/**
	 * Event to load a data channel
	 *
	 * @param   array  &$objects  Array to fill with field type objects.
	 * @param   array  $types     Type of fields to load
	 *
	 * @return  void
	 */
	public function onGetFieldTypes(array &$objects, array $types = array())
	{
		if (!in_array($this->_name, $types))
		{
			return;
		}

		$class = 'RedsourceField' . ucfirst($this->_name);
		$objects[$this->_name] = new $class;
	}
}
