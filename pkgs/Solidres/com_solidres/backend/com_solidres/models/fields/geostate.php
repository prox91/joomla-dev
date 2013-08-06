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
 * Supports an HTML select list of geo state
 *
 * @package     Solidres
 * @subpackage	Room
 * @since		1.6
 */
class JFormFieldGeoState extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'GeoState';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		$html = array();

		$country_id = (int) $this->form->getValue('country_id'); 
		$selectedId	= (int) $this->form->getValue('geo_state_id');
		
		$options = SolidresHelper::getGeoStateOptions($country_id);

		$html[] = JHtml::_('select.genericlist', $options, $this->name, 'class="state_select"','value','text', $selectedId);
        
		return implode($html);
	}
	
}