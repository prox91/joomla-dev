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

        <!--Audio Demo-->
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
        <div id="jp_container_1" class="jp-audio">
            <div class="jp-type-single">
                <div class="jp-gui jp-interface">
                    <ul class="jp-controls">
                        <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                        <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                        <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                        <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                    </ul>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"></div>
                    </div>
                    <div class="jp-time-holder">
                        <div class="jp-current-time"></div>
                        <div class="jp-duration"></div>
                        <ul class="jp-toggles">
                            <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
                            <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
                        </ul>
                    </div>
                </div>
                <div class="jp-title">
                    <ul>
                        <li>Bubble</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="myElement"></div>
        <!--Audio Demo-->

		<div class="clear"></div>
		<div class="introduction">
			<p></p>
		</div>
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
							<audio height="100" width="100">
								<source src="<?php //echo HTTP_IMAGE.$lesson['script']['script_file_name'] ;?>"/>
							</audio>
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
<script>
    jQuery(document).ready(function () {
        audiojs.events.ready(function() {
            var as = audiojs.createAll();
        });

        jQuery('.show_lesson').bind('click', function() {
            var disp = jQuery('#lesson_content').css('display');
            if (disp == 'none') {
                jQuery('#lesson_content').removeClass('hidden');
            } else {
                jQuery('#lesson_content').addClass('hidden');
            }
        });

        jQuery("#jquery_jplayer_1").jPlayer({
            ready:function () {
                jQuery(this).jPlayer("setMedia", {
                    m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
                    oga: "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
                });
            },
            swfPath: "/media/englishconcept/asset/js/jQuery.jPlayer",
            supplied: "m4a, oga"
        });

        jwplayer("myElement").setup({
            playlist: "http://google.com/playlist.rss",
            height: 360,
            listbar: {
                position: 'right',
                size: 320
            },
            width: 960
        });
    });
</script>