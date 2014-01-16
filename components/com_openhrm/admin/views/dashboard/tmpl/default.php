<?php
defined('_JEXEC') or die;

$views = array(
    'employees',
    'countries',
	'states',
	'maritalstates',
);

$images = array(
    'employees' => JHtml::image('media/openhrm/assets/images/48_employee.png', JText::_('COM_OPENHRM_EMPLOYEE_TITLE')),
	'countries' => JHtml::image('media/openhrm/assets/images/48_country.png', JText::_('COM_OPENHRM_COUNTRY_TITLE')),
	'states' => JHtml::image('media/openhrm/assets/images/48_state.png', JText::_('COM_OPENHRM_STATE_TITLE')),
	'maritalstates' => JHtml::image('media/openhrm/assets/images/48_maritalstate.png', JText::_('COM_OPENHRM_MARITALSTATE_TITLE')),
);

$texts = array(
    'employees' => JText::_('COM_OPENHRM_EMPLOYEE_TITLE'),
	'countries' => JText::_('COM_OPENHRM_COUNTRY_TITLE'),
	'states' => JText::_('COM_OPENHRM_STATE_TITLE'),
	'maritalstates' => JText::_('COM_OPENHRM_MARITALSTATE_TITLE'),
);

$countView = count($views);
?>
<div class="row-fluid">
	<div class="span6 offset3">
		<div class="row pagination-centered">
			<?php echo JHtml::image('media/openhrm/assets/images/openhrm.png', JText::_('COM_OPENHRM')) ?>
			<hr />
		</div>
		<div class="row">
			<table class="table">
				<?php for ($i = 0; $i < $countView; $i++) : ?>
					<?php if ($i % 4 == 0) : ?>
						<tr style="border:0;">
					<?php endif; ?>
					<td style="border:0; width: 25%;">
						<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=' . $views[$i]); ?>">
							<div class="row-fluid pagination-centered">
								<?php echo $images[$views[$i]] ?>
							</div>
							<div class="row-fluid pagination-centered">
								<h4><?php echo $texts[$views[$i]] ?></h4>
							</div>
						</a>
					</td>
					<?php if (($i + 1) % 4 == 0 || $i == $countView - 1) : ?>
						</tr>
					<?php endif; ?>
				<?php endfor; ?>
			</table>
		</div>
	</div>
</div>
