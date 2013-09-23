<?php
/**
 * @package     Redsource.Backend
 * @subpackage  Tables
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Content type table.
 *
 * @package     Redsource.Admin
 * @subpackage  Tables
 * @since       1.0
 */
class RedsourceTableCtype extends RTable
{
	/**
	 * The table name without the prefix.
	 *
	 * @var  string
	 */
	protected $_tableName = 'redsource_ctype';

	/**
	 * @var  integer
	 */
	public $id = null;

	/**
	 * @var  string
	 */
	public $name = null;

	/**
	 * @var  integer
	 */
	public $state = 1;

	/**
	 * @var  string
	 */
	public $created_date = '0000-00-00 00:00:00';

	/**
	 * @var  integer
	 */
	public $created_by = null;

	/**
	 * @var  string
	 */
	public $modified_date = '0000-00-00 00:00:00';

	/**
	 * @var  integer
	 */
	public $modified_by = null;

	/**
	 * @var  integer
	 */
	public $checked_out = null;

	/**
	 * @var  string
	 */
	public $checked_out_time = '0000-00-00 00:00:00';

	/**
	 * Checks that the object is valid and able to be stored.
	 *
	 * This method checks that the parent_id is non-zero and exists in the database.
	 * Note that the root node (parent_id = 0) cannot be manipulated with this class.
	 *
	 * @return  boolean  True if all checks pass.
	 */
	public function check()
	{
		if (empty($this->name))
		{
			$this->setError(JText::_('COM_REDSOURCE_NAME_CANNOT_BE_EMPTY'));
		}

		if (!parent::check())
		{
			return false;
		}

		// Modification fields are filled inside the model.

		return !$this->getErrors();
	}
}
