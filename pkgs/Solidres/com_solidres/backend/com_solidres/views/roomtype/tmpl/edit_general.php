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
		<?php echo $this->form->getLabel('alias'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('alias'); ?>
		</div>
	</div>
	<div class="control-group">
		<label id="jform_reservation_asset_id-lbl"
			   for="jform_reservation_asset_id"
			   class="hasTip required control-label"
			   title="<?php echo JText::_('SR_FIELD_RT_RESERVATIONASSET_LABEL') ?>::<?php echo JText::_('SR_FIELD_RT_RESERVATIONASSET_DESC'); ?>"
			   aria-invalid="true">
			<?php echo JText::_('SR_RESERVATION_ASSEST') ?>
			<span class="star">&nbsp;*</span>
		</label>
		<div class="controls">
			<?php echo $this->form->getInput('reservation_asset_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="hasTip control-label"
			   title="<?php echo JText::_('SR_FIELD_ROOM_TYPE_OCCUPANCY_LABEL') ?>::<?php echo JText::_('SR_FIELD_ROOM_TYPE_OCCUPANCY_DESC'); ?>">
			<?php echo JText::_('SR_OCCUPANCY') ?>
		</label>
		<div class="controls">
			<?php echo $this->form->getInput('occupancy_adult'); ?>
			<span class="help-inline">
				<?php echo JText::_('SR_FIELD_OCCUPANCY_ADULT_LABEL'); ?>
			</span>
        </div>
        <div class="controls">
			<?php echo $this->form->getInput('occupancy_child'); ?>
			<span class="help-inline">
				<?php echo JText::_('SR_FIELD_OCCUPANCY_CHILD_LABEL'); ?>
			</span>
		</div>
	</div>
	<div class="control-group tariff-config">
		<label id="jform_price-lbl"
			   for="jform_price"
			   class="hasTip required control-label"
               title="<?php echo JText::_('SR_FIELD_ROOM_TYPE_PRICE_LABEL') ?>::<?php echo JText::_('SR_FIELD_ROOM_TYPE_PRICE_DESC'); ?>">
			<?php echo JText::_('SR_FIELD_ROOM_TYPE_PRICE_LABEL') ?>
			(<?php echo $this->item->currency->currency_code ?>)
			<span class="star">&nbsp;*</span>
		</label>
		<div class="controls">
			<?php echo $this->form->getInput('price'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('coupon_id'); ?>
		<div class="controls">
			<div id="coupon-selection-holder">
				<?php echo $this->form->getInput('coupon_id'); ?>
			</div>
		</div>
	</div>

    <div class="control-group">
        <?php echo $this->form->getLabel('extra_id'); ?>
        <div class="controls">
            <div id="extra-selection-holder">
				<?php echo $this->form->getInput('extra_id'); ?>
			</div>
        </div>
    </div>

	<div class="control-group">
		<?php echo $this->form->getLabel('state'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('state'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('description'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
	</div>
</fieldset>