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
 * Class utility for zip file.
 *
 * @package     Solidres
 * @since		0.1.0
 */
class SRZipArchive
{
	/**
     * Zip a list of files
     *
	 * @param   array   $files   List of files that need to be put in a zip file
	 * @param   string  $desFile Destination zip file
     * 
	 * @return  boolean True if success. False otherwise
	 */
	public static function  zipFiles($files = array(), $desFile) 
	{
		$validFiles = array();
		foreach ($files as $f)
		{
			if(file_exists($f))
            {
				$validFiles[] = $f;
			}
		}

		$zip = new ZipArchive();

		if(!$zip->open($desFile, file_exists($desFile) ? ZipArchive::OVERWRITE : ZipArchive::CREATE))
        {
			return false;
		}
		
		foreach ($validFiles as $f)
        {
			$zip->addFile($f, basename($f));
		}
		$zip->close();

		return true;
	}
	
	/**
	 * Extract zip file
     *
	 * @param   string  $zipFile     Full absolute path of zip file
	 * @param   string  $desFolder   Full absolute path of destination folder
	 * @return  boolean True if success. False otherwise
	 */
	public static function unZip($zipFile, $desFolder)
	{
		$zip = new ZipArchive();

		if(!$zip->open($zipFile))
        {
			return false;
		}

		$zip->extractTo($desFolder);
		$zip->close();
        
		return true;
	}
}