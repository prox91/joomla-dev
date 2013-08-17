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

		var form = document.adminForm;
		if (pressbutton) {
			form.task.value = pressbutton;
		}

		if ((pressbutton == 'edit') || (pressbutton == 'publish') || (pressbutton == 'unpublish') || (pressbutton == 'remove')) {
			form.view.value = "postfeeds";
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

			<thead>
			<tr>
				<th width="5%">
					<?php echo JText::_('COM_REDSOCIALSTREAM_NUM'); ?>
				</th>
				<th class="title">
					<?php echo JHTML::_('grid.sort', JText::_('COM_REDSOCIALSTREAM_NAME'), 'h.title', $this->lists['order_Dir'], $this->lists['order']); ?>

				</th>
				<th>
					<?php echo JText::_('COM_REDSOCIALSTREAM_FACEBOOK'); ?>
				</th>
				<th>
					<?php echo JText::_('COM_REDSOCIALSTREAM_TWITTER'); ?>
				</th>

				<th width="5%" nowrap="nowrap">
					<?php echo JText::_('COM_REDSOCIALSTREAM_LINKEDIN'); ?>
				</th>

				<th width="5%" nowrap="nowrap">
					<?php echo JText::_('COM_REDSOCIALSTREAM_ALL'); ?>

				</th>
				<th width="5%" nowrap="nowrap">
					<?php echo JText::_('COM_REDSOCIALSTREAM_REPOST'); ?>

				</th>
			</tr>
			</thead>
			<?php
			$k = 0;
			for ($i = 0, $n = count($this->items); $i < $n; $i++)
			{

				$row = $this->items[$i];
				$row->checked_out = 0;
				$link = JRoute::_('index.php?option=com_content&task=article.edit&id=' . $row->id);
				$model = $this->getModel('postfeeds');
				$posteData = $model->getPostedFeedData($row->id);
				?>

				<tr class="<?php echo "row$k"; ?>">
					<td align="center" width="5%">
						<?php echo $this->pagination->getRowOffset($i); ?>
					</td>

					<td align="center" width="20%">
						<a href="<?php echo $link; ?>"
						   title="<?php echo JText::_('COM_REDSOCIALSTREAM_EDIT_POST'); ?>"><?php echo $row->title; ?></a>
					</td>
					<td align="center" width="15%">
						<?php if (isset($posteData[0]->facebook) && $posteData[0]->facebook)
						{
							echo JText ::_("COM_REDSOCIALSTREAM_POSTED");
						}
						else
						{
							?>

							<input type="checkbox" name="facebook[]" value="<?php echo $row->id ?>">
						<?php } ?>
					</td>
					<td align="center" width="15%">
						<?php if (isset($posteData[0]->twitter) && $posteData[0]->twitter)
						{
							echo JText ::_("COM_REDSOCIALSTREAM_POSTED");
						}
						else
						{
							?>
							<input type="checkbox" name="twitter[]" value="<?php echo $row->id ?>">
						<?php } ?>
					</td>

					<td align="center" width="15%">
						<?php if (isset($posteData[0]->linkedin) && $posteData[0]->linkedin)
						{
							echo JText ::_("COM_REDSOCIALSTREAM_POSTED");
						}
						else
						{
							?>
							<input type="checkbox" name="linkedin[]" value="<?php echo $row->id ?>">
						<?php } ?>
					</td>

					<td align="center" width="15%">
						<?php if (isset($posteData[0]->linkedin) && $posteData[0]->linkedin && $posteData[0]->facebook && $posteData[0]->twitter)
						{
							echo JText ::_("COM_REDSOCIALSTREAM_POSTED");
						}
						else
						{
							?>
							<input type="checkbox" name="all[]" value="<?php echo $row->id ?>">
						<?php } ?>
					</td>
					<td align="center" width="15%">
						<input type="checkbox" name="repost[]" value="<?php echo $row->id ?>">
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

	<input type="hidden" name="view" value="postfeeds"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>
