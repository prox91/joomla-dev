<?php
defined('_JEXEC') or die;

class EnglishConceptTableLevel extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_levels', 'id', $_db);
	}
}

