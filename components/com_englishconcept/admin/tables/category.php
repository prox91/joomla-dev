<?php
defined('_JEXEC') or die;

class EnglishConceptTableCategory extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_categories', 'id', $_db);
	}
}
