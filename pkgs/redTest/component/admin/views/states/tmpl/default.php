<?php
/**
 * @package     Jab.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

// HTML helpers
JHtml::_('rdropdown.init');
JHtml::_('rjquery.chosen', 'select');

// Required objects
$doc  = JFactory::getDocument();
$user = JFactory::getUser();

$action    = JRoute::_('index.php?option=com_jab&view=states');
$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$saveOrder = $listOrder == 'ordering';

$saveOrderingUrl = 'index.php?option=com_jab&task=states.saveOrderAjax&tmpl=component';
JHtml::_('rsortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);

$script = "
	(function($){
		$(document).ready(function() {
			// create a new instance of the plugin
			$('#adminForm').redgrid({
				'ajaxRefreshUrl' : '" . JUri::root() . "index.php?option=com_jab&task=ajax.',
				'ordering' : '" . $listOrder . "',
				'direction' : '" . $listDirn . "'
	    	});
		});
	})(jQuery);

";

$doc->addScriptDeclaration($script);
?>
<form action="<?php echo $action; ?>" name="adminForm" class="adminForm" id="adminForm" method="post">
	<div class="">
		<?php echo RLayoutHelper::render('search', array('view' => $this)) ?>
		<table class="table table-striped table-hover" id="articleList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
					</th>
					<th width="1%" class="hidden-phone">
					</th>
					<th class="name">
					</th>
					<th width="5%">
						<?php echo $this->filterForm->getInput('filter_published'); ?>
					</th>
					<th width="10%">
						<?php echo $this->filterForm->getInput('filter_language'); ?>
					</th>
					<th width="1%" class="id">
					</th>
				</tr>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('rgrid.sort', null, 'ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-sort'); ?>
					</th>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					<th class="name">
						<?php echo JHtml::_('rgrid.sort',  'COM_JAB_NAME_LABEL', 'st.name', $listDirn, $listOrder); ?>
					</th>
					<th width="5%">
						<?php echo JHtml::_('rgrid.sort',  'JPUBLISHED', 'st.active', $listDirn, $listOrder); ?>
					</th>
					<th width="10%">
						<?php echo JHtml::_('rgrid.sort', 'JGRID_HEADING_LANGUAGE', 'language', $listDirn, $listOrder); ?>
					</th>
					<th width="1%" class="id">
						<?php echo JHtml::_('rgrid.sort',  'COM_JAB_ID', 'st.id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<?php if($this->items): ?>
				<tbody>
					<?php foreach ($this->items as $i => $item): ?>
						<?php
							$canChange = 1;
							$canEdit   = 1;
						?>
						<tr class="row&lt;?php echo $i%2; ?&gt;">
							<td class="order nowrap center hidden-phone">
							<?php if ($canChange) :
								$disableClassName = '';
								$disabledLabel	  = '';
								if (!$saveOrder) :
									$disabledLabel    = JText::_('JORDERINGDISABLED');
									$disableClassName = 'inactive tip-top';
								endif; ?>
								<span class="sortable-handler hasTooltip <?php echo $disableClassName?>" title="<?php echo $disabledLabel?>">
									<i class="icon-ellipsis-vertical"></i>
								</span>
								<input type="text" style="display:none" name="order[]" size="5"
									value="<?php echo $item->ordering;?>" class="width-20 text-area-order " />
							<?php else : ?>
								<span class="sortable-handler inactive" >
									<i class="icon-ellipsis-vertical"></i>
								</span>
							<?php endif; ?>
							</td>
							<td>
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
							<td>
								<a href="<?php echo JRoute::_('index.php?option=com_jab&task=state.edit&id='.$item->id);?>">
									<?php echo $this->escape($item->name); ?>
								</a>
							</td>
							<td class="center">
								<?php echo JHtml::_('rgrid.published', $item->published, $i, 'states.', $canChange, 'cb'); ?>
							</td>
							<td class="center">
								<?php if ($item->language == '*') :?>
									<?php echo JText::alt('JALL', 'language'); ?>
								<?php else:?>
									<?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
								<?php endif;?>
							</td>
							<td>
								<?php echo $item->id; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			<?php endif; ?>
		</table>
		<?php echo $this->pagination->getListFooter(); ?>
	</div>

	<?php
	/**
	* @TODO: Load the batch processing form.
	* echo $this->loadTemplate('batch');
	**/
	?>
	<div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>">
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>">
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
