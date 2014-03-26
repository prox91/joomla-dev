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
		<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=dashboard') ?>">	<?php echo JText::_('OPENHRM_SUBMENU_DASHBOARD') ?>
		</a>
<!--		<ul class="dropdown-menu">-->
<!--			<li>-->
<!--				<a href="--><?php //echo JRoute::_('index.php?option=com_openhrm&view=dashboard') ?><!--">-->
<!--					--><?php //echo JText::_('OPENHRM_SUBMENU_DASHBOARD') ?>
<!--				</a>-->
<!--			</li>-->
<!--		</ul>-->
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_PIM') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=employees') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_EMPLOYEE_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_LEAVE') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=leavetypes') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_LEAVE_TYPE_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=leaverequests') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_LEAVE_REQUEST_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_TIME') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=timesheets') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_TIMESHEET_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_RECRUITMENT') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=candidates') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_CANDIDATE_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=vacancies') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_VACANCY_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_PERFORMANCE') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=kpis') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_KPI_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=reviews') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_REVIEW_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_REPORT') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=employeereports') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_EMPLOYEES_REPORT_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=projectreports') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_PROJECT_REPORT_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_ADMIN') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=users') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_USER_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=jobcategories') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_JOB_CATEGORY_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=jobtitles') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_JOB_TITLE_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=qualifications') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_QUALIFICATION_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"	class="dropdown-toggle"	data-toggle="dropdown">	<?php echo JText::_('OPENHRM_SUBMENU_SYSTEM') ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=countries') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_COUNTRY_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=states') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_STATE_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=organizationinfo') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_ORGANIZATIONINFO_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=configures') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_SETTING_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=maritalstates') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_MARITALSTATE_LIST') ?>
				</a>
			</li>
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=educations') ?>">
					<?php echo JText::_('OPENHRM_SUBMENU_EDUCATION_LIST') ?>
				</a>
			</li>
		</ul>
	</li>
</ul>
