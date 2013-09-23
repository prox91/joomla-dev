<?php
/**
 * @package     Redsource.Libraries
 * @subpackage  Plugins
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Base class for field plugins.
 *
 * @package     Redsource.Libraries
 * @subpackage  Plugins
 * @since       1.0
 */
abstract class RedsourcePluginField extends RPlugin
{
	/**
	 * Type of plugin
	 */
	protected $_type = 'rsfield';

	/**
	 * Data field type name
	 *
	 * @var  string
	 */
	private $dcType = null;

	/**
	 * Constructor
	 *
	 * @param   string  &$subject  Subject
	 * @param   array   $config    Configuration
	 */
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config = array());

		$this->dcType = $this->_name;
	}

	/**
	 * Event to load a data channel
	 *
	 * @param   string  $type  Type of data channel
	 *
	 * @return  RedsourceDataChannelWebservice
	 */
	public function onGetDataChannel($type)
	{
	}

	/**
	 * Event triggered to load the available data channels
	 *
	 * @param   array  $types  Array with the specific types that we want to load
	 *
	 * @return  RedsourceDataChannel|null    Data channel object.
	 *
	 * @throws  RuntimeException
	 * @since   1.0
	 */
	public function onGetDataChannels($types = array())
	{
		if (!$this->extensionId || empty($this->dcType))
		{
			return null;
		}

		return new RedsourceDataChannel($this->dcType);
	}

	/**
	 * Event triggered to validate a data channel
	 *
	 * @param   RedsourceDataChannel  &$dataChannel  The data channel object
	 *
	 * @return  boolean
	 */
	protected function validateDataChannel(RedsourceDataChannel &$dataChannel)
	{
		// We are not checking the current plugin
		if (!$this->isCurrentChannel($dataChannel))
		{
			return true;
		}

		return true;
	}

	/**
	 * Event triggered when preparing the data channel for connection
	 *
	 * @param   RedsourceDataChannel  &$dataChannel  The data channel object
	 *
	 * @return   boolean  True on success, false otherwise.
	 * @throws   InvalidArgumentException
	 */
	public function onDataChannelPrepareWrite(RedsourceDataChannel &$dataChannel)
	{
		// We are not checking the current plugin
		if (!$this->isCurrentChannel($dataChannel))
		{
			return false;
		}

		// Validate that all the parameters required by the plugin are set
		// TODO: function missing
		if (!$this->validateRequiredParams())
		{
			throw new InvalidArgumentException(implode('<br />', $this->getErrors()));
		}

		return true;
	}

	/**
	 * Event triggered to write into the data channel
	 *
	 * @param   RedsourceDataChannel  &$dataChannel  The data channel object
	 *
	 * @return   boolean  True on success, false otherwise.
	 * @throws   InvalidArgumentException
	 */
	public function onDataChannelWrite(RedsourceDataChannel &$dataChannel)
	{
		// We are not checking the current plugin
		if (!$this->isCurrentChannel($dataChannel))
		{
			return false;
		}

		// Validate that all the parameters required by the plugin are set
		// TODO: function missing
		if (!$this->validateRequiredParams())
		{
			throw new InvalidArgumentException(implode('<br />', $this->getErrors()));
		}

		return true;
	}

	/**
	 * Function to detect if this channel is triggered
	 *
	 * @param   RedsourceDataChannel  &$dataChannel  The data channel object
	 *
	 * @return  boolean
	 */
	protected function isCurrentChannel(RedsourceDataChannel &$dataChannel)
	{
		// We are not checking the current plugin
		if (!empty($this->dcType) && $dataChannel->getType() == $this->dcType)
		{
			return true;
		}

		return false;
	}
}
