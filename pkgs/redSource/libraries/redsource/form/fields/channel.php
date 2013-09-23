<?php
/**
 * @package     Redsource.Libraries
 * @subpackage  Plugins
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('list');

/**
 * Field to load a list of available channels
 *
 * @package     Redsource.Libraries
 * @subpackage  Fields
 * @since       1.0
 */
class JFormFieldChannel extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var   string
	 */
	public $type = 'Channel';

	/**
	 * A static cache.
	 *
	 * @var   array
	 */
	protected $cache = array();

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 */
	protected function getOptions()
	{
		if (empty($this->cache))
		{
			$app = RFactory::getApplication();

			$options = array();

			$db = JFactory::getDbo();

			$query = $db->getQuery(true)
				->select('id as value, name as text')
				->from('#__redsource_channel');

			// Load specifc data channels?
			$states = $this->element['states'] ? $this->element['states'] : 1;

			if ($states !== null)
			{
				$states = explode(',', $states);
				JArrayHelper::toInteger($states);

				$query->where('state IN(' . implode(',', $states) . ')');
			}

			$db->setQuery($query);

			if ($options = $db->loadObjectList())
			{
				$options = array_merge(parent::getOptions(), $options);
			}

			$this->cache = $options;
		}

		return $this->cache;
	}
}
