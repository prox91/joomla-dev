<?php
defined('JPATH_OPENHRM') or die;

$data = $displayData;

if (!isset($data['button']))
{
	throw new InvalidArgumentException('The button is not passed to the layout "button.link".');
}

/** @var RToolbarButtonModal $button */
$button = $data['button'];

$class = $button->getClass();
$iconClass = $button->getIconClass();
$text = $button->getText();

$dataTarget = $button->getDataTarget();

// Get the button class.
$btnClass = 'btn';

if (!empty($class))
{
	$btnClass .= ' ' . $class;
}
?>

<button class="<?php echo $btnClass ?>" data-toggle="modal" data-target="<?php echo $dataTarget ?>">
	<?php if (!empty($iconClass)) : ?>
		<i class="<?php echo $iconClass ?>"></i>
	<?php endif; ?>
	<?php echo $text ?>
</button>
