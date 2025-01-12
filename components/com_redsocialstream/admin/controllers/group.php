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

class groupController extends JController
{
	function __construct($default = array())
	{
		parent::__construct($default);
		$this->registerTask('add', 'edit');
	}

	function edit()
	{
		JRequest::setVar('view', 'group');
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
		$post       = JRequest::get('post');
		$cid        = JRequest::getVar('cid', array(0), 'post', 'array');
		$option     = JRequest::getVar('option');
		$post['id'] = $cid[0];
		$model      =  $this->getModel();

		if ($row = $model->store($post))
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_GROUP_SAVE');
		}
		else
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_ERROR_SAVING_GROUP');
		}

		if ($apply == 1)
		{
			$this->setRedirect('index.php?option=' . $option . '&view=group&task=edit&cid[]=' . $row->id, $msg);
		}
		else
		{
			$this->setRedirect('index.php?option=' . $option . '&view=groups', $msg);
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

		$model = $this->getModel('group');
		if (!$model->delete($cid))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=groups');
	}

	function publish()
	{
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('Select an item to publish'));
		}

		$model = $this->getModel('group');
		if (!$model->publish($cid, 1))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=groups');
	}

	function unpublish()
	{
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('Select an item to unpublish'));
		}

		$model = $this->getModel('group');
		if (!$model->publish($cid, 0))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=groups');
	}

	function cancel()
	{
		$model = $this->getModel('group');
		$model->checkin();
		$this->setRedirect('index.php?option=com_redsocialstream&view=groups');
	}

}
