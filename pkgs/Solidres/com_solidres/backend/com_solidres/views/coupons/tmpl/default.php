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

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
?>

<div id="solidres">
    <div class="row-fluid">
		<?php echo SolidresHelperSideNavigation::getSideNavigation($this->getName()); ?>
		<div id="sr_panel_right" class="sr_list_view span10">
			<form action="<?php echo JRoute::_('index.php?option=com_solidres&view=coupons'); ?>" method="post" name="adminForm" id="adminForm">
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="20">
								<input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
							</th>
                            <th width="1%" class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_ID', 'u.id', $listDirn, $listOrder); ?>
                            </th>
							<th class="title">
								<?php echo JHtml::_('grid.sort',  'SR_COUPON_NAME', 'u.coupon_name', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_COUPON_PUBLISHED', 'u.state', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_COUPON_CODE', 'u.coupon_code', $listDirn, $listOrder); ?>
							</th>							
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_COUPON_AMOUNT', 'u.amount', $listDirn, $listOrder); ?>
							</th>							
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_COUPON_PERCENT', 'u.is_percent', $listDirn, $listOrder); ?>
							</th>							
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_COUPON_VALID_FROM', 'u.valid_from', $listDirn, $listOrder); ?>
							</th>							
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_COUPON_VALID_TO', 'u.valid_to', $listDirn, $listOrder); ?>
							</th>
						</tr>
		                <tr class="filter-row">
		                    <th></th>
                            <th></th>
		                    <th>
		                        <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" title="<?php echo JText::_('SR_SEARCH_IN_TITLE'); ?>" />
		                    </th>
							<th>
								 <select name="filter_published" class="inputbox" onchange="this.form.submit()">
									 <option value=""></option>
									 <?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
								 </select>
							 </th>
		                    <th></th>
		                    <th></th>
		                    <th></th>
		                    <th></th>
		                    <th></th>
		                </tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="9">
								<?php echo $this->pagination->getListFooter(); ?>
							</td>
						</tr>
					</tfoot>
					<tbody>
					<?php foreach ($this->items as $i => $item) :
						$canCreate	= $user->authorise('core.create', 'com_solidres.coupon.'.$item->id);
						$canEdit	= $user->authorise('core.edit',	'com_solidres.coupon.'.$item->id);
						$canChange	= $user->authorise('core.edit.state', 'com_solidres.customfieldgroup.'.$item->id);
						?>
						<tr class="row<?php echo $i % 2; ?>">
							<td class="center">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
                            <td class="center">
								<?php echo (int) $item->id; ?>
                            </td>
							<td>
								<a href="<?php echo JRoute::_('index.php?option=com_solidres&task=coupon.edit&id='.(int) $item->id); ?>">
									<?php echo $this->escape($item->coupon_name); ?></a>
								</a>
							</td>
							<td class="center">
								<?php echo JHtml::_('jgrid.published', $item->state, $i, 'coupons.', $canChange);?>
							</td>							
							<td>
								<?php echo $this->escape($item->coupon_code); ?>
							</td>							
							<td>
								<?php echo $this->escape($item->amount); ?>
							</td>							
							<td>
								<?php echo $this->escape( (int) $item->is_percent == 1 ? JText::_('JYES') : JText::_('JNO') ); ?>
							</td>							
							<td>
								<?php echo $this->escape($item->valid_from); ?>
							</td>							
							<td>
								<?php echo $this->escape($item->valid_to); ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>			
				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
				<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</form>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12 powered">
			<p>Powered by <a href="http://solidres.com" target="_blank">Solidres</a></p>
		</div>
	</div>
</div>

