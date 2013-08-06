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

jimport('joomla.user.user');

/**
 * User class.  Handles all application interaction with a user.
 * Extendded from JUser so that we could control the work flow more convenient
 *
 * @package     Joomla.Platform
 * @subpackage  User
 * @since      11.1
 */
class SRUser extends JUser
{
	/**
	 * Constructor activating the default information of the language
	 *
	 * @param   integer  $identifier  The primary key of the user to load (optional).
	 *
	 * @return  JUser
	 *
	 * @since   11.1
	 */
	public function __construct($identifier = 0)
	{
		parent::__construct($identifier);
	}
	
    /**
	 * Method to save the JUser object to the database
	 *
	 * @param   boolean  $updateOnly  Save the object only if not a new user
	 *                                Currently only used in the user reset password method.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 * @throws  exception
	 */
	public function save()
	{
        // Create the user table object
		$table			= $this->getTable();
		$this->params	= (string) $this->_params;
		
		$table->bind($this->getProperties());
		// Allow an exception to be thrown.
		try
		{
			
			// Check and store the object.
			if (!$table->check()) {
				$this->setError($table->getError());
				return false;
			}

			// If user is made a Super Admin group and user is NOT a Super Admin
			//
			// @todo ACL - this needs to be acl checked
			//
			$my = JFactory::getUser();
			
			//are we creating a new user
			$isNew = empty($this->id);

			// Get the old user
			$oldUser = new SRUser($this->id);

			//
			// Access Checks
			//

			// The only mandatory check is that only Super Admins can operate on other Super Admin accounts.
			// To add additional business rules, use a user plugin and throw an Exception with onUserBeforeSave.

			// Check if I am a Super Admin
			$iAmSuperAdmin	= $my->authorise('core.admin');

			// We are only worried about edits to this account if I am not a Super Admin.
			if ($iAmSuperAdmin != true) {
				if ($isNew) {
					// Check if the new user is being put into a Super Admin group.
					foreach ($this->groups as $key => $groupId)
					{
						if (JAccess::checkGroup($groupId, 'core.admin')) {
							throw new Exception(JText::_('JLIB_USER_ERROR_NOT_SUPERADMIN'));
						}
					}
				}
				else {
					// I am not a Super Admin, and this one is, so fail.
					if (JAccess::check($this->id, 'core.admin')) {
						throw new Exception(JText::_('JLIB_USER_ERROR_NOT_SUPERADMIN'));
					}

					if ($this->groups != null) {
					// I am not a Super Admin and I'm trying to make one.
						foreach ($this->groups as $groupId)
						{
							if (JAccess::checkGroup($groupId, 'core.admin')) {
								throw new Exception(JText::_('JLIB_USER_ERROR_NOT_SUPERADMIN'));
							}
						}
					}
				}
			}
			

			// Fire the onUserBeforeSave event.
			JPluginHelper::importPlugin('user');
			$dispatcher = JDispatcher::getInstance();

			$result = $dispatcher->trigger('onUserBeforeSave', array($oldUser->getProperties(), $isNew, $this->getProperties()));
			if (in_array(false, $result, true)) {
				// Plugin will have to raise its own error or throw an exception.
				return false;
			}

			// Store the user data in the database
			if (!($result = $table->store())) {
				throw new Exception($table->getError());
			}
			// Set the id for the JUser object in case we created a new user.
			if (empty($this->id)) {
				$this->id = $table->get('id');
			}

			if ($my->id == $table->id) {
				$registry = new JRegistry;
				$registry->loadString($table->params);
				$my->setParameters($registry);
			}

		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		return $result;
	}
	
	/**
	 * Returns the global User object, only creating it if it
	 * doesn't already exist.
	 *
	 * @param   integer  $identifier  The user to load - Can be an integer or string - If string, it is converted to ID automatically.
	 *
	 * @return  JUser  The User object.
	 * @since   11.1
	 */
	public static function getInstance($identifier = 0)
	{
		static $instances;

		if (!isset ($instances)) {
			$instances = array ();
		}

		// Find the user id
		if (!is_numeric($identifier)) {
			jimport('joomla.user.helper');
			if (!$id = JUserHelper::getUserId($identifier)) {
				JError::raiseWarning('SOME_ERROR_CODE', JText::sprintf('JLIB_USER_ERROR_ID_NOT_EXISTS', $identifier));
				$retval = false;
				return $retval;
			}
		}
		else {
			$id = $identifier;
		}

		if (empty($instances[$id])) {
			$user = new SRUser($id);
			$instances[$id] = $user;
		}

		return $instances[$id];
	}
}