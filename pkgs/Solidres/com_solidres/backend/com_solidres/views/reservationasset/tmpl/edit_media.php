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
<?php if(isset($this->item->media) && count($this->item->media) > 0) : ?>
	<div class="alert alert-info">
		<i class="icon-lamp"></i> <?php echo JText::_('SR_CHECK_SAVE_DELETE_INFO') ?>
	</div>
<?php else :  ?>
	<div class="alert alert-info">
		<i class="icon-lamp"></i> <?php echo JText::_('SR_NO_MEDIA_FOUND') ?>
	</div>
<?php endif; ?>

<div class="btn-group">
    <button id="media-select-all" class="toolbar btn" type="button">
        <i class="icon-checkbox"></i>
		<?php echo JText::_('SR_MEDIA_SELECT_ALL_BTN')?>
    </button>
    <button id="media-deselect-all" class="toolbar btn" type="button">
        <i class="icon-checkbox-unchecked"></i>
		<?php echo JText::_('SR_MEDIA_DESELECT_ALL_BTN') ?>
    </button>
</div>

<fieldset class="adminform" id="mediafset">
    <ul id="media-holder" class="media-container media-sortable">
	<?php
        if(isset($this->item->media)) :
            foreach($this->item->media as $item) :
	?>
		<li data-order="<?php echo $item->weight ?>">
			<input title="<?php echo JText::_('SR_CHECK_SAVE_DELETE') ?>"
				   type="checkbox"
				   class="media-checkbox"
				   name="jform[deleteMediaId][]"
				   value="<?php echo $item->id ?>" />
            <input type="hidden" name="jform[mediaId][]" value="<?php echo $item->id ?>">
			<img title="<?php echo $item->name ?>"
				 alt="<?php echo $item->name ?>"
				 id="sr_media_<?php echo $item->id ?>"
				 src="<?php echo SRURI_MEDIA ?>/assets/images/system/thumbnails/2/<?php echo $item->value ?>" />
			<?php echo $item->name ?>
		</li>
	<?php
            endforeach;
        endif;
	?>
    </ul>
</fieldset>