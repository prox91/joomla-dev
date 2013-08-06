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
		<a href="<?php /*echo JRoute::_('index.php?option=com_solidres&view=extra&layout=edit')*/?>" class="btn" id="newExtra"><i class="icon-plus-2"></i> <?php /*echo JText::_('SR_NEW') */?></a>
	</p>-->

	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th>Name</th>	
				<th>Price</th>
				<th>State</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if( isset($this->item->extras) )
			{
				foreach($this->item->extras as $i)
				{
					$canCreate	= $user->authorise('core.create',		'com_solidres.extra.'.$i->id);
					$canEdit	= $user->authorise('core.edit',			'com_solidres.extra.'.$i->id);
					$canChange	= $user->authorise('core.edit.state',	'com_solidres.extra.'.$i->id);
			?>
			<tr>
				<td>
					<?php if ($canCreate || $canEdit) : ?>
						<a href="<?php echo JRoute::_('index.php?option=com_solidres&task=extra.edit&id='.(int) $i->id); ?>">
							<?php echo $this->escape($i->name); ?>
						</a>
					<?php else : ?>
						<?php echo $this->escape($i->name); ?>
					<?php endif; ?>
				</td>
				<td>
					<?php echo $i->price ?>
				</td>
				<td>
					<?php echo ($i->state == 1) ? 'Yes' : 'No' ?>
				</td>
			</tr>
			<?php 
				} 
			}

			?>
		</tbody>
	</table>
</div>
