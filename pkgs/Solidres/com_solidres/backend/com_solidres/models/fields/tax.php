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
 * Supports an HTML select list of taxes
 *
 * @package
 * @subpackage
 * @since		1.6
 */
class JFormFieldTax extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Tax';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		$html 		= array();
		$selectedId	= (int) $this->form->getValue('tax_id');
		$options 	= SolidresHelper::getTaxOptions($selectedId);
		$html[] 	= JHtml::_('select.genericlist', $options, $this->name, null,'value','text', $selectedId);
        
		return implode('', $html);
	}
}