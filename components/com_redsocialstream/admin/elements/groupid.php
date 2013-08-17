<?php
/**
 * @copyright Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license   GNU/GPL, see license.txt or http://www.gnu.org/copyleft/gpl.html
 *            Developed by email@recomponent.com - redCOMPONENT.com
 *
 * redSHOP can be downloaded from www.redcomponent.com
 * redSHOP is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.
 *
 * You should have received a copy of the GNU General Public License
 * along with redSHOP; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');

class JFormFieldgroupid extends JFormField
{
	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	public $type = 'profiletypeid';

	protected function getInput()
	{


		$db = JFactory::getDbo();
		$name = $this->name;
		$control_name = $this->name;
		// This might get a conflict with the dynamic translation - TODO: search for better solution
		$query = 'SELECT id, title   ' .
			' FROM #__redsocialstream_group WHERE published=1';
		$db->setQuery($query);
		$options = $db->loadObjectList();
		array_unshift($options, JHTML::_('select.option', '0', '- ' . JText::_('COM_REDSOCIALSTREAM_SELECT_GROUP') . ' -', 'id', 'title'));

		return JHTML::_('select.genericlist', $options, $name, 'class="inputbox"', 'id', 'title', $this->value, $name);
	}
}

