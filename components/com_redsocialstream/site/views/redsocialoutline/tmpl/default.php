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
<div class="redsocial_outline">
	<?php $col = 1; ?>
	<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
		<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</div>
	<?php endif; ?>
	<div class="redsocial_intro"><p>
			<?php
			$db = JFactory::getDbo();
			$q = "SELECT * FROM #__redsocialstream_settings where dataname = 'introtext'";
			$db->setQuery($q);
			$rows = $db->loadObjectList();
			if (count($rows) > 0) echo $rows[0]->data;
			?></p></div>
	<br>
	<br>
	<table class="socialmain" width="100%">
		<?php foreach ($this->outlinegroups as $outlinegroup) : ?>

			<?php if ($col == 1)
			{
				echo "<tr valign='top'>";
			}
			; ?>

			<td width="33%">
				<table class="socialsub" width="100%">
					<tr height="20px" valign="top">
						<td class='groupdintrotitle'>
							<h3>
								<?php echo $outlinegroup->introtitle; ?>
								&nbsp;
							</h3>
						</td>
					</tr>
					<tr height="70px" valign="top">
						<td class='groupdetails'>
							<?php echo $outlinegroup->subtitle; ?>
							&nbsp;
						</td>
					</tr>
					<tr height="40px" valign="top">
						<td class='grouptitle'>
							<h2>
								<?php echo $outlinegroup->title; ?>
							</h2>

							<?php
							$l = JRoute::_($outlinegroup->groupsociallink);

							if ($l != "")
							{
								echo '<a href="' . $l . '">' . JText::_('REDSOCIALSTREAM_OUTLINE_SHOWALL') . '</a><br>';
							};
							?>
							&nbsp;
						</td>
					</tr>
					<?php foreach ($outlinegroup->profiletypes as $profiletype) :?>
					<tr>
						<td>
							<?php
							$img = trim($profiletype->img);
							if ($img != '')
							{
								echo '<img src="components/com_redsocialstream/images/' . $img . '" /><br>';
							};

							echo '<h4>' . $profiletype->title . '</h4>';

							?>
						</td>
					</tr>
					<?php foreach ($profiletype->profilereferences as $profilereference) :?>
					<tr>
						<td>
							<?php
							$linkurl = trim($profilereference->profilename);
							if ($linkurl != '' && $profiletype->title != "linkedin")
							{
								echo '<a href="' . $profiletype->linkprefix . $linkurl . '">' . $profilereference->title . '</a>';
							}
							else
							{
								echo $profilereference->title;
							};
							?>
						</td>
					<tr>
						<?php endforeach; ?>
						<?php endforeach; ?>
				</table>
			</td>
			<?php $col++;
			if ($col == 4)
			{
				echo "</tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>";
				$col = 1;
			}
			; ?>
		<?php endforeach; ?>
	</table>
</div>
