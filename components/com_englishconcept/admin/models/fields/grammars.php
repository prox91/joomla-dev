<?php
defined('_JEXEC') or die;

class JFormFieldGrammars extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Grammars';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$options 	= array();
		$model      = JModelLegacy::getInstance('Grammars', 'EnglishConceptModel', array('ignore_request' => true));

		//$model->setState('filter.state', 1);
		//$model->setState('list.ordering', 'u.currency_name');
		$results 	= $model->getItems();

		$selectedId	= (int) $this->form->getValue('grammar_id');

		if (!empty($results))
		{
			foreach($results as $item)
			{
				$options[] = JHTML::_('select.option', $item->id, $item->name);
			}
		}

		$html[] = JHtml::_('select.genericlist', $options, $this->name, null,'value','text', $selectedId);

		return implode($html);
	}
}
