<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 11:20 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;
?>
<fieldset>
	<div class="control-row">
	    <div class="control-group">
	        <div class="control-label">
	            <?php echo $this->form->getLabel('company'); ?>
	        </div>
	        <div class="controls">
	            <?php echo $this->form->getInput('company'); ?>
	        </div>
	    </div>
	</div>
	<div class="control-row">
	    <div class="control-group">
	        <div class="control-label">
	            <?php echo $this->form->getLabel('job_title'); ?>
	        </div>
	        <div class="controls">
	            <?php echo $this->form->getInput('job_title'); ?>
	        </div>
	    </div>
	</div>
	<div class="control-row">
	    <div class="control-group">
	        <div class="control-label">
	            <?php echo $this->form->getLabel('start_date'); ?>
	        </div>
	        <div class="controls">
	            <?php echo $this->form->getInput('start_date'); ?>
	        </div>
	    </div>
	<div>
	<div class="control-row">
		<div class="control-group">
			<div class="control-label">
				<?php echo $this->form->getLabel('end_date'); ?>
			</div>
			<div class="controls">
				<?php echo $this->form->getInput('end_date'); ?>
			</div>
		</div>
	</div>
	<div class="control-row">
		<div class="control-group">
			<div class="control-label">
				<?php echo $this->form->getLabel('comment'); ?>
			</div>
			<div class="controls">
				<?php echo $this->form->getInput('comment'); ?>
			</div>
		</div>
	</div>
	<div class="control-row">
		<div class="control-group">
			<div class="control-label">
				<?php echo $this->form->getLabel('published'); ?>
			</div>
			<div class="controls">
				<?php echo $this->form->getInput('published'); ?>
			</div>
		</div>
	</div>
</fieldset>
