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
	<div id="solidres" class="span12">
		<div class="reservation_asset_item clearfix">
			<div class="row-fluid">
				<h3>
					<?php echo $this->escape($this->item->name); ?>
					<span class="rating rating-<?php echo $this->item->rating?>"></span>
				</h3>
				<span class="address_1 reservation_asset_subinfo">
					<?php echo $this->item->address_1;?>
					<a class="show_map" href="<?php echo JRoute::_('index.php?option=com_solidres&task=map.show&id='.$this->item->id) ?>">
						<?php echo JText::_('SR_SHOW_MAP') ?>
					</a>
				</span>

				<span class="address_2 reservation_asset_subinfo">
					<?php echo $this->item->address_2;?>
				</span>

				<span class="phone reservation_asset_subinfo">
					<?php echo $this->item->phone;?>
				</span>

				<span class="social_network reservation_asset_subinfo clearfix">
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['facebook_link'])
								&& $this->item->reservationasset_extra_fields['facebook_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['facebook_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/facebook.png" width="20" alt="Facebook" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['twitter_link'])
								&& $this->item->reservationasset_extra_fields['twitter_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['twitter_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/twitter.png" width="20" alt="Twitter" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['linkedin_link'])
								&& $this->item->reservationasset_extra_fields['linkedin_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['linkedin_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/linkedin.png" width="20" alt="Linkedin" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['gplus_link'])
								&& $this->item->reservationasset_extra_fields['gplus_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['gplus_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/gplus.png" width="20" alt="Google-Plus" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['tumblr_link'])
								&& $this->item->reservationasset_extra_fields['tumblr_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['tumblr_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/tumblr.png" width="20" alt="Tumblr" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['foursquare_link'])
								&& $this->item->reservationasset_extra_fields['foursquare_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['foursquare_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/foursquare.png" width="20" alt="Foursquare" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['myspace_link'])
								&& $this->item->reservationasset_extra_fields['myspace_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['myspace_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/myspace.png" width="20" alt="Myspace" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['pinterest_link'])
								&& $this->item->reservationasset_extra_fields['pinterest_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['pinterest_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/pinterest.png" width="20" alt="Pinterest" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['slideshare_link'])
								&& $this->item->reservationasset_extra_fields['slideshare_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['slideshare_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/slideshare.png" width="20" alt="Slideshare" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['vimeo_link'])
								&& $this->item->reservationasset_extra_fields['vimeo_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['vimeo_link'];?>" target="_blank"><img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/vimeo.png" width="20" alt="Vimeo" /></a>
					<?php	endif;
					?>
					<?php
						if ( !empty($this->item->reservationasset_extra_fields['youtube_link'])
								&& $this->item->reservationasset_extra_fields['youtube_show']== 1) : ?>
					<a href="<?php echo $this->item->reservationasset_extra_fields['youtube_link'];?>" target="_blank"> <img src="<?php echo JUri::root()?>/media/com_solidres/assets/images/socials/youtube.png" width="20" alt="Youtube" /></a>
					<?php	endif;
					?>
				</span>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->loadTemplate($this->defaultGallery); ?>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<p><?php echo $this->item->description;?></p>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->loadTemplate('searchinfo'); ?>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->loadTemplate('roomtype'); ?>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->loadTemplate('information'); ?>
				</div>
            </div>

			<?php if ($this->showPoweredByLink) : ?>
			<div class="row-fluid">
				<div class="span12 powered">
					<p>
						Powered by <a target="_blank" title="Solidres - A hotel booking extension for Joomla" href="http://www.solidres.com">Solidres</a>
					</p>
				</div>
			</div>
			<?php endif ?>
		</div>
	</div>
</div>