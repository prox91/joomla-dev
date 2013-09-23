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
class RedsourceDataChannelWebservice extends RedsourceDataChannel
{
	/**
	 * Type of the datasource. Unique string
	 *
	 * @var  string
	 */
	protected $type = 'webservice';

	protected $username = null;

	protected $password = null;

	protected $wsdl = null;

	/**
	 * Constructor.
	 *
	 * @throws  InvalidArgumentException
	 */
	public function __construct()
	{
	}

	/**
	 * Function to read from the current data source
	 *
	 * @return  boolean  Success / Error
	 */
	public function read()
	{
		parent::read();
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
	}
}
