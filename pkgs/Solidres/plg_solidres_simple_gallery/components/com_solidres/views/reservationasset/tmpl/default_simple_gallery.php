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

?>
<div class="row-fluid">
	<?php if( !empty($this->item->media) ) : ?>
    <div class="main-photo span5">
        <a class="sr-photo" href="<?php echo SRURI_MEDIA.'/assets/images/system/'.$this->item->media[0]->value; ?>">
            <img width="" src="<?php echo SRURI_MEDIA.'/assets/images/system/thumbnails/1/'.$this->item->media[0]->value; ?>" />
        </a>
    </div>
	<?php endif; ?>

    <div class="other-photos clearfix span7">
		<?php foreach ($this->item->media as $media) : ?>
        <a class="sr-photo" href="<?php echo SRURI_MEDIA.'/assets/images/system/'.$media->value; ?>">
            <img class="photo" src="<?php echo SRURI_MEDIA.'/assets/images/system/thumbnails/2/'.$media->value; ?>" />
        </a>
		<?php endforeach ?>
    </div>
</div>