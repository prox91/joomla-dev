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
/**
 * Class EnglishConceptViewEnglishConcept
 */
class EnglishConceptViewBooks extends ECViewAdmin
{
	protected $items;
	protected $pagination;

	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		// Get data from the model
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		// Set the tool bar
		$this->addToolbar();

		// Display the template
		parent::display($tpl);

		// Set the documents
		$this->setDocument();
	}

	public function addToolbar()
	{
		$canDo	= EnglishConceptHelper::getActions();

		JToolbarHelper::title(JText::_('COM_ENGLISHCONCEPT_TITLE'));
		JToolbarHelper::addNew('book.add');
		JToolbarHelper::editList('book.edit');
		JToolbarHelper::trash('book.trash');
		JToolbarHelper::deleteList('Do you want to delete it?', 'book.delete');

		if ($canDo->get('core.admin'))
		{
			//JToolbarHelper::preferences('com_englisconcept');
			//JToolbarHelper::divider();
		}
	}

	public function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_ENGLISHCONCEPT_TITLE"));
	}
}
