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

$subTotal = $this->item->total_price_tax_excl . ' ' . $this->item->currency_code;
$tax = ($this->item->total_price_tax_incl - $this->item->total_price_tax_excl) . ' ' . $this->item->currency_code;
$totalExtraPrice = $this->item->total_extra_price;
$grandTotal = $this->item->total_price_tax_incl + $totalExtraPrice . ' ' . $this->item->currency_code;

$badges = array(
	0 => 'label-info',
	1 => 'label-success',
	2 => 'label-inverse',
	3 => '',
	4 => 'label-warning',
	-2 => 'label-important'
);

$statuses = array(
	0 => JText::_('SR_RESERVATION_STATE_PENDING_ARRIVAL'),
	1 => JText::_('SR_RESERVATION_STATE_CHECKED_IN'),
	2 => JText::_('SR_RESERVATION_STATE_CHECKED_OUT'),
	3 => JText::_('SR_RESERVATION_STATE_CLOSED'),
	4 => JText::_('SR_RESERVATION_STATE_CANCELED'),
	-2 => JText::_('JTRASHED')
);

SRHtml::_('jquery.editable');

$script =
	' Solidres.jQuery(function($) {
		$.fn.editable.defaults.mode = "inline";
		$( "#state" ).editable({
			url: "' .  JRoute::_('index.php?option=com_solidres&task=reservation.save&format=json', false) . '",
			source: [
				{value: 0, text: "'. JText::_('SR_RESERVATION_STATE_PENDING_ARRIVAL') . '"},
				{value: 1, text: "'. JText::_('SR_RESERVATION_STATE_CHECKED_IN') . '"},
				{value: 2, text: "'. JText::_('SR_RESERVATION_STATE_CHECKED_OUT') . '"},
				{value: 3, text: "'. JText::_('SR_RESERVATION_STATE_CLOSED') . '"},
				{value: 4, text: "'. JText::_('SR_RESERVATION_STATE_CANCELED') . '"},
				{value: -2, text: "'. JText::_('JTRASHED') . '"}
			]
		});
	});';
JFactory::getDocument()->addScriptDeclaration($script);

?>

