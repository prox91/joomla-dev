<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 10:14 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;

// Import joomla controller library
jimport('legacy.controller.legacy');

class OpenHrmController extends JControllerLegacy
{
	/**
	 * Display task
	 *
	 * @return void
	 */
	public function display($cachable = false, $urlparams = array())
	{
		// Set default view if not set
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'Dashboard'));

        JHtml::stylesheet('openhrm/assets/stylesheet.css', false, true, false);

		// Call parent behaviour
		parent::display($cachable, $urlparams);
	}
}
