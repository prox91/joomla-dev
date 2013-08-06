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

<h3><?php echo JText::_('SR_CUSTOMFIELD_FACILITIES') ?></h3>

<?php if (isset($this->item->reservationasset_extra_fields['general'])) : ?>
<div class="row-fluid custom-field-row">
	<div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_GENERAL') ?></div>
	<div class="span10"><?php echo $this->item->reservationasset_extra_fields['general']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['activities'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_ACTIVITIES') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['activities']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['services'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_SERVICES') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['services']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['internet'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_INTERNET') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['internet']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['parking'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_PARKING') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['parking']?></div>
</div>
<?php endif; ?>

<h3><?php echo JText::_('SR_CUSTOMFIELD_POLICIES') ?></h3>

<?php if (isset($this->item->reservationasset_extra_fields['checkin_time'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_CHECKIN') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['checkin_time']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['checkout_time'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_CHECKOUT') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['checkout_time']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['cancellation_prepayment'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_CANCELLATION_PREPAYMENT') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['cancellation_prepayment']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['children_and_extra_beds'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_CHILDREN_EXTRA_BEDS') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['children_and_extra_beds']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['pets'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_PETS') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['pets']?></div>
</div>
<?php endif; ?>

<?php if (isset($this->item->reservationasset_extra_fields['accepted_credit_cards'])) : ?>
<div class="row-fluid custom-field-row">
    <div class="span2 info-heading"><?php echo JText::_('SR_CUSTOMFIELD_ACCEPTED_CREDIT_CARDS') ?></div>
    <div class="span10"><?php echo $this->item->reservationasset_extra_fields['accepted_credit_cards']?></div>
</div>
<?php endif; ?>