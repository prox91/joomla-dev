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

jimport('joomla.application.component.modeladmin');

/**
 * Class RedtwitterModelFollowed_Profile
 */
class RedtwitterModelFollowed_Profile extends JModelAdmin
{
	/**
	 * @var        string    The prefix to use with controller messages.
	 * @since    1.6
	 */
	protected $text_prefix = 'COM_REDTWITTER';

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param    type      The table type to instantiate
	 * @param    string    A prefix for the table class name. Optional.
	 * @param    array     Configuration array for model. Optional.
	 *
	 * @return    JTable    A database object
	 * @since    1.6
	 */
	public function getTable($type = 'Followed_Profile', $prefix = 'RedtwitterTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param    array $data          An optional array of data for the form to interogate.
	 * @param    boolean $loadData    True if the form is to load its own data (default case), false if not.
	 *
	 * @return    JForm    A JForm object on success, false on failure
	 * @since    1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_redtwitter.followed_profile', 'followed_profile', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return    mixed    The data for the form.
	 * @since    1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_redtwitter.edit.followed_profile.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param    integer    The id of the primary key.
	 *
	 * @return    mixed    Object on success, false on failure.
	 * @since    1.6
	 */
	public function getItem($pk = null)
	{
		return parent::getItem($pk);
	}

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since    1.6
	 */
	protected function prepareTable(&$table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id))
		{
			// Set ordering to the last item if not set
			if (@$table->ordering === '')
			{
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__redtwitter_followed_profiles');
				$max             = $db->loadResult();
				$table->ordering = $max + 1;
			}
		}
	}
}