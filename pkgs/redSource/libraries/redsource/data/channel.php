<?php
/**
 * @package     Redsource.Libraries
 * @subpackage  Data
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Data Channel Entity
 *
 * @package     Redsource.Libraries
 * @subpackage  Data
 * @since       1.0
 */
class RedsourceDataChannel
{
	/**
	 * Type of the datasource. Unique string
	 *
	 * @var  string
	 */
	protected $type = null;

	/**
	 * Title of the channel
	 *
	 * @var  string
	 */
	protected $title = null;

	/**
	 * Errors encountered
	 *
	 * @var  array
	 */
	protected $errors = array();

	/**
	 * Constructor.
	 *
	 * @param   string  $type  Type of this data channel
	 *
	 * @throws  InvalidArgumentException
	 */
	public function __construct($type = null)
	{
		// Type received
		if ($type !== null)
		{
			$this->setType($type);
		}
	}

	/**
	 * Add an error to the error array
	 *
	 * @param   string  $errorMessage  The error message
	 *
	 * @return  void
	 */
	protected function addError($errorMessage)
	{
		$this->errors[] = $errorMessage;
	}

	/**
	 * Return all the errors encountered
	 *
	 * @return  array
	 */
	protected function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Title getter
	 *
	 * @return  string  Unique data channel name
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the type of this data channel
	 *
	 * @return  string  Unique data channel name
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Title setter
	 *
	 * @param   string   $title      Title to apply to this channel
	 * @param   boolean  $translate  Translate the title string
	 *
	 * @return  RedsourceDataChannel  Self instance for chainning
	 */
	public function setTitle($title, $translate = false)
	{
		$this->title = $title;

		if ($translate)
		{
			$this->translateTitle();
		}

		return $this;
	}

	/**
	 * Change the type of this data channel
	 *
	 * @param   string  $type  Unique type name
	 *
	 * @return  RedsourceDataChannel  Self instance for chainning
	 */
	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * Function to read from the current data source
	 *
	 * @return  boolean  Success / Error
	 */
	public function read()
	{
		echo 'Reading... <br />';
	}

	/**
	 * Write into the data channel
	 *
	 * @param   array  $options  [description]
	 *
	 * @return  boolean  Success / Error
	 */
	public function write($options = array())
	{
		echo 'Writing... <br />';
	}
}
