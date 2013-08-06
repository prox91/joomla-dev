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

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (document.formvalidator.isValid(document.id('category-modal-form'))) {
			Joomla.submitform(task, document.getElementById('category-modal-form'));
		}
	}
</script>
<form enctype="multipart/form-data"
      action="<?php echo JRoute::_('index.php?option=com_solidres&format=json&task=category.save&'.JSession::getFormToken().'=1') ?>"
      method="post"
      name="adminForm"
      id="category-modal-form"
      class="form-validate form-horizontal">

    <div id="sr-tabs">
        <ul>
            <li><a href="#general"><?php echo JText::_('SR_NEW_GENERAL_INFO')?></a></li>
        </ul>

        <div id="general">
            <?php echo $this->loadTemplate('general'); ?>
        </div>

    </div>
</form>
