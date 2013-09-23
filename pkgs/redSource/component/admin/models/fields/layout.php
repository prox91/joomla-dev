<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Fields
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Form Field class for the subscriptions.
 */
class JFormFieldLayout extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	protected $type = 'layout';

	/**
	 * @see JFormField::getLabel()
	 */
	protected function getLabel()
	{
		return $this->element['label'] ? parent::getLabel() : null;
	}

	/**
	 * @see JFormField::getInput()
	 */
	protected function getInput()
	{
		return RLayoutHelper::render((string) $this->element['file'], $this);
	}
}
