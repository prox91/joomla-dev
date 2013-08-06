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

SRHtml::_('jquery.validate');
?>
<div id="solidres" class="row-fluid">
	<?php if ($this->reservation->room_types === false) : ?>
		<div>
			<?php echo JText::_('SR_ROOM_QUANTITY_EXCEED_QUOTA'); ?>
		</div>
	<?php else : ?>
		<div id="reservation-form-holder" class="span12">
			<?php echo $this->loadTemplate('room') ?>
			<?php echo $this->loadTemplate('guest') ?>
			<?php echo $this->loadTemplate('payment') ?>
			<?php echo $this->loadTemplate('confirmation') ?>
		</div>
		<?php if ($this->showPoweredByLink) : ?>
			<div class="span12 powered">
				<p>
					Powered by <a target="_blank" title="Solidres - A hotel booking extension for Joomla" href="http://www.solidres.com">Solidres</a>
				</p>
			</div>
		<?php endif ?>
	<?php endif; ?>
</div>


