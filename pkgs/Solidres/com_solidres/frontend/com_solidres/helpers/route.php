<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
jimport('joomla.application.categories');

/**
 * Solidres Component Route Helper
 *
 * @package     Solidres
 * @subpackage	Router
 * @since		0.1.0
 */
abstract class SolidresHelperRoute
{ 
	protected static $lookup;
	/**
	 * @param	int	The route of the weblink
	 */
	public static function getSolidresRoute($id, $catid)
	{
		$needles = array(
			'weblink'  => array((int) $id)
		);
		//Create the link
		$link = 'index.php?option=com_weblinks&view=weblink&id='. $id;
		if ($catid > 1)
		{
			$categories = JCategories::getInstance('Weblinks');
			$category = $categories->get($catid);
			$needles['category'] = array_reverse($category->getPath());
			$needles['categories'] = $needles['category'];
			$link .= '&catid='.$catid;
		}

		if ($item = WeblinksHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		};

		return $link;
	}

	public static function getCategoryRoute($catid)
	{
		$categories = JCategories::getInstance('Weblinks');
		$category = $categories->get((int)$catid);
		$catids = array_reverse($category->getPath());
		$needles = array(
			'category' => $catids,
			'categories' => $catids
		);
		//Create the link
		$link = 'index.php?option=com_weblinks&view=category&id='.(int)$catid;

		if ($item = WeblinksHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		};

		return $link;
	}

	protected static function _findItem($needles)
	{
		// Prepare the reverse lookup array.
		if (self::$lookup === null)
		{
			self::$lookup = array();

			$component	= &JComponentHelper::getComponent('com_weblinks');
			$menus		= &JApplication::getMenu('site');
			$items		= $menus->getItems('component_id', $component->id);
			foreach ($items as $item)
			{
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];
					if (!isset(self::$lookup[$view])) {
						self::$lookup[$view] = array();
					}
					if (isset($item->query['id'])) {
						self::$lookup[$view][$item->query['id']] = $item->id;
					}
				}
			}
		}
		foreach ($needles as $view => $ids)
		{
			if (isset(self::$lookup[$view]))
			{
				//return array_shift(array_intersect_key(self::$lookup[$view], $ids));
				foreach($ids as $id)
				{
					if (isset(self::$lookup[$view][(int)$id])) {
						return self::$lookup[$view][(int)$id];
					}
				}
			}
		}

		return null;
	}
}