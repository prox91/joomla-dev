<?php
/**
 * @version     1.0.0
 * @package     com_redtwitter
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ronni K. G. Christiansen <email@redweb.dk> - http://www.redcomponent.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Followed_profile controller class.
 */
class RedtwitterControllerFollowed_profile extends JControllerForm
{

    function __construct() {
        $this->view_list = 'followed_profiles';
        parent::__construct();
    }

}