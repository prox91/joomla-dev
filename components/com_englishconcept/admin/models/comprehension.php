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

class EnglishConceptModelComprehension extends JModelAdmin
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

		$this->event_after_delete 	= 'onComprehensionAfterDelete';
		$this->event_after_save 	= 'onComprehensionAfterSave';
		$this->event_before_delete 	= 'onComprehensionBeforeDelete';
		$this->event_before_save 	= 'onComprehensionBeforeSave';
		$this->event_change_state 	= 'onComprehensionChangeState';
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
	public function getTable($name = 'comprehension', $prefix = 'EnglishConceptTable', $options = array())
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
		$form = $this->loadForm('com_englishconcept.comprehension', 'comprehension', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('comprehensions.id')) {
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
		$data = JFactory::getApplication()->getUserState('com_englishconcept.edit.comprehension.data', array());

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

		$table->modified	= $date->toSql();
		$table->modified_by	= $user->get('id');
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
            // Get data question for comprehension

            $query = $this->_db->getQuery(true);
            $query->select("*")
                ->from("#__ec_lesson_comprehensions_questions")
                ->where("comprehension_id='" . $item->id . "'");
            $this->_db->setQuery($query);

            $questions = $this->_db->loadObjectList();
            if (!empty($questions)) {
                $item->questions = $questions;
            }
        }

        return $item;
    }


    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   11.1
     */
    public function save($data)
    {
        if(parent::save($data))
        {
            $comprehension_id = '';
            if(isset($data['id']))
            {
                // Delete old data
                $q = $this->_db->getQuery(true);
                $q->delete('#__ec_lesson_comprehensions_questions')
                    ->where('comprehension_id='. $data['id']);
                $this->_db->setQuery($q);
                $this->_db->execute();

                if ($error = $this->_db->getErrorMsg())
                {
                    $this->setError($error);
                    return false;
                }
                $comprehension_id = $data['id'];
            }
            else
            {
                // Create
                $comprehension_id = $this->_db->insertid();
            }

            // Save data question of comprehension
            $input = JFactory::getApplication()->input;
            $postData = $input->get('jform', '', 'ARRAY');
            $questionList = $postData['question'];

            if(is_array($questionList) && count($questionList) > 0)
            {
                $query = $this->_db->getQuery(true);
                $query->clear()
                      ->insert('#__ec_lesson_comprehensions_questions')
                      ->columns('comprehension_id, question');

                foreach ($questionList['title'] as $key => $value)
                {
                    $query->values($comprehension_id . ',' . $this->_db->quote($value));
                }

                $this->_db->setQuery($query);
                $this->_db->execute();

                if ($error = $this->_db->getErrorMsg())
                {
                    $this->setError($error);
                    return false;
                }
            }

            return true;
        }
        else
        {
            return false;
        }
    }
}
