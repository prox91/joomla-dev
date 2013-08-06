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
 * Customer controller class.
 *
 * @package     Solidres
 * @subpackage	Customer
 * @since		0.1.0
 */
class SolidresControllerCustomer extends JControllerForm
{
	/**
	 * Method override to check if you can add a new record.
	 *
	 * @param	array $data An array of input data.
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowAdd($data = array())
	{
		$user		= JFactory::getUser();
		$categoryId	= JArrayHelper::getValue($data, 'category_id', JRequest::getInt('filter_category_id'), 'int');
		$allow		= null;

		if ($categoryId)
		{
			// If the category has been passed in the data or URL check it.
			$allow	= $user->authorise('core.create', 'com_solidres.category.'.$categoryId);
		}
		
		if ($allow === null)
		{
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd($data);
		}
		else
		{
			return $allow;
		}
	}

	/**
	 * Method to check if you can add a new record.
	 *
	 * @param	array $data An array of input data.
	 * @param	string $key The name of the key for the primary key.
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		return parent::allowEdit($data, $key);
	}

	public function sendEmail()
	{
		require_once SRPATH_LIBRARY.'/swift/swift_required.php';
		$customerId 	= JRequest::getVar('cId', 0, '', 'int');

		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/tables', 'SolidresTable');
		JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_users/models', 'UsersModel');
		$customerTable 	= JTable::getInstance('Customer', 'SolidresTable');

		$customerTable->load($customerId);	
		
		if (!$customerTable->id)
		{
			echo 0;
			die(1);
		}

		// Sending email
        $message    = Swift_Message::newInstance();
        $transport  = Swift_MailTransport::newInstance();
        $mailer     = Swift_Mailer::newInstance($transport);
        $msg        = '';

        $messageTemplatePath = SRPATH_LIBRARY.'/mail/en-GB/new_customer.html';
		
		$subject 	= JText::_('New customer account is created');
		$model      = JModelLegacy::getInstance('User', 'UsersModel', array('ignore_request' => true));
		$customerJUserInfo = $model->getItem($customerTable->user_id);
		
		$toEmail 	= $customerJUserInfo->email;
		$fromEmail 	= 'vietvh5@gmail.com'; // TODO remove this hard code email
		$fromName  	= 'Viet Hoang Vu';

        if (file_exists($messageTemplatePath))
        {
            $replacements[$toEmail] = array(
                '{customer_firstname}'  => $customerTable->firstname,
                '{customer_middlename}' => $customerTable->middlename,
                '{customer_lastname}'   => $customerTable->lastname
            );

            $body 		= JFile::read($messageTemplatePath);
            $decorator 	= new Swift_Plugins_DecoratorPlugin($replacements);

            $mailer->registerPlugin($decorator);
            $message->setSubject($subject)
                    ->setFrom( array($fromEmail => $fromName) )
                    ->setTo($toEmail)
                    ->setBody($body, 'text/html'); // TODO need to allow use to select html or plain text format

            $numSent = $mailer->send($message);
			echo ($numSent) ? 1 : 0;
			die(1);
        }
		else
		{
			echo 0; // TODO should output proper error message
			die(1);
		}
	}

    /**
	 * Method to save a record.
	 *
	 * @param   string  $key	The name of the primary key of the URL variable.
	 * @param   string  $urlVar	The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return  boolean  True if successful, false otherwise.
	 * @since   11.1
	 */
	public function save($key = null, $urlVar = null)
	{
		// Check for request forgeries.
		JSession::checkToken('GET') or jexit(JText::_('JINVALID_TOKEN'));

		$app		= JFactory::getApplication();
		$lang		= JFactory::getLanguage();
		$model		= $this->getModel();
		$table		= $model->getTable();
		$data		= JRequest::getVar('jform', array(), 'post', 'array');
		$checkin	= property_exists($table, 'checked_out');
		$context	= "$this->option.edit.$this->context";
		$task		= $this->getTask();

		// Determine the name of the primary key for the data.
		if (empty($key))
		{
			$key = $table->getKeyName();
		}

		// To avoid data collisions the urlVar may be different from the primary key.
		if (empty($urlVar))
		{
			$urlVar = $key;
		}

		$recordId	= JRequest::getInt($urlVar);

		$session	= JFactory::getSession();
		$registry	= $session->get('registry');

		if (!$this->checkEditId($context, $recordId))
		{
			// Somehow the person just went to the form and tried to save it. We don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $recordId));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$this->getRedirectToListAppend(), false));

			return false;
		}

		// Populate the row id from the session.
		$data[$key] = $recordId;

		// Access check.
		if (!$this->allowSave($data, $key))
		{
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_SAVE_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$this->getRedirectToListAppend(), false));

			return false;
		}

		// Validate the posted data.
		// Sometimes the form needs some posted data, such as for plugins and modules.
		$form = $model->getForm($data, false);

		if (!$form)
		{
			$app->enqueueMessage($model->getError(), 'error');

			return false;
		}

		// Test whether the data is valid.
		$validData = $model->validate($form, $data);

		// Check for validation errors.
		if ($validData === false)
		{
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				}
				else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState($context.'.data', $data);

			// Redirect back to the edit screen.
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.$this->getRedirectToItemAppend($recordId, $key), false));

			return false;
		}

		// Attempt to save the data.
		if (!$model->save($validData))
		{
			// Save the data in the session.
			$app->setUserState($context.'.data', $validData);

			// Redirect back to the edit screen.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.$this->getRedirectToItemAppend($recordId, $key), false));

			return false;
		}

		// Save succeeded, so check-in the record.
		if ($checkin && $model->checkin($validData[$key]) === false)
		{
			// Save the data in the session.
			$app->setUserState($context.'.data', $validData);

			// Check-in failed, so go back to the record and display a notice.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_CHECKIN_FAILED', $model->getError()));

			$this->setMessage($this->getError(), 'error');
			$this->setRedirect('index.php?option='.$this->option.'&view='.$this->view_item.$this->getRedirectToItemAppend($recordId, $key));

			return false;
		}

		$this->setMessage(JText::_(($lang->hasKey($this->text_prefix.($recordId==0 && $app->isSite() ? '_SUBMIT' : '').'_SAVE_SUCCESS') ? $this->text_prefix : 'JLIB_APPLICATION') . ($recordId==0 && $app->isSite() ? '_SUBMIT' : '') . '_SAVE_SUCCESS'));

		// Load saved record
		$savedRecordId = $model->getState($model->getName().'.id');
		$table->load($savedRecordId);

        echo json_encode(
            array(
                'saved'      	=> 'true',
                'customer_id'	=> $savedRecordId,
				'firstname'		=> $table->firstname,
				'middlename'	=> $table->middlename,
				'lastname'		=> $table->lastname
            )
        );

		die(1);
	}
}