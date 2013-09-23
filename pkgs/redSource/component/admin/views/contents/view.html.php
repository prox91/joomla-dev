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
 * Data list view.
 *
 * @package  Redsource.Admin
 * @subpackage  Views
 * @since    1.0
 */
class RedsourceViewContents extends RedsourceView
{
	/**
	 * @var  array
	 */
	protected $items;

	/**
	 * @var  object
	 */
	protected $state;

	/**
	 * @var  JPagination
	 */
	protected $pagination;

	/**
	 * @var  JForm
	 */
	protected $filterForm;

	/**
	 * Display method
	 *
	 * @param   string  $tpl  The template name
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$model = $this->getModel('contents');

		$this->items = $model->getItems();
		$this->state = $model->getState();
		$this->pagination = $model->getPagination();
		$this->filterForm = $model->getForm();

		parent::display($tpl);
	}

	/**
	 * Get the view title.
	 *
	 * @return  string  The view title.
	 */
	public function getTitle()
	{
		return JText::_('COM_REDSOURCE_CONTENT_LIST_TITLE');
	}

	/**
	 * Get the toolbar to render.
	 *
	 * @return  RToolbar
	 */
	public function getToolbar()
	{
		$canDo = RedsourceHelpersAcl::getActions();
		$user = JFactory::getUser();

		$firstGroup = new RToolbarButtonGroup;
		$secondGroup = new RToolbarButtonGroup;

		if ($user->authorise('core.admin', 'com_redsource'))
		{
			// Add / edit
			if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_redsource', 'core.create'))) > 0)
			{
				$new = RToolbarBuilder::createNewButton('content.add');
				$firstGroup->addButton($new);
			}

			if ($canDo->get('core.edit'))
			{
				$edit = RToolbarBuilder::createEditButton('content.edit');
				$firstGroup->addButton($edit);
			}

			// Publish / Unpublish
			if ($canDo->get('core.edit.state'))
			{
				$publish = RToolbarBuilder::createPublishButton('contents.publish');
				$unpublish = RToolbarBuilder::createUnpublishButton('contents.unpublish');

				$firstGroup->addButton($publish)
					->addButton($unpublish);
			}

			// Delete / Trash
			if ($canDo->get('core.delete'))
			{
				$delete = RToolbarBuilder::createDeleteButton('contents.delete');
				$secondGroup->addButton($delete);
			}
		}

		$toolbar = new RToolbar;
		$toolbar->addGroup($firstGroup)
			->addGroup($secondGroup);

		return $toolbar;
	}}
