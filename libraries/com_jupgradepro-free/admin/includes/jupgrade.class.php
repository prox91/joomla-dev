<?php
/**
 * jUpgrade
 *
 * @version		  $Id$
 * @package		  MatWare
 * @subpackage	com_jupgrade
 * @author      Matias Aguirre <maguirre@matware.com.ar>
 * @link        http://www.matware.com.ar
 * @copyright		Copyright 2006 - 2011 Matias Aguirre. All rights reserved.
 * @license		  GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

/**
 * jUpgrade utility class for migrations
 *
 * @package		MatWare
 * @subpackage	com_jupgrade
 */
class jUpgrade
{	
	/**
	 * @var      
	 * @since  3.0
	 */
	public $params = null;
	
	/**
	 * @var      
	 * @since  3.0
	 */
	public $_db = null;

	/**
	 * @var      
	 * @since  3.0
	 */
	public $_db_old = null;

	/**
	 * @var      
	 * @since  3.0
	 */
	public $_version = null;

	/**
	 * @var	array
	 * @since  3.0
	 */
	private $_step = array();

	/**
	 * @var    array  List of possible parameters.
	 * @since  12.1
	 */
	private $_reserved = array(
		'id',
		'cid',
		'lastid',
		'name',
		'title',
		'class',
		'category',
		'status',
		'extension',
		'laststep',
		'state',
		'xml'
	);

	/**
	 * @var bool Can drop
	 * @since	0.4.
	 */
	public $canDrop = false;

	function __construct($step = null)
	{
		// Set the step params	
		$this->setParameters((array) $step);
			
		$this->checkTimeout();

		jimport('legacy.component.helper');
		jimport('cms.version.version');

		// Getting the Joomla version
		if (class_exists('JVersion')) {
			// Getting the parameters
			$this->params	= JComponentHelper::getParams('com_jupgradepro');

			// Getting the J! version
			$version = new JVersion;
			$this->_version = $version->RELEASE;
		}else{
			// Getting the parameters
			$this->params = new JRegistry(new JConfig);

			$this->_version = $this->params->get('RELEASE');
		}

		// Creating dabatase instance for this installation
		$this->_db = JFactory::getDBO();

		// Creating old dabatase instance
		if ($this->params->get('method') == 'database') {
			// Web
			if (class_exists('JVersion')) {
				$db_config['driver'] = $this->params->get('driver');
				$db_config['host'] = $this->params->get('hostname');
				$db_config['user'] = $this->params->get('username');
				$db_config['password'] = $this->params->get('password');
				$db_config['database'] = $this->params->get('database');
				$db_config['prefix'] = $this->params->get('prefix');
			// Cli
			}else{
				$db_config['driver'] = $this->params->get('old_dbtype');
				$db_config['host'] = $this->params->get('old_host');
				$db_config['user'] = $this->params->get('old_user');
				$db_config['password'] = $this->params->get('old_password');
				$db_config['database'] = $this->params->get('old_db');
				$db_config['prefix'] = $this->params->get('old_prefix');
			}

			$this->_db_old = JDatabase::getInstance($db_config);
		}

		// Set timelimit to 0
		if(!@ini_get('safe_mode')) {
			if (!empty($this->params->timelimit)) {
				set_time_limit(0);
			}
		}

		// Make sure we can see all errors.
		if (!empty($this->params->error_reporting)) {
			error_reporting(E_ALL);
			@ini_set('display_errors', 1);
		}

		// MySQL grants check
		$query = "SHOW GRANTS FOR CURRENT_USER";
		$this->_db->setQuery( $query );
		$list = $this->_db->loadRowList();
		$grant = isset($list[1][0]) ? $list[1][0] : $list[0][0];
		$grant = empty($list[1][0]) ? $list[0][0] : $list[1][0];

		if (strpos($grant, 'DROP') == true || strpos($grant, 'ALL') == true) {
			$this->canDrop = true;
		}
	}

