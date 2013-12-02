<?php
defined('_JEXEC') or die;

class EnglishConceptTableUsageExercise extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_usages_exercises', 'id', $_db);
	}
}
