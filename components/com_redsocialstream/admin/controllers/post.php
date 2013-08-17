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

class postController extends JController
{
	function __construct($default = array())
	{
		parent::__construct($default);
		$this->registerTask('add', 'edit');
	}

	function edit()
	{
		JRequest::setVar('view', 'post');
		JRequest::setVar('layout', 'default');
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
		$model = $this->getModel();
		$model->checkout();
	}

	function save()
	{
		$post = JRequest::get('post');

		$cid        = JRequest::getVar('cid', array(0), 'post', 'array');
		$post['id'] = $cid[0];
		$model      = $this->getModel();

		if ($model->store($post))
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_POST_SAVE');

		}
		else
		{
			$msg = JText::_('COM_REDSOCIALSTREAM_ERROR_SAVING_POST');
		}

		$link = 'index.php?option=com_redsocialstream&view=posts';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		global $mainframe;

		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('COM_REDSOCIALSTREAM_NO_ITEM_SELECTED'));
		}

		$model = $this->getModel('post');
		if (!$model->delete($cid))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=posts');
	}

	function publish()
	{
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('COM_REDSOCIALSTREAM_NO_ITEM_SELECTED'));
		}

		$model = $this->getModel('post');

		if (!$model->publish($cid, 1))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=posts');
	}

	function unpublish()
	{
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JError::raiseError(500, JText::_('COM_REDSOCIALSTREAM_NO_ITEM_SELECTED'));
		}

		$model = $this->getModel('post');
		if (!$model->publish($cid, 0))
		{
			echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect('index.php?option=com_redsocialstream&view=posts');
	}

	function cancel()
	{
		$this->setRedirect('index.php?option=com_redsocialstream&view=posts');
	}
}
