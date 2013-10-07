<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/4/13
 * Time: 11:03 PM
 * To change this template use File | Settings | File Templates.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('legacy.view.legacy');

class EnglishConceptViewLessons extends JViewLegacy
{
	// Overwriting JView display method
	function display($tpl = null)
	{
		// Display the view
		parent::display($tpl);
	}
}
