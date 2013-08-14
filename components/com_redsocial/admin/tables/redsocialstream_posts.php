<?php
/**
 * @package     redSocialstream
 * @subpackage  Tables
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
//create the file for our posts, basically this file will 'describe' our post, there for
defined('_JEXEC') or die;
class Tableredsocialstream_posts extends JTable
{

//inside this class we must have one variable for each field of our table, and for every added column or removed column in our //table, we must add or remove the variable in that class.
	var $id = null;
	var $name = null;
	var $twitterusername = null;
	var $published = null;
	var $checked_out = null;

	// var $params = null;

	//we need a constructor in this class which will specify the table in the database that this class links to  

	function __construct(&$db)
	{
		$this->_table_prefix = '#__redsocialstream_posts';
		parent::__construct($this->_table_prefix, 'id', $db);
		//the '#__' represents the table prefix. Joomla gives you the possibility of having more installations in the same database as //long as they have different prefixes. We use this '#__' and joomla automatically converts it to the right prefix. This is useful //because we just need to change the prefix in the configuration, and not every file that deals with the database ;) ...

	}

	function bind($array, $ignore = '')
	{
		if (key_exists('params', $array) && is_array($array['params']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
		}
		return parent::bind($array, $ignore);
	}
} 
