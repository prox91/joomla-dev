<?php
/**
* Created by JetBrains PhpStorm.
* User: Ngoc Nha
* Date: 4/6/13
* Time: 11:20 AM
* To change this template use File | Settings | File Templates.
*/
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<fieldset class="adminform" id="general-tab">
	<div class="control-group">
		<?php echo $this->form->getLabel('book_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('book_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('cat_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('cat_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('level_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('level_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('name'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('name'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('alias'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('alias'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('description'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('published'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('published'); ?>
		</div>
	</div>
</fieldset>
