<?php
defined('JPATH_OPENHRM') or die;

$modal = $displayData;

?>
<div class="modal-header">
	<?php if ($modal->params->get('showHeaderClose', true)) : ?>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<?php endif; ?>
	<?php if ($modal->params->get('title', null)) : ?>
		<h4><?php echo $modal->params->get('title', null); ?></h4>
	<?php endif; ?>
</div>
