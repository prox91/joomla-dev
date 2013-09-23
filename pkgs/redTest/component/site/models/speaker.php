<?php
/**
 * @package     Jab.Site
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

/**
 * Speaker Model
 *
 * @package     Jab.Site
 * @subpackage  Models
 *
 * @since       1.0
 */
class JabModelSpeaker extends JModelLegacy
{
	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * @return  void
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();

		// Load id from the request.
		$id = $app->input->getInt('id', 0);
		$this->setState('speaker.id', $id);
	}

	/**
	 * Load an item from the database
	 *
	 * @param   mixed  $id  Identifier of the item to load
	 *
	 * @return  Object      Item loaded
	 */
	public function getItem($id = null)
	{
		$id = (!empty($id)) ? $id : $this->getState('speaker.id');

		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->select('s.*')
			->from('#__jab_speakers AS s')
			->where('id = ' . (int) $id);

		$db->setQuery($query);

		try
		{
			$item = $db->loadObject();
		}
		catch (Exception $e)
		{
			throw new RuntimeException($e->getMessage());
		}

		return $item;
	}
}
