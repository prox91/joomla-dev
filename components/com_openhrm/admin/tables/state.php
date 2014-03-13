<?php
defined('_JEXEC') or die;

class OpenHrmTableState extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__openhrm_states', 'id', $_db);
	}
}
