<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * View class for a list of Redtwitter.
 */
class RedtwitterViewFollowed_Profiles extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * @param null $tpl
	 *
	 * @return mixed|void
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state      = $this->get('State');
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		$this->addToolbar();

		$input = JFactory::getApplication()->input;
		$view  = $input->getCmd('view', '');
		RedtwitterHelper::addSubmenu($view);

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT . '/helpers/redtwitter.php';

		$state = $this->get('State');
		$canDo = RedtwitterHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_REDTWITTER_TITLE_FOLLOWED_PROFILES'), 'followed_profiles.png');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/followed_profile';

		if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				JToolBarHelper::addNew('followed_profile.add', 'JTOOLBAR_NEW');
			}

			if ($canDo->get('core.edit') && isset($this->items[0]))
			{
				JToolBarHelper::editList('followed_profile.edit', 'JTOOLBAR_EDIT');
			}
		}

		if ($canDo->get('core.edit.state'))
		{
			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::custom('followed_profiles.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::custom('followed_profiles.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			}
			else
			{
				if (isset($this->items[0]))
				{
					// If this component does not use state then show a direct delete button as we can not trash
					JToolBarHelper::deleteList('', 'followed_profiles.delete', 'JTOOLBAR_DELETE');
				}
			}

			if (isset($this->items[0]->state))
			{
				JToolBarHelper::divider();
				JToolBarHelper::archiveList('followed_profiles.archive', 'JTOOLBAR_ARCHIVE');
			}

			if (isset($this->items[0]->checked_out))
			{
				JToolBarHelper::custom('followed_profiles.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
			}
		}

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{
			if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
				JToolBarHelper::deleteList('', 'followed_profiles.delete', 'JTOOLBAR_EMPTY_TRASH');
				JToolBarHelper::divider();
			}
			else
			{
				if ($canDo->get('core.edit.state'))
				{
					JToolBarHelper::trash('followed_profiles.trash', 'JTOOLBAR_TRASH');
					JToolBarHelper::divider();
				}
			}
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_redtwitter');
		}
	}
}