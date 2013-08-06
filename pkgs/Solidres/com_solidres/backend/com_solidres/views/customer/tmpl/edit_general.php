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
        <?php echo $this->form->getLabel('username'); ?>
        <div class="controls">
            <?php echo $this->form->getInput('username'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $this->form->getLabel('firstname');?>
        <div class="controls">
            <?php echo $this->form->getInput('firstname');?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $this->form->getLabel('middlename');?>
        <div class="controls">
            <?php echo $this->form->getInput('middlename');?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $this->form->getLabel('lastname');?>
        <div class="controls">
            <?php echo $this->form->getInput('lastname');?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $this->form->getLabel('customer_code'); ?>
        <div class="controls">
            <?php echo $this->form->getInput('customer_code'); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $this->form->getLabel('customer_group_id'); ?>
        <div class="controls">
            <?php echo $this->form->getInput('customer_group_id'); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $this->form->getLabel('password'); ?>
        <div class="controls">
            <?php echo $this->form->getInput('password'); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $this->form->getLabel('password2'); ?>
        <div class="controls">
            <?php echo $this->form->getInput('password2'); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $this->form->getLabel('email'); ?>
        <div class="controls">
            <?php echo $this->form->getInput('email'); ?>
        </div>
    </div>


    <input type="hidden" value="<?php echo $this->item->user_id ?>" name="jform[user_id]"/>


</fieldset>