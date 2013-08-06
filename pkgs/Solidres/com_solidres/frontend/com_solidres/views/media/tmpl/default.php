<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addScript(SRURI_MEDIA.'/assets/js/galleria/galleria-1.2.4.min.js');

$doc->addScriptDeclaration("
    jQuery(document).ready(function(){
        // Load the classic theme
        Galleria.loadTheme('".SRURI_MEDIA."/assets/js/galleria/galleria.classic.min.js');

        // Initialize Galleria
        jQuery('#sr-gallery').galleria({
            width: 500,
            height: 300
        });
    });
");

?>
<div id="sr-gallery">
    <?php
        if ($this->items) :
        	foreach($this->items as $m) :
	?>

            <a href="<?php echo SRURI_MEDIA.'/assets/images/system/'.$m->value; ?>">
                <img title="TITLE STRING"
                     alt="ALT STRING"
                     src="<?php echo SRURI_MEDIA.'/assets/images/system/thumbnails/tn_'.$m->value; ?>">
            </a>

    <?php
            endforeach;
        endif;
    ?>
</div>