<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die;

class OpenHrmControllerOrganizationInfo extends RControllerForm
{
	function __construct($config = array())
	{
		parent::__construct($config);
	}

	public function save($key = null, $urlVar = null)
	{
		$task = $this->getTask();

		switch ($task)
		{
			case 'save':
				$this->view_list = 'countries';

				break;
		}

		parent::save($key, $urlVar);
	}

	public function cancel($key = null)
	{
		$this->$this->view_list = 'countries';
	}
}
