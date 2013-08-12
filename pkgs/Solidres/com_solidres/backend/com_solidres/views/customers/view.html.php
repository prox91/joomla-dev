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
 * Customers view class
 *
 * @package     Solidres
 * @subpackage	Customer
 * @since		0.1.0
 */
class SolidresViewCustomers extends JViewLegacy
{
	protected $state;
	protected $items;
	protected $pagination;
	
    function display($tpl = null)
	{
    	$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		JHtml::_('behavior.tooltip');
		JHTML::_('script','multiselect.js');
		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		$this->user			= JFactory::getUser();
		$this->userId		= $this->user->get('id');
		$this->listOrder	= $this->state->get('list.ordering');
		$this->listDirn		= $this->state->get('list.direction');
		
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

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
		$state	= $this->get('State');
		$canDo	= SolidresHelper::getActions();

		JToolBarHelper::title(JText::_('SR_MANAGE_CUSTOMERS'), 'generic.png');
		if ($canDo->get('core.create'))
		{
			JToolBarHelper::addNew('customer.add','JTOOLBAR_NEW');
		}
		if ($canDo->get('core.edit'))
		{
			JToolBarHelper::editList('customer.edit','JTOOLBAR_EDIT');
		}

		if ($canDo->get('core.edit.state')) {
			JToolbarHelper::divider();
			//JToolbarHelper::publish('customers.activate', 'SR_TOOLBAR_ACTIVATE', true);
			JToolbarHelper::unpublish('customers.block', 'SR_TOOLBAR_BLOCK', true);
			JToolbarHelper::custom('customers.unblock', 'unblock.png', 'unblock_f2.png', 'SR_TOOLBAR_UNBLOCK', true);
			JToolbarHelper::divider();
		}
	
		if ($canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'customers.delete','JTOOLBAR_DELETE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('screen.customer','JTOOLBAR_HELP');
	}

	/**
	 * Build an array of block/unblock user states to be used by jgrid.state,
	 * State options will be different for any user
	 * and for currently logged in user
	 *
	 * @param   boolean  $self  True if state array is for currently logged in user
	 *
	 * @return  array  a list of possible states to display
	 *
	 * @since  0.3.0
	 */
	public function blockStates( $self = false)
	{
		if ($self)
		{
			$states = array(
				1 => array(
					'task'				=> 'unblock',
					'text'				=> '',
					'active_title'		=> 'SR_CUSTOMERS_CUSTOMER_FIELD_BLOCK_DESC',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'unpublish',
					'inactive_class'	=> 'unpublish'
				),
				0 => array(
					'task'				=> 'block',
					'text'				=> '',
					'active_title'		=> '',
					'inactive_title'	=> 'SR_CUSTOMERS_CUSTOMERS_ERROR_CANNOT_BLOCK_SELF',
					'tip'				=> true,
					'active_class'		=> 'publish',
					'inactive_class'	=> 'publish'
				)
			);
		}
		else
		{
			$states = array(
				1 => array(
					'task'				=> 'unblock',
					'text'				=> '',
					'active_title'		=> 'SR_CUSTOMER_TOOLBAR_UNBLOCK',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'unpublish',
					'inactive_class'	=> 'unpublish'
				),
				0 => array(
					'task'				=> 'block',
					'text'				=> '',
					'active_title'		=> 'SR_CUSTOMERS_CUSTOMER_FIELD_BLOCK_DESC',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'publish',
					'inactive_class'	=> 'publish'
				)
			);
		}

		return $states;
	}
}