	/**
	 *
	 * @param   stdClass   $options  Parameters to be passed to the database driver.
	 *
	 * @return  jUpgrade  A jupgrade object.
	 *
	 * @since  3.0.0
	 */
	static function getInstance($options = null)
	{
		if ($options == null) {
			return false;
		}

		// Require the file
		if (JFile::exists(JPATH_COMPONENT_ADMINISTRATOR.'/includes/migrate_'.$options->name.'.php')) {
			require_once JPATH_COMPONENT_ADMINISTRATOR.'/includes/migrate_'.$options->name.'.php';
		}

		// Getting the class name
		$class = $options->class;

		// If the class still doesn't exist we have nothing left to do but throw an exception.  We did our best.
		if (!class_exists($class))
		{
			throw new RuntimeException(sprintf('jUpgrade object not exists: %s', $options->name));
		}

		// Create our new jUpgrade connector based on the options given.
		try
		{
			$instance = new $class($options);
		}
		catch (RuntimeException $e)
		{
			throw new RuntimeException(sprintf('Unable to load jUpgrade object: %s', $e->getMessage()));
		}

		return $instance;
	}

	/**
	 * Method to set the parameters. 
	 *
	 * @param   array  $parameters  The parameters to set.
	 *
	 * @return  void
	 *
	 * @since   3.0.0
	 */
	public function setParameters($data)
	{
		// Ensure that only valid OAuth parameters are set if they exist.
		if (!empty($data))
		{
			foreach ($data as $k => $v)
			{
				if (in_array($k, $this->_reserved))
				{
					// Perform url decoding so that any use of '+' as the encoding of the space character is correctly handled.
					$this->_step[$k] = urldecode((string) $v);
				}
			}
		}
	}

	public function getStepName()
	{
		return $this->_step['name'];
	}

