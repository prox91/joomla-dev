<?php
defined('JPATH_OPENHRM') or die;

$data = $displayData;
?>

<div class="pagination pagination-toolbar clearfix" style="text-align: center;">
	<div class="limit pull-right">
		<?php echo JText::_('JGLOBAL_DISPLAY_NUM') . $data['limitfield']; ?>
	</div>
	<?php echo $data['pageslinks']; ?>
	<input type="hidden" name="<?php echo $data['prefix']; ?>limitstart" value="<?php echo $data['limitstart']; ?>" />
</div>
