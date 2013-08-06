<?php
/**
 * @package     RedTwitter.Frontend
 * @subpackage  mod_redtwitter
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

$document->addStyleSheet(JURI::base() . 'modules/mod_redtwitter/includes/css/stylesheet.css');
$document->addStyleSheet(JURI::base() . 'modules/mod_redtwitter/includes/css/easySlider.css');

if (version_compare(JVERSION, '3.0', 'lt'))
{
	$document->addScript(JURI::base() . 'modules/mod_redtwitter/includes/js/jquery.min.js');
}

$document->addScript(JURI::base() . 'modules/mod_redtwitter/includes/js/easySlider1.7.js');

jimport('joomla.application.component.helper');
$date_format = JComponentHelper::getParams('com_redtwitter')->get('date');

$itemPerSlide = $params->get('item_per_slide');
?>
<?php
if (!empty($twitters))
{
	?>
	<div class="custom<?php echo $moduleclass_sfx ?>">
		<div class="twitter-content">
			<?php
			if ($params->get('show_header'))
			{
				$header_user = array();

				if (count($twitters) > 0)
				{
					foreach ($twitters as $twitter)
					{
						if ($twitter['screen_name'] == $params->get('show_header_twitter_screen_name', ''))
						{
							$header_user = $twitter['header'];
							break;
						}
					}
				}

				if (!empty($header_user))
				{
			?>
				<div class="twitter-header">
					<?php if ($params->get('show_header_avatar'))
					{
					?>
						<span class="twitter-header-avatar"><?php echo $header_user['avatar'] ?></span>
					<?php
					}
					?>
					<?php if ($params->get('show_header_screen_name'))
					{
					?>
						<span class="twitter-header-screen"><a
								href="<?php echo $header_user['link']; ?>"><?php echo $header_user['user'] ?></a></span>
					<?php
					}
					?>
					<?php if ($params->get('show_header_desc'))
					{
					?>
						<span
							class="twitter-header-description"><?php echo $header_user['description'] ?></span>
					<?php
					}
					?>
					<?php if ($params->get('show_header_location'))
					{
					?>
						<span class="twitter-header-location"><?php echo $header_user['location'] ?></span>
					<?php
					}
					?>
					<?php if ($params->get('show_header_web'))
					{
					?>
						<span class="twitter-header-web"><?php echo $header_user['web'] ?></span>
					<?php
					}
					?>
				</div>
			<?php
				}
			}

			if ($params->get('display_slide'))
			{
			?>
				<div id="slider">
					<ul>
						<?php
						$html = '<li>';
						$i = 0;
						foreach ($twitters as $k => $v)
						{
							if ($i < $params->get('item_per_slide') && $k < count($twitters))
							{
								$i++;
								$html .= '<div class="twitter-content-row">' . "\n";
								$html .= '<a href="' . $v['link'] . '"><img src="' . $v['profile_image_url'] . '"></a>' . "\n";
								$html .= '<a href="' . $v['link'] . '" title="' . $v['description'] . '">' . JHtml::_('string.truncate', $v['title'], $params->get('title_length')) . '</a>' . "\n";
								$html .= '<div>' . ModRedTwitterHelper::ago($v['pdate']) . '</div>' . "\n";
								$html .= '<div class="twitter-actions">';
								$html .= '<span class="twitter-action twitter-reply"><a rel="nofollow" title="Reply" href="' . $v['replyLink'] . '"></a></span>';
								$html .= '<span class="twitter-action twitter-retweet"><a rel="nofollow" title="Retweet" href="' . $v['retweetLink'] . '"></a></span>';
								$html .= '<span class="twitter-action twitter-favorite"><a rel="nofollow" title="Favourite" href="' . $v['favouriteLink'] . '"></a></span>';
								$html .= '</div>' . "\n";
								$html .= '</div>' . "\n";
							}
							else
							{
								$html .= '</li>' . "\n";
								if ($k < count($twitters))
								{
									$html .= '<li>' . "\n";
									$html .= '<div class="twitter-content-row">' . "\n";
									$html .= '<a href="' . $v['link'] . '"><img src="' . $v['profile_image_url'] . '"></a>' . "\n";
									$html .= '<a href="' . $v['link'] . '" title="' . $v['description'] . '">' . JHtml::_('string.truncate', $v['title'], $params->get('title_length')) . '</a>' . "\n";
									$html .= '<div>' . ModRedTwitterHelper::ago($v['pdate']) . '</div>' . "\n";
									$html .= '<div class="twitter-actions">';
									$html .= '<span class="twitter-action twitter-reply"><a rel="nofollow" title="Reply" href="' . $v['replyLink'] . '"></a></span>';
									$html .= '<span class="twitter-action twitter-retweet"><a rel="nofollow" title="Retweet" href="' . $v['retweetLink'] . '"></a></span>';
									$html .= '<span class="twitter-action twitter-favorite"><a rel="nofollow" title="Favourite" href="' . $v['favouriteLink'] . '"></a></span>';
									$html .= '</div>' . "\n";
									$html .= '</div>' . "\n";
								}
								$i = 0;
							}
						}
						echo $html;
						?>
					</ul>
					<script type="text/javascript">
						jQuery(document).ready(function ()
						{
							var sliderSelector = jQuery('#slider');
							sliderSelector.css('height', <?php echo (52 * $itemPerSlide); ?>);
							jQuery('#slider li').css('height', <?php echo (52 * $itemPerSlide); ?>);

							sliderSelector.easySlider({
								auto: true,
								continuous: true,
								speed: 800,
								pause: 6000,
								nextText: "",
								prevText: ""
							});
						});
					</script>
				</div>
			<?php
			}
			else
			{
				$html = '<div class="twitter-content-main">';

				foreach ($twitters as $k => $v)
				{
					$html .= '<div class="twitter-content-row">';
					$html .= '<a href="' . $v['link'] . '"><img src="' . $v['profile_image_url'] . '"></a>' . "\n";
					$html .= '<a href="' . $v['link'] . '" title="' . $v['description'] . '">' . JHtml::_('string.truncate', $v['title'], $params->get('title_length')) . '</a>';
					$html .= '<div>' . ModRedTwitterHelper::ago($v['pdate']) . '</div>';
					$html .= '<div class="twitter-actions">';
					$html .= '<span class="twitter-action twitter-reply"><a rel="nofollow" title="Reply" href="' . $v['replyLink'] . '"></a></span>';
					$html .= '<span class="twitter-action twitter-retweet"><a rel="nofollow" title="Retweet" href="' . $v['retweetLink'] . '"></a></span>';
					$html .= '<span class="twitter-action twitter-favorite"><a rel="nofollow" title="Favourite" href="' . $v['favouriteLink'] . '"></a></span>';
					$html .= '</div>' . "\n";
					$html .= '</div>' . "\n";
				}

				$html .= '</div>' . "\n";
				echo $html;
			?>
				<script type="text/javascript">
					jQuery(document).ready(function ()
					{
						jQuery('.twitter-content-main').css('height', <?php echo (52 * $itemPerSlide); ?>);
					});
				</script>
			<?php
			}

			if ($params->get('show_follow_button'))
			{
				$follow_button_user = array();

				if (count($twitters) > 0)
				{
					foreach ($twitters as $twitter)
					{
						if ($twitter['screen_name'] == $params->get('show_follow_button_screen_name', ''))
						{
							$follow_button_user = $twitter;
							break;
						}
					}
				}

				if (!empty($follow_button_user))
				{
					echo '<div class="follow-button"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="' . $follow_button_user['followLink'] . '"></iframe></div>';
				}
			}
			?>
		</div>
	</div>
<?php
}
?>
