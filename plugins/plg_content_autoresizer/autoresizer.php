<?php
/**
 * AutoResier Plugin: Resize image of intro and fulltext automatically
 *
 * @package		Joomla
 * @subpackage	AutoResier Content Plugin
 * @copyright Copyright (C) 2013 redweb.dk. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @author Nha Bui
 *
 */

// no direct access
defined( '_JEXEC' ) or die();

if (!defined( 'DS' )) define ('DS','/');

jimport( 'joomla.plugin.plugin' );
require_once(dirname(__FILE__) . '/autoresizer/image.php');

/**
 * Class plgContentAutoResizer
 */
class plgContentAutoResizer extends JPlugin
{
	function plgContentAutoResizer( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	// for J17
	function onContentPrepare($context, &$article, &$params, $limitstart=0 )
	{
		if (($option = JRequest::getVar('option', '')) != 'com_content')
		{
			$this->autoResizerProcess($article);
		}
	}

	// for J17
	function onContentBeforeDisplay( $context, &$article, &$params, $limitstart=0 )
	{
		if (($option = JRequest::getVar('option', '')) == 'com_content')
		{
			$this->autoResizerProcess($article);
		}
	}

	function autoResizerProcess(&$article)
	{
		$app = JFactory::getApplication();
		if (get_class($app) === "JAdministrator" )
		{
			return true;
		}

		// get image information of article
		$image_infos = json_decode($article->images, true);
		if(empty($image_infos['image_intro']) && empty($image_infos['image_fulltext']))
		{
			return true;
		}

		// get plugin parameter
		$plugin = JPluginHelper::getPlugin('content', 'autoresizer');
		if(version_compare(JVERSION,'1.6.0','<'))
		{
			$pluginParams = new JParameter( $plugin->params );
			$option = JRequest::getVar('option', '');
			if ($option)
			{
				$mergeparams	= $app->getParams($option);
			}
			if (isset($mergeparams))
			{
				$pluginParams->merge($mergeparams);
			}
		}
		else
		{
			$version = new JVersion();
			$pluginParams = new JRegistry();
			if ( version_compare($version->getShortVersion(), '3.0.0', '>=') )
			{
				$pluginParams->loadString($plugin->params);
			}
			else
			{
				$pluginParams->loadJSON($plugin->params);
			}
		}

		$resize_image_intro = $pluginParams->def('resize_image_intro', '0');
		$resize_image_article = $pluginParams->def('resize_image_article', '0');
		if(!$resize_image_intro && !$resize_image_article)
		{
			return true;
		}

		// resize image intro
		if($resize_image_intro && !$resize_image_article)
		{
			if(empty($image_infos['image_intro']))
			{
				return true;
			}
		}

		// resize image fulltext
		if(!$resize_image_intro && $resize_image_article)
		{
			if(empty($image_infos['image_fulltext']))
			{
				return true;
			}
		}

		// process convert image
		if($resize_image_intro)
		{
			// Get parameter for image intro
			$scale_img_intro_width = $pluginParams->def('scale_img_intro_width', 160);
			$scale_img_intro_height = $pluginParams->def('scale_img_intro_height', 120);

			// check path file and get information of image
			$path = JPATH_ROOT . "/";
			$original_img_file = $path . $image_infos['image_intro'];

			if (file_exists($original_img_file) && is_file($original_img_file))
			{
				$original_img_file_info = pathinfo($original_img_file);

				// check extension support
				$is_img = ($original_img_file_info['extension'] == 'jpg' || $original_img_file_info['extension'] == 'jpeg' || $original_img_file_info['extension'] == 'png' || $original_img_file_info['extension'] == 'gif' ||
					$original_img_file_info['extension'] == 'JPG' || $original_img_file_info['extension'] == 'JPEG' || $original_img_file_info['extension'] == 'PNG' || $original_img_file_info['extension'] == 'GIF');

				if ($is_img)
				{
					// create new file
					$file_name = md5($original_img_file_info['filename'].$scale_img_intro_width.$scale_img_intro_height) . "." . $original_img_file_info['extension'];

					// check exist resized image
					$resize_image_store_dir = $pluginParams->def('resize_image_store_dir', 1);
					if ($resize_image_store_dir == 0)
					{

					}
					else {
						if ($resize_image_store_dir == 1)
						{
							if (!file_exists(JPATH_ROOT . "/cache/" . $file_name)
								|| !is_file(JPATH_ROOT . "/cache/" . $file_name)
							)
							{
								// process resize image
								list($original_width, $original_height) = getimagesize($original_img_file);
								if ($scale_img_intro_width != $original_width || $scale_img_intro_height != $original_height)
								{
									$image = new Image($original_img_file);
									$image->resize($scale_img_intro_width, $scale_img_intro_height, $original_img_file_info['extension']);
									$image->save(JPATH_ROOT . "/cache/" . $file_name);
								}
							}
							$image_infos['image_intro'] = "cache/" . $file_name;
						}
						else
						{

						}
					}
				}
			}


			/*
			$old_image = $file_name;
			$new_image = 'cache/' . utf8_substr($file_name, 0, utf8_strrpos($file_name, '.')) . '-' . $scale_img_intro_width . 'x' . $scale_img_intro_height . $type .'.' . $extension;

			if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {
				$path = '';

				$directories = explode('/', dirname(str_replace('../', '', $new_image)));

				foreach ($directories as $directory) {
					$path = $path . '/' . $directory;

					if (!file_exists(DIR_IMAGE . $path)) {
						@mkdir(DIR_IMAGE . $path, 0777);
					}
				}

				list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

				if ($width_orig != $width || $height_orig != $height) {
					$image = new Image(DIR_IMAGE . $old_image);
					$image->resize($width, $height, $type);
					$image->save(DIR_IMAGE . $new_image);
				} else {
					copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
				}
			}
			*/


		}

		if($resize_image_article)
		{

		}

		// update image information of article
		$article->images = json_encode($image_infos);
	}
}
?>