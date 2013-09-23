<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Fields
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the available form field types.
 *
 * @package     Redsource.Admin
 * @subpackage  Fields
 * @since       1.0
 */
class JFormFieldFieldType extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	protected $type = 'FieldType';

	/**
	 * Method to get a list of field types available
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   1.0
	 */
	protected function getOptions()
	{
		$options = array();
		$types = array();

		JPluginHelper::importPlugin('rsfield');

		$dispatcher = RFactory::getDispatcher();
		$dispatcher->trigger('onGetFieldTypesList', array($types));

		if (!empty($types))
		{
			foreach ($types as $type)
			{
				$text = JText::_('PLG_RSFIELD_TYPE_' . strtoupper($type));
				$options[$text] = JHtml::_('select.option', $type, $text);
			}
		}

		ksort($options);

		return array_merge(parent::getOptions(), $options);
	}
}
