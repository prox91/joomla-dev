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

class profilesController extends JController
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

	function saveorder()
	{
		$model = $this->getModel('profiles');
		if ($model->saveorder())
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_ORDERING_SAVED');
			$this->setRedirect('index.php?option=com_redsocialstream&view=profiles', $msg);
		}
		else
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_ERROR_REORDERING');
			$this->setRedirect('index.php?option=com_redsocialstream&view=profiles', $msg);
		}

	}

	/**
	 * Logic to orderup
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function orderup()
	{
		$model = $this->getModel('profiles');
		$model->move(-1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}

	/**
	 * Logic to orderdown
	 *
	 * @access public
	 * @return void
	 * @since 0.9
	 */
	function orderdown()
	{
		$model = $this->getModel('profiles');
		$model->move(1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}
}
