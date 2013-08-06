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
 * View to edit a Reservation.
 *
 * @package     Solidres
 * @subpackage	Reservation
 * @since		0.1.0
 */
class SolidresViewReservation extends JViewLegacy
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
		JText::script("SR_RESERVATION_NOTE_NOTIFY_CUSTOMER");
		JText::script("SR_RESERVATION_NOTE_DISPLAY_IN_FRONTEND");

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

		JToolBarHelper::title(JText::_('SR_EDIT_RESERVATION'), 'generic.png');
		JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
		JHtml::_('behavior.tooltip');
		SRHtml::_('jquery.validate');
		
		if (empty($this->item->id))
		{
			JToolBarHelper::cancel('reservation.cancel', 'JToolbar_Cancel');
		}
		else
		{
			JToolBarHelper::cancel('reservation.cancel', 'JToolbar_Close');
		}
		JToolBarHelper::divider();
		JToolBarHelper::help('screen.reservation.edit','JTOOLBAR_HELP');
	}
}
