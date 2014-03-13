<?php
defined('_JEXEC') or die;

class OpenHrmTableMaritalState extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__openhrm_marital_states', 'id', $_db);
	}
}
