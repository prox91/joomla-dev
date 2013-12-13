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

class EnglishConceptViewUsage extends ECViewAdmin
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

		$results = EnglishConceptHelper::getUsageOption($this->item->id);
		if(count($results) > 0)
		{
			if(is_null($this->item->id))
			{
				// Usage new
				$options = '';
				foreach($results as $result)
				{
					$options .= '<option value="' . $result->lesson_id . '">' . $result->diffspecial_no . '</option>';
				}
				$this->options  = $options;
			}
			else
			{
				// Usage already have reference
				if(!empty($results[0]->diffspecial_ref))
				{
					$dsArr = explode(',', $results[0]->diffspecial_ref);
					$options = '';
					foreach($dsArr as $ds)
					{
						$options .= '<option selected="selected" value="' . $ds . '">DS.' . $ds . '</option>';
					}
				}
				else
				{
					$results = EnglishConceptHelper::getUsageOption();
					$options = '';
					foreach($results as $result)
					{
						$options .= '<option value="' . $result->lesson_id . '">' . $result->diffspecial_no . '</option>';
					}
				}
				$this->options  = $options;
			}
		}
		else
		{
			$this->options = '<option></option>';
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

		JToolbarHelper::title(JText::_('COM_ENGLISHCONCEPT_TITLE'));
		JToolBarHelper::apply('usage.apply', 'JToolbar_Apply');
		JToolBarHelper::save('usage.save', 'JToolbar_Save');
		JToolBarHelper::addNew('usage.save2new', 'JToolbar_Save_and_new');
		JToolBarHelper::cancel('usage.cancel', 'JToolbar_Cancel');
	}

	public function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_ENGLISHCONCEPT_TITLE"));
	}
}
