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

?>
<fieldset>
	<div class="control-group">
		<?php echo $this->form->getLabel('state'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('state'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('default'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('default'); ?>
		</div>
	</div>
	<!--<div class="control-group">
		<?php /*echo $this->form->getLabel('featured'); */?>
		<div class="controls">
			<?php /*echo $this->form->getInput('featured'); */?>
		</div>
	</div>-->
	<div class="control-group">
		<?php echo $this->form->getLabel('rating'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('rating'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('deposit_required'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('deposit_required'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('deposit_is_percentage'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('deposit_is_percentage'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('deposit_amount'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('deposit_amount'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('ordering'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('ordering'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('access'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('access'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('language'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('language'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('id'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('created_by'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('created_by'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('created_date'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('created_date'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('modified_date'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('modified_date'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('version'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('version'); ?>
		</div>
	</div>
</fieldset>

