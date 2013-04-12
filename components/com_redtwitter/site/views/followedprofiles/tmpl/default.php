<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * Developed by email@recomponent.com - redCOMPONENT.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
?>
	<style type="text/css">
		<?php
		echo $this->red_detail->get("css_data");
		?>
	</style>
	<h1 class="componentheading<?php echo $this->params->get('pageclass_sfx') ?>">
		<?php
		echo $this->params->get('page_title');
		?>
	</h1>
<?php
$cache = JFactory::getCache();
$cache->setCaching(1);

include_once JPATH_COMPONENT_SITE . '/helpers/redtwitter.php';

echo '<div id="tweetlist">';
$array1 = RedtwitterHelper::get_all_twitter_timelines($this->lists);

if (count($array1) > 0)
{
	$b = 1;

	foreach ($array1 as $key => $val)
	{
		$date = new DateTime($val['pdate']);
		$dt1  = $date->format($this->params->get("date"));
		$dt   = strtotime($dt1);

		$title           = $val['title'];
		$change_contents = $title;

		$change_con = explode("http://", $change_contents);

		if (count($change_con) > 0)
		{
			foreach ($change_con as $f)
			{
				$ifr1   = explode(" ", $f);
				$mytxt1 = "" . $ifr1[0] . "";

				$mylink1 = str_replace($ifr1[0], ".", $ifr1[0]);
				$mylink1 = str_replace($mylink1, ",", $mylink1);
				$mylink1 = str_replace($mylink1, ":", $mylink1);
				$mylink1 = str_replace($mylink1, "'", $mylink1);
				$mylink1 = str_replace($mylink1, ")", $mylink1);

				$url_data        = "<a target='_target' href='http://" . $mytxt1 . "'>http://" . $mytxt1 . "</a>";
				$change_contents = str_replace("http://" . $mytxt1, $url_data, $change_contents);
			}
		}

		$title = explode("@", $change_contents);
		$j     = 0;

		foreach ($title as $f)
		{
			$ifr     = explode(" ", $f);
			$subject = $ifr[0];
			$mytxt   = "@" . $ifr[0] . "";

			$mylink = str_replace($ifr[0], ".", $ifr[0]);
			$mylink = str_replace($mylink, ",", $mylink);
			$mylink = str_replace($mylink, ":", $mylink);
			$mylink = str_replace($mylink, "'", $mylink);

			$ifr[0]          = str_replace(':', '', $ifr[0]);
			$ifr[0]          = str_replace('.', '', $ifr[0]);
			$uname           = "<a target='_target' href='http://twitter.com/" . $ifr[0] . "'>" . $ifr[0] . "</a>";
			$change_contents = str_replace($mytxt, "@" . $uname, $change_contents);
		}

		$j++;
		$title2          = explode("#", $change_contents);
		$j               = 0;

		foreach ($title2 as $f)
		{
			if ($j != 0)
			{
				$ifr     = explode(" ", $f);
				$subject = $ifr[0];
				$mytxt   = "#" . $ifr[0];

				$mylink = str_replace($ifr[0], ".", $ifr[0]);
				$mylink = str_replace($mylink, ",", $mylink);
				$mylink = str_replace($mylink, ":", $mylink);
				$mylink = str_replace($mylink, "'", $mylink);

				$uname           = "<a target='_target' href='http://search.twitter.com/search?q=" . $ifr[0] . "'>#" . $ifr[0] . "</a>";
				$change_contents = str_replace($mytxt, $uname, $change_contents);
			}

			$j++;
		}

		$description = $val['description'];
		$description = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $description);
		$description = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $description);
		$description = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $description);

		echo'<div class="tweet user_' . $val['id'] . '">';

		$avatar = '';

		if ($this->params->get("show_avatar", 0) > 0)
		{
			$val['profile_image_url'] = $val['profile_image_url']
				? $val['profile_image_url'] : 'administrator/components/com_redtwitter/assets/images/default.png';
			$avatar                   = '
				 <div class="image">
					 <a target="_target" href="http://twitter.com/' . $val['screen_name'] . '/">
					 	<img src="' . $val['profile_image_url'] . '" border="0" />
					 </a>
	    		</div>
				 ';
		}

		echo $avatar;

		echo '
		<div class="content">
	         	 <a target="_blank" href="' . $val['link'] . '">' . $val['name'] . '</a>
	             <div class="date">' . $val['pdate'] . '</div>
	         	 <div class="text">' . $change_contents . '</div>
	         </div>
	    </div>
	    ';

		if ($b == $this->params->get("userlimit"))
		{
			break;
		}

		$b++;
	}
}

echo '</div>';

if ($this->params->get("footer_link_text") != "")
{
	$link = "#";

	if ($this->params->get("footer_link") != "")
	{
		$link = JRoute::_($this->params->get("footer_link"));
	}

	echo '
	<div class="tweetlist_footer_link">
		<a href="' . $link . '">' . $this->params->get("footer_link_text") . '<a/>
	</div>';
}