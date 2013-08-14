<?
/**
 * @copyright Copyright (C) 2012-2013 redCOMPONENT.com. All rights reserved.
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
?>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td valign="top">
			<table class="adminlist">
				<tr>
					<td>
						<div id="cpanel">
							<?php
							$option = "com_redsocialstream";
							$link = 'index.php?option=' . $option . '&amp;view=profiles';
							RedsocialstreamsViewRedsocialstreams::quickiconButton($link, '48_redsocialstream_profile.png', JText::_('COM_REDSOCIALSTREAM_PROFILE'));

							$link = 'index.php?option=' . $option . '&amp;view=groups';
							RedsocialstreamsViewRedsocialstreams::quickiconButton($link, '48_redsocialstream_group.png', JText::_('COM_REDSOCIALSTREAM_GROUP'));

							$link = 'index.php?option=' . $option . '&amp;view=posts';
							RedsocialstreamsViewRedsocialstreams::quickiconButton($link, '48_redsocialstream_post.png', JText::_('COM_REDSOCIALSTREAM_POSTS'));

							$link = 'index.php?option=' . $option . '&amp;view=configure';
							RedsocialstreamsViewRedsocialstreams::quickiconButton($link, '48_redsocialstream_configure.png', JText::_('COM_REDSOCIALSTREAM_CONFIGURE'));
							?>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
