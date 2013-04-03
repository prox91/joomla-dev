<?php
/**
 * @version    Id: JFormFieldRedtwitterCategory.php
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * Developed by email@recomponent.com - redCOMPONENT.com
 */
defined('JPATH_PLATFORM') or die;

/**
 * Form Field class for the Joomla Platform.
 * Supports an HTML select list of categories
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldRedtwitterCategory extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $type = 'redtwittercategory';

	/**
	* Method to get the field input markup for a generic list.
	* Use the multiple attribute to enable multiselect.
	*
	* @return  string  The field input markup.
	*
	* @since   11.1
	*/
	protected function getInput()
	{
		$db = JFactory::getDBO();

		$query = 'SELECT id AS twitter_id,';
		$query .= ' name AS display_name, ';
		$query .= ' twitterusername AS twitter_user_name ';
		$query .= ' FROM #__redtwitter_followed_profiles ';
		$query .= ' WHERE state = 1 ORDER BY ordering';

		$db->setQuery($query);
		$twitter_list = $db->loadObjectList();

		$options = '';

		if (!empty($twitter_list))
		{
			ob_start();
			$options = JHTML::_('select.genericlist', $twitter_list, $this->name, 'multiple="multiple"', 'twitter_id', 'twitter_user_name', $this->value);
			ob_end_clean();
		}
		else
		{
			JError::raiseWarning(500, JText::_('JLIB_FORM_ERROR_FIELDS_TWITTER_ERROR_EXTENSION_EMPTY'));
		}

		return $options;
	}
}
