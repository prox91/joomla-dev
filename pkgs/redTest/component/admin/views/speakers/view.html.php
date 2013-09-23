<?php
/**
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/jab.php';

/**
 * Speakers View
 *
 * @package     Jab.Admin
 * @subpackage  Views
 * @since       1.0
 */
class JabViewSpeakers extends JabView
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
		// Get items
		$model = $this->getModel();

		$this->items      = $model->getItems();
		$this->state      = $model->getState();
		$this->pagination = $model->getPagination();
		$this->filterForm = $model->getForm();

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
		return JText::_('COM_JAB_SPEAKER_LIST_TITLE');
	}

	/**
	 * Get the toolbar to render.
	 *
	 * @return  RToolbar
	 */
	public function getToolbar()
	{
		$canDo = JabHelper::getActions($this->state->get('filter.category_id'));
		$user = JFactory::getUser();

		$firstGroup = new RToolbarButtonGroup;
		$secondGroup = new RToolbarButtonGroup;
		$thirdGroup = new RToolbarButtonGroup;

		if ($user->authorise('core.admin', 'com_jab.panel'))
		{
			$panel = RToolbarBuilder::createStandardButton(
				'speakers.topanel',
				'COM_JAB_CONTROL_PANEL_TITLE',
				'',
				'icon-home',
				false
			);

			$firstGroup->addButton($panel);

			// Add / edit
			if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_jab', 'core.create'))) > 0)
			{
				$new = RToolbarBuilder::createNewButton('speaker.add');
				$secondGroup->addButton($new);
			}

			if (($canDo->get('core.edit')))
			{
				$edit = RToolbarBuilder::createEditButton('speaker.edit');
				$secondGroup->addButton($edit);
			}

			// Publish / Unpublish
			if ($canDo->get('core.edit.state'))
			{
				$publish = RToolbarBuilder::createPublishButton('speakers.publish');
				$unpublish = RToolbarBuilder::createUnpublishButton('speakers.unpublish');

				$secondGroup->addButton($publish)
					->addButton($unpublish);
			}

			// Delete / Trash
			if ($canDo->get('core.delete'))
			{
				$delete = RToolbarBuilder::createDeleteButton('speakers.delete');
				$thirdGroup->addButton($delete);
			}

			// Preferences
			if ($canDo->get('core.admin'))
			{
				$options = RToolbarBuilder::createOptionsButton('com_jab');
				$thirdGroup->addButton($options);
			}
		}

		$toolbar = new RToolbar;
		$toolbar->addGroup($firstGroup)
			->addGroup($secondGroup)
			->addGroup($thirdGroup);

		return $toolbar;
	}
}
