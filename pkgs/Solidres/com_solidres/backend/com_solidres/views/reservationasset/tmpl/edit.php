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

<div id="solidres">
    <div class="row-fluid">
		<?php echo SolidresHelperSideNavigation::getSideNavigation($this->getName()); ?>
		<div id="sr_panel_right" class="sr_form_view span10">
			<div class="sr-inner">
				<script type="text/javascript">
                jQuery(document).ready(function($) {
					$('#item-form').validate();
				});

				Joomla.submitbutton = function(task)
				{
					if (task == 'reservationasset.cancel' || jQuery('#item-form').valid()) 
					{
						<?php echo $this->form->getField('description')->save(); ?>
						Joomla.submitform(task, document.getElementById('item-form'));
					} else {
						alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
					}
				}
				</script>
				<form enctype="multipart/form-data" action="<?php JRoute::_('index.php?option=com_solidres&view=reservationassets'); ?>" method="post" name="adminForm" id="item-form" class="form-validate form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('SR_NEW_GENERAL_INFO')?></a></li>
						<li><a href="#publishing" data-toggle="tab"><?php echo JText::_('JGLOBAL_FIELDSET_PUBLISHING')?></a></li>
						<li><a href="#roomtype" data-toggle="tab"><?php echo JText::_('SR_ASSET_ROOM_TYPE')?></a></li>
						<li><a href="#media" data-toggle="tab"><?php echo JText::_('SR_MEDIA')?></a></li>
						<li><a href="#extra" data-toggle="tab"><?php echo JText::_('SR_ASSET_EXTRA')?></a></li>
						<!--<li><a href="#accessrules" data-toggle="tab"><?php /*echo JText::_('SR_ACCESS_RULES_LABEL')*/?></a></li>-->
						<li><a href="#customfields" data-toggle="tab"><?php echo JText::_('SR_CUSTOM_FIELDS')?></a></li>
						<li><a href="#metadata" data-toggle="tab"><?php echo JText::_('SR_METADATA')?></a></li>
						<?php if (isset($this->paymentTabContent)) : ?>
                        <li><a href="#payment" data-toggle="tab"><?php echo JText::_('SR_PAYMENTMETHODS')?></a></li>
						<?php endif ?>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="general">
							<?php echo $this->loadTemplate('general'); ?>
						</div>
						<div class="tab-pane" id="publishing">
							<?php echo $this->loadTemplate('publishing'); ?>
							<?php echo $this->loadTemplate('params'); ?>
						</div>
						<div class="tab-pane" id="roomtype">
							<?php echo $this->loadTemplate('roomtype'); ?>
						</div>
						<div class="tab-pane" id="media">
							<?php echo $this->loadTemplate('media'); ?>
						</div>
						<div class="tab-pane" id="extra">
							<?php echo $this->loadTemplate('extra')?>
						</div>
						<!--<div class="tab-pane" id="accessrules">
							<?php /*echo $this->loadTemplate('accessrules'); */?>
						</div>-->
						<div class="tab-pane" id="customfields">
							<?php echo $this->loadTemplate('customfields') ?>
						</div>
						<div class="tab-pane" id="metadata">
							<?php echo $this->loadTemplate('metadata') ?>
						</div>
						<?php if (isset($this->paymentTabContent)) : ?>
                        <div class="tab-pane" id="payment">
							<?php echo $this->paymentTabContent ?>
                        </div>
						<?php endif ?>
					</div>
					<input type="hidden" name="task" value="" />
					<?php echo JHtml::_('form.token'); ?>
				</form>
			</div>
		</div>
    </div>
    <div class="row-fluid">
		<div class="span12 powered">
			<p>Powered by <a href="http://solidres.com" target="_blank">Solidres</a></p>
		</div>
	</div>
</div>