<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 5/11/13
 * Time: 4:12 PM
 * To change this template use File | Settings | File Templates.
 */
// no direct access
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptModelPrecis extends JModelAdmin
{
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $text_prefix = null;

	/**
	 * The event to trigger after deleting the data.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $event_after_delete = null;

	/**
	 * The event to trigger after saving the data.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $event_after_save = null;

	/**
	 * The event to trigger before deleting the data.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $event_before_delete = null;

	/**
	 * The event to trigger before saving the data.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $event_before_save = null;

	/**
	 * The event to trigger after changing the published state of the data.
	 *
	 * @var    string
	 * @since  12.2
	 */
	protected $event_change_state = null;

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JModelLegacy
	 * @since   12.2
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->event_after_delete 	= 'onPrecisAfterDelete';
		$this->event_after_save 	= 'onPrecisAfterSave';
		$this->event_before_delete 	= 'onPrecisBeforeDelete';
		$this->event_before_save 	= 'onPrecisBeforeSave';
		$this->event_change_state 	= 'onPrecisChangeState';
		$this->text_prefix 			= strtoupper($this->option);
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $name     The table name. Optional.
	 * @param   string  $prefix   The class prefix. Optional.
	 * @param   array   $options  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   12.2
	 * @throws  Exception
	 */
	public function getTable($name = 'precis', $prefix = 'EnglishConceptTable', $options = array())
	{
		return parent::getTable($name, $prefix, $options);
	}

	/**
	 * Abstract method for getting the form from the model.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 *
	 * @since   12.2
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_englishconcept.precis',
			'precis',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('precises.id')) {
			// Existing record. Can only edit in selected categories.
			//$form->setFieldAttribute('catid', 'action', 'core.edit');
		} else {
			// New record. Can only create in selected categories.
			//$form->setFieldAttribute('catid', 'action', 'core.create');
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  array    The default data is an empty array.
	 *
	 * @since   12.2
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_englishconcept.edit.precis.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param   JTable  $table  A reference to a JTable object.
	 *
	 * @return  void
	 *
	 * @since   12.2
	 */
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->name		= htmlspecialchars_decode($table->name, ENT_QUOTES);
		$table->modified	= $date->toSql();
		$table->modified_by	= $user->get('id');
	}
}
