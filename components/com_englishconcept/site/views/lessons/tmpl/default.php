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
?>
<div id="content">
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
		<div class="introduction">
			<p></p>
		</div>
		<?php if (count($lessons) > 0) {
			foreach ($lessons as $lesson_id => $lesson) {
				?>
				<div class="heading">
					<h1>
						<img alt="" src="<?php echo Asset::get_filepath_img('lesson-book.png', true)?>">
						<span>Lesson <?php echo $lesson_id; ?></span>
					</h1>
				</div>
				<div class="content">
					<form id="form" enctype="multipart/form-data" method="post" action="#">
						<div style="padding-bottom: 10px;">
							<audio height="100" width="100">
								<source src="<?php echo HTTP_IMAGE.$lesson['script']['script_file_name'] ;?>"/>
							</audio>
							<?php if(!empty($lesson['script']['script_text'])) { ?>
								<div class="hidden-text-expander inline" title="show/hidden lesson content">
									<a class="show_lesson" href="javascript:;">…</a>
								</div>
							<?php } ?>
						</div>
						<?php if(!empty($lesson['script']['script_text'])) { ?>
							<div id="lesson_content" class="hidden" style="padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;" >
								<?php if(isset($lesson['script']['script_text'])) { echo $lesson['script']['script_text']; } ?>
							</div>
						<?php } ?>

						<?php if(!empty($lesson['compre']) && count($lesson['compre']) > 0) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Comprehension Précis and Composition</span>
							</div>
							<table class="list">
								<tbody>
								<?php foreach ($lesson['compre'] as $compre) { ?>
									<tr>
										<td class="left"><?php echo $compre['question_no'].'. '. $compre['question'];?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<?php } ?>

						<?php if(!empty($lesson['key_struct']['text'])) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Key Structures</span>
							</div>
							<div style="padding-bottom: 10px; font-size: 12px; line-height: 18px; padding-left: 2px;">
								<?php echo $lesson['key_struct']['text']; ?>
							</div>
						<?php } ?>

						<?php if(!empty($lesson['special_diff']['text'])) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Special Difficulties</span>
							</div>
							<div>
								<?php echo $lesson['special_diff']['text']; ?>
							</div>
						<?php } ?>

						<?php if(!empty($lesson['exercise']) && count($lesson['exercise']) > 0) {?>
							<div style="background-color: rgb(239, 239, 239); font-weight: bold; margin-top: 0px; padding-top: 5px; padding-bottom: 5px; padding-left: 8px; border-width: 1px; color: #1B0069;">
								<span>Exercises</span>
							</div>
							<table class="list">
								<tbody>
								<?php foreach ($lesson['exercise'] as $exercise) { ?>
									<tr>
										<td class="left"><?php echo $exercise['question_no'].'. '. $exercise['question'];?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</form>
					<div class="pagination">
						<?php if(isset($pagination)){ echo $pagination; }?>
					</div>
				</div>
			<?php
			}
		}
		?>
	</div>
</div>
<script>
	$(document).ready(function () {
		audiojs.events.ready(function() {
			var as = audiojs.createAll();
		});

		$('.show_lesson').bind('click', function() {
			var disp = $('#lesson_content').css('display');
			if (disp == 'none') {
				$('#lesson_content').removeClass('hidden');
			} else {
				$('#lesson_content').addClass('hidden');
			}
		});
	});
</script>