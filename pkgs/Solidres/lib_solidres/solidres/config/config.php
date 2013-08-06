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
 * Config handler class
 * 
 * @package 	Solidres
 * @subpackage	Config
 *
 * @since 		0.3.0
 */
class SRConfig
{
	/**
	 * Config scope id, 0 is Global
	 *
	 * @var int
	 */
	private $scopeId = 0;

	/**
	 * Config data
	 *
	 * @var array
	 */
	private $data = NULL;

	/**
	 * Data name space
	 *
	 * @var string
	 */
	private $dataNamespace = '';

	public function __construct( $config = array() )
	{
		if (array_key_exists('scope_id', $config))	
		{
			$this->scopeId = $config['scope_id'];
		}

		if (array_key_exists('data_namespace', $config))
		{
			$this->dataNamespace = $config['data_namespace'];
		}

		if (isset($this->scopeId)) 
		{
			$this->data = $this->loadFromDb();
		}
	}

	public function getData()
	{
		return $this->data;
	}

	/**
	 * Retrive data by key name
	 *
	 * @param $dataKey
	 * @return mixed
	 */
	public function get($dataKey)
	{
		if (isset($this->data))
		{
			foreach ($this->data as $dataItem)	
			{
				if ($dataKey == $dataItem[0])
				{
					return $dataItem[1];
				}
			}
		}
	}

	/**
	 * Write data into database
	 *
	 * @param  array $data
	 *
	 * @return bool
	 */
	public function set($data)
	{
		$dbo = JFactory::getDbo();
		$query = $dbo->getQuery(true);

		try
		{
			$query->clear();
			$query->delete()->from($dbo->quoteName('#__sr_config_data'));
			$query->where('scope_id = ' . $this->scopeId);
			$query->where('data_key LIKE ' . $dbo->quote($this->dataNamespace . '%'));
			$dbo->setQuery($query);
			$dbo->execute();

			foreach ($data as $k => $v)
			{
				$query->clear();
				$query->insert($dbo->quoteName('#__sr_config_data'));
				$query->columns(array($dbo->quoteName('scope_id'), $dbo->quoteName('data_key'), $dbo->quoteName('data_value')));
				$query->values($this->scopeId . ',' . $dbo->quote($this->dataNamespace . '/' . $k) . ',' . $dbo->quote($v));
				$dbo->setQuery($query);
				$dbo->execute();
			}
		}
		catch (RuntimeException $e)
		{
			$this->_subject->setError($e->getMessage());
			return false;
		}
	}

	/**
	 * Load config data from database
	 *
	 * @return mixed
	 */
	public function loadFromDb()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('data_key, data_value')->from($db->quoteName('#__sr_config_data'));
		$query->where('scope_id = '. (int) $this->scopeId);
		$db->setQuery($query);

		return $db->loadRowList();
	}
}