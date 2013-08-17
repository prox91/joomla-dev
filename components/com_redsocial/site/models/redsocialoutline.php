<?php
/**
 * @package     redSocialstream
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');
class redsocialstreamModelredsocialoutline extends JModel
{
	function redsocialoutlinecontent()
	{

		$query = $this->_db->getQuery(true);
		$query->select('g.*, pt.*,p.*, g.id as groupid, g.title as grouptitle, pt.id as profiletypeid,
            pt.title as profiletypetitle, p.id as profilereferenceid, p.title as profilereferencetitle');
		$query->join('LEFT', '#__redsocialstream_profiletype AS pt ON p.profiletypeid=pt.id');
		$query->join('LEFT', '#__redsocialstream_group as g ON p.groupid=g.id');
		$query->from('#__redsocialstream_profilereference AS p');
		$query->order('g.ordering, p.ordering, pt.ordering, p.title ');

		$this->_db->setQuery($query);
		$rows = $this->_db->loadObjectList();

		$data = array();
		foreach ($rows as $row)
		{
			$currentgroup = null;
			foreach ($data as $group)
			{
				if ($row->groupid == $group->groupid)
				{
					$currentgroup = $group;

				}
			}
			;

			if (is_null($currentgroup))
			{
				$currentgroup = clone $row;
				$currentgroup->title = $row->grouptitle;
				$currentgroup->datatype = 'group';
				$currentgroup->profiletypes = array();
				$data[] = $currentgroup;
			}
			;

			$currentprofiletype = null;
			foreach ($currentgroup->profiletypes as $profiletype)
			{
				if ($row->profiletypeid == $profiletype->profiletypeid)
				{
					$currentprofiletype = $profiletype;

				}
			}
			;

			if (is_null($currentprofiletype))
			{
				$currentprofiletype = clone $row;
				$currentprofiletype->title = $row->profiletypetitle;
				$currentprofiletype->datatype = 'profiletype';
				$currentprofiletype->profilereferences = array();
				$currentgroup->profiletypes[] = $currentprofiletype;
			}

			$currentprofilereference = clone $row;
			$currentprofilereference->datatype = 'profilereference';
			$currentprofilereference->title = $row->profilereferencetitle;

			$currentprofiletype->profilereferences[] = $currentprofilereference;


		}
		;

		return $data;
	}

}

?>
