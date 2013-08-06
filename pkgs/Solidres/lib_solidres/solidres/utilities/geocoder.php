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

define("MAPS_HOST", "maps.googleapis.com");

/**
 * Class utility for Map API.
 *
 * @package     Solidres
 * @since		0.1.0
 */
class SRGeoCoder
{
	private $add;
	private $city;
	private $geoStateId;
	private $countryId;
	
	private $fullAddress;
	
	public function __construct($options = array())
	{
		$this->add = $options[0];
		$this->city = $options[1];
		
		$this->fullAddress[] = $this->add;
		$this->fullAddress[] = $this->city;
		
		if(isset($options[2]))
		{
			$this->geoStateId = $options[2];
			$geoStateTable = JTable::getInstance('State', 'SolidresTable');
			if(is_numeric($this->geoStateId) && $this->geoStateId > 0)
			{
				$geoStateTable->load($this->geoStateId);
				$this->fullAddress[] = $geoStateTable->name;
			}
		}
		
		if(isset($options[3]))
		{
			$this->countryId = $options[3];
			$countryTable = JTable::getInstance('Country', 'SolidresTable');
			if(is_numeric($this->countryId) && $this->countryId > 0)
			{
				$countryTable->load($this->countryId);
				$this->fullAddress[] = $countryTable->name;
			}
		}
	}
	
	/**
	 * Process geocoding
	 *
	 * @return array Coordinate data
	 */
	public function process()
	{
		$result = array();
		$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/xml?";
		$requestUrl = $base_url . "sensor=true&address=" . urlencode(implode(',', $this->fullAddress));
		
		try
		{
			$xml = simplexml_load_file($requestUrl);	
		}
		catch (Exception $e)
		{
			return false;
		}
		
		$status = $xml->status;
		if(strcmp($status, "OK") == 0)
		{
      		$result['lat'] = (string) $xml->result->geometry->location->lat;
      		$result['lng'] = (string) $xml->result->geometry->location->lng;
		}
		else
		{
			return false;
		}
		
		return $result;
	}
}