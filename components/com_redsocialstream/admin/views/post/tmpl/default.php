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
			alert("<?php echo JText::_( 'COM_REDSOCIALSTREAM_PROFILE_TITLE_ERROR',
			 true ); ?>");
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
	<fieldset class="adminform">
		<table id="adminTable" name="adminTable">
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_TYPE'); ?>:
					</label>
				</td>
				<td>
					<select name="type">
						<?php
						foreach ($this->profiletypes as $type)
						{
							$option = "<option value=\"" . $type->id . "\" ";
							if (isset($this->detail->profiletypeid))
							{
								if ($type->id == $this->detail->profiletypeid)
								{
									$option .= " selected=\"selected\"";
								}
							}
							$option .= "\">" . $type->title . "</option>";
							echo $option;
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_EXT_PROFILE_ID'); ?>:
					</label>
				</td>
				<td>
					<input type="text" name="ext_profile_id" value="<?php echo $this->detail->ext_profile_id; ?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_KILDELINK'); ?>:
					</label>
				</td>
				<td>
					<input type="text" name="kildelink" value="<?php echo $this->detail->source_link; ?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_CREATED_TIME'); ?>:
					</label>
				</td>
				<td>
					<?php
					$date = JFactory::getDate($this->detail->created_time);
					echo JHTML::_('calendar', $date->toFormat('%d-%m-%Y  %H:%M:%S'), 'created_time', 'created_time', '%d-%m-%Y  %H:%M:%S', 'size="40"');
					?>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_DURATION'); ?>:
					</label>
				</td>
				<td>
					<input type="text" name="duration" value="<?php echo $this->detail->duration; ?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE'); ?>:
					</label>
				</td>
				<td>
					<select name="profile_id">
						<?php
						foreach ($this->profiles as $profile)
						{
							$option = "<option value=\"" . $profile->id . "\" ";
							if (isset($this->detail->profile_id))
							{
								if ($profile->id == $this->detail->profile_id)
								{
									$option .= " selected=\"selected\"";
								}
							}
							$option .= "\">" . $profile->title . "</option>";
							echo $option;
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_GROUP'); ?>:
					</label>
				</td>
				<td>
					<select name="group_id">
						<?php
						foreach ($this->groups as $group)
						{
							$option = "<option value=\"" . $group->id . "\" ";
							if (isset($this->detail->groupid))
							{
								if ($group->id == $this->detail->group_id)
								{
									$option .= " selected=\"selected\"";
								}
							}
							$option .= "\">" . $group->title . "</option>";
							echo $option;
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_REDSOCIALSTREAM_PUBLISHED'); ?>:
					</label>
				</td>
				<td>
					<?php echo $this->lists['published']; ?>
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="cid[]" value="<?php echo $this->detail->id; ?>"/>
					<input type="hidden" name="task" value=""/>
					<input type="hidden" name="view" value="post"/>
				</td>
			</tr>
		</table>
	</fieldset>
</form>
