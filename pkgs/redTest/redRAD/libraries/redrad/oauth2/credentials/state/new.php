<?php
/**
 * @package     RedRad
 * @subpackage  OAuth2
 *
 * This work is based on a Louis Landry work about oauth1 server suport for Joomla! Platform.
 * URL: https://github.com/LouisLandry/joomla-platform/tree/9bc988185ccc3e1c437256cc2c927e49312b3d00/libraries/joomla/oauth1
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('JPATH_PLATFORM') or die;

/**
 * OAuth New Credentials class for the RedRAD
 *
 * @package     RedRAD
 * @subpackage  OAuth2
 * @since       1.0
 */
class ROauth2CredentialsStateNew extends ROauth2CredentialsState
{
	/**
	 * Method to authorise the credentials.  This will persist a temporary credentials set to be authorised by
	 * a resource owner.
	 *
	 * @param   integer  $resourceOwnerId  The id of the resource owner authorizing the temporary credentials.
	 * @param   integer  $lifetime         How long the permanent credentials should be valid (defaults to forever).
	 *
	 * @return  ROauth2CredentialsState
	 *
	 * @since   1.0
	 * @throws  LogicException
	 */
	public function authorise($resourceOwnerId, $lifetime = 0)
	{
		throw new LogicException('Only temporary credentials can be authorised.');
	}

	/**
	 * Method to convert a set of authorised credentials to token credentials.
	 *
	 * @return  ROauth2CredentialsState
	 *
	 * @since   1.0
	 * @throws  LogicException
	 */
	public function convert()
	{
		throw new LogicException('Only authorised credentials can be converted.');
	}

	/**
	 * Method to deny a set of temporary credentials.
	 *
	 * @return  ROauth2CredentialsState
	 *
	 * @since   1.0
	 * @throws  LogicException
	 */
	public function deny()
	{
		throw new LogicException('Only temporary credentials can be denied.');
	}

	/**
	 * Method to initialise the credentials.  This will persist a temporary credentials set to be authorised by
	 * a resource owner.
	 *
	 * @param   string   $clientId      The key of the client requesting the temporary credentials.
	 * @param   string   $clientSecret  The secret key of the client requesting the temporary credentials.
	 * @param   string   $callbackUrl   The callback URL to set for the temporary credentials.
	 * @param   string   $lifetime      How long (DateInterval format) the temporary credentials should be valid (defaults to 60 minutes).
	 *
	 * @url http://php.net/manual/en/class.dateinterval.php
	 *
	 * @return  ROauth2CredentialsState
	 *
	 * @since   1.0
	 * @throws  LogicException
	 */
	public function initialise($clientId, $clientSecret, $callbackUrl, $lifetime = 'PT1H')
	{
		// Setup the properties for the credentials.
		$this->table->credentials_id = null;
		$this->table->callback_url = $callbackUrl;
		$this->table->client_id = base64_encode($clientId);
		$this->table->client_secret = $clientSecret;
		$this->table->client_ip = trim($_SERVER['REMOTE_ADDR']);
		$this->table->temporary_token = $this->randomKey();
		$this->table->resource_uri = $callbackUrl;
		$this->table->type = ROauth2Credentials::TEMPORARY;

		// Set the correct date adding the lifetime
		$date = JFactory::getDate();
		$date->add(new DateInterval($lifetime));
		$this->table->temporary_expiration_date = $date->toSql();

		// Persist the object in the database.
		$this->create();

		return new ROauth2CredentialsStateTemporary($this->table);
	}

	/**
	 * Method to revoke a set of token credentials.
	 *
	 * @return  ROauth2CredentialsState
	 *
	 * @since   1.0
	 * @throws  LogicException
	 */
	public function revoke()
	{
		throw new LogicException('Only token credentials can be revoked.');
	}
}
