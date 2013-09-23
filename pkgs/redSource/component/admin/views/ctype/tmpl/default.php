<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

$action = JRoute::_('index.php?option=com_redsource&view=ctype');

// HTML helpers
JHtml::_('behavior.keepalive');
JHtml::_('rbootstrap.tooltip');
JHtml::_('rjquery.chosen', 'select');
?>
<form action="<?php echo $action; ?>" method="post" name="adminForm" id="adminForm"
      class="form-validate form-horizontal">

	<div class="row-fluid">
		<div class="span6">
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
					<?php echo $this->form->getLabel('name'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('name'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('channels'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('channels'); ?>
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
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('fields'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('fields'); ?>
		</div>
	</div>
	<!-- hidden fields -->
	<input type="hidden" name="option" value="com_redsource">
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>">
	<input type="hidden" name="task" value="">
	<?php echo JHTML::_('form.token'); ?>
</form>
