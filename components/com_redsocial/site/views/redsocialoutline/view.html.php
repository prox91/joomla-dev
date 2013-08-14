<?php
/**
 * @package     redSocialstream
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
/**
 * HTML View class for the redSocialstream component
 */
class redsocialstreamViewredsocialoutline extends JView
{

	function display($tpl = null)
	{
		global $mainframe;
		$mainframe = JFactory::getApplication();
		$params = $mainframe->getparams();

		$model = $this->getModel('redsocialoutline');
		$s = $model->redsocialoutlinecontent();
		$this->outlinegroups = $s;
		$this->assignRef("params", $params);
		parent::display($tpl);
	}
}
