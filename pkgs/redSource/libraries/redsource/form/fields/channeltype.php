<?php
/**
 * @package     Redsource.Libraries
 * @subpackage  Plugins
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('list');

/**
 * Field to load a list of available channel types
 *
 * @package     Redsource.Libraries
 * @subpackage  Fields
 * @since       1.0
 */
class JFormFieldChanneltype extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var   string
	 */
	public $type = 'Channeltype';

	/**
	 * A static cache.
	 *
	 * @var   array
	 */
	protected $cache = array();

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 */
	protected function getOptions()
	{
		if (empty($this->cache))
		{
			$app = RFactory::getApplication();

			$options = array();

			// Load specifc data channels?
			$types = $this->element['types'] ? explode(',', $this->element['types']) : array();

			// Try to load the active dataChannels
			JPluginHelper::importPlugin('rschannel');

			if ($dataChannels = $app->triggerEvent('onGetChannelTypes', array($types)))
			{
				foreach ($dataChannels as $channel)
				{
					$options[] = (object) array(
						'value' => $channel->getType(),
						'text'  => $channel->getTitle()
					);
				}

				$options = array_merge(parent::getOptions(), $options);
			}

			$this->cache = $options;
		}

		return $this->cache;
	}
}
