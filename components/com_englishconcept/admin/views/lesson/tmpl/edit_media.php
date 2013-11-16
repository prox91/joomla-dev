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
		<div class="control-label">
			<?php echo $this->form->getLabel('title'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('title'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('title_trans'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('title_trans'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('audio_upload'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('audio_upload'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('audio_url'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('audio_url'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('text'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('text'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('text_trans'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('text_trans'); ?>
		</div>
	</div>
</fieldset>
