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

$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$saveOrder	= $listOrder == 'a.ordering';
?>

<div id="solidres">
    <div class="row-fluid">
		<?php echo SolidresHelperSideNavigation::getSideNavigation($this->getName()); ?>
		<div id="sr_panel_right" class="sr_list_view span10">
			<form action="<?php echo JRoute::_('index.php?option=com_solidres&view=reservationassets'); ?>" method="post" name="adminForm" id="adminForm">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>
								<input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
							</th>
							<th class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_NAME', 'a.name', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_PUBLISHED', 'a.state', $listDirn, $listOrder); ?>
							</th>
							<!--
							<th class="category_name">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_CATEGORY', 'category_name', $listDirn, $listOrder); ?>
							</th>
							-->
							<th class="center">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_NUMBERROOMTYPE', 'number_of_roomtype', $listDirn, $listOrder); ?>
							</th>
							<th class="country_name">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_COUNTRY', 'country_name', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_HITS', 'a.hits', $listDirn, $listOrder); ?>
							</th>
						</tr>
						<tr class="filter-row">
							<th></th>
							<th></th>
							<th>
								<input type="text"
									   name="filter_search"
									   id="filter_search"
									   class="inputbox"
									   value="<?php echo $this->state->get('filter.search'); ?>"
									   title="<?php echo JText::_('SR_SEARCH_BY_NAME'); ?>" />
								</div>
							</th>
							<th>
								<select name="filter_published" class="inputbox" onchange="this.form.submit()">
									<option value=""></option>
									<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
								</select>
							</th>
							<!--
							<th>
								<select name="filter_category_id" class="inputbox" onchange="this.form.submit()">
									<option value=""></option>
									<?php echo JHtml::_('select.options', SolidresHelper::getCategoryOptions(), 'value', 'text', $this->state->get('filter.category_id'));?>
								</select>
							</th>
							-->
							<th></th>
							<th>
								<select name="filter_country_id" class="inputbox" onchange="this.form.submit()">
									<?php echo JHtml::_('select.options', SolidresHelper::getCountryOptions(), 'value', 'text', $this->state->get('filter.country_id'));?>
								</select>
							</th>
							<th>
								<select name="filter_access" class="inputbox" onchange="this.form.submit()">
									<option value=""></option>
									<?php echo JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'));?>
								</select>
							</th>
							<th></th>
					   </tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="8">
								<?php echo $this->pagination->getListFooter(); ?>
							</td>
						</tr>
					</tfoot>
					<tbody>
					<?php foreach ($this->items as $i => $item) :
						$ordering	= ($listOrder == 'a.ordering');
						$canCreate	= $user->authorise('core.create',		'com_solidres.reservationasset.'.$item->id);
						$canEdit	= $user->authorise('core.edit',			'com_solidres.reservationasset.'.$item->id);
						$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $item->checked_out==$user->get('id') || $item->checked_out==0;
						$canChange	= $user->authorise('core.edit.state',	'com_solidres.reservationasset.'.$item->id);
						?>
						<tr class="row<?php echo $i % 2; ?>">
							<td class="center">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
							<td class="center">
								<?php echo (int) $item->id; ?>
							</td>
							<td style="width: 35%">
								<?php if ($item->checked_out) : ?>
									<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'reservationassets.', $canCheckin); ?>
								<?php endif; ?>
								<?php if ($canCreate || $canEdit) : ?>
									<a href="<?php echo JRoute::_('index.php?option=com_solidres&task=reservationasset.edit&id='.(int) $item->id); ?>">
										<?php echo $this->escape($item->name); ?></a>
								<?php else : ?>
										<?php echo $this->escape($item->name); ?>
								<?php endif; ?>
								<?php if ($item->default == 1) : ?>
                                <a href="#" title="<?php echo JText::_('SR_HEADING_DEFAULT') ?>"><i class="icon-star"></i></a>
								<?php endif ?>
							</td>
							<td class="center">
								<?php echo JHtml::_('jgrid.published', $item->state, $i, 'reservationassets.', $canChange);?>
							</td>
							<!--<td>
								<a href="<?php /*echo JRoute::_('index.php?option=com_solidres&task=category.edit&id='.(int) $item->category_id); */?>">
								<?php /*echo $item->category_name;*/?>
								</a>
							</td>-->
							<td class="center">
								<a href="<?php echo JRoute::_('index.php?option=com_solidres&view=roomtypes&filter_reservation_asset_id=' . $item->id) ?>">
									<?php echo $item->number_of_roomtype?>
								</a>
							</td>
							<td style="width: 15%">
								<a href="<?php echo JRoute::_('index.php?option=com_solidres&task=country.edit&id='.(int) $item->country_id); ?>">
								<?php echo $item->country_name;?>
								</a>
							</td>
							<td class="center">
								<?php echo $this->escape($item->access_level); ?>
							</td>
							<td class="center">
								<?php echo $item->hits; ?>
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
