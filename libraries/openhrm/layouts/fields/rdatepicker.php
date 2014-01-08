<?php
defined('JPATH_OPENHRM') or die;

$data = $displayData;

// Add jquery UI js.
JHtml::_('rjquery.datepicker');

$doc = JFactory::getDocument();

$script = "
(function($){
	$(document).ready(function () {
		$('" . $data->cssId . "').datepicker(" . $data->datepickerOptions . ");
		// We will remove all the default images links with a font-awesome icon
		$('img[src=\"rdatepicker-calendar.gif\"]').replaceWith('<i class=\"icon-calendar icon-2x\"></i>');
	});
})(jQuery);
";

$doc->addScriptDeclaration($script);

// Load the common css
RHelperAsset::load('rdatepicker.css', 'redcore');

echo $data->fieldHtml;
