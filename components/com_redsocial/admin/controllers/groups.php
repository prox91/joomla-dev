<?php
/**
 * @package     redSocialstream
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class groupsController extends JController
{
	function display()
	{
		parent::display();
	}

	function __construct($default = array())
	{
		parent::__construct($default);
	}

	function cancel()
	{
		$this->setRedirect('index.php');
	}

	function orderup()
	{
		$model = $this->getModel('groups');
		$model->move(-1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=groups');
	}

	function orderdown()
	{
		$model = $this->getModel('groups');
		$model->move(1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=groups');
	}

	function saveorder()
	{
		$cid   = JRequest::getVar('cid', array(0), 'post', 'array');
		$order = JRequest::getVar('order', array(0), 'post', 'array');

		$model = $this->getModel('groups');
		$model->saveorder($cid, $order);

		$msg = JText::_('COM_REDSOCIALSTREAM_ORDERING_SAVED');
		$this->setRedirect('index.php?option=com_redsocialstream&view=groups', $msg);
	}
}
