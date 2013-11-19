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
		<?php if (!empty($this->lesson)): ?>
			<div class="heading">
				<h3 style="margin-top:12px; margin-bottom:0px;">
					<img src="<?php echo JUri::root(). 'media/englishconcept/assets/images/lesson-book.png';?>" style="margin-top: -12px;">
					<span>Lesson <?php echo $numLesson; ?></span>
				</h3>
			</div>
			<div class="content">
				<form id="form" enctype="multipart/form-data" method="post" action="#">
					<div style="padding-bottom: 10px;">
						<div height="100" width="100" id="audio"></div>
						<?php if(!empty($this->lesson->text)): ?>
							<div class="hidden-text-expander inline" title="show/hidden lesson content">
								<a class="show_lesson" href="javascript:;">…</a>
							</div>
						<?php endif; ?>
					</div>
					<?php if(!empty($this->lesson->text)): ?>
						<div id="lesson_content" class="hidden" style="padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;" >
							<?php echo $this->lesson->text; ?>
						</div>
					<?php endif; ?>

					<?php if(!empty($this->lesson->comprenhensions)): ?>
						<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
							<span>Comprehension Précis and Composition</span>
						</div>
						<?php if(!empty($this->lesson->comprenhensions->questions)): ?>
						<table class="list">
							<tbody>
							<tr>
								<td class="left">
									<?php echo $this->lesson->comprenhensions->description; ?>
								</td>
							</tr>
							<?php foreach ($this->lesson->comprenhensions->questions as $key => $question): ?>
								<tr>
									<td class="left"><?php echo ($key + 1) .'. '. $question->question; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
						<?php endif; ?>
					<?php endif; ?>

					<?php if(!empty($this->lesson->grammars)): ?>
						<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
							<span>Key Structures</span>
						</div>
						<div style="padding-left: 8px; padding-bottom: 10px; font-size: 12px; line-height: 18px; border-collapse: collapse; border: 1px solid rgb(221, 221, 221); margin-bottom: 20px;">
							<?php echo $this->lesson->grammars->description; ?>
                            <?php if(!empty($this->lesson->grammars->exercises)): ?>
                                <div>
                                    <?php foreach($this->lesson->grammars->exercises as $exercise): ?>
                                        <?php echo $exercise->exercise_text; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if(!empty($this->lesson->usages)): ?>
						<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
							<span>Special Difficulties</span>
						</div>
						<div style="padding-left: 8px; padding-bottom: 10px; font-size: 12px; line-height: 18px; border-collapse: collapse; border: 1px solid rgb(221, 221, 221); margin-bottom: 20px;">
							<?php echo $this->lesson->usages->description; ?>
                            <?php if(!empty($this->lesson->usages->exercises)): ?>
                                <div>
                                    <?php foreach($this->lesson->usages->exercises as $exercise): ?>
                                        <?php echo $exercise->exercise_text; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if(!empty($this->lesson->exercises)): ?>
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
					<?php endif; ?>
				</form>
			</div>

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
					height: "30px",
					width: "90%",
					file:"<?php echo JUri::root(); ?>media/englishconcept/media/audio/<?php if(!empty($this->lesson->audio_url_hash)) { echo $this->lesson->audio_url_hash;} ?>",
					flashplayer:"<?php echo JUri::root(); ?>media/englishconcept/assets/js/jwplayer/jwplayer.flash.swf"
				});
			</script>
		<?php endif; ?>
	</div>
	<?php if(isset($this->pagination)):?>
		<?php echo $this->pagination->getListFooter(); ?>
	<?php endif; ?>
</div>
<div class="clear"></div>
