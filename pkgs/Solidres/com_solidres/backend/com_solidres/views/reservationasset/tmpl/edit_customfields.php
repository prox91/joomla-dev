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

$fieldSets = $this->form->getFieldsets('reservationasset_extra_fields');

foreach ($fieldSets as $fieldSet) :
	?>
<fieldset>
    <legend><?php echo JText::_($fieldSet->label) ?></legend>
	<?php foreach ($this->form->getFieldset($fieldSet->name) as $field) : ?>
    <div class="control-group">
		<?php echo $field->label; ?>
        <div class="controls">
			<?php echo $field->input; ?>
        </div>
    </div>
	<?php endforeach; ?>
</fieldset>
<?php
endforeach;

