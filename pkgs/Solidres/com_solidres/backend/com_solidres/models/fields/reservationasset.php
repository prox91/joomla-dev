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
 * Supports an HTML select list of ReservationAssets
 *
 * @package     Solidres
 * @subpackage	RoomType
 * @since		1.6
 */
class JFormFieldReservationAsset extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'ReservationAsset';

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
		
		$selectedId	= (int) $this->form->getValue('reservation_asset_id');
		
		$options = SolidresHelper::getReservationAssetOptions();

		$selectAttributes = array('class' => 'required', 'required' => 'required');

		$html[] = JHtml::_('select.genericlist', $options, $this->name, $selectAttributes,'value','text', $selectedId);
        
		return implode($html);
	}
}