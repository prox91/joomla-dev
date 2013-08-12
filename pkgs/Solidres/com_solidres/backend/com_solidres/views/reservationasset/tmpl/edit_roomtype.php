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

$user	= JFactory::getUser();
$userId	= $user->get('id');
?>

<div class="room_type_assign">

	<!--<p>
		<a href="<?php /*echo JRoute::_('index.php?option=com_solidres&view=roomtype&layout=edit') */?>"
           class="btn" id="newRoomType"><i class="icon-plus-2"></i> <?php /*echo JText::_('SR_NEW') */?></a>
	</p>-->

	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th><?php echo JText::_('SR_FIELD_ROOM_TYPE_NAME_LABEL') ?></th>
				<th><?php echo JText::_('SR_FIELD_ROOM_TYPE_OCCUPANCY_LABEL') ?></th>
				<th><?php echo JText::_('SR_FIELD_ROOM_TYPE_STATE_LABEL') ?></th>
			</tr>
		</thead>
		<tbody>
			
		<?php
		if ( isset($this->item->roomTypes) )  :
			foreach($this->item->roomTypes as $i) :
				$canCreate	= $user->authorise('core.create',		'com_solidres.roomtype.'.$i->id);
				$canEdit	= $user->authorise('core.edit',			'com_solidres.roomtype.'.$i->id);
				$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $i->checked_out==$user->get('id') || $i->checked_out==0;
				$canChange	= $user->authorise('core.edit.state',	'com_solidres.roomtype.'.$i->id);
		?>
		<tr>
			<td>
				<?php if ($canCreate || $canEdit) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_solidres&task=roomtype.edit&id='.(int) $i->id); ?>">
						<?php echo $this->escape($i->name); ?>
					</a>
				<?php else : ?>
					<?php echo $this->escape($i->name); ?>
				<?php endif; ?>
			</td>
			<td>
				<?php
					echo $i->occupancy_adult.' adults, '.$i->occupancy_child.' childs';
				?>
			</td>
			<td>
				<?php echo ($i->state == 1) ? 'Yes' : 'No' ?>
			</td>
		</tr>
		<?php 
			endforeach;
		endif;
		?>
	</table>
</div>
