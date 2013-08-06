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

/**
 * System model.
 *
 * @package     Solidres
 * @subpackage	System
 * @since		0.1.0
 */
class SolidresModelSystem extends JModelAdmin
{
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_solidres.reservationasset', 'reservationasset', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
        {
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('asset.id'))
        {
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');
		}
        else
        {
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
		}

		return $form;
	}

    /**
     * Install sample data
     * 
     * @return bool
     */
	public function installSampleData()
	{
		$config  = JFactory::getConfig();

		$defaultDbType = $config->get('dbtype');

		if ($defaultDbType == 'mysql' || $defaultDbType == 'mysqli')
		{
			$defaultDbType = 'mysql';
		}

		$data = JPATH_COMPONENT_ADMINISTRATOR.'/sql/'. $defaultDbType .'/sample.sql';

		// Attempt to import the database schema.
		if (!file_exists($data))
        {
			$this->setError(JText::sprintf('SR_INSTL_DATABASE_FILE_DOES_NOT_EXIST', $data));
			return false;			
		}
		elseif (!$this->populateDatabase($data))
        {
			$this->setError(JText::sprintf('SR_INSTL_ERROR_DB', $this->getError()));
			return false;
		}

		return true;
	}

    /**
     * Backup Joomla Asset table records and convert to xml
     *
     * @return string
     */
    public function backupAssets()
    {
        $tab = "\t";
        $br = "\n";
        $backup = SRFactory::get('solidres.system.backup');
        $version = JFactory::getDate()->toSql();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.$br;
        $xml .= '<database name="solidres" version="'.$version.'">'.$br;
        $xml .= $tab.$backup->backupJoomlaAsset();
        $xml .= '</database>';

        return $xml;
    }
    
    /**
     * Backup all Solidres tables into sql file
     * 
     * @return string
     */
    public function backupSql()
    {
    	$backup = SRFactory::get('solidres.system.backup');
    	
    	$sql = $backup->backupSolidres();
        return $sql;
    }
    
	/**
	 * Method to import a database schema from a file.
	 *
	 * @access	public
	 * @param	string	$schema Path to the schema file.
	 * @return	boolean	True on success.
	 * @since	1.0
	 */
	function populateDatabase($schema)
	{
		// Initialise variables.
		$return = true;

		// Get the contents of the schema file.
		if (!($buffer = file_get_contents($schema)))
        {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Get an array of queries from the schema and process them.
		$queries = $this->_splitQueries($buffer);
		foreach ($queries as $query)
		{
			// Trim any whitespace.
			$query = trim($query);

			// If the query isn't empty and is not a comment, execute it.
			if (!empty($query) && ($query{0} != '#'))
			{
				// Execute the query.
				$this->_db->setQuery($query);
				$this->_db->execute();

				// Check for errors.
				if ($this->_db->getErrorNum())
                {
					$this->setError($this->_db->getErrorMsg());
					$return = false;
				}
			}
		}

		return $return;
	}

	/**
	 * Method to split up queries from a schema file into an array.
	 *
	 * @access	protected
	 * @param	string	$sql SQL schema.
	 * @return	array	Queries to perform.
	 * @since	1.0
	 */
	function _splitQueries($sql)
	{
		// Initialise variables.
		$buffer		= array();
		$queries	= array();
		$in_string	= false;

		// Trim any whitespace.
		$sql = trim($sql);

		// Remove comment lines.
		$sql = preg_replace("/\n\#[^\n]*/", '', "\n".$sql);

		// Parse the schema file to break up queries.
		for ($i = 0; $i < strlen($sql) - 1; $i ++)
		{
			if ($sql[$i] == ";" && !$in_string)
            {
				$queries[] = substr($sql, 0, $i);
				$sql = substr($sql, $i +1);
				$i = 0;
			}

			if ($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\")
            {
				$in_string = false;
			}
			elseif (!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset ($buffer[0]) || $buffer[0] != "\\"))
            {
				$in_string = $sql[$i];
			}
			if (isset ($buffer[1]))
            {
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}

		// If the is anything left over, add it to the queries.
		if (!empty($sql))
        {
			$queries[] = $sql;
		}

		return $queries;
	}
	/**
	 * In some cases we need to drop all tables related to Solidres
	 * and start importing Sample Data again
     *
     * @return boolean
	 * 
	 */
	public function truncateDatabase()
	{
		$config  = JFactory::getConfig();

		$defaultDbType = $config->get('dbtype');

		if ($defaultDbType == 'mysql' || $defaultDbType == 'mysqli')
		{
			$defaultDbType = 'mysql';
		}

		$data = JPATH_COMPONENT_ADMINISTRATOR.'/sql/'. $defaultDbType .'/empty.sql';
		
		// Attempt to import the database schema.
		if (!file_exists($data))
        {
			$this->setError(JText::sprintf('SR_TRUNCATE_DATABASE_FILE_DOES_NOT_EXIST', $data));
			return false;			
		}
		elseif (!$this->populateDatabase($data))
        {
			$this->setError(JText::sprintf('SR_TRUNCATE_ERROR_DB', $this->getError()));
			return false;
		}

		return true;
	}
		
	/**
	 * Method to reset a database schema from a file.
	 *
	 * @access	public
	 * @param	string	$schema Path to the schema file.
	 * @return	boolean	True on success.
	 * @since	1.0
	 */
	public function resetDatabase($schema)
	{
		// Initialise variables.
		$return = true;

		// Get the contents of the schema file.
		if (!($buffer = file_get_contents($schema)))
        {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Get an array of queries from the schema and process them.
		$queries = $this->_splitQueries($buffer);
		$lastQuery = $queries[count($queries) - 1];
        
		foreach ($queries as $query)
		{
			// Trim any whitespace.
			$query = trim($query);

			// If the query isn't empty and is not a comment, execute it.
			if (!empty($query) && ($query{0} != '#'))
			{
				// Execute the query.
				$this->_db->setQuery($query);
				$this->_db->execute();

				// Check for errors.
				if ($this->_db->getErrorNum())
                {
					$this->setError($this->_db->getErrorMsg());
					$return = false;
				}
			}
		}

		return $return;
	}

	/**
	 * Restore the database from uploaded file
     *
	 * @param $file
     *
     * @return boolean
	 */
	public function restore($file)
	{
		$query = $this->_db->getQuery(true);
		
		$strQuery = 'SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;';
		$this->_db->setQuery($strQuery);
		$this->_db->execute();

		if ($this->_db->getErrorNum())
        {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		
		$strQuery = 'DELETE FROM '.$this->_db->quoteName('#__assets').' WHERE name LIKE \'com_solidres%\';';
		$this->_db->setQuery($strQuery);
		$this->_db->execute();

		if ($this->_db->getErrorNum())
        {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		$zipFile = JFactory::getConfig()->get('tmp_path').'/'.$file['name'];
		JFile::upload($file['tmp_name'], $zipFile);
		
		SRFactory::get('solidres.utilities.ziparchive')->unZip($zipFile, JFactory::getConfig()->get('tmp_path').'/zip/');
		JFile::delete($zipFile);
		
		$listFiles = JFolder::files(JFactory::getConfig()->get('tmp_path').'/zip');
		
		$xmlPath = '';
		$sqlPath = '';
		
		foreach ($listFiles as $f)
		{
			$path = JFactory::getConfig()->get('tmp_path').'/zip/'.$f;
			if(JFile::getExt($path) == 'xml')
            {
				$xmlPath = $path;
			}
            else
            {
				$sqlPath = $path;
			}
		}
		
		$xml = JFactory::getXML($xmlPath);
		
		foreach ($xml->table as $table)
		{
			$query->clear();
			$query->select('MAX(id) max_id, MAX(rgt) max_right');
			$query->from($this->_db->quoteName('#__assets'));
			$this->_db->setQuery($query);
			$result     = $this->_db->loadObject();
			$newId      = (int)$result->max_id + 1;
			$newRight   = (int)$result->max_right;
			
			$subRange   = $newId - (int)$table->row[0]['id'];
			$subRight   = $newRight - (int)$table->row[0]['lft'];
			$rootRight  = $newRight;
			foreach ($table->row as $row)
			{
				//insert this row to asset
				if($row['parent_id'] == 1)
				{
					//update root node
					$rootRight = $row['rgt'] + $subRight + 1;
					$query->clear();
					$query->update($this->_db->quoteName('#__assets'));
					$query->set('rgt = '.$this->_db->quote($rootRight));
					$query->where('id = 1');
					$this->_db->setQuery($query);
					$this->_db->execute();
						
					$query->clear();
					$query->insert($this->_db->quoteName('#__assets'));
					foreach ($row->attributes() as $k=>$v)
					{
						if($k == 'id')
                        {
							$query->set($k.'='.$this->_db->quote(($v + $subRange)));
						}
                        elseif ($k == 'ltf' || $k == 'rgt')
                        {
							$query->set($k.'='.$this->_db->quote(($v + $subRight)));
						}
                        else
                        {
							$query->set($k.'='.$this->_db->quote(htmlspecialchars_decode($v)));
						}
					}
				} else {
					$query->clear();
					$query->insert($this->_db->quoteName('#__assets'));
					foreach ($row->attributes() as $k=>$v)
					{
						if($k == 'id' || $k == 'parent_id')
                        {
							$query->set($k.'='.$this->_db->quote(($v + $subRange)));
						}
                        elseif ($k == 'ltf' || $k == 'rgt')
                        {
							$query->set($k.'='.$this->_db->quote(($v + $subRight)));
						}
                        else
                        {
							$query->set($k.'='.$this->_db->quote(htmlspecialchars_decode($v)));
						}
					}
				}		
				$this->_db->setQuery($query);
				$this->_db->execute();
				
				if ($this->_db->getErrorNum())
                {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
					
				//insert into children table
				foreach ($row->childtable as $childtable)
				{
					$tableName = $childtable['name'];
					foreach ($childtable->childrow as $childrow)
					{
						$query->clear();
						$query->insert($tableName);
						foreach ($childrow->attributes() as $k=>$v)
						{
							if($k == 'asset_id')
                            {
								$query->set($k.'='.$this->_db->quote(($v + $subRange)));
							}
                            elseif ($k == 'id') {

							}
                            else
                            {
								$query->set($k.'='.$this->_db->quote(htmlspecialchars_decode($v)));
							}
						}
						$this->_db->setQuery($query);
						$this->_db->execute();
					
						if ($this->_db->getErrorNum())
                        {
							$this->setError($this->_db->getErrorMsg());
							return false;
						}
					}
				}
			}
		}
		
		if(!$sqlContent = file_get_contents($sqlPath))
        {
			$this->setError(JText::_('SR_RESTORE_READ_FILE_ERROR'));
			return false;
		}
		
		$queries = $this->_splitQueries($sqlContent);
		
		foreach ($queries as $q)
		{
			$q = trim($q);
			
			if (!empty($q) && ($q{0} != '#'))
            {
				$this->_db->setQuery($q);
				$this->_db->execute();

				// Check for errors.
				if ($this->_db->getErrorNum())
                {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}
		
		JFolder::delete(JFactory::getConfig()->get('tmp_path').'/zip');
		
		$strQuery = 'SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS';
		$this->_db->setQuery($strQuery);
		$this->_db->execute();
		if ($this->_db->getErrorNum())
        {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		return true;
	}
}