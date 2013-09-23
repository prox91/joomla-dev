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

$active = null;

if (isset($data['active']))
{
	$active = $data['active'];
}
?>
<ul class="nav nav-tabs nav-stacked">
	<li>
		<?php if ($active === 'categories') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_redsource&view=categories') ?>">
				<i class="icon-tags"></i>
				<?php echo JText::_('COM_REDSOURCE_CATEGORY_LIST_TITLE') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=categories') ?>">
				<i class="icon-tags"></i>
				<?php echo JText::_('COM_REDSOURCE_CATEGORY_LIST_TITLE') ?>
			</a>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($active === 'channels') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_redsource&view=channels') ?>">
				<i class="icon-briefcase"></i>
				<?php echo JText::_('COM_REDSOURCE_CHANNEL_LIST_TITLE') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=channels') ?>">
				<i class="icon-briefcase"></i>
				<?php echo JText::_('COM_REDSOURCE_CHANNEL_LIST_TITLE') ?>
			</a>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($active === 'contents') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_redsource&view=contents') ?>">
				<i class="icon-book"></i>
				<?php echo JText::_('COM_REDSOURCE_CONTENT_LIST_TITLE') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=contents') ?>">
				<i class="icon-book"></i>
				<?php echo JText::_('COM_REDSOURCE_CONTENT_LIST_TITLE') ?>
			</a>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($active === 'ctypes') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_redsource&view=ctypes') ?>">
				<i class="icon-puzzle-piece"></i>
				<?php echo JText::_('COM_REDSOURCE_TYPE_LIST_TITLE') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_redsource&view=ctypes') ?>">
				<i class="icon-puzzle-piece"></i>
				<?php echo JText::_('COM_REDSOURCE_TYPE_LIST_TITLE') ?>
			</a>
		<?php endif; ?>
	</li>
</ul>
