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
 * ReservationNote controller class.
 *
 * @package     Solidres
 * @subpackage	ReservationNote
 * @since		0.3.0
 */
class SolidresControllerReservationNote extends JControllerForm
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
		$allow	= null;

		if ($allow === null)
		{
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd($data);
		} else {
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

	public function save()
	{
		// Check for request forgeries.
		JSession::checkToken('POST') or jexit(JText::_('JINVALID_TOKEN'));
		$date = JFactory::getDate();
		$user = JFactory::getUser();
		$input = JFactory::getApplication()->input;

		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_solidres/tables');	
		$table = JTable::getInstance('ReservationNote', 'SolidresTable');

		$data = array();
		$data['reservation_id'] = $input->getUint('reservation_id', 0);
		$data['text'] = $input->getString('text', '');
		$data['created_date'] = $date->toSql();
		$data['created_by'] = $user->get('id');
		$data['notify_customer'] = $input->getUint('notify_customer', 0);
		$data['visible_in_frontend'] = $input->getUint('visible_in_frontend', 0);

		$table->bind($data);
		$result = $table->store();
				
		$status = 0;	
		if ($result) 
		{
			$status = 1;
		}

		$user = JFactory::getUser($table->created_by);

		// Send email to customer if configured
		$emailSendingResult = '';
		if ($data['notify_customer'] == 1)
		{
			$mail = SRFactory::get('solidres.mail.mail');
			$messageTemplatePath = SRPATH_LIBRARY.'/mail/en-GB/reservation_note_customer_notify.html';

			// Query some info
			$resTable = JTable::getInstance('Reservation', 'SolidresTable');
			$raTable = JTable::getInstance('ReservationAsset', 'SolidresTable');
			$resTable->load($data['reservation_id']);
			$raTable->load($resTable->reservation_asset_id);

			if (file_exists($messageTemplatePath))
			{
				$body = file_get_contents($messageTemplatePath);
			}

			$replacements[$resTable->customer_email] = array(
				'{hotel_name}' => $raTable->name,
				'{hotel_url}' => $raTable->website,
				'{customer_firstname}' => $resTable->customer_firstname,
				'{customer_middlename}' => $resTable->customer_middlename,
				'{customer_lastname}' => $resTable->customer_lastname,
				'{email}' => $raTable->email,
				'{phone}' => $raTable->phone,
				'{text}' => $data['text']
			);

			$mail->mailFrom = array($raTable->email => $raTable->name);
			$mail->mailTo = $resTable->customer_email;
			$mail->replacements = $replacements;
			$mail->subject = JText::_('SR_RESERVATION_NOTE_FROM') . $raTable->name;
			$mail->body = $body;

			if (!$mail->send())
			{
				$emailSendingResult = 'Could not send email';
			}
		}

		$response = array(
			'status' => $status,
			'message' => $emailSendingResult,
			'next' => '',
			'text' => $table->text,
			'created_date' => $table->created_date,
			'created_by_username' => $user->get('username'),
			'notify_customer' => $table->notify_customer == 1 ? JText::_('JYES') : JText::_('JNO'),
			'visible_in_frontend' => $table->visible_in_frontend == 1 ? JText::_('JYES') : JText::_('JNO')
		);

		echo json_encode($response);
	}
}
