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

function sec2hms($sec, $padHours = false)
{

	$hms   = "";
	$hours = intval(intval($sec) / 3600);
	$hms .= ($padHours)
		? str_pad($hours, 2, "0", STR_PAD_LEFT) . ":"
		: $hours . ":";

	/* dividing the total seconds by 60 will give us the number of minutes
	 in total, but we're interested in *minutes past the hour* and to get
	 this, we have to divide by 60 again and then use the remainder*/
	$minutes = intval(($sec / 60) % 60);

	// add minutes to $hms (with a leading 0 if needed)
	$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":";

	/* seconds past the minute are found by dividing the total number of seconds
	by 60 and using the remainder*/
	$seconds = intval($sec % 60);

	// add seconds to $hms (with a leading 0 if needed)
	$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

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
echo"<div class=\"redsocail_group_header\">
			<div class=\"redsocial_group_title\"><h1>" . JText::_('COM_REDSOCIALSTREAM_ALLPOST_HEADLINE') . "</h1></div>
			<div class=\"redsocial_group_teaser\"><p>" . JText::_('COM_REDSOCIALSTREAM_ALLPOST_INTROTEXT') . "</p></div>
		</div>";
if ($this->groupinfo != "")
{
	echo"<div class=\"redsocail_group_header\">
			<div class=\"redsocial_group_title\"><h1>" . $this->groupinfo[0]->introtitle . "</h1></div>
			<div class=\"redsocial_group_teaser\"><p>" . $this->groupinfo[0]->subtitle . "</p></div>
		</div>";
}
echo"<div class=\"redsocial_group\">";
if ($this->fbposts != "" && isset($this->fbposts[0]))
{

	foreach ($this->fbposts as $feeditem)
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
			echo JHtml::date($feeditem->created_time, 'l d/m/y H:i');
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
	}
}
if ($this->twposts != "" && isset($this->twposts[0]))
{
	foreach ($this->twposts as $feeditem)
	{
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
	}
}

if ($this->youtubeposts != "" && isset($this->youtubeposts[0]))
{
	foreach ($this->youtubeposts as $feeditem)
	{
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
			echo    JHtml::date($feeditem->created_time, 'l d/m/y H:i');
			echo    "</div>";
			echo    "<div  class=\"right_" . $feeditem->type_title . "_box\" style='padding-top:50px;'>";
			echo    "<div style=\"display:block;float:left;width:100px;\" >";
			echo    "<img src=\"" . $feeditem->thumb_uri . "\" class=\"profile_" . $feeditem->type_title . "_image\">";
			echo    "</div>";
			echo    "<div>";
			$i    = 0;
			$desc = "";
			echo    "<div class=\"youtube_video_title\">";
			echo    $feeditem->title;
			echo    "</div>";
			echo    "<iframe width=\"560\" height=\"315\" src=\"" . $feeditem->sorce_link . "\" frameborder=\"0\" allowfullscreen></iframe>";
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
	}
}
if ($this->linkedinposts != "" && isset($this->linkedinposts[0]))
{
	foreach ($this->linkedinposts as $feeditem)
	{
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
			echo    "<div>";
			echo    $feeditem->message;
			echo    "</div>";
			echo    "<div style=\"clear:both;\"></div>";
			echo    "</div><br/><hr/><br/>";
		}
	}

}
echo "</div>";
if ($this->linkedinposts == "" && $this->youtubeposts == "" && $this->twposts == "" && $this->fbposts == "")
{
	echo "<div class=\"redsocial_group\">";
	echo JText::_('COM_REDSOCIALSTREAM_NO_FEED');
	echo "</div>";
}
?>
