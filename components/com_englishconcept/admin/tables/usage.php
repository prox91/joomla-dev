<?php
defined('_JEXEC') or die;

class EnglishConceptTableUsage extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lesson_usages', 'id', $_db);
	}
}
