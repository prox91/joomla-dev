<?php
/**
 * @package     redSocialstream
 * @subpackage  Tables
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
//create the file for our posts, basically this file will 'describe' our post, there for
defined('_JEXEC') or die;

class RedSocialStreamTableFacebookAccessToken extends JTable
{
    public function __construct(&$db)
    {
        parent::__construct('#__redsocialstream_facebook_accesstoken', 'id', $db);
    }

}
