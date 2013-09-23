<?php
/**
 * @package     Jab.Admin
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Speaker List Controller
 *
 * @package     Jab.Admin
 * @subpackage  Controllers
 * @since       1.0
 */
class JabControllerSpeakers extends RControllerAdmin
{
	/**
	 * Return to control panel
	 *
	 * @return  void
	 */
	public function toPanel()
	{
		$this->setRedirect(JRoute::_('index.php?option=com_jab', false));
	}
}
