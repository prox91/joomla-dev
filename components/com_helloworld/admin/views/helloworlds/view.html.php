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
 * Class HelloWorldViewHelloWorlds
 */
class HelloWorldViewHelloWorlds extends JViewLegacy
{
	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		// Get data from the model
		$items = $this->get('Items');
		$pagination = $this->get('Pagination');

		// Check for error
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br/>', $errors));
			return false;
		}

		// Assign data to view
		$this->items = $items;
		$this->pagination  = $pagination;

		// Set the tool bar
		$this->addToolbar($this->pagination->total);

		// Display the template
		parent::display($tpl);

		// Set the documents
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	public function addToolbar($total = null)
	{
		JToolbarHelper::title(JText::_('COM_HELLOWORLD_MANAGER_HELLOWORLDS').
				//Reflect number of items in title!
				($total?' <span style="font-size: 0.5em; vertical-align: middle;">('.$total.')</span>':'')
				, 'helloworld');

		JToolbarHelper::addNew('helloworld.add');
		JToolbarHelper::editList('helloworld.edit');
		JToolbarHelper::deleteList('', 'helloworlds.delete');
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION'));
	}
}
?>