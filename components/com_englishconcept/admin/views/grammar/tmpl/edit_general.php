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
		<?php echo $this->form->getLabel('lesson_id'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('lesson_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('description'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
        <div>
            <?php $link = 'index.php?option=com_englishconcept&amp;task=grammarexercise.edit&amp;id=1&amp;tmpl=component&amp;view=grammarexercise&amp;layout=modal'; ?>
            <a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="XXX">Link to modal</a>
        </div>
	</div>
</fieldset>
