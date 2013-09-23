<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

$action = JRoute::_('index.php?option=com_redsource&view=field');
$fieldsets = $this->form->getFieldsets();
?>
<div id="rsfield">

<?php if (0) : // FIXME <- for now assume we're in AJAX call ?>
<form action="<?php echo $action; ?>" method="post" name="fieldForm" id="fieldForm"
      class="form-validate form-horizontal">
<? endif; ?>

	<?php foreach ($fieldsets as $fieldset) :
		$fields = $this->form->getFieldset($fieldset->name);
		?>
	<fieldset>
		<?php if ($fieldset->label) : ?>
		<legend><?php echo JText::_($fieldset->label); ?></legend>
		<?php endif; ?>
		<?php
		foreach($fields as $field) :
			if ($field->hidden) continue;
		?>
		<div class="control-group">
			<div class="control-label">
				<?php echo $field->label; ?>
			</div>
			<div class="controls">
				<?php echo $field->input; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</fieldset>
	<?php endforeach; ?>

	<!-- hidden fields -->
	<input type="hidden" name="option" value="com_redsource">
	<input type="hidden" name="field_id" value="<?php echo 0; ?>">
	<input type="hidden" name="field_task" value="field">
	<?php echo JHTML::_('form.token'); ?>

<?php if (0) : // FIXME <- for now assume we're in AJAX call ?>
</form>
<? endif; ?>

</div>
