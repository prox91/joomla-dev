<?php
/**
 * @package     Redsource.Libraries
 * @subpackage  Field
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Textarea field.
 *
 * @package     Redsource.Libraries
 * @subpackage  Field
 * @since       1.0
 */
class RedsourceFieldTextarea extends RedsourceField
{
	/**
	 * Type of the field. Unique string
	 *
	 * @var  string
	 */
	protected $type = 'textarea';

	/**
	 * Form field attributes.
	 *
	 * @var array
	 */
	protected $fieldProperties = array(
		'name', 'label', 'rows', 'cols', 'default', 'description', 'class', 'filter'
	);

	/**
	 * Attach element into the form.
	 *
	 * @param  JForm  $form
	 * @param  array  $data
	 * @param  string $group
	 * @param  bool   $replace
	 *
	 * @throws  RuntimeException
	 */
	public function setField(JForm $form, array $data, $group = null, $replace = true)
	{
		if (!isset($data['rows'], $data['cols']))
		{
			throw new RuntimeException("Internal error: Data field requires mandatory 'rows' and 'cols' attributes.");
		}
		parent::setField($form, $data, $group, $replace);
	}
}
