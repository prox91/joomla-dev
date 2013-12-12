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
JHtml::_('jquery.framework');
JText::script('JGLOBAL_SELECT_SOME_OPTIONS');
JText::script('JGLOBAL_SELECT_AN_OPTION');
JText::script('JGLOBAL_SELECT_NO_RESULTS_MATCH');
JText::script('JGLOBAL_KEEP_TYPING');
JText::script('JGLOBAL_LOOKING_FOR');

JHtml::_('script', 'jui/chosen.jquery.js', false, true, false, false, $debug);
JHtml::_('stylesheet', 'jui/chosen.css', false, true);
JHtml::_('script', 'jui/ajax-chosen.js', false, true, false, false, $debug);
?>
<fieldset class="adminform" id="general-tab">
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('lesson_id'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('lesson_id'); ?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('title'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('title'); ?>
		</div>
	</div>
<!--	<div class="control-group">-->
<!--		<div class="control-label">-->
<!--			--><?php //echo $this->form->getLabel('diffspecial_ref'); ?>
<!--		</div>-->
<!--		<div class="controls">-->
<!--			--><?php //echo $this->form->getInput('diffspecial_ref'); ?>
<!--		</div>-->
<!--	</div>-->
	<div class="control-group">
		<div class="control-label">
			Difficult Special Ref
		</div>
		<div class="controls">
			<select id="diffspecial_ref" data-live-search="true" multiple name="jform[diffspecial_ref][]">
				<option>Mustard</option>
				<option>Ketchup</option>
				<option>Relish</option>
			</select>
		</div>
	</div>

	<div class="control-group">
		<div class="control-label">
			<?php echo $this->form->getLabel('description'); ?>
		</div>
		<div class="controls">
			<?php echo $this->form->getInput('description'); ?>
		</div>
	</div>
</fieldset>

<script type="text/javascript">
	(function ($) {
		$(document).ready(function () {
			var customTagPrefix = '#new#';
			// Method to add tags pressing enter
			$('#advancedSelect_chzn input').keydown(function (event) {
				// Tag is greater than 3 chars and enter pressed
				if (this.value.length > 3 && (event.which === 13 || event.which === 188)) {

					// Search an highlighted result
					var highlighted = $('#advancedSelect_chzn').find('li.active-result.highlighted').first();

					// Add the highlighted option
					if (event.which === 13 && highlighted.text() !== '') {
						// Extra check. If we have added a custom tag with this text remove it
						var customOptionValue = customTagPrefix + highlighted.text();
						$('#advancedSelect option').filter(function () {
							return $(this).val() == customOptionValue;
						}).remove();

						// Select the highlighted result
						var tagOption = $('#advancedSelect option').filter(function () {
							return $(this).html() == highlighted.text();
						});
						tagOption.attr('selected', 'selected');
					}
					// Add the custom tag option
					else {
						var customTag = this.value;

						// Extra check. Search if the custom tag already exists (typed faster than AJAX ready)
						var tagOption = $('#advancedSelect option').filter(function () {
							return $(this).html() == customTag;
						});
						if (tagOption.text() !== '') {
							tagOption.attr('selected', 'selected');
						}
						else {
							var option = $('<option>');
							option.text(this.value).val(customTagPrefix + this.value);
							option.attr('selected', 'selected');

							// Append the option an repopulate the chosen field
							$('#advancedSelect').append(option);
						}
					}

					this.value = '';
					$('#diffspecial_ref').trigger('liszt:updated');
					event.preventDefault();

				}
			});
		});
	})(jQuery);

	(function ($) {
		$('#diffspecial_ref').chosen({
			disable_search_threshold: 10,
			allow_single_deselect   : true,
			no_results_text         : "Oops, nothing found!"
		});
	}(jQuery));

	(function ($) {
		$('#diffspecial_ref').ajaxChosen({
				dataType      : 'json',
				type          : 'GET',
				url           : '<?php echo JUri::base() .'index.php?option=com_englishconcept&view=usage&task=usage.searchAjax'; ?>',
				jsonTermKey   : 'like',
				afterTypeDelay: '500',
				minTermLength : '3'
			},
			function (data) {
				var results = [];
				$.each(data, function (i, val) {
					results.push({ value: val.value, text: val.text });
				});
				return results;
			}
		);
	}(jQuery));
</script>
