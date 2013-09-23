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
class PlgRsfieldJoomla extends RedsourcePluginField
{
	/**
	 * Name of the plugin
	 */
	protected $_name = 'joomla';

	protected $types = array(
		'accesslevel'      => 1,
		'cachehandler'     => 1,
		'calendar'         => 1,
		'category'         => 1,
		'checkbox'         => 1,
		'checkboxes'       => 1,
		'contentlanguages' => 1,
		'contenttype'      => 1,
		'editor'           => 1,
		'email'            => 1,
		'file'             => 1,
		'filelist'         => 1,
		'folderlist'       => 1,
		'groupedlist'      => 1,
		'headertag'        => 1,
		'hidden'           => 1,
		'imagelist'        => 1,
		'integer'          => 1,
		'language'         => 1,
		'list'             => 1,
		'media'            => 1,
		'note'             => 1,
		'password'         => 1,
		'radio'            => 1,
		'spacer'           => 1,
		'sql'              => 1,
		'tag'              => 1,
		'tel'              => 1,
		'text'             => 1,
		'textarea'         => 1,
		'timezone'         => 1,
		'url'              => 1,
		'user'             => 1,
		'usergroup'        => 1
	);

	/**
	 * Event to get all supported field types.
	 *
	 * @param   array  &$types  List of field type names.
	 *
	 * @return  void
	 */
	public function onGetFieldTypesList(array &$types)
	{
		$types = array_merge($types, $this->getEnabled());
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
		$types = array_intersect($types, $this->getEnabled());

		foreach ($types as $type)
		{
			$class = 'RedsourceField' . ucfirst($type);
			$objects[$type] = new $class;
		}
	}

	/**
	 * function to get the plugin parameters
	 *
	 * @return  JRegistry  The plugin parameters object
	 */
	protected function getParams()
	{
		if (is_null($this->params))
		{
			$plugin = JPluginHelper::getPlugin($this->_type, $this->_name);
			$this->params = new JRegistry($this->types);
			$this->params->loadString($plugin->params);
		}

		return $this->params;
	}

	/**
	 * function to get the plugin parameters
	 *
	 * @return  array  Array of field names
	 */
	protected function getEnabled()
	{
		$list = array();
		$params = $this->getParams();

		foreach ($params->toArray() as $param => $value)
		{
			if (!$value)
			{
				continue;
			}

			$list[] = $param;
		}

		return $list;
	}

	/**
	 * Called before a JForm is rendered. It can be used to modify the JForm object in memory before rendering.
	 *
	 * @param   JForm  $form  The form to be altered.
	 * @param   array  $data  The associated data for the form.
	 *
	 * @return	boolean
	 */
	public function onContentPrepareForm($form, $data)
	{
		if (!($form instanceof JForm))
		{
			$this->_subject->setError('JERROR_NOT_A_FORM');

			return false;
		}

		// Check we are manipulating a valid form.
		$name = $form->getName();

		if (strpos($name, 'com_redsource.edit.field.') !== 0)
		{
			return true;
		}

		// Add the extra fields to the form.
		$type = 'text';

		if ($type)
		{
			// Loading file may fail, but that's ok.
			JForm::addFormPath(__DIR__ . '/forms');
			$form->loadFile('rsfield_' . $type, false);
		}

		$form->removeField('translate_label');
		$form->removeField('translate_description');

		return true;
	}
}
