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
 * View to edit a reservation asset.
 *
 * @package     Solidres
 * @subpackage	ReservationAsset
 * @since		0.1.0
 */
class SolidresViewReservationAsset extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;

	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->item	= $this->get('Item');
		$this->form	= $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		JLoader::register('SRSystemHelper', JPATH_LIBRARIES . '/solidres/system/helper.php');

		try {
			$this->paymentTabContent = $this->loadTemplate('payment');
		}
		catch (Exception $e)
		{
			$this->paymentTabContent = NULL;
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
		JRequest::setVar('hidemainmenu', true);
		include JPATH_COMPONENT.'/helpers/toolbar.php';
		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		$canDo		= SolidresHelper::getActions('', $this->item->id);
		
		if($isNew)
		{
			JToolBarHelper::title(JText::_('SR_ADD_NEW_ASSET'), 'generic.png');
		}
		else
		{
			JToolBarHelper::title(JText::sprintf('SR_EDIT_ASSET', $this->item->name), 'generic.png');
		}
		
		JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
		JHtml::_('behavior.tooltip');
		//JHtml::_('behavior.formvalidation');
		SRHtml::_('jquery.validate');
		
		// If not checked out, can save the item.
		if (!$checkedOut && $canDo->get('core.edit'))
		{
			JToolBarHelper::apply('reservationasset.apply', 'JToolbar_Apply');
			JToolBarHelper::save('reservationasset.save', 'JToolbar_Save');
			JToolBarHelper::addNew('reservationasset.save2new', 'JToolbar_Save_and_new');
		}

		// If an existing item, can save to a copy.
		if (!$isNew && $canDo->get('core.create'))
		{
			JToolBarHelper::custom('reservationasset.save2copy', 'copy.png', 'copy_f2.png', 'JToolbar_Save_as_Copy', false);
		}
		
		if (empty($this->item->id))
		{
			JToolBarHelper::cancel('reservationasset.cancel', 'JToolbar_Cancel');
		}
		else
		{
			JToolBarHelper::cancel('reservationasset.cancel', 'JToolbar_Close');
		}
		
		SRToolBarHelper::mediaManager();
		JToolBarHelper::divider();
		JToolBarHelper::help('screen.reservationasset.edit','JTOOLBAR_HELP');
	}
}
