<?php
defined('_JEXEC') or die;

class EnglishConceptTableUsage extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons_usages', 'id', $_db);
	}
}
