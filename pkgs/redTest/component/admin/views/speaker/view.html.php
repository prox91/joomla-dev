<?php
/**
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Speaker View
 *
 * @package     Jab.Admin
 * @subpackage  Views
 * @since       1.0
 */
class JabViewSpeaker extends JabView
{
	protected $componentTitle = 'red<strong>JAB</strong>';
	protected $displaySidebar = true;
	protected $sidebarLayout = 'sidebar';
	protected $displayTopBar = true;
	protected $topBarLayout = 'topbar';

	/**
	 * Display method
	 *
	 * @param   string  $tpl  template name
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$this->form	= $this->get('Form');
		$this->item	= $this->get('Item');

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Get the view title.
	 *
	 * @return  string  The view title.
	 */
	public function getTitle()
	{
		return JText::_('COM_JAB_SPEAKER_FORM_TITLE');
	}

	/**
	 * Get the toolbar to render.
	 *
	 * @return  RToolbar
	 */
	public function getToolbar()
	{
		$group = new RToolbarButtonGroup;

		$user = JFactory::getUser();

		if ($user->authorise('core.admin', 'com_jab.panel'))
		{
			$save = RToolbarBuilder::createSaveButton('speaker.apply');
			$saveAndClose = RToolbarBuilder::createSaveAndCloseButton('speaker.save');
			$saveAndNew = RToolbarBuilder::createSaveAndNewButton('speaker.save2new');

			$group->addButton($save)
				->addButton($saveAndClose)
				->addButton($saveAndNew);
		}

		if (empty($this->item->id))
		{
			$cancel = RToolbarBuilder::createCancelButton('speaker.cancel');
		}

		else
		{
			$cancel = RToolbarBuilder::createCloseButton('speaker.cancel');
		}

		$group->addButton($cancel);

		$toolbar = new RToolbar;
		$toolbar->addGroup($group);

		return $toolbar;
	}
}
