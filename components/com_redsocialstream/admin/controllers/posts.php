<?php
/**
 * @package     redSocialstream
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class PostsController extends JController
{
	function display()
	{
		parent::display();
	}

	function __construct($default = array())
	{
		parent::__construct($default);
	}

	function cancel()
	{
		$this->setRedirect('index.php');
	}
}
