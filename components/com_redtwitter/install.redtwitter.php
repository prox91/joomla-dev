<?php
/**
 * @version     1.0.0
 * @package     com_redtwitter
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ronni K. G. Christiansen <email@redweb.dk> - http://www.redcomponent.com
 */

/* ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_install()
{
	//Diplay the installation message
	displayInstallMsg();
}

function displayInstallMsg()
{
	echo '<img src="components/com_redtwitter/assets/images/redtwitter_backend_80.png" alt="redTWITTER Logo" align="left"><br /><br /><br /><br /><br /><br /><br />';
	echo 'redTWITTER is a brand new Joomla 2.5 native MVC component.<br /><br />';

	echo '<br /><br />Remember to check for updates on:<br />';
	echo '<a href="http://www.redcomponent.com/" target="_new"><img src="components/com_redtwitter/assets/images/redcomponent_logo.jpg" alt=""></a>';
}

?>
