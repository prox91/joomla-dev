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
    protected $lessons;
    protected $pagination;


	// Overwriting JView display method
	public function display($tpl = null)
	{
        JHTML::Script(Juri::base() . 'media/englishconcept/assets/js/jQuery.jPlayer/jquery.jplayer.min.js');

        JHTML::Script(Juri::base() . 'media/englishconcept/assets/js/jwplayer/jwplayer.js');

        //JHTML::Script(Juri::base() . 'media/englishconcept/assets/js/jwplayer/jwplayer.html5.js');
        //JHTML::Script(Juri::base() . 'media/englishconcept/assets/js/jwplayer/jwplayer.flash.swf');

        $this->lessons = $this->get("Items");
        $this->pagination = $this->get('Pagination');

		// Display the view
		parent::display($tpl);
	}
}
