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

$srMedia = SRFactory::get('solidres.media.media');

?>
	
<form action="<?php JRoute::_('index.php?option=com_solidres'); ?>" method="post" name="adminForm" id="medialibraryform">
	<div class="btn-group">
		<button id="media-library-delete" class="toolbar btn" type="submit">
			<i class="icon-remove"></i> 
			<?php echo JText::_('SR_MEDIA_DELETE_BTN')?>
		</button>
		<button id="media-library-insert" class="toolbar btn">
			<i class="icon-ok"></i> 
			<?php echo JText::_('SR_MEDIA_INSERT_BTN') ?>
		</button>
        <button id="media-select-all" class="toolbar btn" type="button">
            <i class="icon-checkbox"></i>
			<?php echo JText::_('SR_MEDIA_SELECT_ALL_BTN')?>
        </button>
        <button id="media-deselect-all" class="toolbar btn" type="button">
            <i class="icon-checkbox-unchecked"></i>
			<?php echo JText::_('SR_MEDIA_DESELECT_ALL_BTN') ?>
        </button>
	</div>

	<div id="media-messsage"></div>

    <div class="pagination">
        <ul>
			<?php for ($i = 0; $i <= floor(($this->total - 1)  / 10); $i ++) : ?>
            <li class="<?php echo ($i == 0 ) ? 'active' : '' ?>">
				<a data-start="<?php echo $i * 10 ?>" href="#"><?php echo $i + 1 ?></a>
			</li>
			<?php endfor ?>
        </ul>
    </div>

	<div id="medialibrary" class="clearfix">
		<?php if ($this->items) :
			echo '<ul class="media-container clearfix">';

			foreach($this->items as $item) :
				echo '<li>';

				echo '<input class="media-checkbox" type="checkbox" name="media[]" value="'.$item->id.'" />';

				if ( $srMedia->isImage($item->mime_type) ) :
					echo '<img id="sr_media_'.$item->id.'" title="'.$item->name.'" alt="'.$item->name.'" src="'.SRURI_MEDIA.'/assets/images/system/thumbnails/2/'.$item->value.'" />';
				elseif ( $srMedia->isDocument($item->mime_type) ) :
					echo '<img id="sr_media_'.$item->id.'" title="'.$item->name.'" alt="'.$item->name.'" src="'.SRURI_MEDIA.'/assets/images/document.png" />';
				elseif ( $srMedia->isVideo($item->mime_type)) :
					echo '<img id="sr_media_'.$item->id.'" title="'.$item->name.'" alt="'.$item->name.'" src="'.SRURI_MEDIA.'/assets/images/video.png" />';
				endif;

				echo substr($item->name, 0, 20);

				echo '</li>';
			endforeach;

			echo '</ul>';
		endif; ?>

	</div>

	<input type="hidden" name="task" value="media.delete" />
	<input type="hidden" name="format" value="json" />
	<?php echo JHtml::_('form.token'); ?>
</form>

