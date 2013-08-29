<?php
defined('_JEXEC') or die;

/**
 * Class EnglishConceptTableBook
 */
class EnglishConceptTableExercise extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_exercises', 'id', $_db);
	}
}

