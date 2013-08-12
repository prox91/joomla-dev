<?php 
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

?>
<a id="new-room-tier" class="btn"><i class="icon-plus-2"></i> <?php echo JText::_('SR_NEW')?></a>
<table id="room_tbl" class="table" cellspacing="0">
	<thead>
		<tr>
			<th><?php echo JText::_('SR_ROOM_TYPE_ROOM_ACTION'); ?></th>
            <th><?php echo JText::_('SR_ROOM_TYPE_ROOM_ROOM_NUMBER'); ?></th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		if (isset($this->item->rooms)) :
			foreach($this->item->rooms as $key => $value) : ?>
				<tr id="tier-room-<?php echo $key ?>" class="tier-room">
					<td>
						<a title="Delete" id="delete-room-row-<?php echo $value->id?>" class="delete-room-row btn"><i class="icon-remove"></i> </a>
						<span></span>
					</td>
					<td>
						<input type="text" value="<?php echo $value->label ?>" name="jform[rooms][<?php echo $key ?>][label]">
						<input type="hidden" value="<?php echo $value->id ?>" name="jform[rooms][<?php echo $key ?>][id]"/>
					</td>
				</tr>
			<?php 
			endforeach;
		endif; ?>
	</tbody>
</table>