<div id="solidres">
    <div class="row-fluid">
		<?php echo SolidresHelperSideNavigation::getSideNavigation($this->getName()); ?>
		<div id="sr_panel_right" class="sr_form_view span10">
			<div class="row-fluid">
				<div class="span12 reservation-detail-box">
                    <h3><?php echo JText::_("SR_GENERAL_INFO")?></h3>
					<div class="row-fluid">
                        <div class="span4">

                            <ul class="reservation-details">
                                <li><label><?php echo JText::_("SR_CODE")?></label>  <span class="label <?php echo $badges[$this->item->state] ?>"><?php echo $this->item->code?></span> </li>
                                <li><label><?php echo JText::_("SR_CHECKIN")?></label>  <?php echo date('d-m-Y', strtotime($this->item->checkin))?></li>
                                <li><label><?php echo JText::_("SR_CHECKOUT")?></label> <?php echo date('d-m-Y', strtotime($this->item->checkout))?></li>
                                <li><label><?php echo JText::_("SR_CREATED_DATE")?></label> <?php echo date('d-m-Y', strtotime($this->item->created_date))?></li>
                                <!--<li><label><?php /*echo JText::_("SR_MODIFIED_DATE")*/?></label> <?php /*echo date('d-m-Y', strtotime($this->item->modified_date))*/?></li>-->
                                <li><label><?php echo JText::_("SR_PAYMENT_TYPE")?></label> <?php echo $this->item->payment_method_id?></li>
                                <li>
									<label><?php echo JText::_("SR_STATUS")?></label>
									<a href="#"
									   id="state"
									   data-type="select"
									   data-pk="<?php echo $this->item->id ?>"
									   data-value="<?php echo $this->item->state ?>"
									   data-original-title="Enter username"><?php echo $statuses[$this->item->state] ?></a>
								</li>
                            </ul>
                        </div>
                        <div class="span4">
                            <!--<h3><?php /*echo JText::_("SR_CUSTOMER_INFO")*/?></h3>-->
                            <ul class="reservation-details">
                                <li><label><?php echo JText::_("SR_FIRSTNAME")?></label> <?php echo $this->item->customer_firstname ?></li>
                                <li><label><?php echo JText::_("SR_MIDDLENAME")?></label> <?php echo $this->item->customer_middlename ?></li>
                                <li><label><?php echo JText::_("SR_LASTNAME")?></label> <?php echo $this->item->customer_lastname ?></li>
                                <li><label><?php echo JText::_("SR_EMAIL")?></label> <?php echo $this->item->customer_email ?></li>
                                <li><label><?php echo JText::_("SR_PHONE")?></label> <?php echo $this->item->customer_phonenumber ?></li>
                            </ul>
                        </div>

						<div class="span4">
                            <ul>
                                <li>Sub total: <?php echo $subTotal ?></li>
                                <li>Tax: <?php echo $tax ?></li>
                                <li>Grand total: <?php echo $grandTotal ?></li>
                            </ul>
						</div>
					</div>
				</div>
			</disv>

			<div class="row-fluid">
				<div class="span12 reservation-detail-box">

					<h3><?php echo JText::_("SR_ROOM_EXTRA_INFO")?></h3>
					<table class="table">
						<thead>
							<th>Room Type</th>
							<th><?php echo JText::_("SR_ROOM_NUMBER") ?></th>
							<th><?php echo JText::_("SR_GUEST_FULLNAME") ?></th>
							<th><?php echo JText::_("SR_ADULT_CHILDREN_NUMBER") ?></th>
							<th><?php echo JText::_("SR_EXTRAS").': '?></th>
						</thead>
						<tbody>
							<?php foreach($this->item->reserved_room_details as $room) : ?>
								<tr>
									<td><?php echo $room->room_type_name ?></td>
									<td><?php echo $room->room_label ?></td>
									<td><?php echo$room->guest_fullname ?></td>
									<td><?php echo $room->adults_number.' / '.$room->children_number ?></td>
									<td>
										<?php
										if (isset($room->extras)) :
											foreach($room->extras as $extra) :
												?>
												<span class="label"><?php echo $extra->extra_name ?></span>
												<?php
											endforeach;
										endif;
										?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>

				</div>
			</div>

			<div class="row-fluid">
				<div class="span12 reservation-detail-box">
					<h3>Reservation note</h3>
					<div class="span6">
                        <form id="reservationnote-form" action="index.php?option=com_solidres&task=reservationnote.save&format=json">
                            <textarea rows="5" name="text" class="span12" placeholder="Type your message here"></textarea>
                            <label class="checkbox">
                                <input type="checkbox" name="notify_customer" value="1">
								<?php echo JText::_("SR_RESERVATION_NOTE_NOTIFY_CUSTOMER")?>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="visible_in_frontend" value="1">
								<?php echo JText::_("SR_RESERVATION_NOTE_DISPLAY_IN_FRONTEND")?>
                            </label>
							<div class="processing-indicator nodisplay"></div>
                            <button type="submit" class="btn"><?php echo JText::_("SR_SUBMIT")?></button>
                            <input name="reservation_id" type="hidden" value="<?php echo $this->item->id ?>" />
							<?php echo JHtml::_('form.token'); ?>

                        </form>
					</div>
                    <div class="span6 reservation-note-holder">
						<?php
						if (!empty($this->item->notes)) :
							foreach ($this->item->notes as $note) :
								?>
                                <div class="reservation-note-item">
                                    <p class="info">
										<?php echo $note->created_date ?> by <?php echo $note->username ?>
                                    </p>
                                    <p>
										<?php echo JText::_("SR_RESERVATION_NOTE_NOTIFY_CUSTOMER")?>: <?php echo $note->notify_customer == 1 ? JText::_('JYES') : JText::_('JNO') ?>
                                        |
										<?php echo JText::_("SR_RESERVATION_NOTE_DISPLAY_IN_FRONTEND")?>: <?php echo $note->visible_in_frontend == 1 ? JText::_('JYES') : JText::_('JNO') ?></p>
                                    <p>
										<?php echo $note->text ?>
                                    </p>
                                </div>
								<?php
							endforeach;
						endif;
						?>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12 powered">
			<p>Powered by <a href="http://solidres.com" target="_blank">Solidres</a></p>
		</div>
	</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#item-form').validate();
    });

    Joomla.submitbutton = function(task)
    {
        if (task == 'reservation.cancel')
        {
            Joomla.submitform(task, document.getElementById('item-form'));
        }
    }
</script>
<form action="<?php JRoute::_('index.php?option=com_solidres&view=reservations'); ?>" method="post" name="adminForm" id="item-form" class="">
    <input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>