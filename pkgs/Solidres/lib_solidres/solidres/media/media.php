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
 * Media handler class
 * 
 * @package 	Solidres
 * @subpackage	Media
 */

class SRMedia
{
	/**
	 * The database object
	 * 
	 * @var object
	 */
	protected $_dbo = null;
	
	public function __construct()
	{
		$this->_dbo = JFactory::getDbo();
	}

	/**
	 * Get file mime type
	 * 
	 * @param string $filename The file name 
	 * 
	 * @return string The MIME type
	 */
	public function getMime($filename)
	{
		require_once SRPATH_LIBRARY.'/media/getid3/getid3.php';;
		
		// Initialize getID3 engine
		$getID3 = new getID3;
	
		$determinedMimeType = '';
		if ($fp = fopen($filename, 'rb'))
        {
			$thisFileInfo = array('avdataoffset'=>0, 'avdataend'=>0);
	
			getid3_lib::IncludeDependency(SRPATH_LIBRARY.'/media/getid3/module.tag.id3v2.php', __FILE__, true);
			$tag = new getid3_id3v2($fp, $thisFileInfo);
	
			fseek($fp, $thisFileInfo['avdataoffset'], SEEK_SET);
			$formattest = fread($fp, 16);  // 16 bytes is sufficient for any format except ISO CD-image
			fclose($fp);
	
			$determinedFormatInfo = $getID3->GetFileFormat($formattest);
			$determinedMimeType = $determinedFormatInfo['mime_type'];
		}
		return $determinedMimeType;
	}

	/**
	 * Check a file if it is a video or not
	 *
     * @param string $mimeType
	 */
	public function isVideo($mimeType)
	{
	
	}

	/**
	 * Check a file if it is a document type or not
	 * 
	 * @param 	string $mimeType The MIME type
	 * 
	 * @return 	boolean
	 */
	public function isDocument($mimeType)
	{
		// TODO: get these mime type from component's configuration
		$validMime = array(
			'application/msword',
			'application/excel',
			'application/pdf',
			'application/powerpoint',
			'text/plain'
		);
        
		if(in_array($mimeType, $validMime))
        {
			return true;
		}
        else
        {
			return false;
		}
	}
	/**
	 * Check a file if it is an image or not
	 * 
	 * @param 	string $mimeType The MIME type
	 * 
	 * @return 	boolean
	 */
	public function isImage($mimeType)
	{	
		// TODO: get these mime type from component's configuration
		$validMime = array(
			'image/jpeg',
			'image/gif',
			'image/png',
			'image/bmp'
		);
        
		if(in_array($mimeType, $validMime))
        {
			return true;
		}
        else
        {
			return false;
		}
	}

	/**
	 * Store media into database
	 *
	 * @param   $data
	 * @param   $table
	 * @param   $type  int  0 for ReservationAsset, 1 for RoomType
	 */
	public function store($data, $table, $type)
	{
		$query = $this->_dbo->getQuery(true);
		$tableName = ($type == 0) ? '#__sr_media_reservation_assets_xref' : '#__sr_media_roomtype_xref';
		$tableKeyName = ($type == 0) ? 'reservation_asset_id' : 'room_type_id';
		// Quote theme
		$tableName = $this->_dbo->quoteName($tableName);
		$tableKeyName = $this->_dbo->quoteName($tableKeyName);

		// Handle media deletion
		if(isset($data['deleteMediaId']) && count($data['deleteMediaId']))
		{
			foreach($data['deleteMediaId'] as $value)
			{
				$query->clear();
				$query->delete();
				$query->from($tableName);
				$query->where($tableKeyName . ' = ' . $table->id);
				$query->where($this->_dbo->quoteName('media_id') . ' = ' . $value);
				$this->_dbo->setQuery($query);
				$this->_dbo->execute();
			}
		}

		if (isset($data['deleteMediaId']))
		{
			$newMedia = array_diff($data['mediaId'], $data['deleteMediaId']);
		}
		else
		{
			$newMedia = $data['mediaId'];
		}

		if(isset($newMedia) && count($newMedia))
		{
			foreach($newMedia as $key => $value)
			{
				// Delete first
				$query->clear();
				$query->delete()->from($tableName);
				$query->where($tableKeyName . ' = ' . $table->id);
				$query->where($this->_dbo->quoteName('media_id') . ' = ' . $value);
				$this->_dbo->setQuery($query);
				$this->_dbo->execute();

				// Then insert
				$query->clear();
				$query->insert($tableName);
				$query->columns(array(
						$this->_dbo->quoteName('media_id'),
						$tableKeyName,
						$this->_dbo->quoteName('weight'))
				);
				$query->values((int) $value . ',' . (int) $table->id . ',' . $key );
				$this->_dbo->setQuery($query);
				$this->_dbo->execute();
			}
		}
	}
}