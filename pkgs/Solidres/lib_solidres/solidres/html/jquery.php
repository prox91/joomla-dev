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

abstract class SRHtmlJquery
{
	/**
	 * Method to load the jQuery UI framework into the document head
	 *
	 * If debugging mode is on an uncompressed version of jQuery UI is included for easier debugging.
	 *
	 * @return  void
	 */
	public static function ui()
	{
		static $loaded = false;
		if ($loaded)
		{
			return;
		}
		JHtml::_('jquery.framework');
		$uncompressed = JFactory::getConfig()->get('debug') ? '' : '.min';
		JHtml::_('stylesheet', SRURI_MEDIA.'/assets/css/jquery/themes/base/jquery-ui'.$uncompressed.'.css', false, false);
		JHtml::_('script', SRURI_MEDIA.'/assets/js/jquery/ui/jquery-ui'.$uncompressed.'.js', false, false);
		$loaded = true;
	}

	/**
	 * Method to load the jQuery Cookie into the document head
	 *
	 * If debugging mode is on an uncompressed version of jQuery Cookie is included for easier debugging.
	 *
	 * @return  void
	 */
	public static function cookie()
	{
		static $loaded = false;
		if ($loaded)
		{
			return;
		}
		JHtml::_('script', SRURI_MEDIA.'/assets/js/jquery/external/jquery.cookie.js', false, false);
		$loaded = true;
	}

	/**
	 * Method to load the plupload into the document head
	 *
	 * If debugging mode is on an uncompressed version of plupload is included for easier debugging.
	 *
	 * @return  void
	 */
	public static function upload()
	{
		static $loaded = false;
		if ($loaded)
		{
			return;
		}
		JHtml::_('jquery.framework');
		JHtml::_('stylesheet', SRURI_MEDIA.'/assets/js/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css', false, false);
		JHtml::_('script', SRURI_MEDIA.'/assets/js/plupload/plupload.full.js', false, false);
		JHtml::_('script', SRURI_MEDIA.'/assets/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js', false, false);

		$loaded = true;
	}

	/**
	 * Method to load the colorbox into the document head
	 *
	 * If debugging mode is on an uncompressed version of colorbox is included for easier debugging.
	 *
	 * @param string $class
	 * @param string $width
	 * @param string $height
	 * @param string $iframe
	 * @param string $inline
	 *
	 * @return  void
	 */
	public static function colorbox($class = 'sr-iframe', $width = '80%', $height = '80%', $iframe = "true", $inline = "false")
	{
		static $loaded = false;
		if (!$loaded)
		{
			$uncompressed = JFactory::getConfig()->get('debug') ? '' : '.min';
			JHtml::_('stylesheet', SRURI_MEDIA.'/assets/js/colorbox/colorbox.css', false, false);
			JHtml::_('script', SRURI_MEDIA.'/assets/js/colorbox/jquery.colorbox'.$uncompressed.'.js', false, false);
			$script = '
				Solidres.jQuery(document).ready(function($){
					$(".'.$class.'").colorbox({iframe: '.$iframe.', inline: '.$inline.', width:"'.$width.'", height:"'.$height.'"});
				});
			';
			JFactory::getDocument()->addScriptDeclaration($script);
		}
		else
		{
			$script = '
				Solidres.jQuery(document).ready(function($){
					$(".'.$class.'").colorbox({iframe: '.$iframe.', inline: '.$inline.', width:"'.$width.'", height:"'.$height.'"});
				});
			';
			JFactory::getDocument()->addScriptDeclaration($script);
			return;
		}

		$loaded = true;
	}

	/**
	 * Method to load the datepicker into the document head
	 *
	 * @param string $format
	 *
	 * @return  void
	 */
	public static function datepicker($format = 'dd-mm-yy')
	{
		static $loaded = false;
		if ($loaded)
		{
			return;
		}
		$script = ' Solidres.jQuery(function() { jQuery( ".datepicker" ).datepicker({dateFormat : "'.$format.'",}); });';
		JFactory::getDocument()->addScriptDeclaration($script);

		$loaded = true;
	}

	public static function validate()
	{
		static $loaded = false;
		if ($loaded)
		{
			return;
		}
		$uncompressed = JFactory::getConfig()->get('debug') ? '' : '.min';

		JHtml::_('jquery.framework');
		JHtml::_('script', SRURI_MEDIA.'/assets/js/validate/jquery.metadata.js', false, false);
		JHtml::_('script', SRURI_MEDIA.'/assets/js/validate/jquery.validate'.$uncompressed.'.js', false, false);
		$loaded = true;
	}

	/**
	 * Method to load jqplot
	 *
	 * If debugging mode is on an uncompressed version of jqplot is included for easier debugging.
	 *
	 * @param   array $plugins An array of plugin that needed to be loaded with jqplot
	 *
	 * @return  void
	 */
	public static function chart($plugins = array())
	{
		static $loaded = false;
		if ($loaded)
		{
			return;
		}
		JHtml::_('jquery.framework');
		$uncompressed = JFactory::getConfig()->get('debug') ? '' : '.min';
		JHtml::_('stylesheet', SRURI_MEDIA.'/assets/css/jquery.jqplot'.$uncompressed.'.css', false, false);
		JHtml::_('script', SRURI_MEDIA.'/assets/js/jquery.jqplot'.$uncompressed.'.js', false, false);

		if (!empty($plugins))
		{
			foreach ($plugins as $plugin)
			{
				JHtml::_('script', SRURI_MEDIA.'/assets/js/jqplot.'.$plugin.$uncompressed.'.js', false, false);
			}
		}

		$loaded = true;
	}

	/**
	 * Method to load the jquery editable into the document head
	 *
	 * @return  void
	 */
	public static function editable()
	{
		static $loaded = false;
		if ($loaded)
		{
			return;
		}
		$uncompressed = JFactory::getConfig()->get('debug') ? '' : '.min';

		JHtml::_('jquery.framework');
		JHtml::_('bootstrap.framework');
		JHtml::_('stylesheet', SRURI_MEDIA.'/assets/css/bootstrap-editable.css', false, false);
		JHtml::_('script', SRURI_MEDIA.'/assets/js/editable/bootstrap-editable'.$uncompressed.'.js', false, false);
		$loaded = true;
	}
}