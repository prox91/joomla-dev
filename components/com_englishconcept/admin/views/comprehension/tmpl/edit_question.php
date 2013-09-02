<?php
/**
* Created by JetBrains PhpStorm.
* User: Ngoc Nha
* Date: 4/6/13
* Time: 11:20 AM
* To change this template use File | Settings | File Templates.
*/
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<a id="new-question-tier" class="btn">
	<i class="icon-plus-2"></i>
	<?php echo JText::_('SC_COMPREHENSION_NEW_QUESTION')?>
</a>

<table id="comprehension_question_tbl" class="table" cellspacing="0">
	<thead>
	<tr>
		<th><?php echo JText::_('EC_COMPREHENSION_QUESTION_ACTION'); ?></th>
		<th><?php echo JText::_('EC_COMPREHENSION_QUESTION_NUM'); ?></th>
		<th><?php echo JText::_('EC_COMPREHENSION_QUESTION_TITLE'); ?></th>
		<th><?php echo JText::_('EC_COMPREHENSION_QUESTION_STATUS'); ?></th>
	</tr>
	</thead>

	<tbody>
	<?php
	$i = 0;
	if (isset($this->item->questions) && is_array($this->item->questions)) :
		foreach($this->item->questions as $key => $value) :
	?>
			<tr id="question-tier-<?php echo $i ?>" class="question-tier">
				<td width="2%">
					<a title="Remove" class="delete-tier-row btn"><i class="icon-minus-sign"></i></a>
				</td>
				<td width="8%">
					<span class="add-on"><?php echo $i ?></span>
				</td>
				<td width="80%">
					<input type="text" value="<?php echo $value->title ?>" name="jform[question][<?php echo $i ?>][title]" class="">
				</td>
				<td width="10%">
					<?php echo JHtml::_('jgrid.published', $value->published, $i, '', 'cb'); ?>
				</td>
			</tr>
	<?php
			$i++;
		endforeach;
	endif;
	?>
	</tbody>
</table>
