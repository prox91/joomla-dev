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

	<!--<div class="control-group">
		<?php /*echo $this->form->getLabel('category_id'); */?>
		<div class="controls">
			<?php /*echo $this->form->getInput('category_id'); */?>
            <a class="btn btn-small sr-iframe" id="category_modal"
			   href="<?php /*echo JRoute::_('index.php?option=com_solidres&tmpl=component&view=category&layout=modal&disablesidebar=1') */?>">
                <i class="icon-plus-sign"></i> New
			</a>
		</div>
	</div>-->

	<div class="control-group">
		<label class="hasTip control-label"
			   title="<?php echo JText::_("SR_FIELD_PARTNER_LABEL") ?>::<?php echo JText::_("SR_FIELD_PARTNER_DESC") ?>">
				<?php echo JText::_("SR_FIELD_PARTNER_LABEL") ?>
		</label>
		<div class="controls">
			<input type="text" value="<?php echo isset($this->item->partner_name) ? $this->item->partner_name : '' ?>" id="jform_partner_name"/>
			<?php echo $this->form->getInput('partner_id');?>
			<a class="btn btn-small sr-iframe" id="customers_modal"
			   href="<?php echo JRoute::_('index.php?option=com_solidres&tmpl=component&view=customer&layout=modal&disablesidebar=1') ?>">
                <i class="icon-plus-sign"></i> New
			</a>
		</div>
	</div>

	<div class="control-group">
		<?php echo $this->form->getLabel('address_1'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('address_1'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('address_2'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('address_2'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('city'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('city'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('postcode'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('postcode'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('email'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('email'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('website'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('website'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('phone'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('phone'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('fax'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('fax'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('country_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('country_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('geo_state_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('geo_state_id'); ?>
		</div>
	</div>

    <div class="control-group">
		<?php echo $this->form->getLabel('currency_id'); ?>
        <div class="controls">
			<?php echo $this->form->getInput('currency_id'); ?>
        </div>
    </div>

	<div class="control-group">
		<?php echo $this->form->getLabel('description'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
	</div>

</fieldset>