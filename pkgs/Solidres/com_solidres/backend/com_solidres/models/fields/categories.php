<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/helpers/helper.php';
/**
 * Supports an HTML select list of categories
 *
 * @package		Joomla.Administrator
 * @subpackage	com_weblinks
 * @since		1.6
 */
class JFormFieldCategories extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Categories';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html 		= array();
		$options 	= array();
		$doc		= JFactory::getDocument();
		$currentId	= 0;
		
		// When use this field in view/reservationasset/edit
		$selectedId	= (int) $this->form->getValue('category_id');
		// When use this field in view/category/edit
		if(empty($selectedId))
        {
			$selectedId = (int) $this->form->getValue('parent_id');
		}
		// Set the default view name and format from the Request.
		$vName		= JRequest::getWord('view', 'category');
		
		// if we are editing a category, hide it in the parent_id category select list
		if( $vName == 'category' )
        {
			$currentId = (int) $this->form->getValue('id');	
		}
		
		$options = SolidresHelper::getCategoryOptions($currentId);
				
		$html[] = JHtml::_('select.genericlist', $options, $this->name, null,'value','text', $selectedId);
        
		return implode($html);
	}
}