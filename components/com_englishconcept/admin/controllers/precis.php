<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptControllerPrecis extends JControllerForm
{
	function __construct($config = array())
	{
		parent::__construct($config);

		// Need to set list view to plural format in legacy/controllers/form/constructor with array('/is$/i', "ises")
		// Or change like here
		$this->view_list = $this->view_item . "es";
	}
}
