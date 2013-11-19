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

<script type="text/javascript">
    var rowId = 1;
    <?php
    if (isset($this->item->questions) && is_array($this->item->questions)) :
        if(count($this->item->questions) > 0) :
    ?>
        rowId = <?php echo count($this->item->questions); ?>;
    <?
        endif;
    endif;
    ?>
    jQuery(document).ready(function($) {
        jQuery('#new-question-tier').click(function(event) {
            event.preventDefault();
            initialRowQuestion(rowId);
            rowId++;
        });

        function initialRowQuestion(rowId) {
            jQuery('#comprehension_question_tbl tbody').append('<tr id="'+rowId+'"></tr>');

            var rowData = jQuery('#' + rowId);
            var htmlStr = "";
            htmlStr += "<td width='2%'><a class='delete-question-tier btn'><i class='icon-minus-sign'></i></a></td>";
            htmlStr += "<td width='8%'><span class='num'>"+rowId+"</span></td>";
            htmlStr += "<input type='hidden' value='' name='jform[question][id]["+rowId+"]'>";
            htmlStr += "<td width='90%'><input type='text' value='' name='jform[question][title]["+rowId+"]' class=''></td>";

            rowData.append(htmlStr);
            bindDeleteQuestionRowEvent();
        }

        var bindDeleteQuestionRowEvent = function() {
            jQuery('.delete-question-tier').unbind().click(function() {
                jQuery(this).parent().parent().remove();
                rowId--;
            });
        };

        bindDeleteQuestionRowEvent();
    });
</script>