	/**
	 * The public entry point for the class.
	 *
	 * @return	boolean
	 * @since	0.4.
	 */
	public function upgrade()
	{
		try
		{
			$this->setDestinationData();
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return true;
	}

	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 * @since	0.4.
	 * @throws	Exception
	 */
	protected function setDestinationData($rows = null)
	{
		$method = $this->params->get('method');

		// Get the source data.
		if ($rows === null) {
			$rows = $this->dataSwitch();
		}

		if ( $method == 'database' OR $method == 'database_all') {
			if (method_exists($this, 'databaseHook')) { 
				$rows = $this->databaseHook($rows);
			}
		}

		$rows = $this->dataHook($rows);

		if ($rows != false) {
			$this->insertData($rows);
		}
	}

	/*
	 * Fake method of dataHook if it not exists
	 *
	 * @return	void
	 * @since	3.0.0
	 * @throws	Exception
	 */
	public function dataHook($rows)
	{
		// Do customisation of the params field here for specific data.
		return $rows;	
	}

	/**
	 * loadData
	 *
	 * @return	void
	 * @since	3.0.0
	 * @throws	Exception
	 */
	protected function dataSwitch($type = null)
	{
		$method = $this->params->get('method');

		$rows = array();

		switch ($method) {
			case 'rest':
				$type = ($type == null) ? $this->getStepName() : $type;

				if ( ($type == 'components') OR ($type == 'ext_modules') OR ($type == 'plugins')) {
					$rows = $this->getSourceDataRest($type);
				}else{
					$rows = $this->getSourceDataRestIndividual($type);
				}
		    break;
			case 'database':
		    $rows = $this->getSourceDatabase();
		    break;
		}

		return $rows;
	}

	/**
	 * Get total of the rows of the table
	 *
	 * @access	public
	 * @return	int	The total of rows
	 */
	public function getSourceDatabase( )
	{
		$cache_limit = $this->params->get('cache_limit');

		$key = $this->_tbl_key;

		$oid = $this->_getStepID();

		if ($oid === null) {
			return false;
		}

		// Get the conditions
		$conditions = $this->getConditionsHook();

		$where = '';
		if ( isset( $conditions['where'] ) ) {
			$where = count( $conditions['where'] ) ? 'WHERE ' . implode( ' AND ', $conditions['where'] ) : '';
		}
		$where_or = '';
		if (isset($conditions['where_or'])) {
			$where_or = count( $conditions['where_or'] ) ? 'WHERE ' . implode( ' OR ', $conditions['where_or'] ) : '';
		}		
		$select = isset($conditions['select']) ? $conditions['select'] : '*';
		$as = isset($conditions['as']) ? 'AS '.$conditions['as'] : '';
		$group_by = isset($conditions['group_by']) ? 'GROUP BY '.$conditions['group_by'] : '';

		$join = '';
		if (isset($conditions['join'])) {
			$join = count( $conditions['join'] ) ? implode( ' ', $conditions['join'] ) : '';
		}

		$order = isset($conditions['order']) ? "ORDER BY " . $conditions['order'] : "ORDER BY {$key} ASC";

		$limit = "LIMIT {$oid}, {$cache_limit}";

		// Get the row
		$query = "SELECT {$select} FROM {$this->getTableName()} {$as} {$join} {$where}{$where_or} {$group_by} {$order} {$limit}";
		$this->_db_old->setQuery( $query );
		//echo "\n$query\n";
		$rows = $this->_db_old->loadObjectList();

		if (is_array($rows)) {
			return $rows;
		}
		else
		{
			throw new Exception( $this->_db_old->getErrorMsg() );
			return false;
		}
	}

	/**
	 * 
	 *
	 * @return  boolean  True if the user and pass are authorized
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 */
	public function _updateID($id)
	{	
		$query = "UPDATE `jupgrade_steps` SET `cid` = '{$id}' WHERE name = ".$this->_db->quote($this->_step['name']);
		$this->_db->setQuery( $query );

		return $this->_db->query();
	}

	/**
	 * Update the step id
	 *
	 * @return  int  The next id
	 *
	 * @since   3.0.0
	 */
	public function _getStepID()
	{
		$query = 'SELECT `cid` FROM `jupgrade_steps`'
		. ' WHERE name = '. $this->_db->quote($this->_step['name']);
		 $this->_db->setQuery( $query );
		$stepid = (int)  $this->_db->loadResult();

		return $stepid;
	}

	/**
	 * Get total of the rows of the table
	 *
	 * @access	public
	 * @return	int	The total of rows
	 */
	public function getTotal()
	{
		$method = $this->params->get('method');

		$total = 0;

		switch ($method) {
			case 'rest':
				$total = $this->getTotalRest($this->getStepName());
		    break;
			case 'database':
			case 'database_all':
		    $total = $this->getTotalDatabase();
		    break;
		}

		return $total;
	}

	/**
	 * Get total of the rows of the table
	 *
	 * @access	public
	 * @return	int	The total of rows
	 */
	public function getTotalDatabase()
	{
		$conditions = $this->getConditionsHook();

		$where = '';
		$where_or = '';

		if ( isset( $conditions['where'] ) ) {
			$where = count( $conditions['where'] ) ? 'WHERE ' . implode( ' AND ', $conditions['where'] ) : '';
		}
		if ( isset( $conditions['where_or'] ) ) {
			$where_or = count( $conditions['where_or'] ) ? 'WHERE ' . implode( ' OR ', $conditions['where_or'] ) : '';
		}

		$as = isset($conditions['as']) ? 'AS '.$conditions['as'] : '';

		$join = '';
		if (isset($conditions['join'])) {
			$join = count( $conditions['join'] ) ? implode( ' ', $conditions['join'] ) : '';
		}

		/// Get Total
		$query = "SELECT COUNT(*) FROM {$this->source} {$as} {$join} {$where}{$where_or}";
		$this->_db_old->setQuery( $query );
		$total = $this->_db_old->loadResult();

		return (int)$total;
	}

	/**
	 * Get total of the rows of the table using RESTful
	 *
	 * @access	public
	 * @return	int	The total of rows
	 */
	public function getTotalRest($table)
	{
		$total = $this->requestRest('total', $table);

		return (int)$total;
	}

	/*
	 *
	 * @return	void
	 * @since	3.0.0
	 * @throws	Exception
	 */
	public function getConditionsHook()
	{
		$conditions = array();		
		$conditions['where'] = array();
		// Do customisation of the params field here for specific data.
		return $conditions;	
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since	0.4.4
	 * @throws	Exception
	 */
	public function &getRestData()
	{
		$data = array();
	
		// Setting the headers for REST
		$rest_username = $this->params->get('rest_username');
		$rest_password = $this->params->get('rest_password');
		$rest_key = $this->params->get('rest_key');

		// Setting the headers for REST
		$str = $rest_username.":".$rest_password;
		$data['Authorization'] = base64_encode($str);

		// Encoding user
		$user_encode = $rest_username.":".$rest_key;
		$data['AUTH_USER'] = base64_encode($user_encode);
		// Sending by other way, some servers not allow AUTH_ values
		$data['USER'] = base64_encode($user_encode);

		// Encoding password
		$pw_encode = $rest_password.":".$rest_key;
		$data['AUTH_PW'] = base64_encode($pw_encode);
		// Sending by other way, some servers not allow AUTH_ values
		$data['PW'] = base64_encode($pw_encode);

		// Encoding key
		$key_encode = $rest_key.":".$rest_key;
		$data['KEY'] = base64_encode($key_encode);

		return $data;
	}

	/**
	 * Get a single row
	 *
	 * @return   step object
	 */
	public function requestRest($task = 'total', $table = false) {
		// JHttp instance
		jimport('joomla.http.http');
		$http = new JHttp();
		$data = $this->getRestData();
		
		// Getting the total
		$data['task'] = $task;
		$data['table'] = ($table != false) ? $table : '';
		$request = $http->get($this->params->get('rest_hostname'), $data);

		$code = $request->code;

		return ($code == 200 || $code == 301) ? $request->body : $code;
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since 3.0.0
	 * @throws	Exception
	 */
	protected function &getSourceDataRest($table = null)
	{
		// Declare rows
		$rows = array();
		// Cleanup		
		$cleanup = $this->requestRest('cleanup', $table);
		// Total
		$total = $this->requestRest('total', $table);

		for ($i=1;$i<=$total;$i++) {		
			$response = $this->requestRest('row', $table);
			if ($response != '') {
				$rows[$i] = json_decode($response);
			}
		}

		return $rows;
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 * @since	3.0.0
	 * @throws	Exception
	 */
	public function &getSourceDataRestIndividual($table = null)
	{
		$rows = array();
		$response = $this->requestRest('row', $table);

		if ($response != '') {
			$rows[] = json_decode($response);
		}

		return $rows;
	}

	protected function getLastId()
	{
		$method = $this->params->get('method');
	
		// Get the source data.
		if ($method == 'rest') {
			$lastid = $this->getLastIdRest();
		} else if ($method == 'database') {
			$lastid = $this->getLastIdDatabase();
		}

		return $lastid;
	}

	/**
	 * Get the last id from RESTful
	 *
	 * @access	public
	 * @return	int	The last id
	 */
	public function getLastIdRest()
	{
		jimport('joomla.http.http');

		// JHttp instance
		$http = new JHttp();		
		$data = $this->getRestData();

		// Getting the total
		$data['task'] = "lastid";
		$data['table'] = $this->_step['name'];
		$lastid = $http->get($this->params->get('rest_hostname'), $data);
		return (int) $lastid->body;
	}

	/**
	 * Get the last id from database
	 *
	 * @access	public
	 * @return	int	The last id
	 */
	public function getLastIdDatabase()
	{
		$key = $this->getKeyName();
		$conditions = $this->getConditionsHook();

		$where = count( $conditions['where'] ) ? 'WHERE ' . implode( ' AND ', $conditions['where'] ) : '';

		$where_or = '';
		if (isset($conditions['where_or'])) {
			$where_or = count( $conditions['where_or'] ) ? 'WHERE ' . implode( ' OR ', $conditions['where_or'] ) : '';
		}

		$as = isset($conditions['as']) ? 'AS '.$conditions['as'] : '';
		$key_as = isset($conditions['as']) ? $conditions['as'].'.' : '';

		$order = isset($conditions['order']) ? "ORDER BY {$conditions['order']}" : "ORDER BY {$this->getKeyName()} DESC";

		// Get Total
		$query = "SELECT {$key_as}{$key} FROM {$this->source} {$as} {$where}{$where_or} {$order} LIMIT 1";
		$this->_db_old->setQuery( $query );
		$lastid = $this->_db_old->loadResult();

		if ($lastid) {
			return (int)$lastid;
		}
		else
		{
			$this->setError( $this->_db_old->getErrorMsg() );
			return false;
		}
	}

	/**
	 * insertData
	 *
	 * @return	void
	 * @since	3.0.0
	 * @throws	Exception
	 */
	protected function insertData($rows)
	{	
		$table = empty($this->destination) ? $this->source : $this->destination;
	
		if (is_array($rows)) {
			foreach ($rows as $row)
			{
				// Convert the array into an object.
				$row = (object) $row;

				if (!$this->_db->insertObject($table, $row)) {
					throw new Exception($this->_db->getErrorMsg());
				}
				$cid = $this->_getStepID();

				$this->_updateID($cid+1);
			}
		}else if (is_object($rows)) {

			if (!$this->_db->insertObject($table, $rows)) {
				throw new Exception($this->_db->getErrorMsg());
			}

		}
	
		return true;
	}

	/**
	 * populateDatabase
	 */
	function populateDatabase(& $db, $sqlfile, & $errors, $nexttask='mainconfig')
	{
		if( !($buffer = file_get_contents($sqlfile)) )
		{
			return -1;
		}

		$queries = $db->splitSql($buffer);

		foreach ($queries as $query)
		{
			$query = trim($query);
			if ($query != '' && $query {0} != '#')
			{
				$db->setQuery($query);
				$db->query() or die($db->getErrorMsg());
			}
		}

		return true;
	}

	/**
	 * Cleanup the data in the destination database.
	 *
	 * @return	void
	 * @since	0.5.1
	 * @throws	Exception
	 */
	protected function cleanDestinationData($table = false)
	{
		// Get the table
		if ($table == false) {
			$table	= empty($this->destination) ? $this->source : $this->destination;
		}

		if ($this->canDrop) {
			$query = "TRUNCATE TABLE {$table}";
			$this->_db->setQuery($query);
			$this->_db->query();
		} else {
			$query = "DELETE FROM {$table}";
			$this->_db->setQuery($query);
			$this->_db->query();
		}

		// Check for query error.
		$error = $this->_db->getErrorMsg();

		if ($error) {
			throw new Exception($error);
		}

	}

	/**
	 * 
	 * @return  boolean  
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 */
	public function getKeyName()
	{
		return $this->_tbl_key;
	}

	/**
	 * 
	 * @return  boolean  
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 */
	public function getTableName()
	{
		return $this->source;
	}

	/**
	 * Save internal state.
	 *
	 * @return	boolean
	 * @since	1.1.0
	 */
	public function saveState()
	{
		// Cannot save state if step is not defined
		if (!$this->name) return false;

		$state = json_encode($this->state);
		$query = "UPDATE jupgrade_steps SET state = {$this->_db->quote($state)} WHERE name = {$this->_db->quote($this->name)}";
		$this->_db->setQuery($query);
		$this->_db->query();

		// Check for query error.
		$error = $this->_db->getErrorMsg();

		return !$error;
	}

	/**
	 * Check if this migration has been completed.
	 *
	 * @return	boolean
	 * @since	1.1.0
	 */
	public function isReady()
	{
		return $this->ready;
	}

	/**
	 * TODO: Replace this function: get the new id directly
	 * Internal function to get original database prefix
	 *
	 * @return	an original database prefix
	 * @since	0.5.3
	 * @throws	Exception
	 */
	public function getMapList($table = 'categories', $section = false, $custom = false)
	{
		// Getting the categories id's
		$query = "SELECT *"
		." FROM jupgrade_{$table}";

		if ($section !== false) {
			$query .= " WHERE section = '{$section}'";
		}

		if ($custom !== false) {
			$query .= " WHERE {$custom}";
		}

		$this->_db->setQuery($query);
		$data = $this->_db->loadObjectList('old');

		// Check for query error.
		$error = $this->_db->getErrorMsg();

		if ($error) {
			throw new Exception($error);
			return false;
		}

		return $data;
	}

	/**
	 * Converts the params fields into a JSON string.
	 *
	 * @param	string	$params	The source text definition for the parameter field.
	 *
	 * @return	string	A JSON encoded string representation of the parameters.
	 * @since	0.4.
	 * @throws	Exception from the convertParamsHook.
	 */
	protected function convertParams($params)
	{
		$temp	= new JRegistry($params);
		$object	= $temp->toObject();

		// Fire the hook in case this parameter field needs modification.
		$this->convertParamsHook($object);

		return json_encode($object);
	}

	/**
	 * A hook to be able to modify params prior as they are converted to JSON.
	 *
	 * @param	object	$object	A reference to the parameters as an object.
	 *
	 * @return	void
	 * @since	0.4.
	 * @throws	Exception
	 */
	protected function convertParamsHook(&$object)
	{
		// Do customisation of the params field here for specific data.
	}

	/**
	 * Internal function to get the component settings
	 *
	 * @return	an object with global settings
	 * @since	0.5.7
	 * @throws	Exception
	 */
	public function getParams()
	{
		return $this->params->toObject();
	}

	/**
	 * Internal function to check if 5 seconds has been passed
	 *
	 * @return	bool	true / false
	 * @since	1.1.0
	 */
	protected function checkTimeout($stop = false) {
		static $start = null;
		if ($stop) $start = 0;
		$time = microtime (true);
		if ($start === null) {
			$start = $time;
			return false;
		}
		if ($time - $start < 5)
			return false;

		return true;
	}
}
