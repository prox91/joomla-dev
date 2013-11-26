<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptModelLessons extends JModelList
{
    /**
     * Method to auto-populate the model state.
     *
     * This method should only be called once per instantiation and is designed
     * to be called on the first call to the getState() method unless the model
     * configuration flag to ignore the request is set.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   12.2
     */
    protected function populateState($ordering = null, $direction = null)
    {
        parent::populateState($ordering, $direction);

        // Get the pagination request variables
        $app    = JFactory::getApplication();

        // Get the english concept params
		$englishConceptParams = JComponentHelper::getParams('com_englishconcept', true);

        $this->setState('list.limit', 1);
        $this->setState('list.start', $app->input->get('limitstart', 0, 'uint'));
    }

    /**
     * Method to build a sql to load the list data
     *
     * @return   string  An SQL query
     */
    public function getListQuery()
    {
        // Create a new query object
        $query = $this->_db->getQuery(true);

        // Select some field
        $query->select($this->getState('list.select','ls.*'));

        // From the hello table
        $query->from('#__ec_lessons AS ls');
        $query->where('ls.deleted_flg = 0');

        return $query;
    }

	public function getItems()
	{
		$result = parent::getItems();

		if(is_array($result) && !empty($result[0]))
		{
			$item = $result[0];

			// Get compositions info
			$item->compositions = $this->_getCompositionInfos($item->id);

			// Get comprehension info
			$item->comprenhensions = $this->_getComprehensionInfos($item->id);

			// Get precises info
			$item->precises = $this->_getPrecisInfos($item->id);

			// Get grammar info
			$item->grammars = $this->_getGrammarInfos($item->id);

			// Get usage info
			$item->usages = $this->_getUsageInfos($item->id);

			// Get exercise info
			$item->exercises = $this->_getExerciseInfo($item->id);

			$result = $item;
		}

		return $result;
	}

	private function _getCompositionInfos($lessonId)
    {
	    // Create a new query object
	    $query = $this->_db->getQuery(true);
	    $query->select('*')
		    ->from('#__ec_lesson_compositions')
		    ->where('deleted_flg = 0 AND lesson_id='.$lessonId);

		$this->_db->setQuery($query);
	    $result = $this->_db->loadObjectList();
		return $result;
	}

	private function _getComprehensionInfos($lessonId)
    {
	    // Create a new query object
	    $query = $this->_db->getQuery(true);
	    $query->select('*')
		    ->from('#__ec_lesson_comprehensions')
		    ->where('deleted_flg = 0 AND lesson_id='.$lessonId);

	    $this->_db->setQuery($query);
	    $result = $this->_db->loadObject();

	    // Get question
	    if(!empty($result))
	    {
		    $query = $this->_db->getQuery(true);
		    $query->select('*')
			    ->from('#__ec_lesson_comprehensions_questions')
			    ->where('comprehension_id='.$result->id);

			$this->_db->setQuery($query);
		    $questions = $this->_db->loadObjectList();
			$result->questions = $questions;
	    }
	    return $result;
	}

	private function _getPrecisInfos($lessonId)
	{
		// Create a new query object
		$query = $this->_db->getQuery(true);
		$query->select('*')
			->from('#__ec_lesson_precises')
			->where('deleted_flg = 0 AND lesson_id='.$lessonId);

		$this->_db->setQuery($query);
		$result = $this->_db->loadObjectList();
		return $result;
	}

	private function _getGrammarInfos($lessonId)
    {
	    // Create a new query object
	    $query = $this->_db->getQuery(true);
	    $query->select('*')
		    ->from('#__ec_lesson_grammars')
		    ->where('deleted_flg = 0 AND lesson_id='.$lessonId);

	    $this->_db->setQuery($query);
	    $result = $this->_db->loadObject();
        if(!empty($result))
        {
            $query = $this->_db->getQuery(true);
            $query->select('*')
                ->from('#__ec_lesson_grammars_exercises')
                ->where('deleted_flg = 0 AND grammar_id = '.$result->id);

            $this->_db->setQuery($query);
            $exercises = $this->_db->loadObjectList();

            $result->exercises = $exercises;
        }

	    return $result;
	}

	private function _getUsageInfos($lessonId)
    {
	    // Create a new query object
	    $query = $this->_db->getQuery(true);
	    $query->select('*')
		    ->from('#__ec_lesson_usages')
		    ->where('deleted_flg = 0 AND lesson_id='.$lessonId);

	    $this->_db->setQuery($query);
	    $result = $this->_db->loadObject();
        if(!empty($result))
        {
            $query =  $this->_db->getQuery(true);
            $query->select('*')
                ->from('#__ec_lesson_usages_exercises')
                ->where('deleted_flg = 0 AND usage_id='.$result->id);

            $this->_db->setQuery($query);
            $exercises = $this->_db->loadObjectList();

	        if(!empty($exercises) && count($exercises) > 0)
	        {
		        $exerciseIds = array();
		        foreach($exercises as $exercise)
		        {
			        $exerciseIds[] = $exercise->id;
		        }

		        // Get all question which id in exercise id list above
		        $query = $$this->_db->getQuery(true);
		        $query->select('*')
					->from('#__ec_lesson_usages_exercises_questions')
					->where('exercise_id IN (' . implode(',', $exerciseIds) . ')');
				$this->_db->setQuery($query);
				$allQuestions = $this->_db->loadObjectList();

		        if(!empty($allQuestions) && count($allQuestions) > 0)
		        {
			        foreach($exercises as $exercise)
			        {
						//if()
			        }
		        }

		        $result->exercises = $exercises;
	        }
        }
	    return $result;
	}

	private function _getExerciseInfo($lessonId)
    {
	    // Create a new query object
	    $query = $this->_db->getQuery(true);
	    $query->select('*')
		    ->from('#__ec_lesson_exercises')
		    ->where('deleted_flg = 0 AND lesson_id='.$lessonId);

	    $this->_db->setQuery($query);
	    $result = $this->_db->loadObjectList();
	    return $result;
	}
}
