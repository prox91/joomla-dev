<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 11:20 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
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
    <?php echo $this->sidebar; ?>
    <div id="ec-panel-right" class="span10">
        <div class="ec-main-container">
            <script type="text/javascript">
                Joomla.submitbutton = function(task)
                {
                    if (task == 'country.cancel' || document.formvalidator.isValid(document.id('itemForm')))
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
                action="<?php JRoute::_('index.php?option=com_openhrm&view=country'); ?>" method="post" name="itemForm" id="itemForm"
                class="form-validate form-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('General')?></a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="general">
                        <fieldset class="adminform">
                            <div class="control-group">
	                            <div class="control-label">
                                    <?php echo $this->form->getLabel('name'); ?>
		                        </div>
                                <div class="controls">
                                    <?php echo $this->form->getInput('name'); ?>
                                </div>
                            </div>
                            <div class="control-group">
	                            <div class="control-label">
                                    <?php echo $this->form->getLabel('iso_code_2'); ?>
		                        </div>
                                <div class="controls">
                                    <?php echo $this->form->getInput('iso_code_2'); ?>
                                </div>
                            </div>
                            <div class="control-group">
	                            <div class="control-label">
                                    <?php echo $this->form->getLabel('iso_code_3'); ?>
		                        </div>
                                <div class="controls">
                                    <?php echo $this->form->getInput('iso_code_3'); ?>
                                </div>
                            </div>
                            <div class="control-group">
	                            <div class="control-label">
                                    <?php echo $this->form->getLabel('address_format'); ?>
		                        </div>
                                <div class="controls">
                                    <?php echo $this->form->getInput('address_format'); ?>
                                </div>
                            </div>
	                        <div class="control-group">
		                        <div class="control-label">
			                        <?php echo $this->form->getLabel('postcode_required'); ?>
		                        </div>
		                        <div class="controls">
			                        <?php echo $this->form->getInput('postcode_required'); ?>
		                        </div>
	                        </div>
                            <div class="control-group">
	                            <div class="control-label">
                                    <?php echo $this->form->getLabel('published'); ?>
		                        </div>
                                <div class="controls">
                                    <?php echo $this->form->getInput('published'); ?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <input type="hidden" name="task" value="" />
                <input type="hidden" name="jform[id]" value="<?php if(isset($this->item->id)){echo $this->item->id;}?>" />
                <?php echo JHtml::_('form.token'); ?>
            </form>
        </div>
    </div>
</div>
