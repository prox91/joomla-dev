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

class OpenHrmViewOrganizationInfo extends OpenHrmViewAdmin
{
	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		$this->setLayout('edit');

		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
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

        if ($user->authorise('core.admin', 'com_openhrm.panel'))
        {
            // Add / edit
            //if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_openhrm', 'core.create'))) > 0)
            {
                $save = RToolbarBuilder::createSaveButton('organizationinfo.apply');
                $saveClose = RToolbarBuilder::createSaveAndCloseButton('organizationinfo.save');
                $firstGroup->addButton($save)
                    ->addButton($saveClose);
            }

            // Delete / Revoke
            //if ($canDo->get('core.delete'))
            {
                $cancel = RToolbarBuilder::createCloseButton('organizationinfo.close');
                $secondGroup->addButton($cancel);
            }
        }

        $toolbar = new RToolbar;
        $toolbar->addGroup($firstGroup)
            ->addGroup($secondGroup);

        return $toolbar;
    }

	/**
	 * Get the view title.
	 *
	 * @return  string  The view title.
	 */
	public function getTitle()
	{
		return JText::_('COM_OPENHRM_ORGANIZATIONINFO_TITLE');
	}

    /**
     * Get the view title.
     *
     * @return  string  The view title.
     */
    public function getTitleIcon()
    {
        return 'icon-heart';
    }

	public function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_OPENHRM_ORGANIZATIONINFO_TITLE"));
	}
}
