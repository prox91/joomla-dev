<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controllerform');
include_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/redtwitter.php';

/**
 * Class RedtwitterControllerOauth_Info
 */
class RedtwitterControllerOauth_Info extends JControllerForm
{
	/**
	 * @param array $default
	 */
	public function __construct($default = array())
	{
		parent::__construct($default);
	}

	/**
	 * Proxy for getModel.
	 * @since    1.6
	 */
	public function getModel($name = 'Oauth_Info', $prefix = 'RedtwitterModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

	/**
	 * @return bool|void
	 */
	public function cancel()
	{
		$this->redirect = "index.php?option=com_redtwitter";
	}

	/**
	 *  Get access token from twitter
	 */
	public function generateToken()
	{
		$input = JFactory::getApplication()->input;
		$jform = $input->get('jform', '', 'ARRAY');

		if ($jform['consumer_key'] != "" && $jform['consumer_secret'] != "")
		{
			$access_token = RedtwitterHelper::getAccessToken($jform['consumer_key'], $jform['consumer_secret']);

			$session = JFactory::getSession();
			if(!empty($access_token))
			{
				$data['access_token'] = "Bearer ".$access_token;
				$data = array_merge($jform, $data);
				$this->getModel()->updateToken($data);

				$session->set('generatedFlag', true);
			}
			else
			{
				$session->set('generatedFlag', false);
			}

			$this->redirect = "index.php?option=com_redtwitter&view=oauth_info";
		}
	}
}
