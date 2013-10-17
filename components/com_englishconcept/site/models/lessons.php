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
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Select some field
        $query->select($this->getState('list.select','ls.*'));

        // From the hello table
        $query->from('#__ec_lessons AS ls');
        $query->where('ls.deleted_flg = 0');

        return $query;
    }

    public function getLesson($lesson_id)
    {
		$lesson_data = array();

		// get lesson info
		$lesson_data['lesson_base'] = $this->_getLessonInfo($lesson_id);

		// get lesson script
		$lesson_data['script'] = $this->_getScriptInfo($lesson_id);

		// get lesson comprehension
		$lesson_data['compre'] = $this->_getComprehensionInfo($lesson_id);

		// get lesson key structures
		$lesson_data['key_struct'] = $this->_getKeyStructureInfo($lesson_id);

		// get lesson special difficulties
		$lesson_data['special_diff'] = $this->_getSpecialDifficultyInfo($lesson_id);

		// get lesson exercises
		$lesson_data['exercise'] = $this->_getExerciseInfo($lesson_id);

		return $lesson_data;
	}

//	public function getLessons($condition = array()) {
//
//		$lesson_data = array();
//
//		$this->db->where('del_flg', 0);
//		$start = 0;
//		$limit = 1;
//		if (!empty($condition) && isset($condition['start']) && isset($condition['limit'])) {
//			$start = $condition['start'];
//			$limit = $condition['limit'];
//		}
//		$this->db->limit($limit, $start);
//		$query = $this->db->get('lesson');
//
//		foreach ($query->result() as $row){
//			$lesson_data[$row->id] = $this->getLesson($row->id);
//		}
//
//		return $lesson_data;
//	}

	private function _getLessonInfo($lesson_id)
    {
		$this->db->where('id', $lesson_id);
		$query = $this->db->get('lesson');
		return $query->row_array();
	}

	private function _getScriptInfo($lesson_id)
    {
		$this->db->where('lesson_id', $lesson_id);
		$query = $this->db->get('lesson_script');
		return $query->row_array();
	}

	private function _getComprehensionInfo($lesson_id)
    {
		$this->db->where('lesson_id', $lesson_id);
		$query = $this->db->get('lesson_comprehension');
		return $query->result_array();
	}

	private function _getKeyStructureInfo($lesson_id)
    {
		$this->db->where('lesson_id', $lesson_id);
		$query = $this->db->get('lesson_key_structures');
		return $query->row_array();
	}

	private function _getSpecialDifficultyInfo($lesson_id)
    {
		$this->db->where('lesson_id', $lesson_id);
		$query = $this->db->get('lesson_special_difficulties');
		return $query->row_array();
	}

	private function _getExerciseInfo($lesson_id)
    {
		$this->db->where('lesson_id', $lesson_id);
		$query = $this->db->get('lesson_exercises');
		return $query->result_array();
	}
}
