<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Channel Model
 *
 * @package     Redsource.Admin
 * @subpackage  Models
 * @since       1.0
 */
class RedsourceModelChannel extends RModelAdmin
{
	/**
	 * return form object for channel plugin parameters
	 *
	 * @return JForm
	 *
	 * @throws Exception
	 */
	public function getPluginParameters()
	{
		JPluginHelper::importPlugin('rschannel', $this->getState('plugin'));

		$data = $this->getItem($this->getState('id'));

		$xml_path = JPATH_SITE . '/plugins/rschannel/' . $this->getState('plugin') . '/parameters.xml';

		if (!file_exists($xml_path))
		{
			throw new Exception('Missing plugin xml file', 404);
		}

		$registry = new JRegistry;
		$registry->loadString($data->channel_params);

		$loadData = array('channel_params' => $registry->toArray());

		$form = RForm::getInstance('channel_params', $xml_path, array('control' => 'jform'));
		$form->bind($loadData);

		return $form;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success, False on error.
	 *
	 * @since   12.2
	 */
	public function save($data)
	{
		if (isset($data['channel_params']) && is_array($data['channel_params']))
		{
			$registry = new JRegistry;
			$registry->loadArray($data['channel_params']);
			$data['channel_params'] = (string) $registry;
		}

		return parent::save($data);
	}
}
