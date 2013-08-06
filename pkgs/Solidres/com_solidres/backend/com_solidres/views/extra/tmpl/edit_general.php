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
        <?php echo $this->form->getLabel('reservation_asset_id');?>
        <div class="controls">
            <?php echo $this->form->getInput('reservation_asset_id');?>
        </div>
    </div>
	<div class="control-group">
		<?php echo $this->form->getLabel('state'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('state'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('max_quantity'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('max_quantity'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('daily_chargable'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('daily_chargable'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('price'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('price'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('description'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
	</div>

</fieldset>