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
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$config = JFactory::getConfig();
$tzoffset = $config->get('offset');
$timezone = new DateTimeZone($tzoffset);
$date = JDate::getInstance();

?>
<fieldset>	
	<div class="control-group">
		<?php echo $this->form->getLabel('coupon_name'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('coupon_name'); ?>
		</div>
	</div>	
	<div class="control-group">
		<?php echo $this->form->getLabel('coupon_code'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('coupon_code'); ?>
		</div>
	</div>	
	<div class="control-group">
		<?php echo $this->form->getLabel('amount'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('amount'); ?>
		</div>
	</div>	
	<div class="control-group">
		<?php echo $this->form->getLabel('reservation_asset_id');?>
		<div class="controls">
			<?php echo $this->form->getInput('reservation_asset_id');?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('is_percent'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('is_percent'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('valid_from'); ?>
		<div class="controls">
			<input type="text" 
				value="<?php echo $date->setTimestamp($this->item->valid_from)->setTimezone($timezone)->format('d-m-Y', true); ?>"
				name="jform[valid_from]" 
				class="datepicker">
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('valid_to'); ?>
		<div class="controls">
			<input type="text"
                value="<?php echo $date->setTimestamp($this->item->valid_to)->setTimezone($timezone)->format('d-m-Y', true); ?>"
				name="jform[valid_to]" 
				class="datepicker">
		</div>
	</div>
    <div class="control-group">
		<?php echo $this->form->getLabel('valid_from_checkin'); ?>
        <div class="controls">
            <input type="text"
                   value="<?php echo $date->setTimestamp($this->item->valid_from_checkin)->setTimezone($timezone)->format('d-m-Y', true); ?>"
                   name="jform[valid_from_checkin]"
                   class="datepicker">
        </div>
    </div>
    <div class="control-group">
		<?php echo $this->form->getLabel('valid_to_checkin'); ?>
        <div class="controls">
            <input type="text"
                   value="<?php echo $date->setTimestamp($this->item->valid_to_checkin)->setTimezone($timezone)->format('d-m-Y', true); ?>"
                   name="jform[valid_to_checkin]"
                   class="datepicker">
        </div>
    </div>
    <div class="control-group">
		<?php echo $this->form->getLabel('customer_group_id'); ?>
        <div class="controls">
			<?php echo $this->form->getInput('customer_group_id'); ?>
        </div>
    </div>
	<div class="control-group">
		<?php echo $this->form->getLabel('state'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('state'); ?>
		</div>
	</div>
	<div class="sr-clear"></div>
</fieldset>