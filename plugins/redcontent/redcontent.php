<?php
/**
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

require_once JPATH_SITE.'/components/com_content/router.php';

/**
 * Content Search plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	Search.content
 * @since		1.6
 */
class plgSearchRedcontent extends JPlugin
{
	/**
	 * Content Search method
	 * The sql must return the following fields that are used in a common display
	 * routine: href, title, section, created, text, browsernav
	 * @param string Target search string
	 * @param string mathcing option, exact|any|all
	 * @param string ordering option, newest|oldest|popular|alpha|category
	 * @param mixed An array if the search it to be restricted to areas, null if search all
	 */
	function onContentSearch($text, $phrase='', $ordering='', $areas=null)
	{
		$db		= JFactory::getDbo();
		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();
		$groups	= implode(',', $user->getAuthorisedViewLevels());
		$tag = JFactory::getLanguage()->getTag();

		require_once JPATH_SITE . '/components/com_content/helpers/route.php';
		require_once JPATH_ADMINISTRATOR . '/components/com_search/helpers/search.php';

		if (is_array($areas)) {
			if (!array_intersect($areas, array_keys($this->onContentSearchAreas()))) {
				return array();
			}
		}

		$sContent		= $this->params->get('search_redcontent',	    1);
		$limit			= $this->params->def('search_redcontent_limit',	50);

		$nullDate		= $db->getNullDate();
		$date = JFactory::getDate();
		$now = $date->toSql();

        $itemId = $app->input->get('Itemid', 0, 'INT');
        // Get input cookie object
        $inputCookie  = $app->input->cookie;

        // Get cookie data
        $searchByWeek = $inputCookie->get($name = 'searchByWeek', $defaultValue = null);

        // Remove cookie
        $inputCookie->set('searchByWeek', null, time() - 1);

		$text = trim($text);
        $categoryListSearchByWeek = array();
        if(!empty($searchByWeek) && $searchByWeek)
        {
            $session = JFactory::getSession();
            $session->set('searchword', (int)($text), 'redcontent_search');
            $categoryListSearchByWeek = $session->get('categoryIdList', '', 'SearchByWeekModule');
	        $session->clear('categoryIdList', 'SearchByWeekModule');

            $week = is_numeric($text) ? $text : 0;
            $dateFromWeek = date('Y-m-d H:m:s', strtotime('-' . $week . ' week'));
        }

		if ($text == '') {
			return array();
		}

		switch ($phrase) {
			case 'exact':
                $wheres2	= array();
                if($searchByWeek)
                {
                    if($week > 0)
                    {
                        $wheres2[] = "DATE(a.timecreated) >= DATE('" . $dateFromWeek . "')";
                    }
                }
                else
                {
                    $text		= $db->Quote('%'.$db->escape($text, true).'%', false);
                    $wheres2[]	= 'a.documentname LIKE '.$text;
                    $wheres2[]	= 'a.metakey LIKE '.$text;
                    $wheres2[]	= 'a.metadesc LIKE '.$text;
                }

				$where		= '(' . implode(') OR (', $wheres2) . ')';
				break;

			case 'all':
			case 'any':
			default:
                $wheres = array();
                if($searchByWeek)
                {
                    if($week > 0)
                    {
                        $wheres[] = "DATE(a.timecreated) >= DATE('" . $dateFromWeek . "')";
                    }
                }
                else
                {
                    $words = explode(' ', $text);
                    foreach ($words as $word) {
                        $word		= $db->Quote('%'.$db->escape($word, true).'%', false);
                        $wheres2	= array();
                        $wheres2[]	= 'a.documentname LIKE '.$word;
                        $wheres2[]	= 'a.metakey LIKE '.$word;
                        $wheres2[]	= 'a.metadesc LIKE '.$word;
                        $wheres[]	= implode(' OR ', $wheres2);
                    }
                }

				$where = '(' . implode(($phrase == 'all' ? ') AND (' : ') OR ('), $wheres) . ')';
				break;
		}

		switch ($ordering) {
			case 'oldest':
				$order = 'a.timecreated ASC';
				break;

			case 'popular':
				$order = 'a.hits DESC';
				break;

			case 'alpha':
				$order = 'a.documentname ASC';
				break;

			case 'category':
				$order = 'a.documentname ASC';
				break;

			case 'newest':
			default:
				$order = 'a.timecreated DESC';
				break;
		}

		$rows = array();
		$query	= $db->getQuery(true);

		// search articles
		if ($sContent && $limit > 0)
		{
			$query->clear();

			$query->select('a.id, a.documentname AS title, a.metadesc, a.metakey, a.timecreated AS created, a.category_id');
			$query->select($query->concatenate(array('a.documentname')).' AS text');

			$query->from('#__redcontent_articles  AS a');
			$query->where('('. $where .')' . 'AND a.state=1 AND a.access IN ('.$groups.') '
						.'AND (a.publish_start = '.$db->Quote($nullDate).' OR a.publish_start <= '.$db->Quote($now).') '
						.'AND (a.publish_end = '.$db->Quote($nullDate).' OR a.publish_end >= '.$db->Quote($now).')' );
			$query->group('a.id, a.documentname, a.timecreated, a.metadesc, a.metakey');
			$query->order($order);

			// Filter by language
			if ($app->isSite() && $app->getLanguageFilter()) {
				$query->where('a.language in (' . $db->Quote($tag) . ',' . $db->Quote('*') . ')');
			}

			$db->setQuery($query, 0, $limit);
			$list = $db->loadObjectList();

			if (isset($list))
			{
				foreach($list as $key => $item)
				{
                    if(!empty($searchByWeek) && $searchByWeek && !empty($categoryListSearchByWeek) && count($categoryListSearchByWeek) > 0)
                    {
                        $catid = "";
                        $categoriesArr = explode(',', $item->category_id);
                        if(is_array($categoriesArr))
                        {
                            foreach($categoriesArr as $category)
                            {
                                $arrKey = array_search($category, $categoryListSearchByWeek);
                                if($arrKey !== false)
                                {
                                    $catid = $categoryListSearchByWeek[$arrKey];
                                    break;
                                }
                            }
                        }

                        if(!empty($catid))
                        {
                            $list[$key]->href = JRoute::_("index.php?option=com_redcontent&view=article&Itemid=" . $itemId . "&catid=" . $catid . "&id=" . $item->id);
                        }
                    }
                    else
                    {
                        $categoriesArr = explode(',', $item->category_id);
                        $catid = $item->category_id;
                        if(is_array($categoriesArr))
                        {
                            $catid = $categoriesArr[0];
                        }
                        $list[$key]->href = JRoute::_("index.php?option=com_redcontent&view=article&Itemid=" . $itemId . "&catid=" . $catid . "&id=" . $item->id);
                    }
				}
			}
			$rows[] = $list;
		}

        // Get cookie data
        $isInfoSys = $inputCookie->get($name = 'isInfoSys', $defaultValue = null);
        // Remove cookie
        $inputCookie->set('isInfoSys', null, time() - 1);

        $sesson = JFactory::getSession();
        if($isInfoSys)
        {
            $categoryList = $sesson->get('categoryIdList_Infosys', '', 'SearchModule');
            $sesson->clear('categoryIdList_Infosys', 'SearchModule');
        }
        else
        {
            $categoryList = $sesson->get('categoryIdList', '', 'SearchModule');
            $sesson->clear('categoryIdList', 'SearchModule');
        }

		if(!empty($searchByWeek) && $searchByWeek && !empty($categoryListSearchByWeek) && count($categoryListSearchByWeek) > 0)
		{
			$categoryList = $categoryListSearchByWeek;
		}

		$limit -= count($list);

		$results = array();
		if (is_array($rows) && count($rows))
		{
			foreach($rows as $row)
			{
                if(!empty($categoryList) && is_array($categoryList))
                {
                    $row_tmp = array();
                    if(is_array($row) && count($row) > 0)
                    {
                        foreach($row as $item)
                        {
                            $catIdArr = explode(',', $item->category_id);
                            if(!empty($catIdArr) && is_array($catIdArr))
                            {
                                foreach($catIdArr as $catId)
                                {
                                    if(array_search($catId, $categoryList) !== false)
                                    {
                                        $row_tmp[] = $item;
                                        break;
                                    }
                                }
                            }
                        }
                        if(count($row_tmp) > 0)
                        {
                            $results = array_merge($results, (array) $row_tmp);
                        }
                    }
                }
                else
                {
                    $results = array_merge($results, (array) $row);
                }
			}
		}

		return $results;
	}
}
