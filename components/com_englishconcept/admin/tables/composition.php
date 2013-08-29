<?php
defined('_JEXEC') or die;

/**
 * Class EnglishConceptTableBook
 */
class EnglishConceptTableComposition extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lesson_compositions', 'id', $_db);
	}
}

