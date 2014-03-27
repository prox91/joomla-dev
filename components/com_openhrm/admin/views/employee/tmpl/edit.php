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
JHtml::_('bootstrap.modal', 'collapseModal');

$link = JRoute::_('index.php?option=com_openhrm&tmpl=component&view=mediamanagers&layout=modal&' . JSession::getFormToken() . '=1');
?>
<div class="main-container">
	<form enctype="multipart/form-data"
		action="<?php JRoute::_('index.php?option=com_openhrm&view=employee'); ?>" method="post" name="itemForm" id="itemForm"
		class="form-validate form-horizontal">
        <div class="span2">
            <div class="personal">
	            <div class="name">
		            <div>Bui Ngoc Nha</div>
		        </div>
                <div class="picture">
	                <a href="<?php echo $link; ?>" data-target="#collapseModal" data-toggle="modal" id="changePictureId"><img src="<?php echo JUri::root().'media/openhrm/images/default-photo.png'; ?>" id="personalPhotoId"></a>
                </div>
	            <div class="modal hide fade" id="collapseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		            <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			            <h3 id="myModalLabel">Modal header</h3>
		            </div>
		            <div class="modal-body">
		            </div>
	            </div>
            </div>
        </div>
        <div class="span10">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#personal" data-toggle="tab"><?php echo JText::_('Basic Information')?></a></li>
                <li class=""><a href="#contact" data-toggle="tab"><?php echo JText::_('Contact Detail')?></a></li>
	            <li class=""><a href="#education" data-toggle="tab"><?php echo JText::_('Education')?></a></li>
	            <li class=""><a href="#experience" data-toggle="tab"><?php echo JText::_('Experience')?></a></li>
	            <li class=""><a href="#language" data-toggle="tab"><?php echo JText::_('Language')?></a></li>
	            <li class=""><a href="#skill" data-toggle="tab"><?php echo JText::_('Skill')?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="personal">
                    <?php echo $this->loadTemplate('personal'); ?>
                </div>
                <div class="tab-pane" id="contact">
                    <?php //echo $this->loadTemplate('contact'); ?>
                </div>
	            <div class="tab-pane" id="education">
		            <?php //echo $this->loadTemplate('education'); ?>
	            </div>
	            <div class="tab-pane" id="language">
		            <?php //echo $this->loadTemplate('language'); ?>
	            </div>
	            <div class="tab-pane" id="skill">
		            <?php //echo $this->loadTemplate('skill'); ?>
	            </div>
            </div>
        </div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="layout" value="contact" />
		<input type="hidden" name="jform[id]" value="<?php if (isset($this->item->id))	{	echo $this->item->id;	} ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
<script type="text/javascript">
	Joomla.orderTable = function () {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php //echo $listOrder; ?>') {
			dirn = 'asc';
		}
		else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}

	Joomla.submitbutton = function (task) {
		if (task == 'employee.cancel' || document.formvalidator.isValid(document.id('itemForm'))) {
			<?php //echo $this->form->getField('book')->save(); ?>
			Joomla.submitform(task, document.getElementById('itemForm'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	};

	jQuery('a#changePictureId').on('click', function(e) {
		e.preventDefault();
		var url = jQuery(this).attr('href');
		jQuery("div.modal-body").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');
	});

	var tabName = "";
	jQuery('.nav-tabs a').live('click', function(){
		var href = jQuery(this).attr('href');
		if(tabName != href){
			tabName = href;
			jQuery('#itemForm').submit();
		} else {
		}
	});
</script>
