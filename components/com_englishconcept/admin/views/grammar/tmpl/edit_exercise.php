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
//$link = 'index.php?option=com_englishconcept&task=grammar.edit&id=1&tmpl=component&view=grammar&layout=modal';
$link = JRoute::_('index.php?option=com_englishconcept&tmpl=component&view=grammarexercise&layout=modal&exercise_id=' . $this->item->id);
?>
<?php  ?>
<a id="modal" class="modal btn" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}, onClose:function(){var js = window.location.reload();}}" title="title">

    <!-- onClick:function(){window.parent.location.reload();} -->
    <!-- onClose:function(){var js = window.location.reload();} -->

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
	if (isset($this->item->exercises) && is_array($this->item->exercises)) :
		foreach($this->item->exercises as $key => $value) :
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
                    <?php
                    $linkEdit = JRoute::_('index.php?option=com_englishconcept&task=grammarexercise.apply&view=grammarexercise&tmpl=component&layout=modal&exercise_id=' . $this->item->id . '&id=' . $value->id . '&token=' .JSession()::getFormToken());
                    ?>
					<a href="<?php echo $linkEdit; ?>" title=""><?php echo $value->exercise_text ?></a>
				</td>
			</tr>
	<?php
			$i++;
		endforeach;
	endif;
	?>
	</tbody>
</table>
<script type="text/javascript">
    var rowId = 1;
    <?php
    if (isset($this->item->questions) && is_array($this->item->questions)) :
        if(count($this->item->questions) > 0) :
    ?>
    rowId = <?php echo count($this->item->questions); ?>;
    <?php
        endif;
    endif;
    ?>
    jQuery(document).ready(function($) {
        var bindDeleteQuestionRowEvent = function() {
            $('.delete-question-tier').unbind().click(function() {
                $(this).parent().parent().remove();
                rowId--;
            });
        };

        bindDeleteQuestionRowEvent();
    });
</script>