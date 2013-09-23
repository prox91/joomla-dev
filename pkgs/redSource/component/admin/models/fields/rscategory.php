<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Fields
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the redSOURCE categories
 * inspired from com_categories
 *
 * @package     Redsource.Admin
 * @subpackage  Fields
 * @since       1.0
 */
class JFormFieldRSCategory extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 * @since   1.6
	 */
	protected $type = 'RSCategory';

	/**
	 * Method to get a list of categories that respects access controls and can be used for
	 * either category assignment or parent category assignment in edit screens.
	 * Use the parent element to indicate that the field will be used for assigning parent categories.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   1.0
	 */
	protected function getOptions()
	{
		$options = array();
		$published = $this->element['published'] ? $this->element['published'] : array(0, 1);
		$name = (string) $this->element['name'];

		// Let's get the id for the current item, either category or content item.
		$jinput = JFactory::getApplication()->input;

		// Load the category options
		// For categories the old category is the category id or 0 for new category.
		if ($this->element['parent'])
		{
			$oldCat = $jinput->get('id', 0);
			$oldParent = $this->form->getValue($name, 0);
		}
		else
			// For items the old category is the category they are in when opened or 0 if new.
		{
			$oldCat = $this->form->getValue($name, 0);
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('a.id AS value, a.name AS text, a.level, a.state')
			->from('#__redsource_category AS a')
			->join('LEFT', $db->quoteName('#__redsource_category') . ' AS b ON a.lft > b.lft AND a.rgt < b.rgt');

		// No need to display the global root if not setting up parent
		if (!$this->element['parent'])
		{
			$query->where('a.id > 1');
		}

		// If parent isn't explicitly stated but we are in com_categories assume we want parents
		if ($oldCat != 0 && $this->element['parent'] == true )
		{
			// Prevent parenting to children of this item.
			// To rearrange parents and children move the children up, not the parents down.
			$query->join('LEFT', $db->quoteName('#__redsource_category') . ' AS p ON p.id = ' . (int) $oldCat)
				->where('NOT(a.lft >= p.lft AND a.rgt <= p.rgt)');

			$rowQuery = $db->getQuery(true);
			$rowQuery->select('a.id AS value, a.name AS text, a.level, a.parent_id')
				->from('#__redsource_category AS a')
				->where('a.id = ' . (int) $oldCat);
			$db->setQuery($rowQuery);
			$row = $db->loadObject();
		}

		// Filter language
		if (!empty($this->element['language']))
		{
			$query->where('a.language = ' . $db->quote($this->element['language']));
		}

		// Filter on the published state

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif (is_array($published))
		{
			JArrayHelper::toInteger($published);
			$query->where('a.state IN (' . implode(',', $published) . ')');
		}

		$query->group('a.id, a.name, a.level, a.lft, a.rgt, a.parent_id, a.state')
			->order('a.lft ASC');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		if ($options === false)
		{
			// Joomla will throw exception itself starting from 3.x
			throw new RuntimeException($db->getErrorMsg(), 500);
		}

		// Pad the option text with spaces using depth level as a multiplier.
		for ($i = 0, $n = count($options); $i < $n; $i++)
		{
			// Replace name for root category
			if ($options[$i]->level == 0)
			{
				$options[$i]->text = JText::_('JGLOBAL_ROOT_PARENT');
			}

			$depth = $this->element['parent'] ? $options[$i]->level : $options[$i]->level - 1;

			if ($options[$i]->state == 1)
			{
				$options[$i]->text = str_repeat('- ', $depth) . $options[$i]->text;
			}
			else
			{
				$options[$i]->text = str_repeat('- ', $depth) . '[' . $options[$i]->text . ']';
			}
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
