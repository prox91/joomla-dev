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

class OpenHrmViewEmployee extends ECViewAdmin
{
	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display function
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
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
		//JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
		JHtml::_('behavior.tooltip');

		JToolbarHelper::title(JText::_('COM_OPENHRM_EMPLOYEE_TITLE'));
		JToolBarHelper::apply('employee.apply', 'JToolbar_Apply');
		JToolBarHelper::save('employee.save', 'JToolbar_Save');
		JToolBarHelper::cancel('employee.cancel', 'JToolbar_Cancel');
	}

	public function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_OPENHRM_EMPLOYEE_TITLE"));
	}
}
