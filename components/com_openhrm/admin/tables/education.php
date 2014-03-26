<?php
defined('_JEXEC') or die;

class OpenHrmTableEducation extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__openhrm_Educations', 'id', $_db);
	}
}
