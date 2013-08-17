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

<div id="reservation-form-summary" class="span3">
	<dl id="sr-summary-extra">
		<dt>
			<?php echo JText::_('SR_RESERVATION_PROGRESS_EXTRA_PACKAGE_INFO') ?>
			|
			<a class="sr-change-details" href="<?php echo $this->uri ?>#extra">
                <i class="icon-cog"></i>
			</a>
            <?php
                if (isset($this->userState->extra['extra'])) {
                    foreach($this->userState->extra['extra'] as $selected_extra) {
                        foreach($selected_extra as $k => $v) {
                            echo '<dd>'.$v['name']. ' '. (isset($v['quantity']) ? $v['quantity'] : '') .'</dd>';
                        }
                    }
                }
            ?>
		</dt>
	</dl>

	<dl id="sr-summary-guest">
		<dt>
			<?php echo JText::_('SR_RESERVATION_PROGRESS_GUEST_INFO') ?>
			|
			<a class="sr-change-details" href="<?php echo $this->uri ?>#guest">
                <i class="icon-cog"></i>
			</a>
            <?php
            if (isset($this->userState->guest)) {
                $guest_info = $this->userState->guest;
                echo '<dd>'.$guest_info['customer_firstname'].' '.$guest_info['customer_middlename'].' '.$guest_info['customer_lastname'].'</dd>';
                echo '<dd>'.$guest_info['address_1'].' '.
                            $guest_info['city'].' '.
                            $guest_info['zip'].' '.
                            (isset($guest_info['geo_state_name']) ? $guest_info['geo_state_name'] : '').' '.
                            $guest_info['country_name'].
                            '</dd>';
                echo '<dd>'.$guest_info['customer_email'].'</dd>';
                echo '<dd>'.$guest_info['phonenumber'].'</dd>';
            }
            ?>
    	</dt>
	</dl>

	<dl id="sr-summary-payment">
		<dt>
			<?php echo JText::_('SR_RESERVATION_PROGRESS_PAYMENT_INFO') ?>
			|
			<a class="sr-change-details" href="<?php echo $this->uri ?>#payment">
                <i class="icon-cog"></i>
			</a>
            <?php
            if (isset($this->userState->payment)) {
                echo '<dd>'.$this->userState->payment['payment_method'].'</dd>';
            }
            ?>
		</dt>

	</dl>
</div>