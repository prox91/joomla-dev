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
 * View to extract xml backup file.
 *
 * @package     Solidres
 * @subpackage	System
 * @since		0.1.0
 */
class SolidresViewSystem extends JView
{
	public function display($tpl = null)
	{
		$model = $this->getModel();
		
    	$xmlContent = $model->backupAssets();
    	$sqlContent = $model->backupSql();	
        $version = JFactory::getDate()->toUnix();
        
        $xmlFilePath = JFactory::getConfig()->get('tmp_path').'/'.'xml-'.$version.'.xml';
        $sqlFilePath = JFactory::getConfig()->get('tmp_path').'/'.'sql-'.$version.'.sql';
        
        JFile::write($xmlFilePath, $xmlContent);
        JFile::write($sqlFilePath, $sqlContent);
        
        $fileDownloadName = 'solidres'.$version.'.zip';

		SRFactory::get('solidres.utilities.ziparchive')->zipFiles( array($xmlFilePath, $sqlFilePath), JFactory::getConfig()->get('tmp_path').'/'.$fileDownloadName);
		
       	JFile::delete($xmlFilePath);
       	JFile::delete($sqlFilePath);
       	
       	//make file to download
       	header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="'.$fileDownloadName);
        header("Content-Transfer-Encoding: binary");
        header('Accept-Ranges: bytes');
        header("Cache-control: private");
        header('Pragma: private');
        header("Expires: ".JFactory::getDate()->toSql());
        header("Content-Length: " . filesize(JFactory::getConfig()->get('tmp_path').'/'.$fileDownloadName));
        
        ob_clean();
    	flush();
    	readfile(JFactory::getConfig()->get('tmp_path').'/'.$fileDownloadName);
       	JFile::delete(JFactory::getConfig()->get('tmp_path').'/'.$fileDownloadName);
	}

}
