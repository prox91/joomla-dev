<?php
/**
 * @package     redSocialstream
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
class profilesViewprofiles extends JView
{
	function __construct($config = array())
	{
		parent::__construct($config);
	}

	function display($tpl = null)
	{
		//DEVNOTE: we need these 2 globals			 
		$mainframe = JFactory::getApplication();
		$context = "profiles";

		//DEVNOTE: set document title
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'));
		//DEVNOTE: Set ToolBar title
		JToolBarHelper::title(JText::_('COM_REDSOCIALSTREAM_PROFILES'), 'profile');
		//DEVNOTE: Set toolbar items for the page
		JToolBarHelper::addNewX();
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		//DEVNOTE: Get URL
		$uri = JFactory::getURI();

		//DEVNOTE:give me ordering from request
		$filter_order = $mainframe->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'ordering');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');

		//DEVNOTE:remember the actual order and column  
		$lists['order'] = $filter_order;
		$lists['order_Dir'] = $filter_order_Dir;

		$items = $this->get('Data');
		$total = $this->get('Total');

		$pagination = $this->get('Pagination');
		$ordering = ($lists['order'] == 'm.ordering');

		$this->user = JFactory::getUser();
		$this->assignRef('lists', $lists);
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
		$this->assignRef('ordering', $ordering);
		$this->request_url = $uri->toString();

		parent::display($tpl);
	}
}
?> 
