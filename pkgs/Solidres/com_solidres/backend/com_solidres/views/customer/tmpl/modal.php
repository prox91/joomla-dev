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

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (document.formvalidator.isValid(document.id('customer-modal-form'))) {
			Joomla.submitform(task, document.getElementById('customer-modal-form'));
		}
	}
</script>
<form enctype="multipart/form-data"
      action="<?php echo JRoute::_('index.php?option=com_solidres&format=json&task=customer.save&'.JSession::getFormToken().'=1') ?>"
      method="post"
      name="adminForm"
      id="customer-modal-form"
      class="form-validate form-horizontal">
    <fieldset>
		<div class="fltrt">
			<button id="customer-saving" type="submit" class="btn">
				<?php echo JText::_('JAPPLY');?>
			</button>

			<button type="button" id="insert-customer" class="btn">
				<?php echo JText::_('SR_INSERT_CUSTOMER');?>
			</button>

			<button class="btn close-colorbox" type="button">
				<?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
	</fieldset>
    <div id="sr-tabs">
        <ul>
            <li><a href="#general"><?php echo JText::_('SR_NEW_GENERAL_INFO')?></a></li>
        </ul>

        <div id="general">
            <?php echo $this->loadTemplate('general'); ?>
        </div>

    </div>
</form>

<script>
    Solidres.jQuery(function($) {
        $( "#sr-tabs" ).tabs({
            beforeLoad: function( event, ui ) {
                ui.jqXHR.error(function() {
                    ui.panel.html(
                            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                                    "If this wouldn't be a demo." );
                });
            }
        });
    });
</script>

