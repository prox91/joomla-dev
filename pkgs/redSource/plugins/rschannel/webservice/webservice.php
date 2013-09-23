<?php
/**
 * @package     Redsource.Plugins
 * @subpackage  Rschannel
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('JPATH_BASE') or die;

/**
 * Webservice channel plugin for redSOURCE
 *
 * @package     Redsource.Plugin
 * @subpackage  Rschannel
 * @since       1.0
 */
class PlgRschannelWebservice extends RedsourcePluginChannel
{
	/**
	 * Name of the plugin
	 */
	protected $_name = 'webservice';

	/**
	 * Title of the channel
	 *
	 * @var  string
	 */
	protected $title = 'PLG_RSCHANNEL_WEBSERVICE_TITLE';

	/**
	 * Event to load a data channel
	 *
	 * @param   string  $type  Type of data channel
	 *
	 * @return  RedsourceDataChannelWebservice
	 */
	public function onGetDataChannel($type)
	{
		if ($this->_name != $type)
		{
			return false;
		}

		return new RedsourceDataChannelWebservice;
	}
}
