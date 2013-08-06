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
		<?php echo $this->form->getLabel('title'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('title'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('alias'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('alias'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('parent_id'); ?>
		<div class="controls">
		<?php echo $this->form->getInput('parent_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('state'); ?>
		<div class="controls">
		<?php echo $this->form->getInput('state'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('access'); ?>
		<div class="controls">
		<?php echo $this->form->getInput('access'); ?>
		</div>
	</div>
	<div class="sr-clear"></div>
</fieldset>