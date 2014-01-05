<?php
defined('_JEXEC') or die;

class OpenHrmTableOrganizationInfo extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__openhrm_organization_infos', 'id', $_db);
	}
}
