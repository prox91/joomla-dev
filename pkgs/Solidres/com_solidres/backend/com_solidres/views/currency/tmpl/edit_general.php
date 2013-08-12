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
		<?php echo $this->form->getLabel('currency_name'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('currency_name'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('currency_code'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('currency_code'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('sign'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('sign'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('exchange_rate'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('exchange_rate'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('state'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('state'); ?>
		</div>
	</div>
</fieldset>