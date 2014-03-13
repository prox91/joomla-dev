<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 10:57 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;

class OpenHrmViewStates extends OpenHrmViewAdmin
{
	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		// Get data from the model
        $this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// Display the template
		parent::display($tpl);

		// Set the documents
		$this->setDocument();
	}

    /**
     * Get the toolbar to render.
     *
     * @return  RToolbar
     */
    public function getToolbar()
    {
        $canDo = OpenHrmHelpersAcl::getActions($this->state->get('filter.country_id'));
        $user = JFactory::getUser();

        $firstGroup = new RToolbarButtonGroup;
        $secondGroup = new RToolbarButtonGroup;
        $thirdGroup = new RToolbarButtonGroup;

        if ($user->authorise('core.admin', 'com_openhrm.panel'))
        {
            // Add / edit
            //if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_openhrm', 'core.create'))) > 0)
            {
                $new = RToolbarBuilder::createNewButton('state.add');
                $edit = RToolbarBuilder::createEditButton('state.edit');
                $firstGroup->addButton($new)
                    ->addButton($edit);
            }

            $publish =  RToolbarBuilder::createPublishButton('states.published');
            $unpublish =  RToolbarBuilder::createPublishButton('states.unpublished');
            $secondGroup->addButton($publish)
                ->addButton($unpublish);

            // Delete / Revoke
            //if ($canDo->get('core.delete'))
            {
                $delete = RToolbarBuilder::createDeleteButton('states.delete');
                $thirdGroup->addButton($delete);
            }
        }

        $toolbar = new RToolbar;
        $toolbar->addGroup($firstGroup)
            ->addGroup($secondGroup)
            ->addGroup($thirdGroup);

        return $toolbar;
    }

    /**
     * Get the view title.
     *
     * @return  string  The view title.
     */
    public function getTitle()
    {
        return JText::_('COM_OPENHRM_STATE_TITLE');
    }

    /**
     * Get the view title.
     *
     * @return  string  The view title.
     */
    public function getTitleIcon()
    {
        return 'icon-bookmark';
    }

	public function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_OPENHRM_STATE_TITLE"));
	}
}
