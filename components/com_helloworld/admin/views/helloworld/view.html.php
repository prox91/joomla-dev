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
	protected $form;
	protected $item;
	protected $script;
	protected $canDo;

	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		// Get data
		$this->item   = $this->get('Item');
		$this->form   = $this->get('Form');
		$this->script = $this->get('Script');

		// What Access Permissions does this user have? What can (s)he do?
		$this->canDo = HelloWorldHelper::getActions($this->item->id);

		// Check for error
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br/>', $errors));

			return false;
		}

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

		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = ($this->item->id == 0);

		JToolbarHelper::title($isNew ? JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_NEW')
			: JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLD_EDIT'));
		if($isNew)
		{
			if($this->canDo->get('core.create'))
			{
				JToolBarHelper::apply('helloworld.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('helloworld.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom('helloworld.save2new', 'save-new.png', 'save-new_f2.png',
					'JTOOLBAR_SAVE_AND_NEW', false);
			}
			JToolBarHelper::cancel('helloworld.cancel', 'JTOOLBAR_CANCEL');

			JToolbarHelper::save('helloworld.save');
			JToolbarHelper::cancel('helloworld.cancel', $isNew ? 'JTOOLBAR_CANCEL'
				: 'JTOOLBAR_CLOSE');
		}
		else
		{
			if($this->canDo->get('core.edit'))
			{
				// We can save the new record
				JToolBarHelper::apply('helloworld.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('helloworld.save', 'JTOOLBAR_SAVE');

				// We can save this record, but check the create permission to see
				// if we can return to make a new one.
				if ($this->canDo->get('core.create'))
				{
					JToolBarHelper::custom('helloworld.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}

			if ($this->canDo->get('core.create'))
			{
				JToolBarHelper::custom('helloworld.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			}
			JToolBarHelper::cancel('helloworld.cancel', 'JTOOLBAR_CLOSE');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew    = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_HELLOWORLD_HELLOWORLD_CREATING')
			: JText::_('COM_HELLOWORLD_HELLOWORLD_EDITING'));

		$document->addScript(JUri::root() . $this->script);
		$document->addScript(JUri::root() . "administrator/components/com_helloworld/views/helloworld/submitbutton.js");

		JText::script('COM_HELLOWORLD_HELLOWORLD_ERROR_UNACCEPTABLE');
	}
}