<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 5:59 PM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_helloworld&layout=edit&id' . (int) $this->item->id); ?>" method="post"
	name="adminForm" id="hellworld-form">
	<fieldset>
		<legend><?php echo JText::_('COM_HELLOWORLD_HELLOWORLD_DETAILS') ?></legend>
		<ul class="adminformlist">
			<?php foreach ($this->form->getFieldset() as $field): ?>
				<li><?php echo $field->label; echo $field->input;?></li>
			<?php endforeach; ?>
		</ul>
	</fieldset>
	<div>
		<input type="hidden" name="task" value="helloworld.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>