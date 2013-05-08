<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.

$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image) {
		$item->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.$item->title.'</span> ' :
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else { $linktype = $item->title;
}

$class = $item->anchor_css ? $item->anchor_css : '';

$toggle = "";
if ($item->parent) {
	$class .= ' dropdown-toggle disabled';
	$toggle = 'data-toggle="dropdown"';
}

if (!empty($class)) {
	$class = ' class="'.trim($class) .'"';
}

?>

<a <?php echo $class; ?><?php echo $toggle; ?> href="<?php echo $item->flink; ?>" <?php echo $title; ?>
	
<?php 

switch ($item->browserNav) :
	case 1:
		// _blank
?> target="_blank" <?php
		break;
	case 2:
	// window.open
?> onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" s<?php
		break;
endswitch;

?>>
<span>
	<?php echo $linktype; ?>
</span>
<?php if ($item->parent): ?>
	<b class="caret"></b>
<?php endif;?>
</a>
