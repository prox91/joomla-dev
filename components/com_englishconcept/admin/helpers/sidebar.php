<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 6:09 PM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptHelperSideBar
{
    public static $extention = 'com_englishconcept';

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
        $link 		= 'index.php?option=com_englishconcept';

        if ($disabled) return;

        $menuStructure['EC_SUBMENU_MASTER'] = array(
            0 => array( 'EC_SUBMENU_BOOK_LIST', '&view=books' ),
            1 => array( 'EC_SUBMENU_CATEGORY_LIST', '&view=categories'),
            2 => array( 'EC_SUBMENU_LEVEL_LIST', '&view=levels'),
            3 => array( 'EC_SUBMENU_LESSON_LIST', '&view=lessons'),
        );

        $menuStructure['EC_SUBMENU_CONTENT'] = array(
            0 => array( 'EC_SUBMENU_COMPREHENSION_LIST', '&view=comprehensions' ),
            1 => array( 'EC_SUBMENU_PRECIS_LIST', '&view=precises'),
            2 => array( 'EC_SUBMENU_COMPOSITION_LIST', '&view=compositions'),
            3 => array( 'EC_SUBMENU_GRAMMAR_LIST', '&view=grammars'),
            4 => array( 'EC_SUBMENU_USAGE_LIST', '&view=usages'),
        );

        $menuStructure['EC_SUBMENU_SYSTEM'] = array(
            0 => array( 'EC_SUBMENU_SETTING_LIST', '&view=setting' ),
        );

        $html = '';
        $html .= '<div id="ec-panel-left" class="span2">';
        $html .= '<ul id="ec-sidebar-navigation">';

        $html .= '<li class="ec-tools">
					<a id="ec-dashboard" title="'.JText::_('EC_SUBMENU_DASHBOARD').'"
					   href="'.JRoute::_('index.php?option=com_englishconcept').'">
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
