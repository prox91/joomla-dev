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
			<form action="<?php echo JRoute::_('index.php?option=com_solidres&view=states'); ?>" method="post" name="adminForm" id="adminForm">
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="1%">
								<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
							</th>
		                    <th width="1%" class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_ID', 'id', $listDirn, $listOrder); ?>
							</th>
							<th class="title" width="40%">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_STATE_NAME', 'name', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_PUBLISHED', 'state', $listDirn, $listOrder); ?>
							</th>
							<th class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_COUNTRY', 'country', $listDirn, $listOrder); ?>
							</th>
							<th class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_COUNTRY_CODE_2', 'code_2', $listDirn, $listOrder); ?>
							</th>
		                    <th width="1%" class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_COUNTRY_CODE_3', 'code_3', $listDirn, $listOrder); ?>
							</th>
						</tr>
		                <tr class="filter-row">
		                    <th></th>
		                    <th></th>
		                    <th>
		                        <input class="inputbox" type="text" name="filter_search" id="filter_search" value="<?php echo $this->state->get('filter.search'); ?>" title="<?php echo JText::_('SR_SEARCH_IN_TITLE'); ?>" />
		                    </th>
		                    <th>
		                        <select name="filter_published" class="inputbox" onchange="this.form.submit()">
		                            <option value=""></option>
		                            <?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
		                        </select>
		                    </th>
		                    <th>
		                        <?php echo JHtml::_('select.genericlist', SolidresHelper::getCountryOptions(), 'filter_country', 'onchange="this.form.submit()"','value','text', $this->state->get('filter.country'))?>
		                    </th>
		                    <th></th>
		                    <th></th>
		                </tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="7">
								<?php echo $this->pagination->getListFooter(); ?>
							</td>
						</tr>
					</tfoot>
					<tbody>
					<?php foreach ($this->items as $i => $item) :
						$canCreate	= $user->authorise('core.create',		'com_solidres.country.'.$item->id);
						$canEdit	= $user->authorise('core.edit',			'com_solidres.country.'.$item->id);
						$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $item->checked_out==$user->get('id') || $item->checked_out==0;
						$canChange	= $user->authorise('core.edit.state',	'com_solidres.country.'.$item->id);
						?>
						<tr class="row<?php echo $i % 2; ?>">
							<td class="center">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
		                    <td class="center">
								<?php echo (int) $item->id; ?>
							</td>
							<td>
								<?php if ($canCreate || $canEdit) : ?>
									<a href="<?php echo JRoute::_('index.php?option=com_solidres&task=state.edit&id='.(int) $item->id); ?>">
										<?php echo $this->escape($item->name); ?></a>
								<?php else : ?>
										<?php echo $this->escape($item->name); ?>
								<?php endif; ?>
							</td>
							<td class="center">
								<?php echo JHtml::_('jgrid.published', $item->state, $i, 'states.', $canChange);?>
							</td>
							<td class="center">
								<?php echo $this->escape($item->country); ?>
							</td>							
							<td class="center">
								<?php echo $this->escape($item->code_2); ?>
							</td>
							<td class="center">
								<?php echo $this->escape($item->code_3); ?>
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