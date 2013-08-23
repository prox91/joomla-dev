<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/23/13
 * Time: 11:13 AM
 * To change this template use File | Settings | File Templates.
 */
require_once (JPATH_COMPONENT . '/helpers/sidebar.php');

class ECViewAdmin extends JViewLegacy
{

    public function __construct($config = array())
    {
        // Side bar
        $this->sidebar = EnglishConceptHelperSideBar::getSideNavigation();

        parent::__construct($config);

    }
}