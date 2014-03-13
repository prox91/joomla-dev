<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/4/13
 * Time: 11:03 PM
 * To change this template use File | Settings | File Templates.
 */

// No direct access to this file
defined('_JEXEC') or die;

jimport('legacy.view.legacy');

class OpenHrmViewLessons extends JViewLegacy
{
    protected $lesson;
    protected $pagination;

	// Overwriting JView display method
	public function display($tpl = null)
	{
		JHTML::stylesheet(Juri::base() . 'media/openhrm/assets/css/stylesheet.css');
        JHTML::Script(Juri::base() . 'media/openhrm/assets/js/jwplayer/jwplayer.js');

        $this->lesson = $this->get("Items");
        $this->pagination = $this->get('Pagination');

		// Display the view
		parent::display($tpl);
	}
}
