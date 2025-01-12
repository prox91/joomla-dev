<?php
defined('JPATH_OPENHRM') or die;

$data = $displayData;

/** @var JFormFieldTimePicker $field */
$field = $data['field'];
$class = $data['class'];
$id = $data['id'];
$options = $field->getOptions();
$required = (bool) $data['required'];
$value = $data['value'];
$name = $data['name'];

JHtml::_('rbootstrap.timepicker');

$script = "(function($){
	$(document).ready(function () {
	$('#" . $id . "').timepicker(
	" . $options . "
	);
	});
	jQuery('#" . $id . "').show();
	})(jQuery);
";

// Add the script to the document.
JFactory::getDocument()->addScriptDeclaration($script);
?>
<div class="input-append bootstrap-timepicker-component">
	<?php if ($required) : ?>
		<input class="required' . <?php echo $class ?> . '" name="' . <?php echo $name ?> . '" type="text"
		       id="' . <?php echo $id ?> . '" required="required" value="' . <?php echo $value ?> . '" />';
	<?php else : ?>
		'<input class="' . <?php echo $class ?> . '" name="' . <?php echo $name ?> . '" type="text"
		        id="' .  <?php echo $id ?> . '" value="' . <?php echo $value ?> . '" />';
	<?php endif; ?>
	<span class="add-on">
		<i class="icon-clock"></i>
	</span>
</div>
