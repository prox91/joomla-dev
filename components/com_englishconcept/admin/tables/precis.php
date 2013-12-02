<?php
defined('_JEXEC') or die;

class EnglishConceptTablePrecis extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_precises', 'id', $_db);
	}
}
