<?php
/**
 * @package     redSocialstream
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class profileController extends JController
{
	function __construct($default = array())
	{
		parent::__construct($default);
		$this->registerTask('add', 'edit');
	}

	function edit()
	{
		JRequest::setVar('view', 'profile');
		JRequest::setVar('layout', 'default');
		JRequest::setVar('hidemainmenu', 1);

		parent::display();

		$model = $this->getModel();
		$model->checkout();
	}

	function apply()
	{
		$this->save(1);
	}

	function save($apply = 0)
	{
		$post                 = JRequest::get('post');
		$cid                  = JRequest::getVar('cid', array(0), 'post', 'array');
		$option               = JRequest::getVar('option');
		$post['id']           = $cid[0];
		$post['updatet_time'] = date('Y-m-d H:i:s');
		$model                = $this->getModel();

		if ($row = $model->store($post))
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_PROFILE_SAVED');
		}
		else
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_ERROR_SAVING_PROFILE');
		}

		if ($apply == 1)
		{
			$this->setRedirect('index.php?option=' . $option . '&view=profile&task=edit&cid[]=' . $row->id, $msg);
		}
		else
		{
			$this->setRedirect('index.php?option=' . $option . '&view=profiles', $msg);
		}
	}

	function remove()
	{
		global $mainframe;

		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('COM_REDSOCIALSTREAM_NO_ITEM_SELECTED'));
		}

		$model = $this->getModel('profile');
		if (!$model->delete($cid))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}

	function publish()
	{
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('COM_REDSOCIALSTREAM_NO_ITEM_SELECTED'));
		}

		$model = $this->getModel('profile');
		if (!$model->publish($cid, 1))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}

	function unpublish()
	{
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('COM_REDSOCIALSTREAM_NO_ITEM_SELECTED'));
		}

		$model = $this->getModel('profile');
		if (!$model->publish($cid, 0))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}

	function cancel()
	{
		$model = $this->getModel('profile');
		$model->checkin();
		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}

	function orderup()
	{
		$model = $this->getModel('profile');
		$model->move(-1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}

	function orderdown()
	{
		$model = $this->getModel('profile');
		$model->move(1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles');
	}

	function saveorder()
	{
		$cid   = JRequest::getVar('cid', array(0), 'post', 'array');
		$order = JRequest::getVar('order', array(0), 'post', 'array');

		$model = $this->getModel('profile');
		$model->saveorder($cid, $order);

		$msg = 'New ordering saved';
		$this->setRedirect('index.php?option=com_redsocialstream&view=profiles', $msg);
	}
}
