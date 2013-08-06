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
<a id="new-price-tier" class="btn"><i class="icon-plus-2"></i> <?php echo JText::_('SR_ROOM_TYPE_TARIFF_NEW_PRICE_TIER')?></a>
<table id="tariff_tbl" class="table" cellspacing="0">
	<thead>
		<tr>
			<th><?php echo JText::_('SR_ROOM_TYPE_TARIFF_ACTION'); ?></th>
			<th><?php echo JText::_('SR_ROOM_TYPE_TARIFF_TITLE'); ?></th>
			<th><?php echo JText::_('SR_ROOM_TYPE_TARIFF_CUSTOMER_GROUP'); ?></th>
			<th><?php echo JText::_('SR_ROOM_TYPE_TARIFF_VALID_FROM'); ?></th>
			<th><?php echo JText::_('SR_ROOM_TYPE_TARIFF_PRICE'); ?> (<?php echo $this->item->currency->currency_code ?>)</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
			$i = 0;
			if (isset($this->item->tariffSorted) && is_array($this->item->tariffSorted)) :
				foreach($this->item->tariffSorted as $key => $value) :
		?>
				<tr id="tier-tariff-<?php echo $i ?>" class="tier-tariff">
                    <td width="2%">
						<a title="Remove" class="delete-tier-row btn"><i class="icon-minus-sign"></i> </a>
					</td>
					<td width="20%">
						<input type="text" value="<?php echo $value->title ?>" name="jform[tariff][<?php echo $i ?>][title]" class="">
						<input type="text" value="<?php echo $value->description ?>" name="jform[tariff][<?php echo $i ?>][description]" class="">
					</td>
					<td width="10%">
					<?php 
						echo JHtml::_('select.genericlist', $this->customerGroupOptions, 'jform[tariff]['.$i.'][customer_group_id]', 'class="input-small"','value','text', $value->customer_group_id);
					?>
					</td>
					<td width="10%">
						<input type="text" value="<?php echo date('d-m-Y', JFactory::getDate($value->valid_from)->toUnix()) ?>" name="jform[tariff][<?php echo $i ?>][valid_from]" class="datepicker input-small">
						<input type="text" value="<?php echo date('d-m-Y', JFactory::getDate($value->valid_to)->toUnix()) ?>" name="jform[tariff][<?php echo $i ?>][valid_to]" class="datepicker input-small">
					</td>
					<td width="58%">
						<div class="sr-complexed-tariff-wday-all" style="<?php echo !is_array($value->price) ? '': 'display: none' ?> ">
							<div class="input-prepend prependtop">
								<span class="add-on">All week</span>
								<input <?php echo !is_array($value->price) ? '' : 'disabled="disabled"' ?> class="align-right input-mini" type="text" value="<?php echo !is_array($value->price) ? $value->price : '' ?>" name="jform[tariff][<?php echo $i ?>][price]">
								<p class="help-block">
									<a class="sr-switch-complexed-tariff-wday-each" href="">Set price for each week day</a>
								</p>
							</div>
						</div>
						<div class="sr-complexed-tariff-wday-each" style="<?php echo !is_array($value->price) ? 'display: none': '' ?>" >
							<?php
							if (is_array($value->price)) :
								foreach ($value->price as $day => $priceOfDay):
							?>
							<div class="input-prepend prependtop">
								<span class="add-on"><?php echo JText::_($day) ?></span>
								<input <?php echo !is_array($value->price) ? 'disabled="disabled"' : '' ?> name="jform[tariff][<?php echo $i ?>][price][<?php echo $day ?>]" class="align-right input-mini" size="16" type="text" value="<?php echo $priceOfDay ?>">
							</div>
							<?php
								endforeach;
							else :
							?>
								<div class="input-prepend prependtop">
									<span class="add-on"><?php echo JText::_('SUN') ?></span>
									<input disabled="disabled" name="jform[tariff][<?php echo $i ?>][price][sun]" class="align-right input-mini" size="16" type="text">
								</div>
								<div class="input-prepend prependtop">
									<span class="add-on"><?php echo JText::_('MON') ?></span>
									<input disabled="disabled" name="jform[tariff][<?php echo $i ?>][price][mon]" class="align-right input-mini" size="16" type="text">
								</div>
								<div class="input-prepend prependtop">
									<span class="add-on"><?php echo JText::_('TUE') ?></span>
									<input disabled="disabled" name="jform[tariff][<?php echo $i ?>][price][tue]" class="align-right input-mini" size="16" type="text">
								</div>
								<div class="input-prepend prependtop">
									<span class="add-on"><?php echo JText::_('WED') ?></span>
									<input disabled="disabled" name="jform[tariff][<?php echo $i ?>][price][wed]" class="align-right input-mini" size="16" type="text">
								</div>
								<div class="input-prepend prependtop">
									<span class="add-on"><?php echo JText::_('THU') ?></span>
									<input disabled="disabled" name="jform[tariff][<?php echo $i ?>][price][thu]" class="align-right input-mini" size="16" type="text">
								</div>
								<div class="input-prepend prependtop">
									<span class="add-on"><?php echo JText::_('FRI') ?></span>
									<input disabled="disabled" name="jform[tariff][<?php echo $i ?>][price][fri]" class="align-right input-mini" size="16" type="text">
								</div>
								<div class="input-prepend prependtop">
									<span class="add-on"><?php echo JText::_('SAT') ?></span>
									<input disabled="disabled" name="jform[tariff][<?php echo $i ?>][price][sat]" class="align-right input-mini" size="16" type="text">
								</div>

							<?php endif ?>
							<p class="help-block">
								<a class="sr-switch-complexed-tariff-wday-all" href="">Set price for all week day</a>
							</p>
						</div>
					</td>
				</tr>
		<?php
					$i++;
				endforeach;
			endif;
		?>
	</tbody>
</table>

