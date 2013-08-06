<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/
defined('_JEXEC') or die;

/**
 * Customers list controller class.
 *
 * @package     Solidres
 * @subpackage	Customer
 * @since		0.1.0
 */
class SolidresControllerCustomers extends JControllerAdmin
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @return  UsersControllerUsers
	 *
	 * @since   1.6
	 * @see     JController
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->registerTask('block', 'changeBlock');
		$this->registerTask('unblock', 'changeBlock');
	}

	public function getModel($name = 'Customer', $prefix = 'SolidresModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	/**
	 * Method to change the block status on a record.
	 *
	 * @return  void
	 *
	 * @since   0.3.0
	 */
	public function changeBlock()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('block' => 1, 'unblock' => 0);
		$task   = $this->getTask();
		$value  = JArrayHelper::getValue($values, $task, 0, 'int');

		// Convert from customer ID to Joomla user ID
		$joomlaUserIds = array();
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/tables', 'SolidresTable');
		$customerTable = JTable::getInstance('Customer', 'SolidresTable');

		foreach ($ids as $id)
		{
			$customerTable->load($id);
			$joomlaUserIds[] = $customerTable->user_id;
		}

		if (empty($joomlaUserIds))
		{
			JError::raiseWarning(500, JText::_('SR_CUSTOMERS_NO_ITEM_SELECTED'));
		}
		else
		{
			// Get the model.
			JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_users/models', 'UsersModel');
			$model = JModelLegacy::getInstance('User', 'UsersModel', array('ignore_request' => true));

			// Change the state of the records.
			if (!$model->block($joomlaUserIds, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}
			else
			{
				if ($value == 1)
				{
					$this->setMessage(JText::plural('SR_N_CUSTOMERS_BLOCKED', count($joomlaUserIds)));
				}
				elseif ($value == 0)
				{
					$this->setMessage(JText::plural('SR_N_CUSTOMERS_UNBLOCKED', count($joomlaUserIds)));
				}
			}
		}

		$this->setRedirect('index.php?option=com_solidres&view=customers');
	}
}