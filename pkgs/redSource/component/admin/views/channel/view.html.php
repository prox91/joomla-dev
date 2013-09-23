<?php
/**
 * @package    Redsource.Admin
 * @subpackage  Views
 *
 * @copyright  Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Data channel view.
 *
 * @package  Redsource.Admin
 * @subpackage Views
 * @since    1.0
 */
class RedsourceViewChannel extends RedsourceView
{
	/**
	 * @var JForm
	 */
	protected $form;

	/**
	 * @var object
	 */
	protected $item;

	/**
	 * Display method
	 *
	 * @param string $tpl The template name
	 *
	 * @return void
	 */
	public function display($tpl = null)
	{
		$this->form	= $this->get('Form');
		$this->item	= $this->get('Item');

		parent::display($tpl);
	}

	/**
	 * Get the view title.
	 *
	 * @return string The view title.
	 */
	public function getTitle()
	{
		return JText::_('COM_REDSOURCE_CHANNEL_FORM_TITLE');
	}

	/**
	 * Get the toolbar to render.
	 *
	 * @return RToolbar
	 */
	public function getToolbar()
	{
		$group = new RToolbarButtonGroup;
		$user = JFactory::getUser();

		if ($user->authorise('core.admin', 'com_redsource'))
		{
			$save = RToolbarBuilder::createSaveButton('channel.apply');
			$saveAndClose = RToolbarBuilder::createSaveAndCloseButton('channel.save');
			$saveAndNew = RToolbarBuilder::createSaveAndNewButton('channel.save2new');

			$group->addButton($save)
				->addButton($saveAndClose)
				->addButton($saveAndNew);
		}

		if (empty($this->item->id))
		{
			$cancel = RToolbarBuilder::createCancelButton('channel.cancel');
		}

		else
		{
			$cancel = RToolbarBuilder::createCloseButton('channel.cancel');
		}

		$group->addButton($cancel);

		$toolbar = new RToolbar;
		$toolbar->addGroup($group);

		return $toolbar;
	}
}
