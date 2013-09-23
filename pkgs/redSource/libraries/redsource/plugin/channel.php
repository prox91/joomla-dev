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
 * Base class for channel plugins.
 *
 * @package     Redsource.Libraries
 * @subpackage  Plugins
 * @since       1.0
 */
abstract class RedsourcePluginChannel extends RPlugin
{
	/**
	 * Type of plugin
	 */
	protected $_type = 'rschannel';

	/**
	 * Title to show for this channel
	 *
	 * @var  string
	 */
	protected $title = null;

	/**
	 * Constructor
	 *
	 * @param   string  &$subject  Subject
	 * @param   array   $config    Configuration
	 *
	 * @throws  UnexpectedValueException
	 */
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);
	}

	/**
	 * Generate a data channel instance
	 *
	 * @return  RedsourceDataChannel  Initialised data channel
	 */
	protected function genChannelInstance()
	{
		$instance = new RedsourceDataChannel($this->_name);

		// Assign the translated title
		if (property_exists($this, 'title') && $this->title !== null)
		{
			$instance->setTitle(JText::_($this->title));
		}

		return $instance;
	}

	/**
	 * Function to detect if this channel is triggered
	 *
	 * @param   RedsourceDataChannel  &$dataChannel  The data channel object
	 *
	 * @return  boolean  True on success, false otherwise.
	 */
	protected function isCurrentChannel(RedsourceDataChannel &$dataChannel)
	{
		// We are not checking the current plugin
		if (!empty($this->_name) && $dataChannel->getType() == $this->_name)
		{
			return true;
		}

		return false;
	}

	/**
	 * Event to load a data channel
	 *
	 * @param   string  $type  Type of data channel
	 *
	 * @return  RedsourceDataChannelWebservice
	 */
	public function onGetChannelType($type)
	{
		if ($type != $this->_name)
		{
			return true;
		}
	}

	/**
	 * Event triggered to load the available data source types
	 *
	 * @param   array  $types  Array with the specific types that we want to load
	 *
	 * @return  RedsourceDataChannel|null   Data channel object
	 *
	 * @throws  RuntimeException
	 * @since   1.0
	 */
	public function onGetChannelTypes($types = array())
	{
		// Something went wrong
		if (!$this->extensionId || empty($this->_name))
		{
			return null;
		}

		// If we want to load a specific list of data channels
		if (!empty($types) && !in_array($this->_name, $types))
		{
			return null;
		}

		return $this->genChannelInstance();
	}

	/**
	 * Event triggered when preparing the data channel for connection
	 *
	 * @param   RedsourceDataChannel  &$dataChannel  The data channel object
	 *
	 * @return   boolean  True on success, false otherwise.
	 *
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
	 *
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
}
