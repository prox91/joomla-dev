<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JHtml::_('rbootstrap.tooltip');
foreach ($this->form->getFieldsets() as $fieldsets => $fieldset):
?>
	<?php
	// Iterate through the fields and display them.
	foreach($this->form->getFieldset($fieldset->name) as $field):
		// If the field is hidden, only use the input.
		if ($field->hidden):
			echo $field->input;
		else:
			?>
			<div class="control-group">
				<div class="control-label">
					<?php echo $field->label; ?>
				</div>
				<div class="controls">
					<?php echo $field->input; ?>
				</div>
			</div>
		<?php
		endif;
	endforeach;
	?>
<?php endforeach;
