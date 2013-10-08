<?php
/**
 * jUpgrade
 *
 * @version		$Id$
 * @package		MatWare
 * @subpackage	com_jupgrade
 * @copyright	Copyright 2006 - 2011 Matias Aguire. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 * @author		Matias Aguirre <maguirre@matware.com.ar>
 * @link		http://www.matware.com.ar
 */

/**
 * Database methods
 *
 * This class search for extensions to be migrated
 *
 * @since	3.0.0
 */
class jUpgradeUsersDefault extends jUpgrade
{
	/**
	 * @var      
	 * @since  3.0
	 */
	protected	$usergroup_map = array(
			// Old	=> // New
			0		=> 0,	// ROOT
			28		=> 1,	// USERS (=Public)
			29		=> 1,	// Public Frontend
			18		=> 2,	// Registered
			19		=> 3,	// Author
			20		=> 4,	// Editor
			21		=> 5,	// Publisher
			30		=> 6,	// Public Backend (=Manager)
			23		=> 6,	// Manager
			24		=> 7,	// Administrator
			25		=> 8,	// Super Administrator
	);

	/**
	 * Get the mapping of the old usergroups to the new usergroup id's.
	 *
	 * @return	array	An array with keys of the old id's and values being the new id's.
	 * @since	1.1.0
	 */
	protected function getUsergroupIdMap()
	{
		return $this->usergroup_map;
	}

	/**
	 * Map old user group from Joomla 1.5 to new installation.
	 *
	 * @return	int	New user group
	 * @since	1.2.2
	 */
	protected function mapUserGroup($id) {
		return isset($this->usergroup_map[$id]) ? $this->usergroup_map[$id] : $id;
	}

	/**
	 * Method to get a map of the User id to ARO id.
	 *
	 * @returns	array	An array of the user id's keyed by ARO id.
	 * @since	0.4.4
	 * @throws	Exception on database error.
	 */
	protected function getUserIdAroMap($aro_id)
	{
		$this->_db_old->setQuery(
			'SELECT value' .
			' FROM #__core_acl_aro' .
			' WHERE id = '.$aro_id
		);

		$return	= $this->_db_old->loadResult();
		$error	= $this->_db_old->getErrorMsg();

		// Check for query error.
		if ($error) {
			throw new Exception($error);
		}

		return $return;
	}
}
