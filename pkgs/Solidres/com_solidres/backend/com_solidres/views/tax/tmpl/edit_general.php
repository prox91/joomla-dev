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
		<?php echo $this->form->getLabel('name'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('name'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('rate'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('rate'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('country_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('country_id'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('geo_state_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('geo_state_id'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('state'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('state'); ?>
		</div>
	</div>

</fieldset>