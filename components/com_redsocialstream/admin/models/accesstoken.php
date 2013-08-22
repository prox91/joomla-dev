<?php
/**
 * @package     redSocialstream
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/helper.php');
include(JPATH_SITE . '/components/com_redsocialstream/helpers/linkedin/linkedin.php');

class AccessTokenModelAccessToken extends JModel
{
    private $_tablePrefix = "RedSocialStreamTable";

    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    function getData()
	{
		$session         = JFactory::getSession();
		$post            = JRequest::get('post');
		$redsocialhelper = new redsocialhelper();

		$login = $redsocialhelper->getsettings();
		if (!isset($post['generatetoken']))
		{
			return JText::_('PLEASE_SELECT_SECTION');
		}

		switch ($post['generatetoken'])
		{
			case 'facebook':

				$fb_profile_id = $session->set('fb_profile_id', $post['fb_profile_id']);

				$app_id     = $login['app_id'];
				$app_secret = $login['app_secret'];
				require_once(JPATH_SITE . '/components/com_redsocialstream/helpers/facebook/facebook.php');

				$redirect_url = urlencode(JURI::base() . "index.php?option=com_redsocialstream&view=access_token");

				header("location: https://www.facebook.com/dialog/oauth?client_id=" . $login['app_id'] . "&redirect_uri=" . $redirect_url . "&scope=manage_pages,publish_stream&manage_pages=1&publish_stream=1");
				break;

			case 'linkedin':
				//Linkedin APi Key
				$api_key = $login['linked_api_key'];
				//Linkedin Secret Key
				$secret_key          = $login['linked_secret_key'];
				$redirect_url        = JURI::base() . "index.php?option=com_redsocialstream&view=access_token";
				$linkedin_profile_id = $session->set('linkedin_profile_id', $post['linkedin_profile_id']);
				$API_CONFIG          = array(
					'appKey'      => $api_key,
					'appSecret'   => $secret_key,
					'callbackUrl' => $redirect_url
				);

				$linkedin = new LinkedIn($API_CONFIG);
				$response = $linkedin->retrieveTokenRequest();

				if ($response['success'] === TRUE)
				{
					$session->set('oauthReqToken', $response['linkedin']);
					// redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
					header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
					exit;
				}
				break;
		}
	}

	function saveFacebookAccessToken($data)
	{
        // Get table
        $row = $this->getTable('FacebookAccessToken', $this->_tablePrefix);

        if (!$row->bind($data))
        {
            $this->setError($this->_db->getErrorMsg());

            return false;
        }

        if (!$row->store())
        {
            $this->setError($this->_db->getErrorMsg());

            return false;
        }

        return true;
	}

	function saveTwitterAccessToken($data)
	{
        // Get table
        $row = $this->getTable('TwitterAccessToken', $this->_tablePrefix);

        if (!$row->bind($data))
        {
            $this->setError($this->_db->getErrorMsg());

            return false;
        }

        if (!$row->store())
        {
            $this->setError($this->_db->getErrorMsg());

            return false;
        }

        return true;

	}

	function saveLinkedinAcceesToken($data)
	{
        // Get table
        $row = $this->getTable('LinkedinAccessToken', $this->_tablePrefix);

        if (!$row->bind($data))
        {
            $this->setError($this->_db->getErrorMsg());

            return false;
        }

        if (!$row->store())
        {
            $this->setError($this->_db->getErrorMsg());

            return false;
        }

        return true;
	}
}






