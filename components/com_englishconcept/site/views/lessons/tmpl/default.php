<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/4/13
 * Time: 11:04 PM
 * To change this template use File | Settings | File Templates.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$input = JFactory::getApplication()->input;
$start = $input->get->get('start', 0, 'INT');
$numLesson = 1;
if(!empty($start))
{
    $numLesson = $start + 1;
}
?>
<div id="lesson-content">
	<div class="box">
		<!--
		<div id="media">
			<div class="mainpageimage">
				<img src="<?php //echo Asset::get_filepath_img('media_pic.jpg', true)?>"
					alt="English Courses in Cairns"
					title="English Courses in Cairns">
			</div>
		</div>
		 -->
		<div class="clear"></div>
		<?php if (count($this->lessons) > 0) {
			foreach ($this->lessons as $lesson) {
				?>
				<div class="heading">
					<h1>
						<img alt="" src="<?php //echo Asset::get_filepath_img('lesson-book.png', true)?>">
						<span>Lesson <?php echo $numLesson; ?></span>
					</h1>
				</div>
				<div class="content">
					<form id="form" enctype="multipart/form-data" method="post" action="#">
						<div style="padding-bottom: 10px;">
							<div height="100" width="100" id="audio"></div>
							<?php //if(!empty($lesson['script']['script_text'])) { ?>
								<div class="hidden-text-expander inline" title="show/hidden lesson content">
									<a class="show_lesson" href="javascript:;">…</a>
								</div>
							<?php //} ?>
						</div>
						<?php //if(!empty($lesson['script']['script_text'])) { ?>
							<div id="lesson_content" class="hidden" style="padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;" >
								<?php //if(isset($lesson['script']['script_text'])) { echo $lesson['script']['script_text']; } ?>
							</div>
						<?php //} ?>

						<?php //if(!empty($lesson['compre']) && count($lesson['compre']) > 0) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Comprehension Précis and Composition</span>
							</div>
							<table class="list">
								<tbody>
								<?php //foreach ($lesson['compre'] as $compre) { ?>
									<tr>
										<td class="left"><?php //echo $compre['question_no'].'. '. $compre['question'];?></td>
									</tr>
								<?php //} ?>
								</tbody>
							</table>
						<?php //} ?>

						<?php //if(!empty($lesson['key_struct']['text'])) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Key Structures</span>
							</div>
							<div style="padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;">
								<?php //echo $lesson['key_struct']['text']; ?>
							</div>
						<?php //} ?>

						<?php //if(!empty($lesson['special_diff']['text'])) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Special Difficulties</span>
							</div>
							<div>
								<?php //echo $lesson['special_diff']['text']; ?>
							</div>
						<?php //} ?>

						<?php //if(!empty($lesson['exercise']) && count($lesson['exercise']) > 0) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Exercises</span>
							</div>
							<table class="list">
								<tbody>
								<?php //foreach ($lesson['exercise'] as $exercise) { ?>
									<tr>
										<td class="left"><?php //echo $exercise['question_no'].'. '. $exercise['question'];?></td>
									</tr>
								<?php //} ?>
								</tbody>
							</table>
						<?php //} ?>
					</form>
					<div class="pagination">
                        <?php if(isset($this->pagination)){ echo $this->pagination->getListFooter(); }?>
					</div>
				</div>
			<?php
			}
		}
		?>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.show_lesson').bind('click', function() {
            var disp = jQuery('#lesson_content').css('display');
            if (disp == 'none') {
                jQuery('#lesson_content').removeClass('hidden');
            } else {
                jQuery('#lesson_content').addClass('hidden');
            }
        });
    });

    jwplayer("audio").setup({
	    //autostart: true,
	    file:"<?php echo JUri::root(); ?>media/englishconcept/audio/3bb12ead6413df21b3b25ec831dfc945.mp3",
	    flashplayer:"<?php echo JUri::root(); ?>media/englishconcept/assets/js/jwplayer/jwplayer.flash.swf"
    });
</script>