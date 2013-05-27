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


		}

		if($resize_image_article)
		{

		}

		// update image information of article
		$image_infos['image_intro'] = 'cache/65_images_thumb_medium500_0.jpg';
		$article->images = json_encode($image_infos);
	}
}
?>