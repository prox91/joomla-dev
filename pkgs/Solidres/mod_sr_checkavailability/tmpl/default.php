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
<div class="solidres-module">
	<div class="row-fluid">
    <form id="sr-checkavailability-form" action="<?php echo JRoute::_('index.php', false)?>" method="GET" class="form-stacked sr-validate">
    	<fieldset>
    		<input name="city" value="<?php echo $default->city ?>" type="hidden" />
    		<input name="country_id" value="<?php echo $default->country_id ?>" type="hidden" />
    		<input name="geo_state_id" value="<?php echo $default->geo_state_id ?>" type="hidden" />
    		<input name="id" value="<?php echo $default->id ?>" type="hidden" />

			<div class="span12">
				<label for="checkin">
					<?php echo JText::_('SR_SEARCH_CHECKIN_DATE')?>
				</label>
				<input type="text" name="checkin" id="checkin" class="datepicker span12"
					   value="<?php echo isset($checkin) ? $checkin : 'dd/mm/yyyy' ?>" required/>
            </div>

            <div class="span12">
				<label for="checkout">
					<?php echo JText::_('SR_SEARCH_CHECKOUT_DATE')?>
				</label>
				<input type="text" name="checkout" id="checkout" class="datepicker span12"
					   value="<?php echo isset($checkout) ? $checkout : 'dd/mm/yyyy' ?>" required/>
			</div>

            <!--
			<div class="span12">
				<label for="adult_number">
					<?php echo JText::_('SR_SEARCH_ADULT_NUMBER')?>
				</label>
				<select name="adults" id="adult_number" class="span12">
					<option value="">1</option>
					<option value="">2</option>
					<option value="">3</option>
				</select>
			</div>

            <div class="span12">
				<label for="children_number">
					<?php echo JText::_('SR_SEARCH_CHILDREN_NUMBER')?>
				</label>
				<select name="children" id="children_number" class="span12">
					<option value="">0</option>
					<option value="">1</option>
					<option value="">2</option>
				</select>
			</div>
			-->

            <div class="span12">
				<div class="action">
					<button class="btn primary" type="submit"><?php echo JText::_('SR_SEARCH')?></button>
					<button class="btn" type="reset"><?php echo JText::_('SR_RESET')?></button>
				</div>
            </div>

    	</fieldset>

    	<input type="hidden" name="option" value="com_solidres" />
    	<input type="hidden" name="task" value="reservationasset.checkavailability" />
    	<?php echo JHtml::_('form.token'); ?>
    </form>
    </div>
</div>
