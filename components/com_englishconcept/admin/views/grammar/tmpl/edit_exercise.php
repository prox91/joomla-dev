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
$link = 'index.php?option=com_englishconcept&task=grammarexercise.edit&id=1&tmpl=component&view=grammarexercise&layout=modal';
?>
<?php  ?>
<a id="modal" class="modal btn" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="title">
	<i class="icon-plus-2"></i>
	<?php echo JText::_('SC_COMPREHENSION_NEW_EXERCISE')?>
</a>
<table id="comprehension_question_tbl" class="table" cellspacing="0">
	<thead>
	<tr>
		<th><?php echo JText::_('EC_COMPREHENSION_QUESTION_ACTION'); ?></th>
		<th><?php echo JText::_('EC_COMPREHENSION_QUESTION_NUM'); ?></th>
		<th><?php echo JText::_('EC_COMPREHENSION_QUESTION_TITLE'); ?></th>
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
					<a title="Remove" class="delete-question-tier btn"><i class="icon-minus-sign"></i></a>
				</td>
				<td width="8%">
					<span class="num"><?php echo $i ?></span>
				</td>
				<td width="90%">
                    <input type="hidden" value="<?php echo $value->id ?>" name="jform[question][id][<?php echo $value->id ?>]">
					<input type="text" value="<?php echo $value->question ?>" name="jform[question][title][<?php echo $i ?>]" class="">
				</td>
			</tr>
	<?php
			$i++;
		endforeach;
	endif;
	?>
	</tbody>
</table>
