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
 * Reservation view class
 *
 * @package     Solidres
 * @subpackage	Reservation
 * @since		0.1.0
 */
class SolidresViewReservations extends JViewLegacy
{
	protected $state;
	protected $items;
	protected $pagination;
	
    function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->reservationStatusList = $this->getReservationStatusList();

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
		$state	= $this->get('State');
		$canDo	= SolidresHelper::getActions();

		JToolBarHelper::title(JText::_('SR_MANAGE_RESERVATION'), 'generic.png');

		if ($canDo->get('core.edit'))
		{
			JToolBarHelper::editList('reservation.edit','JTOOLBAR_EDIT');
		}

		if ($canDo->get('core.edit.state'))
		{
			if ($state->get('filter.state') != 2)
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('reservations.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('reservations.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}	
		}

		if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolBarHelper::deleteList('', 'reservations.delete','JTOOLBAR_EMPTY_TRASH');
		}
		else if ($canDo->get('core.edit.state'))
		{
			JToolBarHelper::trash('reservations.trash','JTOOLBAR_TRASH');
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_solidres');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('screen.reservation','JTOOLBAR_HELP');
	}

	public function getReservationStatusList($config = array())
	{
		// Build the active state filter options.
		$options = array();

		$options[] = JHtml::_('select.option', '0',  'SR_RESERVATION_STATE_PENDING_ARRIVAL');
		$options[] = JHtml::_('select.option', '1',  'SR_RESERVATION_STATE_CHECKED_IN');
		$options[] = JHtml::_('select.option', '2',  'SR_RESERVATION_STATE_CHECKED_OUT');
		$options[] = JHtml::_('select.option', '3',  'SR_RESERVATION_STATE_CLOSED');
		$options[] = JHtml::_('select.option', '4',  'SR_RESERVATION_STATE_CANCELED');
		$options[] = JHtml::_('select.option', '-2', 'JTRASHED');
		$options[] = JHtml::_('select.option', '',   'JALL');

		return $options;
	}
}
