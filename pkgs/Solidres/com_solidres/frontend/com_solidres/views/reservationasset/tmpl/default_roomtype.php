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

$dayMapping = array('0' => JText::_('SUN'), '1' => JText::_('MON'), '2' => JText::_('TUE'), '3' => JText::_('WED'), '4' => JText::_('THU'), '5' => JText::_('FRI'), '6' => JText::_('SAT') );

?>

<h3><?php echo JText::_('SR_AVAILABILITY') ?></h3>

<?php if (isset($this->checkin) && $this->checkout) : ?>
<div class="coupon">
    <input type="text" name="coupon_code" class="span12" id="coupon_code" placeholder="<?php echo JText::_('SR_COUPON_ENTER') ?>"/>
	<?php if (isset($this->coupon)) : ?>
		<?php echo JText::_('SR_APPLIED_COUPON') ?>
        <span class="label label-success">
			<?php echo $this->coupon['coupon_name']	?>
		</span>&nbsp;
		<a id="sr-remove-coupon" href="javascript:void(0)" data-couponid="<?php echo $this->coupon['coupon_id'] ?>">
			<?php echo JText::_('SR_REMOVE') ?>
		</a>
	<?php endif ?>
</div>
<?php endif ?>

<?php if(count($this->item->roomTypes) > 0) : ?>
<form action="<?php echo JRoute::_('index.php', false)?>" method="GET" id="sr-availability-form">
	<input type="hidden" name="option" value="com_solidres" />
	<input type="hidden" name="task" value="reservation.start" />
	<input type="hidden" name="id" value="<?php echo $this->item->id ?>" />
    <input type="hidden" name="bookingconditions" value="<?php echo $this->item->params['termsofuse'] ?>" />
    <input type="hidden" name="privacypolicy" value="<?php echo $this->item->params['privacypolicy'] ?>" />
	<input type="hidden" name="checkin" value="<?php echo $this->checkin ?>" />
	<input type="hidden" name="checkout" value="<?php echo $this->checkout ?>" />
	<input type="hidden" name="country_id" value="<?php echo $this->countryId ?>" />
	<input type="hidden" name="geo_state_id" value="<?php echo $this->geoStateId ?>" />
	<input type="hidden" name="adults" value="<?php echo $this->adults ?>" />
	<input type="hidden" name="children" value="<?php echo $this->children ?>" />

	<?php if (isset($this->checkin) && $this->checkout) : ?>
		<button type="submit" class="btn btn-success btn-top" id="submit-norm">
			<i class="icon-checkmark"></i> <?php echo JText::_('SR_BOOK_NOW') ?>
		</button>

		<?php if (SR_PLUGIN_PAYPAL_EXPRESSCHECKOUT_ENABLED) : ?>
		or
		<a href="#" id="submit-ppec">
			<img src="https://fpdbs.paypal.com/dynamicimageweb?cmd=_dynamic-image&buttontype=ecshortcut" alt="Paypal"/>
		</a>
		<?php endif ?>
	<?php endif ?>

	<?php

		$count = 1;
		foreach($this->item->roomTypes as $roomType ) :
			if ( isset($roomType->tariffBreakDown) && is_array($roomType->tariffBreakDown)) :
				$tariffBreakDownHtml = '<table class=\"tariff-break-down\"><tr>';

				foreach ($roomType->tariffBreakDown as $wday => $priceOfWDay ) :
					$tariffBreakDownHtml .= '<td><p>'.$dayMapping[$wday].'</p>'.$priceOfWDay->format().'</td>';
				endforeach;

				$tariffBreakDownHtml .= '</tr></table>';

				$this->document->addScriptDeclaration('
					Solidres.jQuery(function($){
						var content = "'.$tariffBreakDownHtml.'";
						$("#custom-tariff-'.$roomType->id.'").popover({
							html: true,
							content: content,
							title: "'.JText::_('SR_TARIFF_BREAK_DOWN').'",
							placement: "bottom",
							trigger: "hover"
						});
					});
				');
			endif;

			$rowCSSClass = ($count % 2) ? ' even' : ' odd';
			$rowCSSClass .= $roomType->featured == 1 ? ' featured' : '';
	?>
	<div class="row-fluid <?php echo $rowCSSClass ?>">
		<div class="span6">
			<div class="inner">
				<h4 class="roomtype_name">
					<a href="#" class="room_type_details" id="room_type_details_handler_<?php echo $roomType->id ?>">
						<?php echo $roomType->name; ?>
					</a>
					<?php if ($roomType->featured == 1) : ?>
						<span class="label label-success"><?php echo JText::_('SR_FEATURED_ROOM_TYPE') ?></span>
					<?php endif ?>
				</h4>

				<?php if ( !empty($roomType->media) ) : ?>
					<a class="room_type_details sr-photo" href="<?php echo SRURI_MEDIA.'/assets/images/system/'.$roomType->media[0]->value; ?>">
						<img src="<?php echo SRURI_MEDIA.'/assets/images/system/thumbnails/2/'.$roomType->media[0]->value; ?>"
							 alt="<?php echo $roomType->media[0]->name ?>"/>
					</a>
				<?php endif ?>

				<div class="roomtype_desc">
					<ul class="unstyled">
						<li>
							<?php
							if ( isset($roomType->roomtype_custom_fields['free_cancellation']) && $roomType->roomtype_custom_fields['free_cancellation']== 1) :
								echo JText::_('SR_FREE_CANCELLATION');
							else :
								echo JText::_('SR_NON_REFUNDABLE');
							endif;
							?>
						</li>
						<li>
							<?php
							if ( isset($roomType->roomtype_custom_fields['breakfast_included']) && $roomType->roomtype_custom_fields['breakfast_included']== 1) :
								echo JText::_('SR_BREAKFAST_INCLUDED');
							else :
								echo JText::_('SR_BREAKFAST_EXCLUDED');
							endif;
							?>
						</li>
						<li>
							<?php echo JText::_('SR_ROOM_OCCUPANCY') ?>
							<?php for ($i = 0, $n = ((int)$roomType->occupancy_adult + (int)$roomType->occupancy_child); $i < $n; $i++) : ?>
								<i class="icon-user"></i>
							<?php endfor; ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="span3 align-right">
			<div class="inner">
				<?php
				if (isset($roomType->complexTariff) || isset($roomType->defaultTariff)) : ?>
					<p>
						<?php
						$defaultTariffCSSClass = 'default-tariff';
						if (!empty($roomType->complexTariff) && $roomType->complexTariff->getValue() != $roomType->defaultTariff->getValue())
							$defaultTariffCSSClass .= ' line-through';
						else if ($roomType->defaultTariffIsAppliedCoupon)
							$defaultTariffCSSClass .= ' is-applied-coupon';
						?>
						<span class="<?php echo $defaultTariffCSSClass ?>">
							<?php echo $roomType->defaultTariff->format() ?>
						</span>
					</p>

					<p>
						<?php
						$customTariffCSSClass = 'custom-tariff';
						if (!empty($roomType->complexTariff) && $roomType->complexTariff->getValue() != $roomType->defaultTariff->getValue()) :
							if ($roomType->complexTariffIsAppliedCoupon)
								$customTariffCSSClass .= ' is-applied-coupon';
						?>
							<span class="<?php echo $customTariffCSSClass ?>" id="custom-tariff-<?php echo $roomType->id ?>">
								<?php if (!empty($roomType->complexTariff)) echo $roomType->complexTariff->format(); ?>
							</span>
						<?php
						endif
						?>
					</p>
				<?php endif ?>
			</div>
		</div>
		<div class="span3">
			<div class="inner">
			<?php
			if (isset ($roomType->totalAvailableRoom)) :
				if ($roomType->totalAvailableRoom == 0) :
					echo JText::_('SR_NO_ROOM_AVAILABLE');
				else :
					if (empty($roomType->currency) && empty($roomType->defaultTariff)) :
						echo JText::_('SR_NO_TARIFF_AVAILABLE');
					else :
						if (!empty($roomType->complexTariff)) :
							$currencyValue = $roomType->complexTariff->getValue();
						else :
							$currencyValue = $roomType->defaultTariff->getValue();
						endif;
						?>
						<select class="span12" name="rt_<?php echo $this->item->id ?>_<?php echo $roomType->id ?>">
							<?php
							for($i = 0; $i <= $roomType->totalAvailableRoom; $i ++) :
								$temp = new SRCurrency(0, $this->item->currency_id);
								$temp->setValue($currencyValue * $i);
								echo '<option value="'.$i.'">'.$i . (($i > 0) ? ' ('. ($temp->format()) . ')' : ''). '</option>';
							endfor;
							?>
						</select>
					<?php
					endif;
				endif;
			endif; ?>
			</div>
		</div>
	</div>
	<div class="row-fluid <?php echo $rowCSSClass ?> room_type_details hidden room_type_details_handler_<?php echo $roomType->id ?>">
		<div class="span12">
			<div class="inner">
				<?php
				if( !empty($roomType->media) ) :
					$count2 = 0;
					foreach ($roomType->media as $media) :
						if ($count2 != 0) :
							?>
							<a class="sr-photo" href="<?php echo SRURI_MEDIA.'/assets/images/system/'.$media->value; ?>">
								<img src="<?php echo SRURI_MEDIA.'/assets/images/system/thumbnails/2/'.$media->value; ?>"
									 alt="<?php echo $media->name ?>"/>
							</a>
						<?php
						endif;
						$count2 ++;
					endforeach;
				endif;
				?>
				<p>
					<?php echo $roomType->description ?>
				</p>
				<ul>
					<?php
					if (!empty($roomType->roomtype_custom_fields['room_facilities'])) :
						echo '<li>'. JText::_('SR_ROOM_FACILITIES') .': '.  $roomType->roomtype_custom_fields['room_facilities'] .'</li>';
					endif;

					if (!empty($roomType->roomtype_custom_fields['room_size'])) :
						echo '<li>'. JText::_('SR_ROOM_SIZE') .': '.  $roomType->roomtype_custom_fields['room_size'] .'</li>';
					endif;

					if (!empty($roomType->roomtype_custom_fields['bed_size'])) :
						echo '<li>'. JText::_('SR_BED_SIZE') .': '.  $roomType->roomtype_custom_fields['bed_size'] .'</li>';
					endif;

					if (!empty($roomType->roomtype_custom_fields['taxes'])) :
						echo '<li>'. JText::_('SR_TAXES') .': '.  $roomType->roomtype_custom_fields['taxes'] .'</li>';
					endif;

					if (!empty($roomType->roomtype_custom_fields['prepayment'])) :
						echo '<li>'. JText::_('SR_PREPAYMENT') .': '.  $roomType->roomtype_custom_fields['prepayment'] .'</li>';
					endif;
					?>
				</ul>

				<?php if ($this->config->get('availability_calendar_enable', 1)) : ?>
					<div class="processing-indicator nodisplay"></div>
					<button type="button" data-roomtypeid="<?php echo $roomType->id ?>" class="btn load-calendar">
						<i class="icon-calendar"></i> <?php echo JText::_('SR_AVAILABILITY_CALENDAR_VIEW') ?>
					</button>
					<div id="availability-calendar-<?php echo $roomType->id ?>" class="availability-calendar"></div>
				<?php endif ?>
			</div>
		</div>
	</div>
	<?php
			$count ++;
		endforeach
	?>

	<?php if (isset($this->checkin) && $this->checkout) : ?>
	<button type="submit" class="btn btn-success btn-bottom">
		<i class="icon-checkmark"></i> <?php echo JText::_('SR_BOOK_NOW') ?>
	</button>
	<?php endif ?>

	<?php echo JHtml::_('form.token'); ?>
</form>
<?php endif ?>
