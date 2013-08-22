<?php
defined('_JEXEC') or die;

/**
 * Class EnglishConceptTableBook
 */
class EnglishConceptTableCategory extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__ec_categories', 'id', $_db);
	}
}

