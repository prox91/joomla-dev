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
 * Checkboxes field
 *
 * @package     Redsource.Libraries
 * @subpackage  Field
 * @since       1.0
 */
class RedsourceFieldCheckboxes extends RedsourceField
{
	/**
	 * Type of the field. Unique string
	 *
	 * @var  string
	 */
	protected $type = 'checkboxes';

	/**
	 * Form field attributes.
	 *
	 * @var array
	 */
	protected $fieldProperties = array(
		'name'
	);
}
