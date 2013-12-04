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
// Tags field ajax
$chosenAjaxSettings = new JRegistry(
	array(
		'selector'    => '.selectpicker',
		'type'        => 'GET',
		'url'         => JUri::root() . 'index.php?option=com_englishconcept&task=usage.searchAjax',
		'dataType'    => 'json',
		'jsonTermKey' => 'like'
	)
);
JHtml::_('formbehavior.ajaxchosen', $chosenAjaxSettings);
?>
<fieldset class="adminform" id="general-tab">
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('lesson_id'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('lesson_id'); ?>
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
			<?php echo $this->form->getLabel('diffspecial_ref'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('diffspecial_ref'); ?>
		</div>
	</div>

	<!--Test control using bootstrap-->
	<div class="control-group">
		<div class="control-label">
			Test Control
		</div>
		<div class="controls">
			<select class="selectpicker" data-live-search="true" multiple>
				<option>Mustard</option>
				<option>Ketchup</option>
				<option>Relish</option>
			</select>
		</div>
	</div>
	<!--Test control using bootstrap -->

	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('description'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
	</div>
</fieldset>
