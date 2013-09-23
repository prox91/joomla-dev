<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Data channel view.
 *
 * @package     Redsource.Admin
 * @subpackage  Views
 * @since       1.0
 */
class RedsourceViewChannel extends JViewLegacy
{
	/**
	 * @var JForm
	 */
	protected $form;

	/**
	 * @var object
	 */
	protected $item;

	/**
	 * Display method
	 *
	 * @param   string  $tpl  The template name
	 *
	 * @return void
	 */
	public function display($tpl = null)
	{
		if ($this->getLayout() == 'pluginparameters')
		{
			return $this->_displayPluginParameters($tpl);
		}
	}

	/**
	 * Display method for channel plugin parameters
	 *
	 * @param   string  $tpl  The template name
	 *
	 * @return void
	 */
	public function _displayPluginParameters($tpl = null)
	{
		$this->form = $this->get('PluginParameters');

		parent::display($tpl);
	}
}
