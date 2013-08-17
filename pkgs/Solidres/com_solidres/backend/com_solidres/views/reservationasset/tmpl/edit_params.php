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

$fieldSets = $this->form->getFieldsets('params');
foreach ($fieldSets as $name => $fieldSet) :
?>
	<?php foreach ($this->form->getFieldset($name) as $field) : ?>
		<div class="control-group">
			<?php echo $field->label; ?>
			<div class="controls">
				<?php echo $field->input; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php endforeach; ?>


