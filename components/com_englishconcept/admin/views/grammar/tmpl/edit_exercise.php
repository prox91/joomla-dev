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
$link = JRoute::_('index.php?option=com_englishconcept&tmpl=component&view=grammarexercise&layout=modal&grammar_id=' . $this->item->id . '&' . JSession::getFormToken() . '=1');
?>
<?php ?>
<a id="modal" class="modal btn" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}, onClose:function(){var js = window.location.reload();}}" title="title">

	<!-- onClick:function(){window.parent.location.reload();} -->
	<!-- onClose:function(){var js = window.location.reload();} -->

	<i class="icon-plus-2"></i>
	<?php echo JText::_('EC_COMPREHENSION_NEW_EXERCISE')?>
</a>
<table id="comprehension_question_tbl" class="table" cellspacing="0">
	<thead>
	<tr>
		<th width="2%"><?php echo JText::_('EC_COMPREHENSION_QUESTION_ACTION'); ?></th>
		<th width="6%"><?php echo JText::_('EC_COMPREHENSION_QUESTION_NUM'); ?></th>
		<th width="75%"><?php echo JText::_('EC_COMPREHENSION_QUESTION_TITLE'); ?></th>
		<th width="17%"><?php echo JText::_('EC_COMPREHENSION_QUESTION_ADD'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	if (isset($this->item->exercises) && is_array($this->item->exercises)) :
		foreach ($this->item->exercises as $key => $value) :
			?>
			<tr id="question-tier-<?php echo $i ?>" class="question-tier">
				<td>
					<a title="Remove" class="delete-question-tier btn" onclick="deleteExercise('<?php echo $value->id; ?>');"><i class="icon-minus-sign"></i></a>
				</td>
				<td>
					<span class="num"><?php echo $i ?></span>
				</td>
				<td>
					<?php
					$linkEdit = JRoute::_('index.php?option=com_englishconcept&tmpl=component&view=grammarexercise&layout=modal&grammar_id=' . $this->item->id . '&id=' . $value->id . '&' . JSession::getFormToken() . '=1');
					?>
					<a id="modal" class="modal" href="<?php echo $linkEdit; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}, onClose:function(){var js = window.location.reload();}}" title=""><?php echo $value->exercise_text ?></a>
				</td>
				<td>
					<?php
					$linkAddQuestion = JRoute::_('index.php?option=com_englishconcept&tmpl=component&view=grammarexercisequestion&layout=modal&exercise_id=' . $value->id . '&' . JSession::getFormToken() . '=1');
					?>
					<a id="modal" class="modal" href="<?php echo $linkAddQuestion; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title=""><?php echo JText::_('EC_COMPREHENSION_QUESTION_ADD_MODIFY'); ?></a>
				</td>
			</tr>
			<?php
			$i++;
		endforeach;
	endif;
	?>
	</tbody>
</table>
<div id="dialog_box" style="display: none;">
	Do you want to delete?
</div>
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
//	jQuery(document).ready(function ($) {
//		var bindDeleteQuestionRowEvent = function (e) {
//			$('.delete-question-tier').unbind().click(function (e) {
//				// Confirm message before delete
////				$('#dialog_box').dialog({
////					title    : 'Alert Dialog',
////					width    : 265,
////					height   : 150,
////					modal    : true,
////					resizable: false,
////					draggable: false,
////					buttons  : [
////						{
////							text : 'Yes, delete it!',
////							click: function () {
////								// Delete through ajax
////
////								// Remove from list
////								$(this).parent().parent().remove();
////								rowId--;
////								return true;
////							}
////						},
////						{
////							text : 'No',
////							click: function () {
////								$(this).dialog('close');
////								return false;
////							}
////						}
////					]
////				});
//				var x = e;
//			});
//		};
//		bindDeleteQuestionRowEvent();
//
//	});


	function deleteExercise(id)	{
		jQuery(document).ready(function ($) {
			// Remove through ajax
			$.ajax(	{
					type: "GET",
					url: "<?php echo JRoute::_('index.php?option=com_englishconcept&task=grammar.delete&format=json', false); ?>&id=" + id
			});
		});
	}
</script>