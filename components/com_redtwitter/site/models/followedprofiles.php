<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * Developed by email@recomponent.com - redCOMPONENT.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Class RedtwitterModelFollowedProfiles
 */
class RedtwitterModelFollowedProfiles extends JModelLegacy
{
	public $pagination = null; /* Paginatio */
	public $total = null;

	/**
	 * Class constructor, overridden in descendant classes.
	 *
	 * @since   11.1
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_table_prefix = '#__';
	}

	/**
	 * Get detail function
	 *
	 * @since   11.1
	 * @return   $component_params
	 */
	public function getDetail()
	{
		jimport('joomla.application.component.helper');
		$component_params = JComponentHelper::getParams('com_redtwitter');

		return $component_params;
	}

	/**
	 * Get data function
	 *
	 * @param   array() $twitter_id  Array twitter id.
	 *
	 * @since   11.1
	 * @return   dataa
	 */
	public function &getData($twitter_id = array())
	{
		if ($this->_loadData($twitter_id))
		{
			return $this->_data;
		}
		else
		{
			$this->_initData();
		}

		return $this->_data;
	}

	/**
	 * _loadData function
	 *
	 * @param   array() $twitter_id  Array twitter id.
	 *
	 * @since   11.1
	 * @return   true
	 */
	private function _loadData($twitter_id = array())
	{
		if (empty($this->_data))
		{
			if (!empty($twitter_id))
			{
				$query = 'SELECT * FROM #__redtwitter_followed_profiles WHERE state = 1 AND id in (' . implode(',', $twitter_id) . ') ORDER BY id DESC';
			}
			else
			{
				$query = 'SELECT * FROM #__redtwitter_followed_profiles WHERE state = 1 ORDER BY id DESC';
			}

			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));

			return (boolean) $this->_data;
		}

		return true;
	}

	/**
	 * _initData function
	 *
	 * @since   11.1
	 * @return   true
	 */
	private function _initData()
	{
		if (empty($this->_data))
		{
			$detail[0]                  = new stdClass;
			$detail[0]->id              = 0;
			$detail[0]->username        = null;
			$detail[0]->twitterusername = null;
			$detail[0]->twitterpassword = null;
			$detail[0]->private         = 0;
			$detail[0]->params          = null;
			$this->_data                = $detail;

			return (boolean) $this->_data;
		}

		return true;
	}
}
