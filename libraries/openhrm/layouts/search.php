<?php
defined('JPATH_OPENHRM') or die;

$data = $displayData;

// If a state is given use it
if (isset($data['state']))
{
	$state = $data['state'];
}

// Use the view state
elseif (isset($data['view']))
{
	$view = $data['view'];
	$state = $view->getModel()->getState();
}

else
{
	throw new InvalidArgumentException('No View passed to the "search" layout.');
}

$filterName = 'search';

if (isset($data['filter_name']))
{
	$filterName = $data['filter_name'];
}
?>

<div id="filter-bar" class="btn-toolbar">
	<div class="filter-search btn-group pull-left">
		<input type="text" name="filter_<?php echo $filterName ?>" id="filter_<?php echo $filterName ?>"
		       placeholder="<?php echo JText::_('JSEARCH'); ?>"
		       value="<?php echo $state->get('filter.' . $filterName); ?>"
		       title="<?php echo JText::_('JSEARCH'); ?>"/>
	</div>
	<div class="btn-group hidden-phone">
		<button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>">
			<i class="icon-search"></i>
		</button>
		<button class="btn hasTooltip" type="button" onclick="document.id('filter_<?php echo $filterName ?>').value='';this.form.submit();"
		        title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>">
			<i class="icon-remove"></i>
		</button>
	</div>
</div>
