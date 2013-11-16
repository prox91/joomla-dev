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
$exerciseId = $this->state->get('exerciseId');
if(isset($this->item->id) && !empty($this->item->id))
{
	$link = JRoute::_('index.php?option=com_englishconcept&task=usageexercisequestion.apply&view=usageexercisequestion&tmpl=component&layout=modal&exercise_id=' . $exerciseId . '&id=' . $this->item->id);
}
else
{
	$link = JRoute::_('index.php?option=com_englishconcept&task=usageexercisequestion.apply&view=usageexercisequestion&tmpl=component&layout=modal&exercise_id=' . $exerciseId);
}
?>
<form enctype="multipart/form-data"
	action="<?php echo $link; ?>" method="post" name="itemForm" id="itemForm"
	class="form-validate form-horizontal">
	<fieldset class="filter clearfix">
		<div class="btn-toolbar">
			<div class="btn-group pull-left">
				<button type="button" class="btn btn-primary" onclick="this.form.submit();">
					<?php echo JText::_('JAPPLY');?></button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn" onclick="window.parent.SqueezeBox.close();">
					<?php echo JText::_('JTOOLBAR_CLOSE');?></button>
			</div>
			<div class="clearfix"></div>
		</div>
	</fieldset>
	<fieldset>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab"><?php echo JText::_('General')?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="general">
				<fieldset class="adminform" id="general-tab">
					<div class="control-group">
						<div class="control-label">
							<label title="Exercise ID::Exercise ID" class="hasTip required control-label" for="jform_exercise_id" id="jform_exercise_id-lbl">Exercise ID<span class="star">&nbsp;*</span></label>
						</div>
						<div class="controls">
							<input type="text" readonly="readonly" class="readonly required" value="<?php echo $exerciseId; ?>" id="jform_exercise_id" name="jform[exercise_id]">
						</div>
					</div>
					<div class="control-group">
						<a id="new-question-tier" class="btn">
							<i class="icon-plus-2"></i>
							<?php echo JText::_('EC_USAGE_EXERCISE_QUESTION_NEW_QUESTION')?>
						</a>
						<div class="clearfix"></div>
						<table id="comprehension_question_tbl" class="table" cellspacing="0">
							<thead>
							<tr>
								<th width="2%"><?php echo JText::_('EC_USAGE_EXERCISE_QUESTION_ACTION'); ?></th>
								<th width="8%"><?php echo JText::_('EC_USAGE_EXERCISE_QUESTION_NUM'); ?></th>
								<th width="90%"><?php echo JText::_('EC_USAGE_EXERCISE_QUESTION_TITLE'); ?></th>
							</tr>
							</thead>

							<tbody>
							<?php
							$i = 1;
							if (isset($this->item->questions) && is_array($this->item->questions)) :
								foreach($this->item->questions as $key => $value) :
									?>
									<tr id="question-tier-<?php echo $i ?>" class="question-tier">
										<td>
											<a title="Remove" class="delete-question-tier btn"><i class="icon-minus-sign"></i></a>
										</td>
										<td>
											<span class="num"><?php echo $i ?></span>
										</td>
										<td>
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
					</div>
				</fieldset>
			</div>
		</div>
	</fieldset>
	<input type="hidden" name="jform[id]" value="<?php if(isset($this->item->id)){echo $this->item->id;}?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>
<script type="text/javascript">
	var rowId = 1;
	<?php
	if (isset($this->item->questions) && is_array($this->item->questions)) :
		if(count($this->item->questions) > 0) :
	?>
	rowId = <?php echo count($this->item->questions) + 1; ?>;
	<?php
		endif;
	endif;
	?>
	jQuery(document).ready(function($) {
		$('#new-question-tier').click(function(event) {
			event.preventDefault();
			initialRowQuestion(rowId);
			rowId++;
		});

		function initialRowQuestion(rowId) {
			$('#comprehension_question_tbl tbody').append('<tr id="'+rowId+'"></tr>');

			var rowData = $('#' + rowId);
			var htmlStr = "";
			htmlStr += "<td><a class='delete-question-tier btn'><i class='icon-minus-sign'></i></a></td>";
			htmlStr += "<td><span class='num'>"+rowId+"</span></td>";
			htmlStr += "<input type='hidden' value='' name='jform[question][id]["+rowId+"]'>";
			htmlStr += "<td><input type='text' value='' name='jform[question][title]["+rowId+"]' class=''></td>";

			rowData.append(htmlStr);
			bindDeleteQuestionRowEvent();
		}

		var bindDeleteQuestionRowEvent = function() {
			$('.delete-question-tier').unbind().click(function() {
				$(this).parent().parent().remove();
				rowId--;
			});
		};

		bindDeleteQuestionRowEvent();
	});
</script>
