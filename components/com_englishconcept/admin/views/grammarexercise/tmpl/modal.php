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
$grammarId = $this->state->get('grammarId');
if(isset($this->item->id) && !empty($this->item->id))
{
    $link = JRoute::_('index.php?option=com_englishconcept&task=grammarexercise.apply&view=grammarexercise&tmpl=component&layout=modal&grammar_id=' . $grammarId . '&id=' . $this->item->id);
}
else
{
    $link = JRoute::_('index.php?option=com_englishconcept&task=grammarexercise.apply&view=grammarexercise&tmpl=component&layout=modal&grammar_id=' . $grammarId);
}
?>
<form enctype="multipart/form-data"
	action="<?php echo $link; ?>" method="post" name="itemForm" id="itemForm"
	class="form-validate form-horizontal">
	<fieldset class="filter clearfix">
		<div class="btn-toolbar">
			<div class="btn-group pull-left">
				<button type="button" class="btn btn-primary" onclick="this.form.submit();">
					<?php echo JText::_('JAPPLY');?></button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn" onclick="window.parent.SqueezeBox.close();">
					<?php echo JText::_('JTOOLBAR_CLOSE');?></button>
			</div>
			<div class="clearfix"></div>
		</div>
	</fieldset>
	<fieldset>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('General')?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="general">
				<fieldset class="adminform" id="general-tab">
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('grammar_id'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('grammar_id', null, $grammarId); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('title'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('title'); ?>
						</div>
					</div>
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('exercise_text'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('exercise_text'); ?>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
	</fieldset>
    <input type="hidden" name="jform[id]" value="<?php if(isset($this->item->id)){echo $this->item->id;}?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>
