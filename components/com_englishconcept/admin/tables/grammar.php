<?php
defined('_JEXEC') or die;

class EnglishConceptTableGrammar extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lesson_grammars', 'id', $_db);
	}
}
