<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 6:09 PM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;

class OpenHrmHelpersOpenhrm
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
			JText::_('COM_OPENHRM_SUBMENU_USERS'),
			'index.php?option=com_openhrm&view=users',
			$vName == 'openhrm'
		);

		// Groups and Levels are restricted to core.admin
		$canDo = self::getActions();

		if ($canDo->get('core.admin'))
		{
			JHtmlSidebar::addEntry(
				JText::_('COM_OPENHRM_SUBMENU_GROUPS'),
				'index.php?option=com_openhrm&view=groups',
				$vName == 'groups'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_OPENHRM_SUBMENU_LEVELS'),
				'index.php?option=com_openhrm&view=levels',
				$vName == 'levels'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_OPENHRM_SUBMENU_NOTES'),
				'index.php?option=com_openhrm&view=notes',
				$vName == 'notes'
			);

			$extension = JFactory::getApplication()->input->getString('extension');
			JHtmlSidebar::addEntry(
				JText::_('COM_OPENHRM_SUBMENU_NOTE_CATEGORIES'),
				'index.php?option=com_categories&extension=com_openhrm',
				$vName == 'categories' || $extension == 'com_openhrm'
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

			$actions = JAccess::getActions('com_openhrm');

			foreach ($actions as $action)
			{
				self::$actions->set($action->name, $user->authorise($action->name, 'com_openhrm'));
			}
		}

		return self::$actions;
	}

	public static function getGrammarOption($id = null)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select("id, lesson_id, keystruct_no, keystruct_ref")
			->from("#__ec_lessons_grammars");
		if(!is_null($id))
		{
			$query->where('id=' . $id);
		}
		$db->setQuery($query);
		$result = $db->loadObjectList();

		return $result;
	}

	public static function getUsageOption($id = null)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select("id, lesson_id, diffspecial_no, diffspecial_ref")
			  ->from("#__ec_lessons_usages");
		if(!is_null($id))
		{
			$query->where('id=' . $id);
		}
		$db->setQuery($query);
		$result = $db->loadObjectList();

		return $result;
	}

	public static function resize($filename, $width, $height)
	{
        $path     = JPath::clean($filename);
        $JImage   = new JImage($path);

        $info = pathinfo($filename);
        $extension = $info['extension'];

        $old_image = basename($filename);
        $new_image = $info['filename'] . '-' . $width . 'x' . $height . '.' . $extension;
        $ret = '';

        if (!file_exists(DIR_IMAGE . '/' . $new_image)
            || (filemtime(DIR_IMAGE . '/' . $old_image) > filemtime(DIR_IMAGE . '/' . $new_image)))
        {
            $path = '';

            $directories = explode('/', dirname(str_replace('../', '', DIR_IMAGE . '/' . $new_image)));

            foreach ($directories as $directory)
            {
                if(!empty($directory))
                {
                    $path = $path . '/' . $directory;

                    if (!file_exists($path))
                    {
                        @mkdir(DIR_IMAGE . $path, 0777);
                    }
                }
            }

            $image = $JImage->resize($width, $height, true, 1);
            if($image->toFile(DIR_IMAGE . $new_image))
            {
                $ret = DIR_IMAGE . '/' . $new_image;
            }
        }

        return $ret;
	}
}
