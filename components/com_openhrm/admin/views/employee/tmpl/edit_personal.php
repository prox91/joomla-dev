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
    <div class="span12">
        <div class="span4">
            <div class="control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('first_name'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('first_name'); ?>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('middle_name'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('middle_name'); ?>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('last_name'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('last_name'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('employee_code'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('employee_code'); ?>
        </div>
    </div>
</fieldset>
<fieldset>
    <div class="span12">
        <div class="span4">
            <div class="control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('driver_license_num'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('driver_license_num'); ?>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="control-group">
                <div class="control-label">
                    <?php echo $this->form->getLabel('driver_license_exp_date'); ?>
                </div>
                <div class="controls">
                    <?php echo $this->form->getInput('driver_license_exp_date'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('picture'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('picture'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('gender'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('gender'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('marital_state_id'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('marital_state_id'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('birthday'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('birthday'); ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo $this->form->getLabel('published'); ?>
        </div>
        <div class="controls">
            <?php echo $this->form->getInput('published'); ?>
        </div>
    </div>
</fieldset>
