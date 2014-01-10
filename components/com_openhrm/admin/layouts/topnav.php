<?php
/**
 * @package     Redshopb.Admin
 * @subpackage  Layouts
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;
?>
<span class="divider-vertical pull-left"></span>
<ul class="nav">
	<li class="dropdown">
		<a href="#"
		   class="dropdown-toggle"
		   data-toggle="dropdown">
			<?php echo JText::_('COM_REDSHOPB_SHOP') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_redshopb&view=users') ?>">
					<?php echo JText::_('COM_REDSHOPB_USER_LIST_TITLE') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_redshopb&view=companies') ?>">
					<?php echo JText::_('COM_REDSHOPB_COMPANY_LIST_TITLE') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_redshopb&view=departments') ?>">
					<?php echo JText::_('COM_REDSHOPB_DEPARTMENT_LIST_TITLE') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_redshopb&view=wardrobes') ?>">
					<?php echo JText::_('COM_REDSHOPB_WARDROBE_LIST_TITLE') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_redshopb&view=products') ?>">
					<?php echo JText::_('COM_REDSHOPB_PRODUCT_LIST_TITLE') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_redshopb&view=categories') ?>">
					<?php echo JText::_('COM_REDSHOPB_CATEGORY_LIST_TITLE') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#">Product Sheets</a>
	</li>
	<li>
		<a href="#">Catalog</a>
	</li>
	<li>
		<a href="#">Newsletters</a>
	</li>
	<li>
		<a href="#">Offers</a>
	</li>
	<li>
		<a href="#">Contacts</a>
	</li>
	<li>
		<a href="#">Gallery</a>
	</li>
</ul>
