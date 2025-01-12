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

class EnglishConceptModelGrammarExerciseQuestion extends JModelAdmin
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

		$this->event_after_delete 	= 'onGrammarAfterDelete';
		$this->event_after_save 	= 'onGrammarAfterSave';
		$this->event_before_delete 	= 'onGrammarBeforeDelete';
		$this->event_before_save 	= 'onGrammarBeforeSave';
		$this->event_change_state 	= 'onGrammarChangeState';
		$this->text_prefix 			= strtoupper($this->option);

		$app = JFactory::$application;
		$input = $app->input;

		$exerciseId = $input->get('exercise_id', 0, 'INT');
		if(!empty($exerciseId))
		{
			$this->setState('exerciseId', $exerciseId);
		}
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
	public function getTable($name = 'grammarexercisequestion', $prefix = 'EnglishConceptTable', $options = array())
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
		$form = $this->loadForm('com_englishconcept.grammarexercisequestion',
			'grammarexercisequestion',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('grammarexercisequestion.id')) {
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
		$data = JFactory::getApplication()->getUserState('com_englishconcept.edit.grammarexercisequestion.data', array());

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
		$exerciseId = $this->getState('exerciseId', 0);

		if (!empty($exerciseId)) {
			// Get data question for exercise
			$query = $this->_db->getQuery(true);
			$query->select("*")
				->from("#__ec_lessons_grammars_exercises_questions")
				->where("exercise_id=" . $exerciseId);
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
		if(isset($data['exercise_id']))
		{
			// Delete old data
			$q = $this->_db->getQuery(true);
			$q->delete('#__ec_lessons_grammars_exercises_questions')
				->where('exercise_id=' . $data['exercise_id']);
			$this->_db->setQuery($q);
			$this->_db->execute();

			if ($error = $this->_db->getErrorMsg())
			{
				$this->setError($error);
				return false;
			}
			$exercise_id = $data['exercise_id'];
		}
		else
		{
			return false;
		}

		// Save data question of exercise
		$input = JFactory::getApplication()->input;
		$postData = $input->get('jform', '', 'ARRAY');
		$questionList = $postData['question'];

		if(is_array($questionList) && count($questionList) > 0)
		{
			$query = $this->_db->getQuery(true);
			$query->clear()
				->insert('#__ec_lessons_grammars_exercises_questions')
				->columns('exercise_id, question');

			foreach ($questionList['title'] as $value)
			{
				$query->values($exercise_id . ',' . $this->_db->quote($value));
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
}
