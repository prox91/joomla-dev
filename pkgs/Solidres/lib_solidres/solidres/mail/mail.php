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

require_once SRPATH_LIBRARY.'/swift/swift_required.php';

/**
 * @package     Solidres
 * @subpackage	Mail
 * @since		0.3.0
 */
class SRMail
{
	public $mailTo = array();

	public $mailFrom = array();

	public $subject;

	public $body;

	protected $transport;

	protected $mailer;

	public $replacements;

	protected $message;

	public $contentType = 'text/html';

	public function __construct()
	{
		$this->getMailer();

		$this->message = Swift_Message::newInstance();
	}

	public function getTransport()
	{
		// Get Joomla mailer
		$config = JFactory::getConfig();
		$jmailer = $config->get('mailer');
		switch ($jmailer)
		{
			case 'sendmail':
				$this->transport  = Swift_SendmailTransport::newInstance($config->get('sendmail') . ' -bs');
				break;
			case 'smtp':
				$this->transport  = Swift_SmtpTransport::newInstance( $config->get('smtphost'), $config->get('smtpport'));

				if ($config->get('smtpauth') == 1)
				{
					$smtpUser = $config->get('smtpuser');
					$smtpPass = $config->get('smtppass');
					if (!empty($smtpUser) && !empty($smtpPass))
					{
						$this->transport->setUsername($smtpUser)->setPassword($smtpPass);
					}

					$smtpEncryption = $config->get('smtpsecure');
					if (!empty($smtpEncryption))
					{
						$this->transport->setEncryption($smtpEncryption);
					}
				}

				break;
			default:
			case 'mail':
				$this->transport  = Swift_MailTransport::newInstance();
				break;
		}
	}

	public function getMailer()
	{
		if (!isset($this->transport))
		{
			$this->getTransport();
		}
		$this->mailer = Swift_Mailer::newInstance($this->transport);
	}

	public function send()
	{
		if (!empty($this->replacements))
		{
			$decorator = new Swift_Plugins_DecoratorPlugin($this->replacements);
			$this->mailer->registerPlugin($decorator);
		}

		$this->message->setSubject($this->subject)
			->setFrom( $this->mailFrom )
			->setTo( $this->mailTo )
			->setBody($this->body, $this->contentType);
		$numSent = $this->mailer->send($this->message);
		if (!$numSent)
		{
			return false;
		}
		return true;
	}
}