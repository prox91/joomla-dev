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
JHTML::_('behavior.tooltip');
$uri = JURI::getInstance();
$url = $uri->root();
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


			form.view.value = "configure";
		}
		try {
			form.onsubmit();
		}
		catch (e) {
		}
		form.submit();
	}

</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div class="col100">
		<fieldset>
			<legend><?php echo JText::_('COM_REDSOCIALSTREAM_DETAILS'); ?></legend>
			<table class="admintable">


				<?php foreach ($this->settingsrows as $row) : ?>

					<tr>
						<td width="250" align="left" class="key">
							<label for="type">
								<?php echo JText::_('COM_REDSOCIALSTREAM_SETTINGS') . " " . JText::_($row->datalabel); ?>
								:

							</label>
						</td>
						<td>
							&nbsp;



							<?php
							if (strtolower($row->datatype) == 'html')
							{
								$editor = JFactory::getEditor();
								echo $editor->display('settings_' . $row->dataname,
									$row->data,
									800, 300, 100, 30,
									array('article' => 0,
										'image' => 0,
										'pagebreak' => 0,
										'readmore' => 0));
							};
							if (strtolower($row->datatype) == "text")
							{
								if ($row->dataname == "app_secret" || $row->dataname == "twitter_consumer_sec" || $row->dataname == "linked_secret_key")
								{
									echo"<input type=\"password\" value=\"" . $row->data . "\" name=\"settings_" . $row->dataname . "\" />";
								}
								else
								{
									echo"<input type=\"text\" value=\"" . $row->data . "\" name=\"settings_" . $row->dataname . "\" />";
								}
							}
							?>
						</td>
					</tr>

					<input type="hidden" name="<?php echo 'settings_' . $row->dataname . '_save'; ?>" value="true"/>

				<?php endforeach;

				?>


			</table>
		</fieldset>
	</div>
	<input type="hidden" name="option" value="com_redsocialstream"/>
	<input type="hidden" name="id" value="<?php if (isset($this->data->id))
	{
		echo $this->data->id;
	} ?>"/>
	<input type="hidden" name="task" value="edit"/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="view" value="configure"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>
