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

jimport('solidres.version');

/**
 * Solidres Side Navigation Helper class
 *
 * @package     Solidres
 */
class SolidresHelperSideNavigation
{
	public static $extention = 'com_solidres';
	
	/**
	 * Display the side navigation bar, ACL aware
	 * 
	 * @return  string the html representation of side navigation
 	 */
	public static function getSideNavigation()
	{
	    JHtml::_('behavior.framework', true);
		$input = JFactory::getApplication()->input;
		$viewName 	= $input->get('view', '', 'cmd');
		$disabled	= $input->get('disablesidebar', '0', 'int');
		$link 		= 'index.php?option=com_solidres';
		$doc 		= JFactory::getDocument();
		JLoader::register('SRSystemHelper', JPATH_LIBRARIES . '/solidres/system/helper.php');

		if ($disabled) return;

		$menuStructure['SR_SUBMENU_ASSET'] = array(
			0 => array( 'SR_SUBMENU_ASSETS_LIST', '&view=reservationassets' ),
			1 => array( 'SR_SUBMENU_ROOM_TYPE_LIST', '&view=roomtypes' )
		);

		$menuStructure['SR_SUBMENU_CUSTOMER'] = array(
			0 => array( 'SR_SUBMENU_CUSTOMERS_LIST', '&view=customers' ),
			1 => array( 'SR_SUBMENU_CUSTOMERGROUPS_LIST', '&view=customergroups' )
		);

		$menuStructure['SR_SUBMENU_RESERVATION'] = array(
			0 => array( 'SR_SUBMENU_RESERVATIONS_LIST', '&view=reservations' )
		);

		$menuStructure['SR_SUBMENU_COUPON_EXTRA'] = array(
			0 => array( 'SR_SUBMENU_COUPONS_LIST', '&view=coupons' ),
			1 => array( 'SR_SUBMENU_EXTRAS_LIST', '&view=extras' )
		);

		if (SR_PLUGIN_FEEDBACK_ENABLED)
		{
			$menuStructure['SR_SUBMENU_CUSTOMER_FEEDBACK'] = array(
				0 => array( 'SR_SUBMENU_COMMENT_LIST', '&view=feedbacks' ),
				1 => array( 'SR_SUBMENU_CONDITION_LIST', '&view=feedbackconditions' ),
				2 => array( 'SR_SUBMENU_CUSTOMER_FEEDBACK_TYPE_LIST', '&view=feedbacktypes')
			);
		}

		$menuStructure['SR_SUBMENU_SYSTEM'] = array(
			0 => array( 'SR_SUBMENU_CURRENCIES_LIST', '&view=currencies' ),
			//0 => array( 'SR_SUBMENU_SYSTEM_BACKUP', '&task=system.backup' ),
			//1 => array( 'SR_SUBMENU_SYSTEM_RESTORE', '&view=system&layout=restore' ),
			//2 => array( 'SR_SUBMENU_SYSTEM_RESET_SAMPLE_DATA', '&task=system.resetsampledata'),
			3 => array( 'SR_SUBMENU_SYSTEM_INSTALL_SAMPLE_DATA', '&task=system.installsampledata'),
			4 => array( 'SR_SUBMENU_COUNTRY_LIST', '&view=countries'),
			5 => array( 'SR_SUBMENU_STATE_LIST', '&view=states'),
			6 => array( 'SR_SUBMENU_TAX_LIST', '&view=taxes'),
			7 => array( 'SR_SUBMENU_EMPLOYEES', '&option=com_users')
		);

		$html = '';
		$html .= '<div id="sr_panel_left" class="span2">';
		$html .= '<ul id="sr_side_navigation">';
		
		$html .= '<li class="sr_tools">
					<a id="sr_dashboard" title="'.JText::_('SR_SUBMENU_DASHBOARD').'"
					   href="'.JRoute::_('index.php?option=com_solidres').'">
					   <img src="'.JUri::root().'media/com_solidres/assets/images/logo.png" alt="Solidres" title="Solidres" />
					</a>
					<a id="sr_current_ver">'.SRVersion::getShortVersion().'</a>
				  </li>';

		$iconMap = array(
			'asset' => 'icon-home',
			'customer' => 'icon-user',
			'reservation' => 'icon-key',
			'coupon_extra' => 'icon-file-add',
			'customer_feedback' => 'icon-comments-2',
			'system' => 'icon-wrench'
		);

		foreach ($menuStructure as $menuName => $menuDetails)
		{
			$html .= '<li class="sr_toggle" id="sr_sn_'.strtolower(substr($menuName, 11)).'"><a class="sr_indicator">Open</a><a class="sr_title"><i class="'. $iconMap[strtolower(substr($menuName, 11))] .'"></i> '.JText::_($menuName).'</a>';
			$html .= '<ul>';
			foreach ($menuDetails as $menu)
			{
				if ((substr($menu[1], 1, 4) == 'view'))
				{
					$html .= '<li class="'.(substr($menu[1], 6) == $viewName ? 'active': '').'">';
				}
				else
				{
					$html .= '<li class="">';
				}
				$html .= '<a id="'.strtolower($menu[0]).'" href="'.JRoute::_($link.$menu[1]).'">'.JText::_($menu[0]).'</a></li>';
			}
			$html .= '</ul>';
			$html .= '</li>';
		}

		$html .= '</ul>';
		$html .= SolidresLiveUpdate::getIcon();
		$html .= '</div>';

		return $html;
	}
}