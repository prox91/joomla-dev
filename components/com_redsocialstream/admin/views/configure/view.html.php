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
class configureViewconfigure extends JView
{
	function display($tpl = null)
	{
		JToolBarHelper::title(JText::_('COM_REDSOCIALSTREAM_CONFIGURE'), 'configure.png');
		JToolBarHelper::apply();
		JToolBarHelper::cancel('cancel', 'COM_REDSOCIALSTREAM_CLOSE');

		//DEVNOTE: set document title
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'));

		$mainframe = JFactory::getApplication();
		$context = "config";
		$model = $this->getModel('configure');

		$db = JFactory::getDbo();
		$q = "SELECT * FROM #__redsocialstream_settings";
		$db->setQuery($q);

		$this->settingsrows = $db->loadObjectList();
		$typelist = $this->get('type_list_sorted');
		$pagination = $this->get('Pagination');

		//DEVNOTE:give me ordering from request
		$filter_order = $mainframe->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'ordering');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');

		$this->assignRef('lists', $lists);
		$this->assignRef("typelist", $typelist);
		$this->assignRef('pagination', $pagination);
		parent::display($tpl);
	}
}
?> 
