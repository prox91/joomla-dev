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

class EnglishConceptViewGrammar extends ECViewAdmin
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

		$results = EnglishConceptHelper::getGrammarOption($this->item->id);
		if(count($results) > 0)
		{
			if(is_null($this->item->id))
			{
				// Grammar new
				$options = '';
				foreach($results as $result)
				{
					$options .= '<option value="' . $result->lesson_id . '">' . $result->keystruct_no . '</option>';
				}
				$this->options  = $options;
			}
			else
			{
				// Usage already have reference
				if(!empty($results[0]->keystruct_ref))
				{
					$ksArr = explode(',', $results[0]->keystruct_ref);
					$options = '';
					foreach($ksArr as $ks)
					{
						$options .= '<option selected="selected" value="' . $ks . '">KS.' . $ks . '</option>';
					}
				}
				else
				{
					$results = EnglishConceptHelper::getGrammarOption();
					$options = '';
					foreach($results as $result)
					{
						$options .= '<option value="' . $result->lesson_id . '">' . $result->keystruct_no . '</option>';
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
		JToolBarHelper::apply('grammar.apply', 'JToolbar_Apply');
		JToolBarHelper::save('grammar.save', 'JToolbar_Save');
		JToolBarHelper::addNew('grammar.save2new', 'JToolbar_Save_and_new');
		JToolBarHelper::cancel('grammar.cancel', 'JToolbar_Cancel');
	}

	public function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_("COM_ENGLISHCONCEPT_TITLE"));
	}
}
