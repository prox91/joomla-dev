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
$user   = JFactory::getUser();
$userId	= $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$saveOrder = $listOrder == 'r.id';

$statuses = array(
	0 => JText::_('SR_RESERVATION_STATE_PENDING_ARRIVAL'),
	1 => JText::_('SR_RESERVATION_STATE_CHECKED_IN'),
	2 => JText::_('SR_RESERVATION_STATE_CHECKED_OUT'),
	3 => JText::_('SR_RESERVATION_STATE_CLOSED'),
	4 => JText::_('SR_RESERVATION_STATE_CANCELED'),
	-2 => JText::_('JTRASHED')
);

$badges = array(
	0 => 'label-info',
	1 => 'label-success',
	2 => 'label-inverse',
	3 => '',
	4 => 'label-warning',
	-2 => 'label-important'
);

?>

<div id="solidres">
    <div class="row-fluid">
		<?php echo SolidresHelperSideNavigation::getSideNavigation($this->getName()); ?>
		<div id="sr_panel_right" class="sr_list_view span10">
			<form action="<?php echo JRoute::_('index.php?option=com_solidres&view=reservations'); ?>" method="post" name="adminForm" id="adminForm">
				<button type="submit" class="btn">Submit</button>
				<a id="reservation-filter-clear" href="<?php echo JRoute::_('index.php?option=com_solidres&view=reservations&filter_clear=1') ?>" class="btn">Clear</a>

				<table class="table table-striped">
					<thead>
						<tr>
							<th width="1%">
								<input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
							</th>
							<th class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_ID', 'r.id', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_CUSTOM_FIELD_RESERVATION_CODE', 'r.code', $listDirn, $listOrder); ?>
							</th>
                            <th>
								<?php echo JHtml::_('grid.sort',  'SR_RESERVATION_STATUS', 'r.state', $listDirn, $listOrder); ?>
                            </th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_RESERVATION_CUSTOMER', 'customer_fullname', $listDirn, $listOrder); ?>
							</th>
                            <th>
								<?php echo JHtml::_('grid.sort',  'SR_RESERVATION_CHECKIN', 'r.checkin', $listDirn, $listOrder); ?>
                            </th>
                            <th>
								<?php echo JHtml::_('grid.sort',  'SR_RESERVATION_CHECKOUT', 'r.checkout', $listDirn, $listOrder); ?>
                            </th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_CUSTOM_FIELD_RESERVATION_CREATE_DATE', 'r.created_date', $listDirn, $listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort',  'SR_CUSTOM_FIELD_RESERVATION_USERNAME', 'r1.username', $listDirn, $listOrder); ?>
							</th>
						</tr>
		                <tr class="filter-row">
		                    <th></th>
		                    <th></th>
							<th>
								<input class="inputbox"
									   type="text"
									   name="filter_search"
									   id="filter_search"
									   placeholder="<?php echo JText::_('SR_SEARCH_BY_CODE'); ?>"
									   value="<?php echo $this->state->get('filter.search'); ?>"
									   title="<?php echo JText::_('SR_SEARCH_BY_CODE'); ?>" />
							</th>
                            <th>
                                <select name="filter_published" class="inputbox small">
									<?php echo JHtml::_('select.options', $this->reservationStatusList, 'value', 'text', $this->state->get('filter.state'), true);?>
                                </select>
                            </th>
							<th></th>
							<th>
								<p class="reservation-date-filter">
                                    <label><?php echo JText::_('SR_RESERVATION_FILTER_FROM') ?> <i class="icon-calendar"></i> </label>
                                    <input type="text" name="filter_checkin_from" id="filter_checkin_from" class="filter_checkin_checkout datepicker span5"
                                           value="<?php echo $this->state->get('filter.checkin_from'); ?>" />
								</p>
                                <p class="reservation-date-filter">
                                    <label><?php echo JText::_('SR_RESERVATION_FILTER_TO') ?> <i class="icon-calendar"></i> </label>
                                    <input type="text" name="filter_checkin_to" id="filter_checkin_to" class="filter_checkin_checkout datepicker span5"
                                           value="<?php echo $this->state->get('filter.checkin_to'); ?>" />
								</p>
							</th>
							<th>
                                <p class="reservation-date-filter">
                                    <label><?php echo JText::_('SR_RESERVATION_FILTER_FROM') ?> <i class="icon-calendar"></i> </label>
                                    <input type="text" name="filter_checkout_from" id="filter_checkout_from" class="filter_checkin_checkout datepicker span5"
                                           value="<?php echo $this->state->get('filter.checkout_from'); ?>" />
                                </p>
                                <p class="reservation-date-filter">
                                    <label><?php echo JText::_('SR_RESERVATION_FILTER_TO') ?> <i class="icon-calendar"></i> </label>
                                    <input type="text" name="filter_checkout_to" id="filter_checkout_to" class="filter_checkin_checkout datepicker span5"
                                           value="<?php echo $this->state->get('filter.checkout_to'); ?>" />
                                </p>
							</th>
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
					<?php
						foreach ($this->items as $i => $item) :
						$ordering	= ($listOrder == 'a.ordering');
						$canCreate	= $user->authorise('core.create',       'com_solidres.reservation.'.$item->id);
						$canEdit	= $user->authorise('core.edit',	        'com_solidres.reservation.'.$item->id);
						$canCheckin	= $user->authorise('core.manage',       'com_checkin') || $item->checked_out==$user->get('id') || $item->checked_out==0;
						$canChange	= $user->authorise('core.edit.state',   'com_solidres.reservation.'.$item->id);
						$editLink	= JRoute::_('index.php?option=com_solidres&task=reservation.edit&id='.(int) $item->id);
						?>
						<tr class="row<?php echo $i % 2; ?>">
							<td class="center">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
							<td class="center">
								<?php echo $item->id; ?>
							</td>
							<td>
								<span class="label <?php echo $badges[$item->state] ?> reservation-code">
									<a href="<?php echo $editLink ?>">
										<?php echo $this->escape($item->code); ?>
									</a>
								</span>
							</td>
                            <td>
								<?php echo $statuses[$item->state]; ?>
                            </td>
                            <td>
								<?php echo $item->customer_firstname .' '. $item->customer_middlename .' '. $item->customer_lastname ?>
							</td>
							<td>
								<?php echo date('d/m/Y', strtotime($item->checkin)); ?>
							</td>
							<td>
								<?php echo date('d/m/Y', strtotime($item->checkout)); ?>
							</td>
                            <td>
								<?php echo date('d/m/Y', strtotime($item->created_date)); ?>
                            </td>
							<td>
								<?php
								if(empty($item->username))
								{
									echo 'Unknown';
								}
								else
								{
									echo $this->escape($item->username);
								}
								?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
                <input type="hidden" name="filter_clear" value="0" />
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