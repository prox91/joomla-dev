<?php
/**
 * @package     Jab.Site
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

?>
<?php if ($this->item) : ?>
	<h1><?php echo $this->item->name; ?></h1>
	<?php if (!empty($this->item->tags)) : ?>
		<p>
			<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags);?>
		</p>
	<?php endif; ?>
<?php else: ?>
	<p><?php echo JText::_('COM_JAB_SPEAKER_NOT_FOUND'); ?></p>
<?php endif;
