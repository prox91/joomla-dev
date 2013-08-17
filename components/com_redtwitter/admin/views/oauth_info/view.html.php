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

/**
 * Class RedtwitterViewOauth_Info
 */
class RedtwitterViewOauth_Info extends JViewLegacy
{
	protected $state;

	protected $item;

	protected $form;

	/**
	 * @param null $tpl
	 *
	 * @return mixed|void
	 *
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->item  = $this->get('Item');
		$this->form  = $this->get('Form');

        // Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		$session = JFactory::getSession();
		$generated_flg = $session->get('generatedFlag', -1);
		$session->clear('generatedFlag');
		$this->assignRef('generatedFlag', $generated_flg);

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return none
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		JToolBarHelper::title(JText::_('COM_REDTWITTER_TITLE_OAUTH_INFO'), 'followed_profile.png');

		JToolBarHelper::cancel('oauth_info.cancel', 'JTOOLBAR_CLOSE');
		JToolBarHelper::divider();
		JToolBarHelper :: custom('oauth_info.generateToken', 'access_token', JText::_('COM_REDTWITTER_OAUTH_INFO_ACCESS_TOKEN') , JText::_('COM_REDTWITTER_OAUTH_INFO_ACCESS_TOKEN'), false, false );
	}
}