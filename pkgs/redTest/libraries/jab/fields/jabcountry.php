<?php
/**
 * @package     Jab.Libraries
 * @subpackage  Fields
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JLoader::import('joomla.form.formfield');

JFormHelper::loadFieldClass('list');

/**
 * Country select list for JAB
 *
 * @package     Jab.Admin
 * @subpackage  Controllers
 *
 * @since       1.0
 */
class JFormFieldJabCountry extends JFormFieldList
{

	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	2.5
	 */
	protected $type = 'Jabcountry';

	/**
	 * Get the select options
	 *
	 * @return  array  Options to populate the select field
	 */
	public function getOptions()
	{
		// Initialize variables.
		$options = array();

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id as value, name as text')
			->from('#__jab_countries')
			->where('published = 1');
		$db->setQuery($query);

		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			throw new Exception($e->getMessage());
		}

		// Get other options inserted in the XML file
		$parentOptions = parent::getOptions();

		return array_merge($parentOptions, $options);
	}
}
