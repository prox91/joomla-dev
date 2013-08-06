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
		<?php echo $this->form->getLabel('featured'); ?>
        <div class="controls">
			<?php echo $this->form->getInput('featured'); ?>
        </div>
    </div>
	<div class="control-group">
		<?php echo $this->form->getLabel('created_by'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('created_by'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('created_by_alias'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('created_by_alias'); ?>
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
	<div class="control-group">
		<?php echo $this->form->getLabel('ordering'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('ordering'); ?>
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
</fieldset>