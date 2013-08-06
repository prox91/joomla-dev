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
 * Media helper class.
 *
 * @package     Solidres
 * @subpackage	Media
 * @since		0.1.0
 */
class SRMediaHelper
{
	/**
	 * Checks if the file is an image
	 * 
	 * @param string $filePath The filename
	 * @return boolean
	 */
	public static function isImage($filePath)
	{
		return getimagesize($filePath);
	}

	/**
	 * Checks if the file can be uploaded
	 *
	 * @param array $file File information
	 * @param string $err An error message to be returned
	 * @return boolean
	 */
	public static function canUpload($file, &$err)
	{
		$params = JComponentHelper::getParams('com_solidres');

		if (empty($file['name']))
        {
			$err = 'SR_ERROR_UPLOAD_INPUT';
			return false;
		}

		jimport('joomla.filesystem.file');
		if ($file['name'] !== JFile::makesafe($file['name']))
        {
			$err = 'SR_ERROR_WARNFILENAME';
			return false;
		}

		$format = strtolower(JFile::getExt($file['name']));

		//$allowable = explode(',', $params->get('upload_extensions'));
		$ignored = explode(',', $params->get('ignore_extensions'));

		if (empty($allowable))
		{
			$allowable = array('bmp','gif','jpg','png');
		}
		if (!in_array($format, $allowable) && !in_array($format,$ignored))
		{
			$err = 'SR_ERROR_WARNFILETYPE';
			return false;
		}

		$maxSize = (int) $params->get('upload_maxsize', 0);
		if ($maxSize > 0 && (int) $file['size'] > $maxSize)
		{
			$err = 'SR_ERROR_WARNFILETOOLARGE';
			return false;
		}

		$user = JFactory::getUser();
		$imginfo = null;
		if ($params->get('restrict_uploads',1))
        {
			$images = explode(',', $params->get('image_extensions'));
			if (in_array($format, $images))
            { // if its an image run it through getimagesize
				// if tmp_name is empty, then the file was bigger than the PHP limit
				if (!empty($file['tmp_name']))
                {
					if (($imginfo = getimagesize($file['tmp_name'])) === FALSE)
                    {
						$err = 'SR_ERROR_WARNINVALID_IMG';
						return false;
					}
				}
                else
                {
					$err = 'SR_ERROR_WARNFILETOOLARGE';
					return false;
				}
			}
            else if (!in_array($format, $ignored))
            {
				// if its not an image...and we're not ignoring it
				$allowed_mime = explode(',', $params->get('upload_mime'));
				$illegal_mime = explode(',', $params->get('upload_mime_illegal'));
				if (function_exists('finfo_open') && $params->get('check_mime',1))
                {
					// We have fileinfo
					$finfo = finfo_open(FILEINFO_MIME);
					$type = finfo_file($finfo, $file['tmp_name']);
					if (strlen($type) && !in_array($type, $allowed_mime) && in_array($type, $illegal_mime))
                    {
						$err = 'SR_ERROR_WARNINVALID_MIME';
						return false;
					}
					finfo_close($finfo);
				}
                else if (function_exists('mime_content_type') && $params->get('check_mime',1))
                {
					// we have mime magic
					$type = mime_content_type($file['tmp_name']);
					if (strlen($type) && !in_array($type, $allowed_mime) && in_array($type, $illegal_mime))
                    {
						$err = 'SR_ERROR_WARNINVALID_MIME';
						return false;
					}
				}
                else if (!$user->authorise('core.manage'))
                {
					$err = 'SR_ERROR_WARNNOTADMIN';
					return false;
				}
			}
		}

		$xss_check =  file_get_contents($file['tmp_name'], false, null, -1, 256);
		$html_tags = array('abbr','acronym','address','applet','area','audioscope','base','basefont','bdo','bgsound','big','blackface','blink','blockquote','body','bq','br','button','caption','center','cite','code','col','colgroup','comment','custom','dd','del','dfn','dir','div','dl','dt','em','embed','fieldset','fn','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','iframe','ilayer','img','input','ins','isindex','keygen','kbd','label','layer','legend','li','limittext','link','listing','map','marquee','menu','meta','multicol','nobr','noembed','noframes','noscript','nosmartquotes','object','ol','optgroup','option','param','plaintext','pre','rt','ruby','s','samp','script','select','server','shadow','sidebar','small','spacer','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','ul','var','wbr','xml','xmp','!DOCTYPE', '!--');
		foreach($html_tags as $tag)
        {
			// A tag is '<tagname ', so we need to add < and a space or '<tagname>'
			if (stristr($xss_check, '<'.$tag.' ') || stristr($xss_check, '<'.$tag.'>'))
            {
				$err = 'SR_ERROR_WARNIEXSS';
				return false;
			}
		}
		return true;
	}

	/**
	 * Display the file size 
	 * 
	 * @param $size The file size
	 *
     * @return string
	 */
	public static function parseSize($size)
	{
		if ($size < 1024)
        {
			return $size . ' bytes';
		}
		else
		{
			if ($size >= 1024 && $size < 1024 * 1024)
            {
				return sprintf('%01.2f', $size / 1024.0) . ' Kb';
			}
            else
            {
				return sprintf('%01.2f', $size / (1024.0 * 1024)) . ' Mb';
			}
		}
	}
}