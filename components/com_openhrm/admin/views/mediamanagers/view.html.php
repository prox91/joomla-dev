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

class OpenHrmViewMediaManagers extends OpenHrmViewAdmin
{
	protected $items;
	protected $pagination;

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

		$this->componentLayout = 'modal';

		// Display the template
		parent::display($tpl);

		// Set the documents
		$this->setDocument();
	}

	/**
	 * Get the view title.
	 *
	 * @return  string  The view title.
	 */
	public function getTitle()
	{
		return JText::_('COM_OPENHRM_COUNTRY_TITLE');
	}

    /**
     * Get the view title.
     *
     * @return  string  The view title.
     */
    public function getTitleIcon()
    {
        return 'icon-globe';
    }

	public function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_OPENHRM_COUNTRY_TITLE"));
	}
}
