<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 10:57 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import Joomla View library
jimport('legacy.view.legacy');

/**
 * Class HelloWorldViewHelloWorld
 */
class HelloWorldViewHelloWorld extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form = null;

	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		// Get data
		$item = $this->get('Item');
		$form = $this->get('Form');

		// Check for error
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br/>', $errors));
			return false;
		}

		// Assign data to view
		$this->item = $item;
		$this->form = $form;

		// Set the tool bar
		$this->addToolbar();

		// Display the template
		parent::display($tpl);

		// Set the documents
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	public function addToolbar()
	{
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		JToolbarHelper::title($isNew ? JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_NEW')
									: JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_EDIT'));
		JToolbarHelper::save('helloworld.save');
		JToolbarHelper::cancel('helloworld.cancel', $isNew ? 'JTOOLBAR_CANCEL'
															: 'JTOOLBAR_CLOSE');
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_HELLOWORLD_HELLOWORLD_CREATING')
			: JText::_('COM_HELLOWORLD_HELLOWORLD_EDITING'));
	}
}