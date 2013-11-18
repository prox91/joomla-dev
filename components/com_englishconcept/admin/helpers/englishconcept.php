<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 6:09 PM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

/**
 * Class EnglishConceptHelper
 */
class EnglishConceptHelper
{
	/**
	 * @var    JObject  A cache for the available actions.
	 * @since  1.6
	 */
	protected static $actions;

	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_ENGLISHCONCEPT_SUBMENU_USERS'),
			'index.php?option=com_englishconcept&view=users',
			$vName == 'englishconcept'
		);

		// Groups and Levels are restricted to core.admin
		$canDo = self::getActions();

		if ($canDo->get('core.admin'))
		{
			JHtmlSidebar::addEntry(
				JText::_('COM_ENGLISHCONCEPT_SUBMENU_GROUPS'),
				'index.php?option=com_englishconcept&view=groups',
				$vName == 'groups'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_ENGLISHCONCEPT_SUBMENU_LEVELS'),
				'index.php?option=com_englishconcept&view=levels',
				$vName == 'levels'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_ENGLISHCONCEPT_SUBMENU_NOTES'),
				'index.php?option=com_englishconcept&view=notes',
				$vName == 'notes'
			);

			$extension = JFactory::getApplication()->input->getString('extension');
			JHtmlSidebar::addEntry(
				JText::_('COM_ENGLISHCONCEPT_SUBMENU_NOTE_CATEGORIES'),
				'index.php?option=com_categories&extension=com_englishconcept',
				$vName == 'categories' || $extension == 'com_englishconcept'
			);
		}
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return  JObject
	 *
	 * @since   1.6
	 * @todo    Refactor to work with notes
	 */
	public static function getActions()
	{
		if (empty(self::$actions))
		{
			$user = JFactory::getUser();
			self::$actions = new JObject;

			$actions = JAccess::getActions('com_englishconcept');

			foreach ($actions as $action)
			{
				self::$actions->set($action->name, $user->authorise($action->name, 'com_englishconcept'));
			}
		}

		return self::$actions;
	}
}
