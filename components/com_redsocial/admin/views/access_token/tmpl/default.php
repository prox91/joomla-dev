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
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div class="col100">
		<fieldset>
			<legend><?php echo JText::_('COM_REDSOCIALSTREAM_GENERATE_ACCESS_TOKEN'); ?></legend>
			<table class="adminList">

				<tr>
					<td><input type="radio" name="generatetoken" value="facebook"
					           onclick="return select_profile(this.value)"><?php echo JText::_('COM_REDSOCIALSTREAM_FACEBOOK_TOKEN'); ?></input>
					</td>

				</tr>
				<tr>
					<td>
						<div id="facebook_profile" style="display:none">
							<table>
								<tr>
									<td><?php echo  JText::_('COM_REDSOCIALSTREAM_SELECT_PROFILE'); ?> :</td>
									<td><?php echo $this->lists['fbprofiles'] ?></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="radio" name="generatetoken" value="twitter"
					                       onclick="return select_profile(this.value)"><?php echo JText::_('COM_REDSOCIALSTREAM_TWITTER_TOKEN'); ?></input>
					</td>

				</tr>
				<tr>
					<td>

						<div id="twitter_profile" style="display:none">
							<table>
								<tr>
									<td><?php echo  JText::_('COM_REDSOCIALSTREAM_SELECT_PROFILE'); ?> :</td>
									<td><?php echo $this->lists['twitterprofiles'] ?></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>

				<tr>
					<td colspan="2"><input type="radio" name="generatetoken" value="linkedin"
					                       onclick="return select_profile(this.value)"><?php echo JText::_('COM_REDSOCIALSTREAM_LINKEDIN_TOKEN'); ?></input>
					</td>

				</tr>
				<tr>
					<td>

						<div id="linkedin_profile" style="display:none">
							<table>
								<tr>
									<td><?php echo  JText::_('COM_REDSOCIALSTREAM_SELECT_PROFILE'); ?> :</td>
									<td><?php echo $this->lists['linkedinprofiles'] ?></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>

			</table>
			<input type="hidden" name="option" value="com_redsocialstream"/>
			<input type="hidden" name="view" value="access_token"/>
			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="boxchecked" value="0"/>
		</fieldset>
	</div>

</form>
<script type=" text/javascript">
	function select_profile(val) {
		if (val == "facebook") {
			document.getElementById('facebook_profile').style.display = "";
			document.getElementById('twitter_profile').style.display = "none";
			document.getElementById('linkedin_profile').style.display = "none";
		} else if (val == "twitter") {
			document.getElementById('facebook_profile').style.display = "none";
			document.getElementById('twitter_profile').style.display = "";
			document.getElementById('linkedin_profile').style.display = "none";
		} else if (val == "linkedin") {
			document.getElementById('facebook_profile').style.display = "none";
			document.getElementById('twitter_profile').style.display = "none";
			document.getElementById('linkedin_profile').style.display = "";
		}
	}
</script>
