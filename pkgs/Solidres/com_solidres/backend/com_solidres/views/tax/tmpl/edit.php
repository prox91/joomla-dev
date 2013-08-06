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
					if (task == 'tax.cancel' || jQuery('#item-form').valid())
					{
						<?php //echo $this->form->getField('description')->save(); ?>
						Joomla.submitform(task, document.getElementById('item-form'));
					}
					else
					{
						alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
					}
				}
				</script>	
				<form enctype="multipart/form-data" action="<?php JRoute::_('index.php?option=com_solidres&view=taxes'); ?>" method="post" name="adminForm" id="item-form" class="form-validate form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('SR_NEW_GENERAL_INFO')?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="general">
							<?php echo $this->loadTemplate('general'); ?>
						</div>
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
	