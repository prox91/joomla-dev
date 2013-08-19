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

class configureController extends JController
{
	function __construct($default = array())
	{
		parent::__construct($default);
		$this->registerTask('save', 'apply', 'cancel');
	}

	function apply()
	{
		$db = JFactory::getDBO();
		$q  = "SELECT * FROM #__redsocialstream_settings";
		$db->setQuery($q);
		$settingsrows = $db->loadObjectList();

		foreach ($settingsrows as $row)
		{
			if (strtolower(JRequest::getVar('settings_' . $row->dataname . '_save')) == 'true')
			{
				if (strtolower($row->datatype) == 'html')
				{
					$data = JRequest::getVar('settings_' . $row->dataname, '', 'post', 'string', JREQUEST_ALLOWRAW);
				}
				else
				{
					$data = JRequest::getVar('settings_' . $row->dataname);
				}

				$q = ' update #__redsocialstream_settings set data = "' . mysql_real_escape_string($data) . '" where dataname = "' . $row->dataname . '" ';
				$db->setQuery($q);
				$db->query();

			}

		}

		$link = 'index.php?option=com_redsocialstream&view=configure';
		$this->setRedirect($link, $msg);
	}

	function cancel()
	{
		$link = 'index.php?option=com_redsocialstream';
		$this->setRedirect($link, $msg);
	}

	function saveorder()
	{
		$model = $this->getModel('configure');
		if ($model->saveorder())
		{
			$this->setRedirect('index.php?option=com_redsocialstream&view=configure');
		}
		else
		{
			$this->setRedirect('index.php?option=com_redsocialstream&view=configure', JText::_('COM_REDFORM_ERROR_REORDERING'));
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
		$model = $this->getModel('configure');
		$model->move(-1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=configure');
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
		$model = $this->getModel('configure');
		$model->move(1);

		$this->setRedirect('index.php?option=com_redsocialstream&view=configure');
	}
}
