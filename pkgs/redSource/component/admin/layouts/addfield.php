<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Layouts
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

$data = $displayData;
$remote = JRoute::_('index.php?option=com_redsource&view=field&tmpl=component');
?>
<a href="#fieldModal" role="button" class="btn" data-toggle="modal"><?php echo JText::_('COM_REDSOURCE_TYPE_BTN_ADD_FIELD'); ?></a>

<div id="fieldModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="" data-remote="<?php echo $remote; ?>">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel"><?php echo JText::_('COM_REDSOURCE_TYPE_ADD_FIELD_TITLE'); ?></h3>
	</div>
	<div class="modal-body">
		<p><?php echo JText::_('COM_REDSOURCE_PLEASE_WAIT_LOADING'); ?></p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JCANCEL'); ?></button>
		<button type="submit" class="btn btn-primary"><?php echo JText::_('COM_REDSOURCE_TYPE_BTN_ADD_FIELD'); ?></button>
	</div>
</div>
