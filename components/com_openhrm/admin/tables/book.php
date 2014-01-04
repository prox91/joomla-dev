<?php
defined('_JEXEC') or die;

class OpenHrmTableBook extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_books', 'id', $_db);
	}
}
