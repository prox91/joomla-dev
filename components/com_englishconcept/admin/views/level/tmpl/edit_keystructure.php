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

<fieldset class="adminform" id="keystructure-tab">
	<div class="control-group">
		<?php echo $this->form->getLabel('keyStructScript'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('keyStructScript'); ?>
		</div>
	</div>
	<div class="control-group">
		<?php echo $this->form->getLabel('keyStructScriptTrans'); ?>
		<div class="controls">
			<?php echo $this->form->getInput('keyStructScriptTrans'); ?>
		</div>
	</div>
</fieldset>