<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controllerform');

/**
 * Class FollowedprofilesController
 */
class RedtwitterControllerOauth_Info extends JControllerForm
{
	/**
	 * @param array $default
	 */
	public function __construct($default = array())
	{
		$this->view_list = 'oauth_infos';
		parent::__construct($default);
	}
}