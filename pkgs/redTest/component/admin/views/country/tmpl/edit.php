<?php
/**
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

$action = JRoute::_('index.php?option=com_jab&view=country');

// HTML helpers
//JHtml::_('behavior.multiselect');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('rdropdown.init');
JHtml::_('rbootstrap.tooltip');
JHtml::_('rjquery.chosen', 'select');
?>
<form action="<?php echo $action; ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">
	<div class="jab-country">
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
				<?php echo $this->form->getLabel('language'); ?>
		    </div>
		    <div class="controls">
				<?php echo $this->form->getInput('language'); ?>
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
		<!-- hidden fields -->
	  	<input type="hidden" name="option"	value="com_jab">
	  	<input type="hidden" name="id"	value="<?php echo $this->item->id; ?>">
	  	<input type="hidden" name="task" value="">
		<?php echo JHTML::_('form.token'); ?>
	</div>
</form>
