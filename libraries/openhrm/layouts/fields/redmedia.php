<?php
defined('JPATH_OPENHRM') or die;

$data = $displayData;

// Add jquery UI js.
JHtml::_('rjquery.framework');

$link = (string) $data->element['link'];

$automaticLink = 'index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;asset=' . $asset
		. '&amp;author=' . $data->form->getValue($authorField) . '&amp;fieldid=' . $data->id
		. '&amp;folder=' . $folder;

$script = "
$('#openBtn').click(function() {
  	$('.modal-body').load('" . $data . "',function(result){
	    $('#myModal').modal({show:true});
	});
});
";

$doc = JFactory::getDocument();
$doc->addScriptDeclaration($script);

echo $data->fieldHtml;
