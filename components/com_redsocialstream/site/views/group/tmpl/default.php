<?php
/**
 * @copyright Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license   GNU/GPL, see license.txt or http://www.gnu.org/copyleft/gpl.html
 *            Developed by email@recomponent.com - redCOMPONENT.com
 *
 * redSocialstream can be downloaded from www.redcomponent.com
 * redSocialstream is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.
 *
 * You should have received a copy of the GNU General Public License
 * along with redSocialstream; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
defined('_JEXEC') or die;
?>
<script language='javascript'>

	function last_msg_funtion() {

		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			if (document.getElementById("currentlimit")) {
				var currentlimit = document.getElementById("currentlimit").value;
			}
			if (document.getElementById("limit")) {
				var limit = document.getElementById("limit").value;
			}

			var finallimit = parseFloat(currentlimit) + parseFloat(limit);
			if (document.getElementById("currentlimit")) {
				document.getElementById("currentlimit").value = finallimit;
			}
			var url = site_url + 'index.php?option=com_redsocialstream&format=raw&view=group&task=getajaxposts&groupid=' + '<?php echo $this->groupinfo[0]->id; ?>' + '&limit=' + finallimit + '<?php if($this->profiletypeid != "" ){ echo "&profiletypeid=".$this->profiletypeid;}?>';
			if (document.getElementById("button_nextposts")) {
				document.getElementById("button_nextposts").innerHTML = "<img src='" + site_url + "administrator/components/com_redsocialstream/assets/images/preloader.gif'>&nbsp;" + COM_REDSOCIALSTREAM_NEXT_POSTS;
			}
			var data = '';

			var request = new Request({

				url: url,

				method: 'post',

				data: data,

				async: true,

				onSuccess: function (responseText) {

					if (responseText) {

						$$('[class$=redsocial_wrapper]').set('html', responseText);
						$$('[class$=button max limit]').set('html', "");
					}
				}


			}).send();
		}


	}
	;
	$(window).scroll(function () {
		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			last_msg_funtion();
		}
	});

	$(document).ready(function (evt) {
		if (document.getElementById("currentlimit")) {
			var currentlimit = document.getElementById("currentlimit").value;
		}

		var url = site_url + 'index.php?option=com_redsocialstream&format=raw&view=group&task=save&groupid=' + '<?php echo $this->groupinfo[0]->id; ?>' + '&limit=' + currentlimit + '<?php if($this->profiletypeid != "" ){ echo "&profiletypeid=".$this->profiletypeid;}?>';
		var data = '';
		var request = new Request({

			url: url,

			method: 'post',

			data: data,

			async: true,

			onSuccess: function (responseText) {

				var url = site_url + 'index.php?option=com_redsocialstream&format=raw&view=group&task=getajaxposts&groupid=' + '<?php echo $this->groupinfo[0]->id; ?>' + '&limit=' + currentlimit + '<?php if($this->profiletypeid != "" ){ echo "&profiletypeid=".$this->profiletypeid;}?>';

				var data = '';

				var request = new Request({

					url: url,

					method: 'post',

					data: data,

					async: true,

					onSuccess: function (responseText) {

						$$('[class$=redsocial_wrapper]').set('html', responseText);

					}

				}).send();

			}

		}).send();
	});
</script>
<?php
$doc = JFactory::getDocument();
$script = "window.COM_REDSOCIALSTREAM_NEXT_POSTS = '" . JText::_('COM_REDSOCIALSTREAM_NEXT_POSTS') . "';
	 window.site_url = '" . JURI::root() . "';";
$doc->addScriptDeclaration($script);
function sec2hms($sec, $padHours = false)
{
	// start with a blank string
	$hms = "";

	// do the hours first: there are 3600 seconds in an hour, so if we divide
	// the total number of seconds by 3600 and throw away the remainder, we're
	// left with the number of hours in those seconds
	$hours = intval(intval($sec) / 3600);

	// add hours to $hms (with a leading 0 if asked for)
	$hms .= ($padHours)
		? str_pad($hours, 2, "0", STR_PAD_LEFT) . ":"
		: $hours . ":";

	// dividing the total seconds by 60 will give us the number of minutes
	// in total, but we're interested in *minutes past the hour* and to get
	// this, we have to divide by 60 again and then use the remainder
	$minutes = intval(($sec / 60) % 60);

	// add minutes to $hms (with a leading 0 if needed)
	$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":";

	// seconds past the minute are found by dividing the total number of seconds
	// by 60 and using the remainder
	$seconds = intval($sec % 60);

	// add seconds to $hms (with a leading 0 if needed)
	$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

	// done!
	return $hms;
}
function makeLink($string)
{
// Function to convert url to a link

	/*** make sure there is an http:// on all URLs ***/
	$string = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i", "$1http://$2", $string);

	/*** make all URLs links ***/
	$string = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i", "<a target=\"_blank\" href=\"$1\">$1</A>", $string);

	/*** make all emails hot links ***/
	$string = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i", "<A HREF=\"mailto:$1\">$1</A>", $string);

	return $string;
}
?>
<div class="redsocial_wrapper">
	<?php


	if ($this->groupinfo != "")
	{
		echo "<div class=\"redsocail_group_header\">
			<div class=\"redsocial_group_title\"><h1>" . $this->groupinfo[0]->introtitle . "</h1></div>
			<div class=\"redsocial_group_teaser\"><p>" . $this->groupinfo[0]->subtitle . "</p></div>
		</div>";
	}
	if ($this->posts != "" && isset($this->posts[0]))
	{
		echo"<div class=\"redsocial_group\">";
		foreach ($this->posts as $feeditem)
		{
			if ($feeditem->type_title == 'facebook')
			{
				echo    "<div class=\"" . $feeditem->type_title . "\">";
				echo    "<div class=\"left_" . $feeditem->type_title . "_box\" style='float:left';>";
				echo    "<img src=\"components/com_redsocialstream/images/" . $feeditem->type_title . ".jpg\" class=\"icon_" . $feeditem->type_title . "\" />";
				echo    "</div>";
				echo    "<div class=\"title_" . $feeditem->type_title . "_box\" style='float:left';><h2>";
				echo    $feeditem->ext_post_name;
				echo    "</h2></div>";
				echo    "<div class=\"date_" . $feeditem->type_title . "_box\" style='float:right';>";
				echo    JHtml::date($feeditem->created_time, 'l d/m/y H:i');
				echo    "</div>";
				echo    "<div class=\"right_" . $feeditem->type_title . "_box\" style='padding-top:50px;'>";
				echo    "<div style=\"display:block;float:left;width:100px;\" >";
						$facebookprofilepictureurl = "https://graph.facebook.com/" . $feeditem->ext_profile_id . "/picture";
				echo    "<img src=\"" . $facebookprofilepictureurl . "\" class=\"profile_" . $feeditem->type_title . "_image\" />";
				echo    "</div>";
				echo    "<div style=\"display:block;\">";
				echo    "<div class=\"redsocial_description " . $feeditem->type_title . "\">";
				echo    $feeditem->message;
				echo    "</div>";
				echo    "</div>";
				echo    "<div style='float:right';>";
						$facebooklink = explode("_", $feeditem->ext_post_id);
				echo    "<a href=\"http://www.facebook.com/" . $facebooklink[0] . "\">" . JText::_('COM_REDSOCIALSTREAM_READMORE') . "</a>";
				echo    "</div>";
				echo    "</div >";
				echo    "<div style=\"clear:both;\"></div>";
				echo    "</div><br/><hr/><br/>";
			}
			if ($feeditem->type_title == 'twitter')
			{


				echo    "<div class=\"" . $feeditem->type_title . "\">";
				echo    "<div class=\"left_" . $feeditem->type_title . "_box\" style='float:left';>";
				echo    "<img src=\"components/com_redsocialstream/images/" . $feeditem->type_title . ".jpg\"  class=\"icon_" . $feeditem->type_title . "\">";
				echo    "</div>";
				echo    "<div class=\"title_" . $feeditem->type_title . "_box\" style='float:left';><h2>";
				echo    $feeditem->ext_post_name;
				echo    "</h2></div>";
				echo    "<div class=\"date_" . $feeditem->type_title . "_box\" style='float:right';>";
				echo    JHtml::date($feeditem->created_time, 'l d/m/y H:i');
				echo    "</div>";
				echo    "<div class=\"right_" . $feeditem->type_title . "_box\" style='padding-top:50px;'>";
				echo    "<div style=\"display:block;float:left;width:100px;\" >";
				echo    "<img src=\"" . $feeditem->thumb_uri . "\" class=\"profile_" . $feeditem->type_title . "_image\"\">";
				echo    "</div>";
				echo    "<div class=\"redsocial_description " . $feeditem->type_title . "\">";
				echo    makeLink($feeditem->message);
				echo    "</div>";
				echo    "<div style='float:right';>";
				echo    "<a href=\"http://twitter.com/#!/" . $feeditem->ext_post_name . "\">" . JText::_('COM_REDSOCIALSTREAM_READMORE') . "</a>";
				echo    "</div>";
				echo    "</div>";
				echo    "<div style=\"clear:both;\"></div>";
				echo    "</div><br/><hr/><br/>";
			}
			if ($feeditem->type_title == 'youtube')
			{
				echo    "<div class=\"" . $feeditem->type_title . "\">";
				echo    "<div class=\"left_" . $feeditem->type_title . "_box\" style='float:left';>";
				echo    "<img src=\"components/com_redsocialstream/images/" . $feeditem->type_title . ".jpg\" class=\icon_" . $feeditem->type_title . "\">";

				echo    "</div>";

				echo    "<div  class=\"title_" . $feeditem->type_title . "_box\" style='float:left';><h2>";
				echo    $feeditem->ext_post_name;
				echo    "</h2></div>";
				echo    "<div class=\"date_" . $feeditem->type_title . "_box\" style='float:right';>";
				echo JHtml::date($feeditem->created_time, 'l d/m/y H:i');
				echo    "</div>";
				echo    "<div  class=\"right_" . $feeditem->type_title . "_box\" style='padding-top:50px;'>";
				echo    "<div style=\"display:block;float:left;width:100px;\" >";
				echo    "<img src=\"" . $feeditem->thumb_uri . "\" class=\"profile_" . $feeditem->type_title . "_image\">";
				echo    "</div>";
				echo    "<div>";
				$i = 0;
				$desc = "";
				echo    "<div class=\"youtube_video_title\">";
				echo    $feeditem->title;
				echo    "</div>";
				echo    "<iframe width=\"560\" height=\"315\" src=\"" . $feeditem->source_link . "\" frameborder=\"0\" allowfullscreen></iframe>";
				echo    "<div class=\"youtube_duration\">";
				echo    sec2hms($feeditem->duration);
				echo    "</div>";
				echo    "<div>";
				echo    "<div class=\"redsocial_description " . $feeditem->type_title . "\">";
				preg_match_all('/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}[^<]*/', str_replace("\n", "<br />", $feeditem->message), $out, PREG_PATTERN_ORDER);
				foreach ($out[0] as $link)
				{
					$feeditem->message = str_replace($link, "<a href=\"" . $link . "\">" . $link . "</a>", $feeditem->message);

				}
				echo    str_replace("\n", "<br />", $feeditem->message);
				echo    "</div>";
				echo    "</div>";
				echo    "</div>";
				echo    "</div>";
				echo    "<div style=\"clear:both;\"></div>";
				echo    "</div><br/><hr/><br/>";
			}
			if ($feeditem->type_title == 'linkedin')
			{
				echo    "<div class=\"" . $feeditem->type_title . "\">";
				echo    "<div class=\"left_" . $feeditem->type_title . "_box\" style='float:left';>";
				echo    "<img src=\"components/com_redsocialstream/images/" . $feeditem->type_title . ".jpg\" class=\icon_" . $feeditem->type_title . "\">";
				echo    "</div>";
				echo    "<div><h2>";
				echo    $feeditem->ext_post_name;
				echo    "</h2></div>";
				echo    "<div style=\"display:block;float:left;width:100px;\" >";
				echo    "<img src=\"" . $feeditem->thumb_uri . "\" class=\"profile_" . $feeditem->type_title . "_image\">";
				echo    "</div>";
				//echo	$feeditem->created_time;
				echo    "<div>";
				echo    $feeditem->message;
				echo    "</div>";
				echo    "<div style=\"clear:both;\"></div>";
				echo    "</div><br/><hr/><br/>";
			}
		}
		echo "</div>";
	}
	else
	{
		echo "<div class=\"redsocial_group\" >";
		echo JText::_('COM_REDSOCIALSTREAM_LOADING');
		echo "</div>";
	}
	?>
</div>
<div>
	<?php
	echo "<div id=\"button_nextposts\" class=\"button max limit\"><img src='administrator/components/com_redsocialstream/assets/images/preloader.gif'>&nbsp;" . JText::_('COM_REDSOCIALSTREAM_NEXT_POSTS') . "</div>";
	echo "<input id=\"limit\" type=\"hidden\" value=\"" . $this->limit . "\" />";
	echo "<input id=\"currentlimit\" type=\"hidden\" value=\"" . $this->limit . "\" />";
	?>
</div>
