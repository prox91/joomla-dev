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
	<div class="col50">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE_DETAILS'); ?></legend>

			<table class="admintable">
				<tr>
					<td width="100" align="right" class="key">
						<label for="title">
							<?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE_TITLE'); ?>:
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
						<label for="title">
							<?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE_PROFILENAME'); ?>:
						</label>
					</td>
					<td>
						<input class="text_area" type="text" name="profilename" id="profilename" size="32"
						       maxlength="250" value="<?php if (isset($this->detail->profilename))
						{
							echo $this->detail->profilename;
						} ?>"/>
					</td>
				</tr>
				<tr>
					<td width="100" align="right" class="key">
						<label for="title">
							<?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE_GROUP'); ?>:
						</label>
					</td>
					<td>
						<select name="groupid">
							<?php
							foreach ($this->groups as $group)
							{
								$option = "<option value=\"" . $group->id . "\" ";
								if (isset($this->detail->groupid))
								{
									if ($group->id == $this->detail->groupid)
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
					<td width="100" align="right" class="key">
						<label for="title">
							<?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE_TYPE'); ?>:
						</label>
					</td>
					<td>
						<select name="profiletypeid">
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
							<?php echo JText::_('COM_REDSOCIALSTREAM_PROFILE_PUBLISHED'); ?>:
						</label>
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
	<input type="hidden" name="view" value="profile"/>
	<input type="hidden" name="ordering" value="<?php if (isset($this->detail->ordering) && $this->detail->ordering != "")
	{
		echo $this->detail->ordering;
	}
	else
	{
		echo "1";
	} ?>"/>
</form>
