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
 * Class EnglishConceptViewEnglishConcept
 */
class EnglishConceptViewEnglishConcepts extends JViewLegacy
{
	protected $items;
	protected $pagination;

	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		// Get data from the model
		//$this->items = $this->get('Items');
		//$this->pagination = $this->get('Pagination');

		//$this->canDo = HelloWorldHelper::getActions();

		// Set the tool bar
		$this->addToolbar();

		// Display the template
		parent::display($tpl);

		// Set the documents
		$this->setDocument();
	}

	public function addToolbar() {
		JToolbarHelper::title(JText::_('COM_ENGLISHCONCEPT_TITLE'));

		JToolbarHelper::addNew('englishconcept.add');

		JToolbarHelper::editList('englishconcept.edit');
	}

	public function setDocument() {
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_ENGLISHCONCEPT_TITLE"));
	}
}