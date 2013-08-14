<?php
/**
 * @package     redSocialstream
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class RedsocialstreamsController extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
}
