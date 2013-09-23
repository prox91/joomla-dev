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

$action = JRoute::_('index.php?option=com_redsource&view=categories');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$saveOrder = $listOrder == 'c.lft';

$saveOrderingUrl = 'index.php?option=com_redsource&task=categories.saveOrderAjax&tmpl=component';
JHtml::_('rsortablelist.sortable', 'categoryList', 'adminForm', strtolower($listDirn), $saveOrderingUrl, false, true);
?>
<form action="<?php echo $action; ?>" name="adminForm" class="adminForm" id="adminForm" method="post">
	<div class="row-fluid">
		<?php echo RLayoutHelper::render('search', array('view' => $this)) ?>
		<?php echo $this->filterForm->getInput('filter_state'); ?>
		<?php echo $this->filterForm->getInput('filter_access'); ?>
		<?php echo $this->filterForm->getInput('filter_language'); ?>
		<hr/>
		<table class="table table-striped table-hover" id="categoryList">
			<thead>
			<tr>
				<th class="span1 nowrap center hidden-phone">
					<?php echo JHtml::_('rgrid.sorto', null, 'c.lft', $listDirn, $listOrder); ?>
				</th>
				<th class="span1 hidden-phone">
					<input type="checkbox" name="checkall-toggle" value=""
					       title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
				</th>
				<th class="span1 nowrap center">
					<?php echo JHtml::_('rgrid.sort', 'JSTATUS', 'c.state', $listDirn, $listOrder); ?>
				</th>
				<th class="span6 nowrap">
					<?php echo JHtml::_('rgrid.sort', 'COM_REDSOURCE_NAME', 'c.name', $listDirn, $listOrder); ?>
				</th>
				<th class="span1 nowrap hidden-phone">
					<?php echo JHtml::_('rgrid.sort', 'JGRID_HEADING_ACCESS', 'c.access', $listDirn, $listOrder); ?>
				</th>
				<th class="span1 nowrap hidden-phone">
					<?php echo JHtml::_('rgrid.sort', 'JGRID_HEADING_LANGUAGE', 'c.language', $listDirn, $listOrder); ?>
				</th>
				<th class="span1 nowrap hidden-phone">
					<?php echo JHtml::_('rgrid.sort', 'JGRID_HEADING_ID', 'c.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
			</thead>
			<?php if ($this->items): ?>
				<tbody>
				<?php $originalOrders = array(); ?>
				<?php foreach ($this->items as $i => $item): ?>
					<?php
					$orderkey   = array_search($item->id, $this->ordering[$item->parent_id]);
					$canChange = 1;
					$canEdit = 1;
					$canCheckin = 1;

					// Get the parents of item for sorting
					if ($item->level > 1)
					{
						$parentsStr = "";
						$_currentParentId = $item->parent_id;
						$parentsStr = " " . $_currentParentId;
						for ($i2 = 0; $i2 < $item->level; $i2++)
						{
							foreach ($this->ordering as $k => $v)
							{
								$v = implode("-", $v);
								$v = "-" . $v . "-";
								if (strpos($v, "-" . $_currentParentId . "-") !== false)
								{
									$parentsStr .= " " . $k;
									$_currentParentId = $k;
									break;
								}
							}
						}
					}
					else
					{
						$parentsStr = "";
					}
					?>
					<tr class="row<?php echo $i % 2; ?>"
						sortable-group-id="<?php echo $item->parent_id; ?>"
						item-id="<?php echo $item->id ?>"
						parents="<?php echo $parentsStr ?>"
						level="<?php echo $item->level ?>">
						<td class="order nowrap center hidden-phone">
							<?php if ($canChange) :
								$disableClassName = '';
								$disabledLabel = '';

								if (!$saveOrder)
								{
									$disabledLabel = JText::_('JORDERINGDISABLED');
									$disableClassName = 'inactive tip-top';
								}
								?>
								<span class="sortable-handler hasTooltip <?php echo $disableClassName ?>"
									title="<?php echo $disabledLabel ?>">
									<i class="icon-ellipsis-vertical"></i>
								</span>
								<input type="text" style="display:none" name="order[]" size="5"
								       value="<?php echo $item->lft; ?>" class="width-20 text-area-order "/>
							<?php else : ?>
								<span class="sortable-handler inactive">
									<i class="icon-ellipsis-vertical"></i>
								</span>
							<?php endif; ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<td>
							<?php echo JHtml::_('rgrid.published', $item->state, $i, 'categories.', $canChange, 'cb'); ?>
						</td>
						<td>
							<?php echo str_repeat('<span class="gi">&mdash;</span>', $item->level - 1) ?>
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('rgrid.checkedout', $i, $item->checked_out,
									$item->checked_out_time, 'categorys.', $canCheckin); ?>
							<?php endif; ?>
							<a href="<?php echo JRoute::_('index.php?option=com_redsource&task=category.edit&id=' . $item->id); ?>">
							<?php echo $this->escape($item->name); ?>
							</a>
						</td>
						<td>
							<?php echo $this->escape($item->access_level); ?>
						</td>
						<td>
							<?php if ($item->language == '*') : ?>
								<?php echo JText::alt('JALL', 'language'); ?>
							<?php else: ?>
								<?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
							<?php endif; ?>
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
