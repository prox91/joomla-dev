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

/**
 * Supports an HTML select list of countries
 *
 * @package     Solidres
 * @subpackage	Room
 * @since		1.6
 */
class JFormFieldCountry extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Country';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		$html = array();

		$selectedId	= (int) $this->form->getValue('country_id');
		
		$options = SolidresHelper::getCountryOptions();

		$html[] = JHtml::_('select.genericlist', $options, $this->name, 'class="country_select"','value','text', $selectedId);
        
		return implode($html);
	}
}