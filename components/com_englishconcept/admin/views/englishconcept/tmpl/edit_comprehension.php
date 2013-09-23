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

<fieldset class="adminform" id="comprehension-tab">
	<div class="control-group">
		<?php echo $this->form->getLabel('compreQuesion'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('compreQuesion'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('compreQuesionTrans'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('compreQuesionTrans'); ?>
		</div>
	</div>
</fieldset>