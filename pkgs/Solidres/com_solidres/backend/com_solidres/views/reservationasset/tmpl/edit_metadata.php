<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

$fieldSets = $this->form->getFieldsets('metadata');
foreach ($fieldSets as $name => $fieldSet) :
	?>
	<fieldset>
		<?php if ($name == 'jmetadata') : // Include the real fields in this panel. ?>
			<div class="control-group">
				<?php echo $this->form->getLabel('metadesc'); ?>
				<div class="controls">
					<?php echo $this->form->getInput('metadesc'); ?>
				</div>
			</div>

			<div class="control-group">
				<?php echo $this->form->getLabel('metakey'); ?>
				<div class="controls">
					<?php echo $this->form->getInput('metakey'); ?>
				</div>
			</div>

			<div class="control-group">
				<?php echo $this->form->getLabel('xreference'); ?>
				<div class="controls">
					<?php echo $this->form->getInput('xreference'); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php foreach ($this->form->getFieldset($name) as $field) : ?>
			<div class="control-group">
				<?php echo $field->label; ?>
				<div class="controls">
					<?php echo $field->input; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</fieldset>
<?php endforeach; ?>