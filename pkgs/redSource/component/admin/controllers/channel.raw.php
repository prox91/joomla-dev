<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Channel type controller
 *
 * @package     Redsource.Admin
 * @subpackage  Controllers
 * @since       1.0
 */
class RedsourceControllerChannel extends RControllerForm
{
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var  string
	 */
	protected $text_prefix = 'COM_REDSOURCE_CHANNEL';

	/**
	 * display html code for channel plugin parameters for ajax call
	 *
	 * @return void
	 */
	public function ajaxpluginparams()
	{
		$id     = $this->input->getInt('id');
		$plugin = $this->input->getCmd('plugin');

		if (!$plugin)
		{
			return;
		}

		$model = $this->getModel();

		$model->setState('id', $id);
		$model->setState('plugin', $plugin);

		$view = $this->getView('channel', 'raw');
		$view->setModel($model, true);
		$view->setLayout('pluginparameters');

		try
		{
			echo $view->display();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}
