<?php
defined('_JEXEC') or die;

class EnglishConceptTableGrammarExerciseQuestion extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lesson_grammars_exercises_questions', 'id', $_db);
	}
}
