<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 1/11/14
 * Time: 1:10 AM
 * To change this template use File | Settings | File Templates.
 */
defined('JPATH_REDCORE') or die;

$data = $displayData;

$active = null;

if( isset($data['active']) )
{
	$active = $data['active'];
}
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        (function(jQuery) {
            // fix sub nav on scroll
            var win = jQuery(window)
            var nav = jQuery('.convention-nav');
            var navTop = jQuery('.convention-nav').length && jQuery('.convention-nav').offset().top - 40;
            var isFixed = 0;
            processNavScroll();
            // hack sad times - holdover until rewrite for 2.1
            nav.on('click', function() {
                if (!isFixed) {
                    setTimeout(function()
                    {
                        win.scrollTop(win.scrollTop() - 47)
                    }, 10)
                }
            })
            win.on('scroll', processNavScroll);
            function processNavScroll() {
                var i, scrollTop = win.scrollTop()
                if (scrollTop >= navTop && !isFixed) {
                    isFixed = 1;
                    nav.addClass('convention-nav-fixed');
                } else if (scrollTop <= navTop && isFixed) {
                    isFixed = 0;
                    nav.removeClass('convention-nav-fixed');
                }
            }
        })(jQuery);
    });
</script>
<ul class="convention-nav nav nav-tabs nav-stacked">
	<li>
		<?php if ($active === 'countries') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_openhrm&view=countries') ?>">
				<i class="icon-globe"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_COUNTRY_LIST') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=countries') ?>">
				<i class="icon-globe"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_COUNTRY_LIST') ?>
			</a>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($active === 'states') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_openhrm&view=states') ?>">
				<i class="icon-bookmark"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_STATE_LIST') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=states') ?>">
				<i class="icon-bookmark"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_STATE_LIST') ?>
			</a>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($active === 'organizationinfo') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_openhrm&view=organizationinfo') ?>">
				<i class="icon-ticket"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_ORGANIZATIONINFO_LIST') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=organizationinfo') ?>">
				<i class="icon-ticket"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_ORGANIZATIONINFO_LIST') ?>
			</a>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($active === 'configures') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_openhrm&view=configures') ?>">
				<i class="icon-wrench"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_SETTING_LIST') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=configures') ?>">
				<i class="icon-wrench"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_SETTING_LIST') ?>
			</a>
		<?php endif; ?>
	</li>
	<li>
		<?php if ($active === 'maritalstates') : ?>
			<a class="active" href="<?php echo JRoute::_('index.php?option=com_openhrm&view=maritalstates') ?>">
				<i class="icon-heart"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_SETTING_LIST') ?>
			</a>
		<?php else : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_openhrm&view=maritalstates') ?>">
				<i class="icon-heart"></i>
				<?php echo JText::_('OPENHRM_SUBMENU_MARITALSTATE_LIST') ?>
			</a>
		<?php endif; ?>
	</li>
</ul>


