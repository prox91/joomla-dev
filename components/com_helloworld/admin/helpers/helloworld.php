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


/**
 * Class HelloWorldModelHelloWorld
 */
abstract class HelloWorldHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($submenu)
	{
		JSubMenuHelper::addEntry(JText::_('COM_HELLOWORLD_SUBMENU_MESSAGES'),
			'index.php?option=com_helloworld', $submenu == 'messages');
		JSubMenuHelper::addEntry(JText::_('COM_HELLOWORLD_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_helloworld',
			$submenu == 'categories');
		// set some global property
		$document = JFactory::getDocument();
		//$document->addStyleDeclaration('.icon-48-helloworld ' .
		//	'{background-image: url(../media/com_helloworld/images/tux-48x48.png);}');
		if ($submenu == 'categories')
		{
			$document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION_CATEGORIES'));
		}
	}
}