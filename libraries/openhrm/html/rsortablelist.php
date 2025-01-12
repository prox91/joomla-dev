<?php
defined('JPATH_OPENHRM') or die;

abstract class JHtmlRsortablelist
{
	/**
	 * Array containing information for loaded files
	 *
	 * @var  array
	 */
	protected static $loaded = array();

	/**
	 * Extension name to use in the asset calls
	 * Basically the media/com_xxxxx folder to use
	 */
	const EXTENSION = 'redcore';

	/**
	 * Method to load the Sortable script and make table sortable
	 *
	 * @param   string   $tableId                 DOM id of the table
	 * @param   string   $formId                  DOM id of the form
	 * @param   string   $sortDir                 Sort direction
	 * @param   string   $saveOrderingUrl         Save ordering url, ajax-load after an item dropped
	 * @param   boolean  $proceedSaveOrderButton  Set whether a save order button is displayed
	 * @param   boolean  $nestedList              Set whether the list is a nested list
	 *
	 * @return  void
	 */
	public static function sortable($tableId, $formId, $sortDir = 'asc', $saveOrderingUrl, $proceedSaveOrderButton = true, $nestedList = false)
	{
		// Only load once
		if (isset(self::$loaded[__METHOD__]))
		{
			return;
		}

		// Depends on jQuery UI
		JHtml::_('rjquery.ui', array('core', 'sortable'));

		RHelperAsset::load('lib/sortablelist.js', self::EXTENSION);
		RHelperAsset::load('lib/sortablelist.css', self::EXTENSION);

		// Attach sortable to document
		JFactory::getDocument()->addScriptDeclaration("
			(function ($){
				$(document).ready(function (){
					var sortableList = new $.JSortableList('#" . $tableId . " tbody','" . $formId . "','" . $sortDir . "' , '" . $saveOrderingUrl . "','','" . $nestedList . "');
				});
			})(jQuery);
			"
		);

		if ($proceedSaveOrderButton)
		{
			self::_proceedSaveOrderButton();
		}

		// Set static array
		self::$loaded[__METHOD__] = true;

		return;
	}

	/**
	 * Method to inject script for enabled and disable Save order button
	 * when changing value of ordering input boxes
	 *
	 * @return  void
	 */
	public static function _proceedSaveOrderButton()
	{
		JFactory::getDocument()->addScriptDeclaration(
			"(function ($){
				$(document).ready(function (){
					var saveOrderButton = $('.saveorder');
					saveOrderButton.css({'opacity':'0.2', 'cursor':'default'}).attr('onclick','return false;');
					var oldOrderingValue = '';
					$('.text-area-order').focus(function ()
					{
						oldOrderingValue = $(this).attr('value');
					})
					.keyup(function (){
						var newOrderingValue = $(this).attr('value');
						if (oldOrderingValue != newOrderingValue)
						{
							saveOrderButton.css({'opacity':'1', 'cursor':'pointer'}).removeAttr('onclick')
						}
					});
				});
			})(jQuery);"
		);

		return;
	}
}
