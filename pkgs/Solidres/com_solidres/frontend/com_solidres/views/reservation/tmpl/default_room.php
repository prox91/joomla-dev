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

<div id="room" class="reservation-box">
	<h3>
		<span>1</span>
        <?php echo JText::_('SR_ROOM_SELECTION')?>
	</h3>
	<div class="reservation-box-inner">
		<form enctype="multipart/form-data"
			  id="sr-reservation-form-room"
			  class="sr-reservation-form sr-validate"
			  action="<?php echo JRoute::_('index.php?option=com_solidres&task=reservation.process&step=room&format=json') ?>"
			  method="POST">
			
			<div class="row-fluid">
				<div class="span6">
					<ul>
						<li>
							<?php echo JText::_('SR_SEARCH_CHECKIN_DATE')?>:
							<?php echo date('l, d F Y', strtotime($this->checkin)) ?>
							<input type="hidden" name="jform[checkin]" value="<?php echo $this->checkin ?>"/>
						</li>
						<li>
							<?php echo JText::_('SR_SEARCH_CHECKOUT_DATE')?>:
							<?php echo date('l, d F Y', strtotime($this->checkout)) ?>
							<input type="hidden" name="jform[checkout]" value="<?php echo $this->checkout ?>"/>
						</li>
						<li>
							<?php echo JText::_('SR_NUMBER_OF_ROOM')?>: <?php echo $this->totalReservedRoom ?>
						</li>
						<li>
							<?php echo JText::_('SR_NUMBER_OF_NIGHT')?>: <?php echo $this->numberOfNights ?>
						</li>
					</ul>
				</div>
				<div class="span6">
					<ul>
						<li>
							<?php echo JText::_('SR_TOTAL_PRICE')?>: <?php echo $this->reservation->total_price_tax_excl_formatted ?>
						</li>

					</ul>
				</div>
			</div>

			<?php
				$i = 0; // Room type index
				$extraCount = 0; // Extra index

				foreach ($this->reservation->room_types as $k => $v) :
					for ($t = 1; $t <= $v['quantity']; $t ++ ) :
						$i ++;
		?>
						<div class="single-room-type-selection">
							<h4 class="room_type_name"><?php echo $v['name']; ?></h4>
							<input type="hidden" name="jform[room_types][<?php echo $i ?>][room_type_id]" value="<?php echo $k ?>" />

							<div class="room-reservation-info sr-clearfix row-fluid">
								<div class="room-guest-name span6">
									<p><?php echo JText::_('SR_ROOM_TYPE_GUEST_NAME') ?></p>
									<input type="text"
										   class=""
										   required
										   name="jform[room_types][<?php echo $i ?>][guest_fullname]"
										   value="<?php echo (isset($this->userState->room['room_types'][$i])) ? $this->userState->room['room_types'][$i]['guest_fullname'] : '' ?>"
											/>
								</div>
								<div class="span3">
									<p><?php echo JText::_('SR_ROOM_TYPE_ADULT_PER_ROOM'); ?></p>
									<select class="" name="jform[room_types][<?php echo $i ?>][adults_number]">
										<?php
											$adultCount = 0;
											$maxAdult = $v['occupancy_adult'];
											for($adultCount = 0; $adultCount <= $maxAdult; $adultCount ++) :
												$checked = '';
												if (isset($this->userState->room['room_types'][$i])) :
													$checked = ($this->userState->room['room_types'][$i]['adults_number'] == $adultCount) ? 'selected="selected"' : '';
												endif;
												echo '<option '.$checked.' value="'.$adultCount.'">'.$adultCount.'</option>';
											endfor;
										?>

									</select>
								</div>
								<div class="span3">
									<p><?php echo JText::_('SR_ROOM_TYPE_CHILDREN_PER_ROOM') ?></p>
									<select class="" name="jform[room_types][<?php echo $i ?>][children_number]">
										<?php
											$childCount = 0;
											$maxChild = $v['occupancy_child'];
											for($childCount = 0; $childCount <= $maxChild; $childCount ++) :
												$checked = '';
												if (isset($this->userState->room['room_types'][$i])) :
													$checked = ($this->userState->room['room_types'][$i]['children_number'] == $childCount) ? 'selected="selected"': '' ;
												endif;
												echo '<option '.$checked.' value="'.$childCount.'">'.$childCount.'</option>';
											endfor;
										?>
									</select>
								</div>
							</div>

						<?php
						if (isset($v['extras']) && is_array($v['extras'])) :
							foreach ($v['extras'] as $extraItem) :
								$inputClass = $extraCount .'-'. $extraItem->id;
								$storedExtraId = isset($this->userState->room['room_types'][$i]['extra'][$extraCount][$extraItem->id]) ? $this->userState->room['room_types'][$i]['extra'][$extraCount][$extraItem->id] : NULL ;
								?>
							<div class="room-extra-info sr-clearfix row-fluid">
								<div class="extra-name span6">
									<input
										class="sr-extra-<?php echo $inputClass ?>"
										type="checkbox"
										<?php echo isset($storedExtraId) ? 'checked="checked"': '' ?>
										/>

									<?php echo $extraItem->name ?> (<?php echo  $extraItem->currency->format() ?>)

									<input class="sr-extra-<?php echo $inputClass ?>-d"
										<?php echo isset($storedExtraId) ? '' : 'disabled="disabled"' ?>
										   type="hidden"
										   name="jform[room_types][<?php echo $i ?>][extra][<?php echo $extraCount ?>][<?php echo $extraItem->id ?>][name]"
										   value="<?php echo $extraItem->name ?>" />

									<!--<p class="help-block"><?php /*echo $extraItem->description */?></p>-->

								</div>

								<div class="span6">
									<?php if ($extraItem->max_quantity > 0) : ?>
									<select class="span1 sr-extra-<?php echo $inputClass ?>-d"
										<?php echo isset($storedExtraId['quantity']) ? '' : 'disabled="disabled"' ?>
											name="jform[room_types][<?php echo $i ?>][extra][<?php echo $extraCount ?>][<?php echo $extraItem->id ?>][quantity]">
										<?php
										for ($quantitySelection = 1; $quantitySelection <= $extraItem->max_quantity; $quantitySelection ++) :
											$checked = '';
											if (isset($storedExtraId['quantity'])) :
												$checked = ($storedExtraId['quantity'] == $quantitySelection) ? 'selected="selected"': '' ;
											endif;
											echo '<option '.$checked.' value="'.$quantitySelection.'">'.$quantitySelection.'</option>';
										endfor;
										?>
									</select>
									<?php endif; ?>
								</div>
							</div>

								<?php
								$extraCount ++;
							endforeach;
						endif;
						?>
					</div>
		<?php
					endfor;
				endforeach;
			?>

			<div class="processing-indicator nodisplay"></div>
			<button class="btn btn-primary sr-button sr-i-progress" id="" type="submit">
                <?php echo JText::_('SR_BUTTON_RESERVATION_PARTIAL_SUBMIT') ?>
			</button>

			<input type="hidden" name="jform[customer_id]" 	value="" />
			<input type="hidden" name="jform[raid]" 		value="<?php echo $this->raid ?>" />
			<input type="hidden" name="jform[state]" 		value="0" />
			<input type="hidden" name="jform[returnurl]" 	value="<?php echo JURI::getInstance()->getQuery() ?>" />
			<input type="hidden" name="jform[next_step]" 	value="guest" />
			<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>
</div>