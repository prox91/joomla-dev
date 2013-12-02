<?php
defined('_JEXEC') or die;

class EnglishConceptTableComposition extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_compositions', 'id', $_db);
	}
}
