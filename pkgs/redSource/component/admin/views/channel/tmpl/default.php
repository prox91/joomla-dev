<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

$action = JRoute::_('index.php?option=com_redsource&view=channel');

// HTML helpers
JHtml::_('behavior.keepalive');
JHtml::_('rbootstrap.tooltip');
JHtml::_('rjquery.chosen', 'select');

// Keep the javascript here as it might need to be adapted according to layout changes (and overrides !)
$script = <<<JS
	jQuery(document).ready(function () {
		jQuery('.ch_type').change(function() {
			jQuery.post('index.php?option=com_redsource&task=channel.ajaxpluginparams&tmpl=component&format=raw',
				{'id': jQuery('input[name=id]').val(), 'plugin': jQuery('#jform_type').val()},
				function(data) {
					jQuery('#plugin-params').remove();
					var container = jQuery('<div id="plugin-params" class="span4"></div>').append(data);
					jQuery('#main-params').after(container);

					// Reload tooltips
					jQuery('.hasTooltip').tooltip();
				}
			);
		}).trigger('change');
	});
JS;
JFactory::getDocument()->addScriptDeclaration($script);
?>
<form action="<?php echo $action; ?>" method="post" name="adminForm" id="adminForm"
      class="form-validate form-horizontal">

	<div class="row-fluid">
		<div id="main-params" class="span6">
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('state'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('state'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('type'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('type'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('name'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('name'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('description'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('description'); ?>
				</div>
			</div>
		</div>
		<?php if ($this->item->id) : ?>
			<div class="span6">
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('created_date'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('created_date'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('created_by'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('created_by'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('modified_date'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('modified_date'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('modified_by'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('modified_by'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<!-- hidden fields -->
	<input type="hidden" name="option" value="com_redsource">
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>">
	<input type="hidden" name="task" value="">
	<?php echo JHTML::_('form.token'); ?>
</form>
