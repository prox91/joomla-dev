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

$loggeduser = JFactory::getUser();
?>

<div id="solidres">
    <div class="row-fluid">
		<?php echo SolidresHelperSideNavigation::getSideNavigation($this->getName()); ?>
		<div id="sr_panel_right" class="sr_list_view span10">
			<form action="<?php echo JRoute::_('index.php?option=com_solidres&view=customers'); ?>" method="post" name="adminForm" id="adminForm">
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="1%">
								<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)" />
							</th>
		                    <th width="1%" class="nowrap">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_ID', 'r.id', $this->listDirn, $this->listOrder); ?>
							</th>
							<th class="title">
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_CUSTOMER_CODE', 'r.customer_code', $this->listDirn, $this->listOrder); ?>
							</th>
							<th>
								<?php echo JHtml::_('grid.sort', 'SR_HEADING_CUSTOMER_ENABLED', 'a.block', $this->listDirn, $this->listOrder); ?>
							</th>
							<th>
								<?php echo JText::_('SR_HEADING_CUSTOMER_FULLNAME'); ?>
							</th>
							<th>
								<?php echo JText::_('SR_HEADING_CUSTOMER_USERNAME'); ?>
							</th>
							<th>
								<?php echo JText::_('SR_HEADING_CUSTOMER_EMAIL'); ?>
							</th>
							<th>
								<?php echo JText::_('SR_HEADING_CUSTOMER_REGISTER_DATE'); ?>
							</th>
							<th>
								<?php echo JText::_('SR_HEADING_CUSTOMER_LASTVISIT_DATE'); ?>
							</th>
		                    <th>
								<?php echo JHtml::_('grid.sort',  'SR_HEADING_CUSTOMER_GROUP_NAME', 'r.group_name', $this->listDirn, $this->listOrder); ?>
							</th>
						</tr>
		                <tr class="filter-row">
		                    <th></th>
		                    <th></th>
		                    <th>
		                        <input class="inputbox" type="text" name="filter_customer_code" id="filter_customer_code" value="<?php echo $this->state->get('filter.customer_code'); ?>" title="<?php echo JText::_('SR_SEARCH_IN_TITLE'); ?>" />
		                    </th>
                            <th></th>
							<th></th>
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
						$ordering	= ($this->listOrder == 'r.ordering');
						$canCreate	= $this->user->authorise('core.create',		'com_solidres.customer.'.$item->id);
						$canEdit	= $this->user->authorise('core.edit',		'com_solidres.customer.'.$item->id);
						$canCheckin	= $this->user->authorise('core.manage',		'com_checkin') || $item->checked_out==$this->user->get('id') || $item->checked_out==0;
						$canChange	= $this->user->authorise('core.edit.state',	'com_solidres.customer.'.$item->id);
		                $customerEditLink = JRoute::_('index.php?option=com_solidres&task=customer.edit&id='.(int) $item->id);
		                $customerGroupEditLink = JRoute::_('index.php?option=com_solidres&task=customergroup.edit&id='.(int) $item->customer_group_id);
						?>
						<tr class="row<?php echo $i % 2; ?>">
							<td class="center">
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
		                    <td class="center">
								<?php echo $item->id; ?>
							</td>
							<td>
								<?php if ($canCreate || $canEdit) : ?>
									<a href="<?php echo $customerEditLink; ?>">
										<?php echo $this->escape($item->customer_code); ?></a>
								<?php else : ?>
										<?php echo $this->escape($item->customer_code); ?>
								<?php endif; ?>
							</td>
                            <td class="center">
								<?php if ($canChange) : ?>
									<?php
									$self = $loggeduser->id == $item->id;
									echo JHtml::_('jgrid.state', $this->blockStates($self), $item->jblock, $i, 'customers.', !$self);
									?>
								<?php else : ?>
									<?php echo JText::_($item->block ? 'JNO' : 'JYES'); ?>
								<?php endif; ?>
                            </td>
							<td>
								<?php echo $item->firstname. ' ' . $item->middlename .' '. $item->lastname ?>
							</td>
							<td>
								<?php echo $item->jusername ?>
							</td>
							<td>
								<?php echo $item->jemail ?>
							</td>
							<td>
								<?php echo $item->jregisterDate ?>
							</td>
							<td>
								<?php echo $item->jlastvisitDate ?>
							</td>
		                    <td>
		                        <?php if($canCreate || $canEdit) : ?>
		                            <a href="<?php echo $customerGroupEditLink ?>">
		                            <?php echo $item->group_name; ?>
		                            </a>
		                        <?php else : ?>
									<?php echo $item->group_name; ?>
								<?php endif; ?>
		                    </td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>			
				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="filter_order" value="<?php echo $this->listOrder; ?>" />
				<input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn; ?>" />
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
