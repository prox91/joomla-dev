<?php
/**
 * @package     RedRad
 * @subpackage  Layouts
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_REDRAD') or die;

$data = $displayData;

?>
<ul class="nav nav-tabs nav-stacked">
	<li>
		<a href="<?php echo JRoute::_('index.php?option=com_jab&view=speakers')?>">
			<i class="icon-dashboard"></i>
			Speakers
		</a>
	</li>
	<li>
		<a href="<?php echo JRoute::_('index.php?option=com_jab&view=countries')?>">
			<i class="icon-dashboard"></i>
			Countries
		</a>
	</li>
	<li>
		<a href="<?php echo JRoute::_('index.php?option=com_jab&view=states')?>">
			<i class="icon-dashboard"></i>
			States
		</a>
	</li>
</ul>
