<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * HTML View class for the Solidres component
 *
 * @package   Solidres
 * @since     0.1.0
 */
class SolidresViewMap extends JViewLegacy
{
    public function display($tpl = null)
	{
		$model = $this->getModel();

		$this->info = $model->getMapInfo();
		$uncompressed = JFactory::getConfig()->get('debug') ? '' : '.min';
		JFactory::getDocument()->addStyleSheet(SRURI_MEDIA.'/assets/css/main'.$uncompressed.'.css');

		JHtml::_('jquery.framework');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		parent::display($tpl);
    }
}