<!---->
<!--JHtml::_('behavior.framework', true);-->
<!--jimport('joomla.string.inflector');-->
<!--$inflector = JStringInflector::getInstance();-->
<!---->
<!--$input = JFactory::getApplication()->input;-->
<!--$viewName 	= $input->get('view', '', 'cmd');-->
<!--$disabled	= $input->get('disablesidebar', '0', 'int');-->
<!--$link 		= 'index.php?option=com_openhrm';-->
<!---->
<!--if ($disabled) return;-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_DASHBOARD'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_DASHBOARD', '&view=dashboard' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_PIM'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_EMPLOYEE_LIST', '&view=employees' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_LEAVE'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_LEAVE_TYPE_LIST', '&view=leavetypes' ),-->
<!--	1 => array( 'OPENHRM_SUBMENU_LEAVE_REQUEST_LIST', '&view=leaverequests' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_TIME'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_TIMESHEET_LIST', '&view=timesheets' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_RECRUITMENT'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_CANDIDATE_LIST', '&view=candidates' ),-->
<!--	1 => array( 'OPENHRM_SUBMENU_VACANCY_LIST', '&view=vacancies' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_PERFORMANCE'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_KPI_LIST', '&view=kpis' ),-->
<!--	1 => array( 'OPENHRM_SUBMENU_REVIEW_LIST', '&view=reviews' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_REPORT'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_EMPLOYEES_REPORT_LIST', '&view=employeereports' ),-->
<!--	1 => array( 'OPENHRM_SUBMENU_PROJECT_REPORT_LIST', '&view=projectreports' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_ADMIN'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_USER_LIST', '&view=users' ),-->
<!--	1 => array( 'OPENHRM_SUBMENU_JOB_CATEGORY_LIST', '&view=jobcategories' ),-->
<!--	2 => array( 'OPENHRM_SUBMENU_JOB_TITLE_LIST', '&view=jobtitles' ),-->
<!--	3 => array( 'OPENHRM_SUBMENU_QUALIFICATION_LIST', '&view=qualifications' ),-->
<!--);-->
<!---->
<!--$menuStructure['OPENHRM_SUBMENU_SYSTEM'] = array(-->
<!--	0 => array( 'OPENHRM_SUBMENU_COUNTRY_LIST', '&view=countries' ),-->
<!--	1 => array( 'OPENHRM_SUBMENU_STATE_LIST', '&view=states'),-->
<!--	2 => array( 'OPENHRM_SUBMENU_ORGANIZATIONINFO_LIST', '&view=organizationinfo'),-->
<!--	//3 => array( 'OPENHRM_SUBMENU_SETTING_LIST', '&view=configures' ),-->
<!--	4 => array( 'OPENHRM_SUBMENU_MARITALSTATE_LIST', '&view=maritalstates' ),-->
<!--);-->
<!---->
<!--$html = '';-->
<!--$html .= '<div id="ec-panel-left" class="span2">';-->
<!--$html .= '<ul id="ec-sidebar-navigation">';-->
<!---->
<!--$html .= '<li class="ec-tools">-->
<!--					<a id="ec-dashboard" title="'.JText::_('OPENHRM_SUBMENU_DASHBOARD').'"-->
<!--					   href="'.JRoute::_('index.php?option=com_openhrm').'">-->
<!--					</a>-->
<!--				  </li>';-->
<!---->
<!--$iconMap = array(-->
<!--	'dashboard' => 'icon-home',-->
<!--	'pim' => 'icon-user',-->
<!--	'leave' => 'icon-share',-->
<!--	'time' => 'icon-time',-->
<!--	'recruitment' => 'icon-comments-2',-->
<!--	'performance' => 'icon-adjust',-->
<!--	'report' => 'icon-bookmark',-->
<!--	'admin' => 'icon-key',-->
<!--	'system' => 'icon-wrench'-->
<!--);-->
<!---->
<!--foreach ($menuStructure as $menuName => $menuDetails)-->
<!--{-->
<!--	$html .= '<li class="ec-toggle" id="ec-sn_'.strtolower(substr($menuName, 16)).'">-->
<!--			            <a class="ec-indicator">Open</a>-->
<!--			            <a class="ec-title"><i class="'. $iconMap[strtolower(substr($menuName, 16))] .'"></i> '.JText::_($menuName).'</a>';-->
<!--	$html .= '<ul>';-->
<!--	foreach ($menuDetails as $menu)-->
<!--	{-->
<!--		if ((substr($menu[1], 1, 4) == 'view'))-->
<!--		{-->
<!--			$html .= '<li class="'.((substr($menu[1], 6) == $viewName || $inflector->toSingular(substr($menu[1], 6)) == $viewName) ? 'active': '').'">';-->
<!--		}-->
<!--		else-->
<!--		{-->
<!--			$html .= '<li class="">';-->
<!--		}-->
<!--		$html .= '<a id="'.strtolower($menu[0]).'" href="'.JRoute::_($link.$menu[1]).'">'.JText::_($menu[0]).'</a></li>';-->
<!--	}-->
<!--	$html .= '</ul>';-->
<!--	$html .= '</li>';-->
<!--}-->
<!---->
<!--$html .= '</ul>';-->
<!--$html .= '</div>';-->
<!--$html .= '</div>';-->
<!---->
<!--echo $html;-->