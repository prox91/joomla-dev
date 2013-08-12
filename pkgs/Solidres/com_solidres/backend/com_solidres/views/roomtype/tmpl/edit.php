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
					if (task == 'roomtype.cancel' || jQuery('#item-form').valid()) 
					{
						<?php echo $this->form->getField('description')->save(); ?>
						Joomla.submitform(task, document.getElementById('item-form'));
					}
					else {
						alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
					}
				}
				</script>
				<form enctype="multipart/form-data"
				      action="<?php JRoute::_('index.php?option=com_solidres&view=roomtypes'); ?>"
				      method="post"
				      name="adminForm"
				      id="item-form"
				      class="form-validate form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('SR_NEW_GENERAL_INFO')?></a></li>
						<li><a href="#publishing" data-toggle="tab"><?php echo JText::_('JGLOBAL_FIELDSET_PUBLISHING')?></a></li>
						<li><a href="#tariff" data-toggle="tab"><?php echo JText::_('SR_ROOM_TYPE_TARIFF')?></a></li>
						<li><a href="#room" data-toggle="tab"><?php echo JText::_('SR_ROOM_TYPE_ROOM')?></a></li>
						<li><a href="#media" data-toggle="tab"><?php echo JText::_('SR_MEDIA')?></a></li>
						<li><a href="#customfields" data-toggle="tab"><?php echo JText::_('SR_CUSTOM_FIELDS')?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="general">
							<?php echo $this->loadTemplate('general'); ?>
						</div>

						<div class="tab-pane" id="publishing">
							<?php echo $this->loadTemplate('publishing'); ?>
						</div>
						<div class="tab-pane" id="tariff">
							<?php echo $this->loadTemplate('tariff'); ?>
						</div>
						<div class="tab-pane" id="room">
							<?php echo $this->loadTemplate('room'); ?>
						</div>
						<div class="tab-pane" id="media">
							<?php echo $this->loadTemplate('media') ?>
						</div>
						<div class="tab-pane" id="customfields">
							<?php echo $this->loadTemplate('customfields') ?>
						</div>
					</div>
					<input type="hidden" name="task" value="" />
					<input type="hidden" name="jform[currency_id]" value="<?php echo $this->currency_id ?>" />
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
	