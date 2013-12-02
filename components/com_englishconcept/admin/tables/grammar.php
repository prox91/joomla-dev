<?php
defined('_JEXEC') or die;

class EnglishConceptTableGrammar extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_grammars', 'id', $_db);
	}
}
