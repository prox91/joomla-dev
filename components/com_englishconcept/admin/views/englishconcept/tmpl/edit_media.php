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

<fieldset class="adminform" id="media-tab">
	<div class="control-group">
		<?php echo $this->form->getLabel('bookName'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('bookName'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('lessonName'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('lessonName'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('lessonName'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('lessonName'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('lessonNameTrans'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('lessonNameTrans'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('mediaScript'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('mediaScript'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('lessonScript'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('lessonScript'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('lessonScriptTrans'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('lessonScriptTrans'); ?>
		</div>
	</div>
</fieldset>