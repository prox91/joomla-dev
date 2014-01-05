<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 6:09 PM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;

class OpenHrmHelperSideBar
{
    public static $extention = 'com_openhrm';

    /**
     * Display the side navigation bar, ACL aware
     *
     * @return  string the html representation of side navigation
     */
    public static function getSideNavigation()
    {
        JHtml::_('behavior.framework', true);
        jimport('joomla.string.inflector');
        $inflector = JStringInflector::getInstance();

        $input = JFactory::getApplication()->input;
        $viewName 	= $input->get('view', '', 'cmd');
        $disabled	= $input->get('disablesidebar', '0', 'int');
        $link 		= 'index.php?option=com_openhrm';

        if ($disabled) return;

        $menuStructure['OPENHRM_SUBMENU_MASTER'] = array(
            0 => array( 'OPENHRM_SUBMENU_COUNTRY_LIST', '&view=countries' ),
            1 => array( 'OPENHRM_SUBMENU_STATE_LIST', '&view=states'),
        );

        $menuStructure['OPENHRM_SUBMENU_CONTENT'] = array(
            0 => array( 'OPENHRM_SUBMENU_COMPREHENSION_LIST', '&view=comprehensions' ),
            1 => array( 'OPENHRM_SUBMENU_PRECIS_LIST', '&view=precises'),
            2 => array( 'OPENHRM_SUBMENU_COMPOSITION_LIST', '&view=compositions'),
            3 => array( 'OPENHRM_SUBMENU_GRAMMAR_LIST', '&view=grammars'),
            4 => array( 'OPENHRM_SUBMENU_USAGE_LIST', '&view=usages'),
        );

        $menuStructure['OPENHRM_SUBMENU_SYSTEM'] = array(
            0 => array( 'OPENHRM_SUBMENU_SETTING_LIST', '&view=setting' ),
        );

        $html = '';
        $html .= '<div id="ec-panel-left" class="span2">';
        $html .= '<ul id="ec-sidebar-navigation">';

        $html .= '<li class="ec-tools">
					<a id="ec-dashboard" title="'.JText::_('OPENHRM_SUBMENU_DASHBOARD').'"
					   href="'.JRoute::_('index.php?option=com_openhrm').'">
					</a>
				  </li>';

        $iconMap = array(
            'master' => 'icon-home',
            //'customer' => 'icon-user',
            'content' => 'icon-key',
            //'' => 'icon-file-add',
            //'' => 'icon-comments-2',
            'system' => 'icon-wrench'
        );

        foreach ($menuStructure as $menuName => $menuDetails)
        {
            $html .= '<li class="ec-toggle" id="ec-sn_'.strtolower(substr($menuName, 11)).'">
			            <a class="ec-indicator">Open</a>
			            <a class="ec-title"><i class="'. $iconMap[strtolower(substr($menuName, 11))] .'"></i> '.JText::_($menuName).'</a>';
            $html .= '<ul>';
            foreach ($menuDetails as $menu)
            {
                if ((substr($menu[1], 1, 4) == 'view'))
                {
                    $html .= '<li class="'.((substr($menu[1], 6) == $viewName || $inflector->toSingular(substr($menu[1], 6)) == $viewName) ? 'active': '').'">';
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
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
