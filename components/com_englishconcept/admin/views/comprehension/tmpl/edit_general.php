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
		<?php echo $this->form->getLabel('description'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
	</div>
</fieldset>
