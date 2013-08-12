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
 * View to edit a extra.
 *
 * @package     Solidres
 * @subpackage	Extra
 * @since		0.1.0
 */
class SolidresViewExtra extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;

	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->item			= $this->get('Item');
		$this->form			= $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		$this->addToolbar();
        
		parent::display($tpl);
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);
		include JPATH_COMPONENT.'/helpers/toolbar.php';
		$isNew		= ($this->item->id == 0);
		$canDo		= SolidresHelper::getActions('', $this->item->id);
		
		if($isNew)
		{
			JToolBarHelper::title(JText::_('SR_ADD_NEW_EXTRA'), 'generic.png');
		}
		else
		{
			JToolBarHelper::title(JText::sprintf('SR_EDIT_EXTRA', $this->item->name), 'generic.png');
		}
		
		JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
		JHtml::_('behavior.tooltip');
		//JHtml::_('behavior.formvalidation');
		SRHtml::_('jquery.validate');
		
		//echo SolidresHelperSideNavigation::getSideNavigation($this->getName());

		// If not checked out, can save the item.
		if ($canDo->get('core.edit'))
		{
			JToolBarHelper::apply('extra.apply', 'JToolbar_Apply');
			JToolBarHelper::save('extra.save', 'JToolbar_Save');
			JToolBarHelper::addNew('extra.save2new', 'JToolbar_Save_and_new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create'))
		{
			JToolBarHelper::custom('extra.save2copy', 'copy.png', 'copy_f2.png', 'JToolbar_Save_as_Copy', false);
		}
		
		if (empty($this->item->id))
		{
			JToolBarHelper::cancel('extra.cancel', 'JToolbar_Cancel');
		}
		else
		{
			JToolBarHelper::cancel('extra.cancel', 'JToolbar_Close');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('screen.extra.edit','JTOOLBAR_HELP');
	}
}
