<?php
defined('_JEXEC') or die;

/**
 * Class EnglishConceptTableBook
 */
class EnglishConceptTableGrammar extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lesson_grammars', 'id', $_db);
	}
}

