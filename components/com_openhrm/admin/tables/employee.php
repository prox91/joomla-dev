<?php
defined('_JEXEC') or die;

class OpenHrmTableEmployee extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__openhrm_employees', 'id', $_db);
	}
}
