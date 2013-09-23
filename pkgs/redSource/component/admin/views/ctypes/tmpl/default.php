<?php
/**
 * @package     Redsource.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('rdropdown.init');
JHtml::_('rbootstrap.tooltip');
JHtml::_('rjquery.chosen', 'select');

// Required objects
$doc = JFactory::getDocument();
$user = JFactory::getUser();

$action = JRoute::_('index.php?option=com_redsource&view=types');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$saveOrder = $listOrder == 'ordering';
?>
<form action="<?php echo $action; ?>" name="adminForm" class="adminForm" id="adminForm" method="post">
	<div class="">
		<?php echo RLayoutHelper::render('search', array('view' => $this)) ?>
		<hr/>
		<table class="table table-striped table-hover" id="companyList">
			<thead>
			<tr>
				<th class="span1" class="hidden-phone"></th>
				<th class="span1 nowrap center">
					<?php echo $this->filterForm->getInput('filter_state'); ?>
				</th>
				<th class="span5"></th>
				<th class="span1 nowrap"></th>
				<th class="span1 nowrap"></th>
				<th class="span2 nowrap center"></th>
				<th class="span1 nowrap hidden-phone"></th>
			</tr>
			<tr>
				<th class="hidden-phone">
					<input type="checkbox" name="checkall-toggle" value=""
					       title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
				</th>
				<th class="nowrap center">
					<?php echo JHtml::_('rgrid.sort', 'JSTATUS', 'c.state', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap hidden-phone">
					<?php echo JHtml::_('rgrid.sort', 'COM_REDSOURCE_NAME', 'c.name', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap hidden-phone">
					<?php echo JText::_('Fields'); ?>
				</th>
				<th class="nowrap hidden-phone">
					<?php echo JText::_('Items'); ?>
				</th>
				<th class="nowrap hidden-phone">
					<?php echo JHtml::_('rgrid.sort', 'Created', 'c.created_date', $listDirn, $listOrder); ?>
				</th>
				<th class="nowrap hidden-phone">
					<?php echo JHtml::_('rgrid.sort', 'JGRID_HEADING_ID', 'c.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
			</thead>
			<?php if ($this->items): ?>
				<tbody>
				<?php foreach ($this->items as $i => $item): ?>
					<?php
					$canChange = 1;
					$canEdit = 1;
					$canCheckin = 1;
					?>
					<tr>
						<td>
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<td>
							<?php echo JHtml::_('rgrid.published', $item->state, $i, 'ctypes.', $canChange, 'cb'); ?>
						</td>
						<td>
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('rgrid.checkedout', $i, $item->checked_out,
									$item->checked_out_time, 'ctypes.', $canCheckin); ?>
							<?php endif; ?>
							<a href="<?php echo JRoute::_('index.php?option=com_redsource&task=ctype.edit&id=' . $item->id); ?>">
								<?php echo $this->escape($item->name); ?>
							</a>
						</td>
						<td>
							<?php echo 0; // TODO ?>
						</td>
						<td>
							<?php echo 0; // TODO ?>
						</td>
						<td>
							<?php echo $item->created_date; ?>
						</td>
						<td>
							<?php echo $item->id; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			<?php endif; ?>
		</table>
		<?php echo $this->pagination->getListFooter(); ?>
	</div>

	<div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
