<?php
defined('_JEXEC') or die;

class EnglishConceptTableBook extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_books', 'id', $_db);
	}
}
