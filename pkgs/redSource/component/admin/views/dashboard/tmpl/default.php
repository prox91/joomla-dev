<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;
?>

<div class="span6 offset3">
	<div class="row pagination-centered">
		<img src="<?php echo JUri::root(true); ?>/media/com_redsource/images/redsource_backend_80.png" alt="<?php echo JText::_('COM_REDSOURCE'); ?>" />
		<hr />
	</div>
	<div class="row">
		<table class="table">
			<tr style="border:0;">
				<td style="border:0;">
					<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=categories'); ?>">
						<div class="row-fluid pagination-centered">
							<img src="<?php echo JUri::root(true); ?>/media/com_redsource/images/categories48.png" alt="<?php echo JText::_('COM_REDSOURCE_CATEGORY_LIST_TITLE'); ?>" />
						</div>
						<div class="row-fluid pagination-centered">
							<h4><?php echo JText::_('COM_REDSOURCE_CATEGORY_LIST_TITLE'); ?></h4>
						</div>
					</a>
				</td>
				<td style="border:0;">
					<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=channels'); ?>">
						<div class="row-fluid pagination-centered">
							<img src="<?php echo JUri::root(true); ?>/media/com_redsource/images/channels48.png" alt="<?php echo JText::_('COM_REDSOURCE_CHANNEL_LIST_TITLE'); ?>" />
						</div>
						<div class="row-fluid pagination-centered">
							<h4><?php echo JText::_('COM_REDSOURCE_CHANNEL_LIST_TITLE'); ?></h4>
						</div>
					</a>
				</td>
				<td style="border:0;">
					<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=contents'); ?>">
						<div class="row-fluid pagination-centered">
							<img src="<?php echo JUri::root(true); ?>/media/com_redsource/images/content48.png" alt="<?php echo JText::_('COM_REDSOURCE_CONTENT_LIST_TITLE'); ?>" />
						</div>
						<div class="row-fluid pagination-centered">
							<h4><?php echo JText::_('COM_REDSOURCE_CONTENT_LIST_TITLE'); ?></h4>
						</div>
					</a>
				</td>
				<td style="border:0;">
					<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=ctypes'); ?>">
						<div class="row-fluid pagination-centered">
							<img src="<?php echo JUri::root(true); ?>/media/com_redsource/images/contenttypes48.png" alt="<?php echo JText::_('COM_REDSOURCE_TYPE_LIST_TITLE'); ?>" />
						</div>
						<div class="row-fluid pagination-centered">
							<h4><?php echo JText::_('COM_REDSOURCE_TYPE_LIST_TITLE'); ?></h4>
						</div>
					</a>
				</td>
			</tr>
		</table>
	</div>
</div>
