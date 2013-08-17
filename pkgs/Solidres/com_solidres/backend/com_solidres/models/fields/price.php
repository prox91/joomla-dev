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

require_once SRPATH_HELPERS.'/helper.php';

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldPrice extends JFormFieldText
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	public $type = 'Price';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		$price = $this->form->getValue('price');
		$html = "";

		if (is_array($price))
		{
			foreach ($price as $wday => $priceOfWeekDay)
			{
				$html .= '
					<div class="input-prepend prependtop">
						<span class="add-on">'.JText::_($wday).'</span>
						<input class="align-right input-mini" name="jform[price]['.$wday.']" value="'.$priceOfWeekDay.'">
					</div>
				';
			}
			$html .= '
				<p class="help-block">
					Switch back to <a id="sr-switch-simple-tariff" href="">Simple Tariff</a>
					or use <a id="sr-switch-complexed-tariff" href="">Complex Tariff</a>
				</p>
			';
		}
		else
		{
			$html .= parent::getInput();

			$html .= '
				<p class="help-block">
					For more flexible tariff, you can try <a id="sr-switch-advanced-tariff" href="">Advanced Tariff</a>
					or <a id="sr-switch-complexed-tariff" href="">Complex Tariff</a>
				</p>
			';
		}

		return $html;
	}
}


