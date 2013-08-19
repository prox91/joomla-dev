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
class postViewpost extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		JToolBarHelper::title(JText::_('COM_REDSOCIALSTREAM_PROFILE'), 'posts.png');
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
		$profiletypes = $model->getprofiletypes();
		$groups = $model->getgroups();
		$profiles = $model->getprofiles();

		$lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $detail->published);
		JToolBarHelper::save('save', 'COM_REDSOCIALSTREAM_SAVE');
		JToolBarHelper::cancel('cancel', 'COM_REDSOCIALSTREAM_CLOSE');
		//clean helloworld data
		jimport('joomla.filter.filteroutput');
		JFilterOutput::objectHTMLSafe($detail, ENT_QUOTES, 'description');

		$this->assignRef('lists', $lists);
		$this->assignRef('detail', $detail);
		$this->request_url = $uri->toString();
		$this->assignRef('profiletypes', $profiletypes);
		$this->assignRef('groups', $groups);
		$this->assignRef('profiles', $profiles);

		parent::display($tpl);
	}
}
?> 
