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
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('street1'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('street1'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('street2'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('street2'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('city'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('city'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('country_id'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('country_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('state_id'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('state_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('zip_code'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('zip_code'); ?>
		</div>
	</div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('home_phone'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('home_phone'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('work_phone'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('work_phone'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('mobile_phone'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('mobile_phone'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('work_email'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('work_email'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('other_email'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('other_email'); ?>
        </div>
    </div>
</fieldset>
