<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHTML::_('script', 'system/multiselect.js', false, true);

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_redtwitter/assets/css/redtwitter.css');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canOrder = $user->authorise('core.edit.state', 'com_redtwitter');
$saveOrder = $listOrder == 'a.ordering';
?>

<form action="<?php echo JRoute::_('index.php?option=com_redtwitter&view=oauth_infos'); ?>" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
		<tr>
			<th width="1%">
				<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
			</th>

			<th class='left'>
				<?php echo JHtml::_('grid.sort', 'COM_REDTWITTER_OAUTH_INFO_CONSUMER_KEY', 'a.consumer_key', $listDirn, $listOrder); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_('grid.sort', 'COM_REDTWITTER_OAUTH_INFO_CONSUMER_SECRET', 'a.consumer_secret', $listDirn, $listOrder); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_('grid.sort', 'COM_REDTWITTER_OAUTH_INFO_ACCESS_TOKEN', 'a.access_token', $listDirn, $listOrder); ?>
			</th>
			<th class='left'>
				<?php echo JHtml::_('grid.sort', 'COM_REDTWITTER_OAUTH_INFO_ACCESS_TOKEN_SECRET', 'a.access_token_secret', $listDirn, $listOrder); ?>
			</th>

			<?php
			if (isset($this->items[0]->state))
			{
				?>
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
				</th>
			<?php
			}
			?>
			<?php
			if (isset($this->items[0]->ordering))
			{
				?>
				<th width="10%">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
					<?php if ($canOrder && $saveOrder) : ?>
						<?php echo JHtml::_('grid.order', $this->items, 'filesave.png', 'oauth_infos.saveorder'); ?>
					<?php endif; ?>
				</th>
			<?php
			}
			?>
			<?php
			if (isset($this->items[0]->id))
			{
				?>
				<th width="1%" class="nowrap">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			<?php
			}
			?>
		</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="10">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$ordering   = ($listOrder == 'a.ordering');
			$canEdit    = $user->authorise('core.edit', 'com_redtwitter');
			$canCheckin = $user->authorise('core.manage', 'com_redtwitter');
			$canChange  = $user->authorise('core.edit.state', 'com_redtwitter');
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>

				<td>
					<?php if (isset($item->checked_out) && $item->checked_out) : ?>
						<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'oauth_infos.', $canCheckin); ?>
					<?php endif; ?>
					<?php if ($canEdit) : ?>
						<a href="<?php echo JRoute::_('index.php?option=com_redtwitter&task=oauth_info.edit&id=' . (int) $item->id); ?>">
							<?php echo $this->escape($item->consumer_key); ?></a>
					<?php else : ?>
						<?php echo $this->escape($item->consumer_key); ?>
					<?php endif; ?>
				</td>
				<td>
					<?php echo $item->consumer_secret; ?>
				</td>
				<td>
					<?php echo $item->access_token; ?>
				</td>
				<td>
					<?php echo $item->access_token_secret; ?>
				</td>
				<?php
				if (isset($this->items[0]->state))
				{
					?>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $item->state, $i, 'oauth_infos.', $canChange, 'cb'); ?>
					</td>
				<?php
				}
				?>
				<?php
				if (isset($this->items[0]->ordering))
				{
					?>
					<td class="order">
						<?php if ($canChange) : ?>
							<?php if ($saveOrder) : ?>
								<?php if ($listDirn == 'asc') : ?>
									<span><?php echo $this->pagination->orderUpIcon($i, true, 'oauth_infos.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
									<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'oauth_infos.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
								<?php elseif ($listDirn == 'desc') : ?>
									<span><?php echo $this->pagination->orderUpIcon($i, true, 'oauth_infos.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
									<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'oauth_infos.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
								<?php endif; ?>
							<?php endif; ?>
							<?php $disabled = $saveOrder ? '' : 'disabled="disabled"'; ?>
							<input type="text" name="order[]" size="5" value="<?php echo $item->ordering; ?>" <?php echo $disabled ?> class="text-area-order" />
						<?php else : ?>
							<?php echo $item->ordering; ?>
						<?php endif; ?>
					</td>
				<?php
				}
				?>
				<?php
				if (isset($this->items[0]->id))
				{
					?>
					<td class="center">
						<?php echo (int) $item->id; ?>
					</td>
				<?php
				}
				?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>