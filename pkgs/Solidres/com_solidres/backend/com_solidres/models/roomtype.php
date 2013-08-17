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
 * RoomType model.
 *
 * @package     Solidres
 * @subpackage	RoomType
 * @since		0.1.0
 */
class SolidresModelRoomType extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = null;

	/**
	 * @var		string	The event to trigger after deleting the data.
	 * @since	1.6
	 */
	protected $event_after_delete = null;

	/**
	 * @var		string	The event to trigger after saving the data.
	 * @since	1.6
	 */
	protected $event_after_save = null;

	/**
	 * @var		string	The event to trigger after deleting the data.
	 * @since	1.6
	 */
	protected $event_before_delete = null;

	/**
	 * @var		string	The event to trigger after saving the data.
	 * @since	1.6
	 */
	protected $event_before_save = null;

	/**
	 * @var		string	The event to trigger after changing the published state of the data.
	 * @since	1.6
	 */
	protected $event_change_state = null;

	/**
	 * Constructor.
	 *
	 * @param	array An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->event_after_delete 	= 'onRoomTypeAfterDelete';
		$this->event_after_save 	= 'onRoomTypeAfterSave';
		$this->event_before_delete 	= 'onRoomTypeBeforeDelete';
		$this->event_before_save 	= 'onRoomTypeBeforeSave';
		$this->event_change_state 	= 'onRoomTypeChangeState';
		$this->text_prefix 			= strtoupper($this->option);
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	A record object.
	 * @return	boolean	True if allowed to delete the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canDelete($record)
	{
		$user = JFactory::getUser();

		return $user->authorise('core.delete', 'com_solidres.roomtype.'.(int) $record->id);
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param	object	A record object.
	 * @return	boolean	True if allowed to change the state of the record. Defaults to the permission set in the component.
	 * @since	1.6
	 */
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		return $user->authorise('core.edit.state', 'com_solidres.roomtype.'.(int) $record->id);
	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'RoomType', $prefix = 'SolidresTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_solidres.roomtype', 'roomtype', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('roomtype.id'))
		{
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('reservation_asset_id', 'action', 'core.edit');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('reservation_asset_id', 'action', 'core.create');
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_solidres.edit.roomtype.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		// Get the dispatcher and load the users plugins.
		$dispatcher	= JDispatcher::getInstance();
		JPluginHelper::importPlugin('extension');

		// Trigger the data preparation event.
		$results = $dispatcher->trigger('onRoomTypePrepareData', array('com_solidres.roomtype', $data));

		// Check for errors encountered while preparing the data.
		if (count($results) && in_array(false, $results, true))
		{
			$this->setError($dispatcher->getError());
		}

		return $data;
	}

	/**
	 * Method to allow derived classes to preprocess the form.
	 *
	 * @param   JForm   $form   A JForm object.
	 * @param   mixed   $data   The data expected for the form.
	 * @param   string  $group  The name of the plugin group to import (defaults to "content").
	 *
	 * @return  void
	 *
	 * @see     JFormField
	 * @since   12.2
	 * @throws  Exception if there is an error in the form event.
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'extension')
	{
		// Import the appropriate plugin group.
		JPluginHelper::importPlugin($group);

		// Get the dispatcher.
		$dispatcher = JEventDispatcher::getInstance();

		// Trigger the form preparation event.
		$results = $dispatcher->trigger('onRoomTypePrepareForm', array($form, $data));

		// Check for errors encountered while preparing the form.
		if (count($results) && in_array(false, $results, true))
		{
			// Get the last error.
			$error = $dispatcher->getError();

			if (!($error instanceof Exception))
			{
				throw new Exception($error);
			}
		}
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);
		$reservationAssetModel = JModelLegacy::getInstance('ReservationAsset', 'SolidresModel', array('ignore_request' => true));
		$currencyModel = JModelLegacy::getInstance('Currency', 'SolidresModel', array('ignore_request' => true));

		if ($item->id)
		{
			$dbo = JFactory::getDbo();
			$query = $dbo->getQuery(true);
			$media = JModelLegacy::getInstance('MediaList', 'SolidresModel', array('ignore_request' => true));

			// Load the tariff/prices belong to this room type
			// We can load the tariff by overloading load() method in table Price instead, not sure which one is better at this moment
			$query->clear();
			$query->select('p.*, c.currency_code, c.currency_name');
			$query->from($dbo->quoteName('#__sr_prices').' as p');
			$query->join('left', $dbo->quoteName('#__sr_currencies').' as c ON c.id = p.currency_id');
			$query->where('room_type_id = '.(empty($item->id) ? 0 : (int) $item->id));

			$dbo->setQuery($query);
			$item->tariff = $dbo->loadObjectList();
			// Loop to get the default tariff (customer group is Regular and has no date constraint)
			$hash = '';
			$item->tariffSorted = array();
			$createdHash = false;
			$dayMapping = array('0' => 'sun', '1' => 'mon', '2' => 'tue', '3' => 'wed', '4' => 'thu', '5' => 'fri', '6' => 'sat' );
			$nullDate = $dbo->getNullDate();

			foreach($item->tariff as $k => $v)
			{
				// Remove default tariff
				if ($v->customer_group_id === NULL && $v->valid_from == $nullDate && $v->valid_to == $nullDate )
				{
					if ($v->w_day == 7) // Default tariff, one price for all week days (Simple tariff)
					{
						$item->price = $v->price;
					}
					else // Default tariff, each price for each week day (Advanced Tariff)
					{
						$item->price[$dayMapping[$v->w_day]] = $v->price;
					}
					unset($item->tariff[$k]); // then unset it so it does not display in the form, tab tariff
					continue;
				}

				// Group similar price into tariff (Complex tariff)
				if (!$createdHash)
				{
					$hash = md5($v->customer_group_id.$v->valid_from.$v->valid_to.$v->room_type_id);
					$createdHash = true;
					$item->tariffSorted[$hash] = new stdClass();
					$item->tariffSorted[$hash]->id = $v->id;
					$item->tariffSorted[$hash]->currency_id = $v->currency_id;
					$item->tariffSorted[$hash]->customer_group_id = $v->customer_group_id;
					$item->tariffSorted[$hash]->valid_from = $v->valid_from;
					$item->tariffSorted[$hash]->valid_to = $v->valid_to;
					$item->tariffSorted[$hash]->room_type_id = $v->room_type_id;
					$item->tariffSorted[$hash]->title = $v->title;
					$item->tariffSorted[$hash]->description = $v->description;
					$item->tariffSorted[$hash]->d_min = $v->d_min;
					$item->tariffSorted[$hash]->d_max = $v->d_max;
					$item->tariffSorted[$hash]->p_min = $v->p_min;
					$item->tariffSorted[$hash]->p_max = $v->p_max;
					$item->tariffSorted[$hash]->currency_code = $v->currency_code;
					$item->tariffSorted[$hash]->currency_name = $v->currency_name;
				}

				$tmpHash = md5($v->customer_group_id.$v->valid_from.$v->valid_to.$v->room_type_id);
				if ($tmpHash != $hash)
				{
					$hash = $tmpHash;
					$item->tariffSorted[$hash] = new stdClass();
					$item->tariffSorted[$hash]->id = $v->id;
					$item->tariffSorted[$hash]->currency_id = $v->currency_id;
					$item->tariffSorted[$hash]->customer_group_id = $v->customer_group_id;
					$item->tariffSorted[$hash]->valid_from = $v->valid_from;
					$item->tariffSorted[$hash]->valid_to = $v->valid_to;
					$item->tariffSorted[$hash]->room_type_id = $v->room_type_id;
					$item->tariffSorted[$hash]->title = $v->title;
					$item->tariffSorted[$hash]->description = $v->description;
					$item->tariffSorted[$hash]->d_min = $v->d_min;
					$item->tariffSorted[$hash]->d_max = $v->d_max;
					$item->tariffSorted[$hash]->p_min = $v->p_min;
					$item->tariffSorted[$hash]->p_max = $v->p_max;
					$item->tariffSorted[$hash]->currency_code = $v->currency_code;
					$item->tariffSorted[$hash]->currency_name = $v->currency_name;
				}

				if ($tmpHash == $hash)
				{
					if ($v->w_day <= 6 )
					{
						$item->tariffSorted[$hash]->price[$dayMapping[$v->w_day]] = $v->price;
					}
					else
					{
						$item->tariffSorted[$hash]->price = $v->price;
					}
				}
			}

			$query->clear();
			$query->select('a.id, a.label');
			$query->from($dbo->quoteName('#__sr_rooms').' a');
			$query->where('room_type_id = '.(empty($item->id) ? 0 : (int) $item->id));
			$dbo->setQuery($query);
			$item->rooms = $dbo->loadObjectList();

			// Load media
			$media->setState('filter.reservation_asset_id', NULL);
			$media->setState('filter.room_type_id', (int) $item->id);
			$item->media = $media->getItems();
		}

        // Load currency
		$reservationAsset = $reservationAssetModel->getItem($item->reservation_asset_id);
		$currency = $currencyModel->getItem($reservationAsset->currency_id);

        $item->currency = $currency;

		return $item;
	}

	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
		$table->alias = JApplication::stringURLSafe($table->alias);

		if (empty($table->alias))
		{
			$table->alias = JApplication::stringURLSafe($table->name);
		}

		if (empty($table->params))
		{
			$table->params = '';
		}

		if (empty($table->id))
		{
			$table->created_date = $date->toSql();

			// Set ordering to the last item if not set
			if (empty($table->ordering))
			{
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->clear();
				$query->select('MAX(ordering)')->from($db->quoteName('#__sr_room_types'));
				$db->setQuery($query);
				$max = $db->loadResult();

				$table->ordering = $max+1;
			}
		}
		else
		{
			$table->modified_date	= $date->toSql();
			$table->modified_by		= $user->get('id');
		}
	}

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param	object	A record object.
	 * @return	array	An array of conditions to add to add to ordering queries.
	 * @since	1.6
	 */
	protected function getReorderConditions($table = null)
	{
		$condition = array();
		$condition[] = 'reservation_asset_id = '.(int) $table->reservation_asset_id;
		return $condition;
	}

	/**
	 * Method to save the form data.
	 *
	 * @param	array	The form data.
	 * @return	boolean	True on success.
	 */
	public function save($data)
	{
		$dispatcher = JDispatcher::getInstance();
		$table		= $this->getTable();
		$pk			= (!empty($data['id'])) ? $data['id'] : (int)$this->getState($this->getName().'.id');
		$isNew		= true;

		// Include the content plugins for the on save events.
		JPluginHelper::importPlugin('extension');

		// Load the row if saving an existing record.
		if ($pk > 0)
		{
			$table->load($pk);
			$isNew = false;
		}

		// Bind the data.
		if (!$table->bind($data))
		{
			$this->setError($table->getError());
			return false;
		}

		// Prepare the row for saving
		$this->prepareTable($table);

		// Check the data.
		if (!$table->check())
		{
			$this->setError($table->getError());
			return false;
		}

		// Trigger the onContentBeforeSave event.
		$result = $dispatcher->trigger($this->event_before_save, array($data, $table, $isNew));
		if (in_array(false, $result, true))
		{
			$this->setError($table->getError());
			return false;
		}

		// Store the data.
		if (!$table->store())
		{
			$this->setError($table->getError());
			return false;
		}

		// Clean the cache.
		$cache = JFactory::getCache($this->option);
		$cache->clean();

		// Trigger the onContentAfterSave event.
		$dispatcher->trigger($this->event_after_save, array($data, $table, $isNew));

		$pkName = $table->getKeyName();
		if (isset($table->$pkName))
		{
			$this->setState($this->getName().'.id', $table->$pkName);
		}
		$this->setState($this->getName().'.new', $isNew);

		return true;
	}
}