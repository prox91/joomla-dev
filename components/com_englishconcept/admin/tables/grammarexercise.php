<?php
defined('_JEXEC') or die;

class EnglishConceptTableGrammarExercise extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_grammars_exercises', 'id', $_db);
	}
}
