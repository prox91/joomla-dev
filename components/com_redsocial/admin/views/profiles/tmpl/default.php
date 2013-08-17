<?php
/**
 * @copyright Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license   GNU/GPL, see license.txt or http://www.gnu.org/copyleft/gpl.html
 *            Developed by email@recomponent.com - redCOMPONENT.com
 *
 * redSocialstream can be downloaded from www.redcomponent.com
 * redSocialstream is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.
 *
 * You should have received a copy of the GNU General Public License
 * along with redSocialstream; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
defined('_JEXEC') or die('Restricted access');
//Ordering allowed ?
$ordering = ($this->lists['order'] == 'ordering');
//DEVNOTE: import html tooltips
JHTML::_('behavior.tooltip');
?>

<script language="javascript" type="text/javascript">
	Joomla.submitbutton = function (pressbutton) {
		submitbutton(pressbutton);
	}
	submitbutton = function (pressbutton) {

		var form = document.adminForm;
		if (pressbutton) {
			form.task.value = pressbutton;
		}

		if ((pressbutton == 'add') || (pressbutton == 'edit') || (pressbutton == 'publish') || (pressbutton == 'unpublish') || (pressbutton == 'remove')) {
			form.view.value = "profile";
		}
		try {
			form.onsubmit();
		}
		catch (e) {
		}

		form.submit();
	}


</script>
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" id="adminForm">
	<div id="editcell">
		<table class="adminlist">
			<?php $k = 0;
			for ($i = 0, $n = count($this->items); $i < $n; $i++)
			{
				$row = $this->items[$i];
				$row->checked_out = 0;
				$link = JRoute::_('index.php?option=com_redsocialstream&controller=configure&task=edit');
			}?>


			<thead>
			<tr>
				<th width="5%" align="center">
					<?php echo JText::_('COM_REDSOCIALSTREAM_NUM'); ?>
				</th>

				<th width="5%" align="center">
					<input type="checkbox" name="toggle" value=""
					       onclick="checkAll(<?php echo count($this->items); ?>);"/>
				</th>
				<th width="20%" class="title" align="center">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_NAME'), 'h.title', $this->lists['order_Dir'], $this->lists['order']); ?>

				</th>
				<th align="center" width="20%">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_TYPE'), 'p.title', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="20%">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_GROUP'), 'h.groupid', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>

				<th width="15%" class="title" nowrap="nowrap" align="center">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_ORDERING'), 'ordering', $this->lists['order_Dir'], $this->lists['order']); ?>
					<?php echo JHTML::_('grid.order', $this->items); ?>
				</th>

				<th width="5%" nowrap="nowrap" align="center">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_PUBLISHED'), 'h.published', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>

				<th width="5%" nowrap="nowrap" align="center">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_ID'), 'h.id', $this->lists['order_Dir'], $this->lists['order']); ?>

				</th>
			</tr>
			</thead>
			<?php
			$k = 0;
			for ($i = 0, $n = count($this->items); $i < $n; $i++)
			{
				$row = $this->items[$i];
				$row->checked_out = 0;
				$link = JRoute::_('index.php?option=com_redsocialstream&view=profile&task=edit&cid[]=' . $row->id);
				$checked = JHTML::_('grid.checkedout', $row, $i);
				$published = JHTML::_('grid.published', $row, $i);
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td align="center">
						<?php echo $this->pagination->getRowOffset($i); ?>
					</td>
					<td align="center">
						<?php echo $checked;?>
					</td>
					<td align="center">
						<a href="<?php echo $link; ?>"
						   title="<?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE_EDIT'); ?>">
							<?php echo $row->title; ?></a>
					</td>
					<td align="center">
						<?php echo $row->profiletypetitle; ?>
					</td>
					<td align="center">
						<?php echo $row->grouptitle; ?>
					</td>
					<td class="order">
						<span><?php echo $this->pagination->orderUpIcon($i, true, 'orderup', JText::_("COM_REDSOCIALSTREAM_MOVE_UP"), $row->ordering); ?></span>
						<span><?php echo $this->pagination->orderDownIcon($i, $n, true, 'orderdown', JText::_("COM_REDSOCIALSTREAM_MOVE_DOWN"), $row->ordering);?></span>
						<?php $disabled = $row->ordering ? '' : '"disabled=disabled"'; ?>
						<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>"
						       class="text_area" style="text-align: center"/>
					</td>
					<td align="center">
						<?php echo $published;?>
					</td>
					<td align="center">
						<?php echo $row->id; ?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			<tfoot>
			<td colspan="9">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
			</tfoot>
		</table>
	</div>

	<input type="hidden" name="view" value="profiles"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>
