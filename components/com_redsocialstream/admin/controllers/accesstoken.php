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
require_once JPATH_COMPONENT . '/helpers/redsocialstream.php';

class AccessTokenController extends JController
{
	function __construct($config = array())
	{
		parent::__construct($config);
	}

    public function requestToken()
    {
        // Get data which was redirect from social site
        $input = JFactory::getApplication()->input;
        $session = JFactory::getSession();

        $generateToken = $input->get('generateToken', '', 'STRING');
        if(!isset($generateToken) || $generateToken == '')
        {
            $this->setRedirect('index.php?option=com_redsocialstream&view=accesstoken', JText::_('PLEASE_SELECT_SECTION'), 'WARNING');
        }
        else
        {
            $callbackUrl = urlencode(JURI::base() ."index.php?option=com_redsocialstream&controller=accesstoken&task=getaccesstoken&view=accesstoken");
            $settingData = RedSocialStreamHelper::getSettingData();

            $session->set('settingData', $settingData);
            $session->set('generateToken', $generateToken);

            switch($generateToken)
            {
                case 'facebook':

                    $session->set('fbProfileId', $input->get('fb_profile_id', 0, 'INT'));
                    $session->set('callbackUrl', $callbackUrl);
                    $loginUrl = "https://www.facebook.com/dialog/oauth?client_id=" . $settingData['app_id'] . "&redirect_uri=" . $callbackUrl . "&scope=manage_pages,publish_stream&manage_pages=1&publish_stream=1";
                    header("location: $loginUrl");
                    break;

                case 'twitter':

                    $session->set('twitterProfileId', $input->get('twitter_profile_id', 0, 'INT'));
                    $this->setRedirect("index.php?option=com_redsocialstream&controller=accesstoken&task=getaccesstoken&view=accesstoken");
                    break;

                case 'linkedin':
                    break;

                case 'youtube':
                    break;

                default:
                    break;
            }
        }

        /*
        $oauth_verifier = $input->get('oauth_verifier', '', 'STRING');
        $oauth_token = $input->get('oauth_token', '', 'STRING');
        if ($oauth_verifier != "" && $oauth_token != "")
        {
            $model = $this->getModel('AccessToken');
            $model->saveLinkedinAcceesToken($oauth_token, $oauth_verifier);
        }
        */
    }

    public function getAccessToken()
    {
        // Get data which was redirect from social site
        $input = JFactory::getApplication()->input;
        $session = JFactory::getSession();
        $generateToken    = $input->get('generate_token', '', 'STRING');
        $model = $this->getModel('AccessToken');
        $settingData = $session->get('settingData');
        $generateToken =$session->get('generateToken');

        $session->clear('generateToken');
        $session->clear('settingData');

        switch($generateToken)
        {
            case 'facebook':

                $code = $input->get('code', '', 'STRING');
                $fbProfileId = $session->get('fbProfileId');
                $callbackUrl = $session->get('callbackUrl');
                $session->clear('fbProfileId');
                $session->clear('callbackUrl');
                $accessToken = "";
                if ($code != "")
                {
                    $accessToken = RedSocialStreamHelper::requestFbAccessToken($settingData['app_id'], $settingData['app_secret'], $callbackUrl, $code);
                }

                if(!empty($accessToken))
                {
                    // Save to database
                    $data = RedSocialStreamHelper::getFacebookAccessToken($fbProfileId);

                    $now = date('Y-m-d H:i:s');

                    if(empty($data))
                    {
                        $data = new stdClass;
                        $data->created = $now;
                    }

                    $data->profile_id = $fbProfileId;
                    $data->access_token = $accessToken;
                    $data->updated = $now;

                    if($model->saveFacebookAccessToken($data))
                    {
                        $msg = JText::_('COM_REDSOCIALSTREAM_FACEBOOK_TOKEN_GENERATED');
                        $level = 'MESSAGE';
                    }
                    else
                    {
                        $msg = $model->getError();
                        if(empty($msg))
                        {
                            $msg = JText::_('COM_REDSOCIALSTREAM_FACEBOOK_TOKEN_UNGENERATED');
                        }
                        $level = 'WARNING';
                    }
                }
                else
                {
                    $msg = JText::_('COM_REDSOCIALSTREAM_FACEBOOK_TOKEN_UNGENERATED');
                    $level = 'WARNING';
                }
                $this->setRedirect('index.php?option=com_redsocialstream&view=accesstoken', $msg, $level);

                break;

            case 'twitter':
                $twitterProfileId  = $session->get('twitterProfileId');
                $session->clear('twitterProfileId');

                $bearerToken = RedSocialStreamHelper::requestTwitterAccessToken($settingData['twitter_consumer_key'], $settingData['twitter_consumer_sec']);
                if(!empty($bearerToken))
                {
                    // Save to database
                    $data = RedSocialStreamHelper::getTwitterAccessToken($twitterProfileId);

                    $now = date('Y-m-d H:i:s');

                    if(empty($data))
                    {
                        $data = new stdClass;
                        $data->created = $now;
                    }

                    $data->profile_id = $twitterProfileId;
                    $data->access_token = $bearerToken;
                    $data->updated = $now;

                    if($model->saveTwitterAccessToken($data))
                    {
                        $msg = JText::_('COM_REDSOCIALSTREAM_TWITTER_TOKEN_GENERATED');
                        $level = 'MESSAGE';
                    }
                    else
                    {
                        $msg = $model->getError();
                        if(empty($msg))
                        {
                            $msg = JText::_('COM_REDSOCIALSTREAM_TWITTER_TOKEN_UNGENERATED');
                        }
                        $level = 'WARNING';
                    }
                }
                else
                {
                    $msg = JText::_('COM_REDSOCIALSTREAM_TWITTER_TOKEN_UNGENERATED');
                    $level = 'WARNING';
                }
                $this->setRedirect('index.php?option=com_redsocialstream&view=accesstoken', $msg, $level);

                break;

            case 'linkedin':
                break;

            case 'youtube':
                break;

            default:
                break;
        }
    }

	public function cancel()
	{
		$this->setRedirect('index.php?option=com_redsocialstream');
	}
}
