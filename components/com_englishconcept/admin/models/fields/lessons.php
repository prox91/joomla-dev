<?php
defined('_JEXEC') or die;

class JFormFieldLessons extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Lessons';

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
		$model      = JModelLegacy::getInstance('Lessons', 'EnglishConceptModel', array('ignore_request' => true));

		//$model->setState('filter.state', 1);
		//$model->setState('list.ordering', 'u.currency_name');
		$results 	= $model->getItems();

		$selectedId	= (int) $this->form->getValue('lesson_id');

		if (!empty($results))
		{
			foreach($results as $item)
			{
				$options[] = JHTML::_('select.option', $item->id, $item->id . ' - ' . $item->title);
			}
		}

		$html[] = JHtml::_('select.genericlist', $options, $this->title, null,'value','text', $selectedId);

		return implode($html);
	}
}
