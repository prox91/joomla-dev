<?php
defined('_JEXEC') or die;

class EnglishConceptTableComprehension extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_comprehensions', 'id', $_db);
	}
}
