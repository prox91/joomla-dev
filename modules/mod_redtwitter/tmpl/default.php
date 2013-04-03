<?php
/**
 * @version    Id: default.php
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */
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

?>
<?php
if (!empty($twitters))
{
	?>
	<div class="custom<?php echo $moduleclass_sfx ?>">
		<div class="twitter_content">
			<?php if ($params->get('display_slide'))
			{ ?>
				<div id="slider">
					<ul>
						<?php
						$html = '<li>';
						$i = 0;
						foreach ($twitters as $k => $v)
						{
							if($i < $params->get('item_per_slide') && $k < count($twitters)) {
								$i++;
								$html .= '<div class="twitter_content_row">'."\n";
								$html .= '<img src="' . $v['profile_image_url'] . '">'."\n";
								$html .= '<a href="' . $v['link'] . '" title="' . $v['description'] . '">' . JHtml::_('string.truncate', $v['title'], $params->get('title_length')) . '</a>'."\n";
								$html .= '<div>' . modRedTwitterHelper::ago($v['pdate']) . '</div>'."\n";
								//$html .= '<div>' . date($date_format, strtotime($v['pdate'])) . '</div>'."\n";
								$html .= '</div>'."\n";
							}
							else
							{
								$html .= '</li>'."\n";
								if($k < count($twitters)) {
									$html .= '<li>'."\n";
									$html .= '<div class="twitter_content_row">'."\n";
									$html .= '<img src="' . $v['profile_image_url'] . '">'."\n";
									$html .= '<a href="' . $v['link'] . '" title="' . $v['description'] . '">' . JHtml::_('string.truncate', $v['title'], $params->get('title_length')) . '</a>'."\n";
									$html .= '<div>' . modRedTwitterHelper::ago($v['pdate']) . '</div>'."\n";
									//$html .= '<div>' . date($date_format, strtotime($v['pdate'])) . '</div>'."\n";
									$html .= '</div>'."\n";
								}
								$i = 0;
							}
						}
						echo $html;
						?>
					</ul>
					<script type="text/javascript">
						jQuery(document).ready(function () {
							jQuery('#slider').easySlider({
								auto: true,
								continuous: true,
								speed: 800,
								pause: 6000
								//nextId: "slider1next",
								//nextText: "",
								//prevText: "",
								//prevId: "slider1prev"
							});
						});
					</script>
				</div>
			<?php
			}
			else
			{
				foreach ($twitters as $k => $v)
				{
					echo '<div class="twitter_content_row">';
					echo '<img src="' . $v['profile_image_url'] . '">';
					echo '<a href="' . $v['link'] . '" title="' . $v['description'] . '">' . JHtml::_('string.truncate', $v['title'], $params->get('title_length')) . '</a>';
					echo '<div>' . modRedTwitterHelper::ago($v['pdate']) . '</div>';
					//echo '<div>' . date($date_format, strtotime($v['pdate'])) . '</div>';
					echo '</div>';
				}
			}
			?>
		</div>
	</div>
<?php
}
?>