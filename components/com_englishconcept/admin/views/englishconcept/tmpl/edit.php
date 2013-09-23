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

//JHtml::_('bootstrap.tooltip');
//JHtml::_('behavior.multiselect');
//JHtml::_('dropdown.init');
//JHtml::_('formbehavior.chosen', 'select');
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
    <?php //else : ?>
    <!--	<div id="ec-main-container">-->
    <?php //endif;?>
        <div class="ec-main-container">
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    jQuery('#itemForm').validate();
                });
                Joomla.submitbutton = function(task)
                {
                    if (task == 'englishconcept.cancel' || jQuery('#itemForm').valid())
                    {
                        <?php //echo $this->form->getField('book')->save(); ?>
                        Joomla.submitform(task, document.getElementById('itemForm'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
                    }
                }
            </script>
            <form enctype="multipart/form-data"
                action="<?php JRoute::_('index.php?option=com_englishconcept&view=englishconcept'); ?>" method="post" name="itemForm" id="itemForm"
                class="form-validate form-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#media" data-toggle="tab"><?php echo JText::_('Media')?></a></li>
                    <li class=""><a href="#comprehension" data-toggle="tab"><?php echo JText::_('Comprehensions')?></a></li>
                    <li class=""><a href="#key-structure" data-toggle="tab"><?php echo JText::_('Key Structure')?></a></li>
                    <li class=""><a href="#spec-difficult" data-toggle="tab"><?php echo JText::_('Special Difficulties')?></a></li>
                    <li class=""><a href="#exercise" data-toggle="tab"><?php echo JText::_('Exercise')?></a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="media">
                        <?php echo $this->loadTemplate('media'); ?>
                    </div>
                    <div class="tab-pane" id="comprehension">
                        <?php echo $this->loadTemplate('comprehension'); ?>
                    </div>
                    <div class="tab-pane" id="key-structure">
                        <?php echo $this->loadTemplate('keystructure'); ?>
                    </div>
                    <div class="tab-pane" id="spec-difficult">
                        <?php echo $this->loadTemplate('specialdifficult'); ?>
                    </div>
                    <div class="tab-pane" id="exercise">
                        <?php echo $this->loadTemplate('exercise'); ?>
                    </div>
                </div>

                <input type="hidden" name="task" value="" />
                <input type="hidden" name="jform[id]" value="<?php if(isset($this->item->id)){echo $this->item->id;}?>" />
                <?php echo JHtml::_('form.token'); ?>
            </form>
        </div>
    </div>
</div>