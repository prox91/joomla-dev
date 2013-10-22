<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 11:20 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php //echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<div class="ec-contain">
    <div id="ec-panel-right" class="span10">
        <div class="ec-main-container">
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    jQuery('#itemForm').validate();
                });
                Joomla.submitbutton = function(task)
                {
                    if (task == 'grammarexercise.cancel' || jQuery('#itemForm').valid())
                    {
	                    <?php //echo $this->form->getField('book')->save(); ?>
                        Joomla.submitform(task, document.getElementById('itemForm'));
                    }
                    else
                    {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
                    }
                }
            </script>
            <form enctype="multipart/form-data"
                action="<?php JRoute::_('index.php?option=com_englishconcept&view=grammarexercise'); ?>" method="post" name="itemForm" id="itemForm"
                class="form-validate form-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('General')?></a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="general">
	                    <?php echo $this->loadTemplate('general'); ?>
                    </div>
                </div>

                <input type="hidden" name="task" value="" />
                <input type="hidden" name="jform[id]" value="<?php if(isset($this->item->id)){echo $this->item->id;}?>" />
                <?php echo JHtml::_('form.token'); ?>
            </form>
        </div>
    </div>
</div>
