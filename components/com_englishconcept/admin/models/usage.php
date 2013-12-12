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

class EnglishConceptModelUsage extends JModelAdmin
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

		$this->event_after_delete 	= 'onUsageAfterDelete';
		$this->event_after_save 	= 'onUsageAfterSave';
		$this->event_before_delete 	= 'onUsageBeforeDelete';
		$this->event_before_save 	= 'onUsageBeforeSave';
		$this->event_change_state 	= 'onUsageChangeState';
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
	public function getTable($name = 'usage', $prefix = 'EnglishConceptTable', $options = array())
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
		$form = $this->loadForm('com_englishconcept.usage',
			'usage',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('usages.id')) {
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
		$data = JFactory::getApplication()->getUserState('com_englishconcept.edit.usage.data', array());

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
		$date = JFactory::getDate();
		$user = JFactory::getUser();

        // register difference special/usage no
        $query = $this->_db->getQuery(true);
        $query->select('lesson_no')
            ->from('#__ec_lessons')
            ->where('deleted_flg = 0 AND id='.$table->lesson_id);
        $this->_db->setQuery($query);
        $lessonObj = $this->_db->loadObject();

        // Set lesson number
        if(empty($lessonObj))
        {
            $table->diffspecial_no = "DS.1";
        }
        else
        {
            $table->diffspecial_no = "DS." . $lessonObj->lesson_no;
        }

		$diffspecial_ref = implode(",", $table->diffspecial_ref);
		$table->diffspecial_ref = $diffspecial_ref;

        // If insert new record
        if(is_null($table->id))
        {
            $table->created	= $date->toSql();
            $table->created_by	= $user->get('id');
        }
        else // Update record
        {
            $table->modified	= $date->toSql();
            $table->modified_by	= $user->get('id');
        }
	}

    /**
     * Method to get a single record.
     *
     * @param   integer  $pk  The id of the primary key.
     *
     * @return  mixed    Object on success, false on failure.
     *
     * @since   11.1
     */
    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);

        if (!empty($item)) {

            // Get data exercise for grammar
            $query = $this->_db->getQuery(true);
            $query->select("*")
                ->from("#__ec_lessons_usages_exercises")
                ->where("usage_id='" . $item->id . "'");
            $this->_db->setQuery($query);

            $exercises = $this->_db->loadObjectList();
            if (!empty($exercises)) {
                $item->exercises = $exercises;
            }
        }

        return $item;
    }
}
