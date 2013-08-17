<?php
/**
 * @package     RedTwitter.Frontend
 * @subpackage  mod_redtwitter
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Module JFormFieldRedTwitterCategory
 *
 * @package     RedTwitter.Frontend
 * @subpackage  Modules
 * @since       1.0
 */
class JFormFieldRedtwitterCategory extends JFormFieldList
{
	/**
	 * @var string field type
	 */
	public $type = 'redtwittercategory';

	/**
	 * Override get input function
	 *
	 * @return mixed|string
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
		$twitterList = $db->loadObjectList();

		$options = '';

		if (!empty($twitterList))
		{
			ob_start();
			$options = JHTML::_('select.genericlist', $twitterList, $this->name, '', 'twitter_user_name', 'display_name', $this->value);
			ob_end_clean();
		}
		else
		{
			JError::raiseWarning(500, JText::_('JLIB_FORM_ERROR_FIELDS_TWITTER_ERROR_EXTENSION_EMPTY'));
		}

		return $options;
	}
}
