<?php
defined('_JEXEC') or die;

class OpenHrmTableCountry extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__openhrm_countries', 'id', $_db);
	}
}
