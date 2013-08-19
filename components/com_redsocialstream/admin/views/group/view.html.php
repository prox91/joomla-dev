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
class groupViewgroup extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		$uri = JFactory::getURI();
		$user = JFactory::getUser();
		$model = $this->getModel();
		$this->setLayout('default');
		$lists = array();

		//DEVNOTE: set document title
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'));

		//get the helloworld
		$detail = $this->get('data');
		//DEVNOTE: the new record ?  Edit or Create?
		$isNew = ($detail->id < 1);
		// Set toolbar items for the page
		$text = $isNew ? JText::_('COM_REDSOCIALSTREAM_NEW') : JText::_('COM_REDSOCIALSTREAM_EDIT');
		JToolBarHelper::title(JText::_('COM_REDSOCIALSTREAM_GROUP') . ': <small><small>[ ' . $text . ' ]</small></small>', 'group.png');

		JToolBarHelper::apply();
		JToolBarHelper::save();
		if ($isNew)
		{
			JToolBarHelper::cancel();
		}
		else
		{
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel('cancel', 'COM_REDSOCIALSTREAM_CLOSE');
		}

		$lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $detail->published);

		//clean helloworld data
		jimport('joomla.filter.filteroutput');
		JFilterOutput::objectHTMLSafe($detail, ENT_QUOTES, 'description');
		$this->assignRef('lists', $lists);
		$this->assignRef('groups', $groups);
		$this->assignRef('profiletypes', $profiletypes);
		$this->assignRef('detail', $detail);
		$this->request_url = $uri->toString();

		parent::display($tpl);
	}
}
?> 
