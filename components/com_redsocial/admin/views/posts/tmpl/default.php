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
//onsubmit="return submitform();"
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

		if ((pressbutton == 'edit') || (pressbutton == 'publish') || (pressbutton == 'unpublish') || (pressbutton == 'remove')) {
			form.view.value = "post";
		}
		try {
			form.onsubmit();
		}
		catch (e) {
		}

		form.submit();
	}

</script>
<table border="0" cellpadding="2" cellspacing="2" width="100%">
	<tr>
		<td>
			<form action="<?php echo 'index.php?option=com_redsocialstream&view=posts'; ?>" method="post"
			      name="adminForm2" id="adminForm2">
				<label><?php echo JText::_("COM_REDSOCIALSTREAM_SEARCH_LBL")?></label> :
				<input type="text" name="keyword" value="<?php echo $this->keyword; ?>"> <input type="submit"
				                                                                                value="<?php echo JText::_("COM_REDSOCIALSTREAM_SEARCH") ?>">
			</form>
		</td>

	</tr>
</table>
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" id="adminForm">
	<div id="editcell">
		<table class="adminlist">

			<thead>
			<tr>
				<th width="5%">
					<?php echo JText::_('COM_REDSOCIALSTREAM_NUM'); ?>
				</th>

				<th width="5%">
					<input type="checkbox" name="toggle" value=""
					       onclick="checkAll(<?php echo count($this->items); ?>);"/>
				</th>
				<th class="title" align="center" width="30%">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_NAME'), 'po.title', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th>
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_TYPE'), 'p.title', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th>
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_GROUP'), 'po.group_id', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="5%" nowrap="nowrap">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_PUBLISHED'), 'po.published', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="5%" nowrap="nowrap">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_ID'), 'po.id', $this->lists['order_Dir'], $this->lists['order']); ?>

				</th>
			</tr>
			</thead>
			<?php
			$k = 0;
			for ($i = 0, $n = count($this->items); $i < $n; $i++)
			{

				$row = $this->items[$i];
				$row->checked_out = 0;
				$link = JRoute::_('index.php?option=com_redsocialstream&view=post&task=edit&cid[]=' . $row->id);
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
						<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_REDSOCIALSTREAM_EDIT_POST'); ?>">
							<?php echo $row->ext_post_id . ' : ' . $row->ext_post_name; ?></a>
					</td>
					<td align="center">
						<?php echo $row->typetitle; ?>
					</td>
					<td align="center">
						<?php echo $row->grouptitle; ?>
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

	<input type="hidden" name="view" value="posts"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>
