<?php
/**
 * @package     redSocialstream
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
require_once (JPATH_COMPONENT . '/helpers/redsocialstream.php');

class AccessTokenViewAccessToken extends JView
{
	function display($tpl = null)
	{
        $fbProfiles = JHtml::_('select.genericlist', RedSocialStreamHelper::getFacebookProfilesOptions(), 'fb_profile_id', 'class="inputbox"', 'value', 'text', '');
        $twitterProfiles = JHtml::_('select.genericlist', RedSocialStreamHelper::getTwitterProfilesOptions(), 'twitter_profile_id', 'class="inputbox"', 'value', 'text', '');
        $linkedinProfiles = JHtml::_('select.genericlist', RedSocialStreamHelper::getLinkedinProfilesOptions(), 'linkedin_profile_id', 'class="inputbox"', 'value', 'text', '');

        $this->fbProfiles = $fbProfiles;
        $this->twitterProfiles = $twitterProfiles;
        $this->linkedinProfiles = $linkedinProfiles;

        $this->addToolbar();

		parent::display($tpl);

        $this->setDocument();
	}

    protected function addToolbar()
    {
        JToolBarHelper::title(JText::_('COM_REDSOCIALSTREAM_ACCESS_TOKEN'), 'configure.png');
        JToolBarHelper::cancel('cancel', 'COM_REDSOCIALSTREAM_CLOSE');

        JToolBarHelper::custom('requestToken', 'redsocialstream_import_generate32', JText::_('COM_REDSOCIALSTREAM_GENERATE_ACCESS_TOKEN'), JText::_('COM_REDSOCIALSTREAM_GENERATE_ACCESS_TOKEN'), false, false);
    }

    protected function setDocument()
    {
        $document =  JFactory::getDocument();
        $document->setTitle(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'));
    }
}
