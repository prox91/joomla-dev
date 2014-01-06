<?php
defined('_JEXEC') or die;

class OpenHrmTableMaritalStatus extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__openhrm_marital_statuses', 'id', $_db);
	}
}
