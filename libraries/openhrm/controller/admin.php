<?php

defined('JPATH_OPENHRM') or die;

if (version_compare(JVERSION, '3.0', 'lt'))
{
	JLoader::import('joomla.application.component.model');

	class RControllerAdmin extends RControllerAdminBase
	{
		protected function postDeleteHook(JModel $model, $id = null)
		{
		}
	}
}

else
{
	class RControllerAdmin extends RControllerAdminBase
	{
	}
}
