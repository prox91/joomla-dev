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
<div class="alert alert-info">
	<?php
	if ($this->checkin && $this->checkout) :
		echo JText::sprintf('SR_ROOM_AVAILABLE_FROM_TO', $this->checkin, $this->checkout);
		echo ' <a href="#sr-checkavailability-form-component2" class="btn" id="sr-change-date">'.JText::_('SR_CHANGE').'</a>';
	endif;
	?>
    <div <?php echo ($this->checkin && $this->checkout) ? 'style="display: none"' : ''?>>
        <form id="sr-checkavailability-form-component" action="<?php echo JRoute::_('index.php', false)?>" method="GET" class="form-inline sr-validate">
            <p>
				<?php echo JText::_('SR_ASK_FOR_CHECKIN_CHECKOUT') ?>
            </p>
            <input name="city" value="<?php echo $this->item->city ?>" type="hidden" />
            <input name="country_id" value="<?php echo $this->item->country_id ?>" type="hidden" />
            <input name="geo_state_id" value="<?php echo $this->item->geo_state_id ?>" type="hidden" />
            <input name="id" value="<?php echo $this->item->id ?>" type="hidden" />

            <label for="checkin_component">
				<?php echo JText::_('SR_SEARCH_CHECKIN_DATE')?>
            </label>
            <input type="text" name="checkin" id="checkin_component" class="datepicker input-small"
                   value="<?php echo isset($this->checkin) ? $this->checkin : 'dd/mm/yyyy' ?>" required/>
            <label for="checkout_component">
				<?php echo JText::_('SR_SEARCH_CHECKOUT_DATE')?>
            </label>
            <input type="text" name="checkout" id="checkout_component" class="datepicker input-small"
                   value="<?php echo isset($this->checkout) ? $this->checkout : 'dd/mm/yyyy' ?>" required/>


            <button class="btn primary" type="submit"><?php echo JText::_('SR_SEARCH')?></button>
            <input type="hidden" name="option" value="com_solidres" />
            <input type="hidden" name="task" value="reservationasset.checkavailability" />
			<?php echo JHtml::_('form.token'); ?>
        </form>
    </div>

    <div style="display: none">
        <form id="sr-checkavailability-form-component2" action="<?php echo JRoute::_('index.php', false)?>" method="GET" class="form-horizontal sr-validate">
            <fieldset>
                <legend>
					<?php echo JText::_('SR_ASK_FOR_CHECKIN_CHECKOUT') ?>
                </legend>


                <input name="city" value="<?php echo $this->item->city ?>" type="hidden" />
                <input name="country_id" value="<?php echo $this->item->country_id ?>" type="hidden" />
                <input name="geo_state_id" value="<?php echo $this->item->geo_state_id ?>" type="hidden" />
                <input name="id" value="<?php echo $this->item->id ?>" type="hidden" />

                <div class="control-group">
                    <div class="control-label">
                        <label for="checkin_component">
							<?php echo JText::_('SR_SEARCH_CHECKIN_DATE')?>
                        </label>
                    </div>
                    <div class="controls">
                        <input type="text" name="checkin" id="checkin_component2" class="datepicker input-small"
                               value="<?php echo isset($this->checkin) ? $this->checkin : 'dd/mm/yyyy' ?>" required/>
                    </div>
                </div>

                <div class="control-group">
                    <div class="control-label">
                        <label for="checkout_component">
							<?php echo JText::_('SR_SEARCH_CHECKOUT_DATE')?>
                        </label>
                    </div>
                    <div class="controls">
                        <input type="text" name="checkout" id="checkout_component2" class="datepicker input-small"
                               value="<?php echo isset($this->checkout) ? $this->checkout : 'dd/mm/yyyy' ?>" required/>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn primary" type="submit"><?php echo JText::_('SR_SEARCH')?></button>
                </div>

                <input type="hidden" name="option" value="com_solidres" />
                <input type="hidden" name="task" value="reservationasset.checkavailability" />
				<?php echo JHtml::_('form.token'); ?>
            </fieldset>

        </form>
    </div>
</div>
