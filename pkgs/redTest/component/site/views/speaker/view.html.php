<?php
/**
 * @package     Jab.Site
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JLoader::import('joomla.application.component.view');

/**
 * Speaker View
 *
 * @package     Jab.Site
 * @subpackage  Views
 *
 * @since       1.0
 */
class JabViewSpeaker extends JViewLegacy
{
	/**
	 * Display method
	 *
	 * @param   string  $tpl  template name
	 *
	 * @return void
	 */
	function display($tpl = null)
	{
		$this->item	= $this->get('Item');

		if (!empty($this->item))
		{
			$this->item->tags = new JHelperTags;
			$this->item->tags->getItemTags('com_jab.speaker', $this->item->id);
		}

		// Display the template
		parent::display($tpl);
	}
}
