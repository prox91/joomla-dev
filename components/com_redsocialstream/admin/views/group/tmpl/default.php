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
defined('_JEXEC') or die;
?>
<script language="javascript" type="text/javascript">
	Joomla.submitbutton = function (pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform(pressbutton);
			return;
		}

		// do field validation
		if (form.title.value == "") {
			alert("<?php echo JText::_( 'COM_REDSOCIALSTREAM_GROUP_TITLE_ERROR', true ); ?>");
		} else {
			submitform(pressbutton);
		}
	}
</script>
<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>
<form action="<?php echo JRoute::_($this->request_url) ?>" method="post" name="adminForm" id="adminForm">
	<div class="col50">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_REDSOCIALSTREAM_GROUP_DETAILS'); ?></legend>

			<table class="admintable">
				<tr>
					<td width="100" align="right" class="key">
						<label for="introtitle">
							<?php echo JText::_('COM_REDSOCIALSTREAM_GROUP_INTROTITLE'); ?>:
						</label>
					</td>
					<td>
						<input class="text_area" type="text" name="introtitle" id="introtitle" size="32" maxlength="250"
						       value="<?php if (isset($this->detail->introtitle))
						       {
							       echo $this->detail->introtitle;
						       } ?>"/>
					</td>
				</tr>
				<tr>
					<td width="100" align="right" class="key">
						<label for="subtitle">
							<?php echo JText::_('COM_REDSOCIALSTREAM_GROUP_SUBTITLE'); ?>:
						</label>
					</td>
					<td>
						<textarea class="text_area" rows="4" cols="40" name="subtitle" id="subtitle"><?php
							if (isset($this->detail->subtitle))
							{
								echo $this->detail->subtitle;
							}
							?></textarea>

					</td>
				</tr>
				<tr>
					<td width="100" align="right" class="key">
						<label for="title">
							<?php echo JText::_('COM_REDSOCIALSTREAM_GROUP_TITLE'); ?>:
						</label>
					</td>
					<td>
						<input class="text_area" type="text" name="title" id="title" size="32" maxlength="250"
						       value="<?php if (isset($this->detail->title))
						       {
							       echo $this->detail->title;
						       } ?>"/>
					</td>
				</tr>
				<tr>
					<td width="100" align="right" class="key">
						<label for="groupsociallink">
							<?php echo JText::_('COM_REDSOCIALSTREAM_GROUP_GROUPSOCIALLINK'); ?>:
						</label>
					</td>
					<td>
						<input class="text_area" type="text" name="groupsociallink" id="groupsociallink" size="32"
						       maxlength="250" value="<?php if (isset($this->detail->groupsociallink))
						{
							echo $this->detail->groupsociallink;
						} ?>"/>
					</td>
				</tr>


				<tr>
					<td valign="top" align="right" class="key">
						<?php echo JText::_('COM_REDSOCIALSTREAM_PUBLISHED'); ?>:
					</td>
					<td>
						<?php echo $this->lists['published']; ?>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>
	<div class="clr"></div>

	<input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="view" value="group"/>
	<input type="hidden" name="ordering" value="<?php if ($this->detail->ordering != "")
	{
		echo $this->detail->ordering;
	}
	else
	{
		echo "1";
	} ?>"/>
</form>
