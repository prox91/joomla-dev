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
$link = JRoute::_('index.php?option=com_englishconcept&tmpl=component&view=usageexercise&layout=modal&usage_id=' . $this->item->id . '&' . JSession::getFormToken() . '=1');
?>
<?php ?>
<a id="modal" class="modal btn" href="<?php echo $link; ?>"
   rel="{handler: 'iframe', size: {x: 900, y: 550}, onClose:function(){var js = window.location.reload();}}"
   title="title">
    <i class="icon-plus-2"></i>
    <?php echo JText::_('EC_COMPREHENSION_NEW_EXERCISE') ?>
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
                    <a title="Remove" class="delete-question-tier btn"
                       onclick="deleteExercise(this, <?php echo $value->id; ?>);"><i class="icon-minus-sign"></i></a>
                </td>
                <td>
                    <span class="num"><?php echo $i ?></span>
                </td>
                <td>
                    <?php
                    $linkEdit = JRoute::_('index.php?option=com_englishconcept&tmpl=component&view=usageexercise&layout=modal&usage_id=' . $this->item->id . '&id=' . $value->id . '&' . JSession::getFormToken() . '=1');
                    ?>
                    <a id="modal" class="modal" href="<?php echo $linkEdit; ?>"
                       rel="{handler: 'iframe', size: {x: 900, y: 550}, onClose:function(){var js = window.location.reload();}}"
	                    title="<?php //echo $value->exercise_text; ?>"><?php echo $this->escape($value->title); ?></a>
                </td>
                <td>
                    <?php
                    $linkAddQuestion = JRoute::_('index.php?option=com_englishconcept&tmpl=component&view=usageexercisequestion&layout=modal&exercise_id=' . $value->id . '&' . JSession::getFormToken() . '=1');
                    ?>
                    <a id="modal" class="modal" href="<?php echo $linkAddQuestion; ?>"
                       rel="{handler: 'iframe', size: {x: 900, y: 550}}"
                       title=""><?php echo JText::_('EC_COMPREHENSION_QUESTION_ADD_MODIFY'); ?></a>
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
    endif;
    ?>
    </tbody>
</table>
<div id="dialogBox" style="display: none;">Do you want to delete?</div>
<script type="text/javascript">
    function deleteExercise(obj, id) {
        jQuery(document).ready(function ($) {
            jQuery('#dialogBox').dialog({
                height: 140,
                autoOpen: true,
                modal: true,
                resizable: false,
                show: {
                    effect: "blind",
                    duration: 100
                },
                hide: {
                    effect: "blind",
                    duration: 100
                },
                buttons: {
                    'Delete': function () {
                        deleteViaAjax(obj, id);
                        jQuery(this).dialog("close");
                    },
                    'Cancel': function () {
                        jQuery(this).dialog("close");
                    }
                }
            });

        });
    }

    function deleteViaAjax(obj, id) {
        jQuery(document).ready(function ($) {
            // Delete exercise through ajax
            jQuery.ajax({
                type: "GET",
                url: "<?php echo JRoute::_('index.php?option=com_englishconcept&task=usageexercise.delete&format=json', false); ?>&id=" + id,
                success: function (result, status, xhr) {
                    var result = jQuery.parseJSON(result);
                    if (result.status) {
                        jQuery(obj).parent().parent().remove();
                        var html = "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                        html += "<div class=\"alert alert-success\">";
                        html += "Delete successful!";
                        html += "</div>";
                        jQuery('#system-message-container').html(html);
                    } else {
                        var html = "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                        html += "<div class=\"alert alert-error\">";
                        html += "Delete unsuccessful!";
                        html += "</div>";
                        jQuery('#system-message-container').html(html);
                    }
                },
                error: function (xhr, status, error) {
                    var html = "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                    html += "<div class=\"alert alert-error\">";
                    html += "Delete unsuccessful!";
                    html += "</div>";
                    jQuery('#system-message-container').html(html);
                }
            });
        });
    }
</script>