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

JHtml::addIncludePath(SRPATH_LIBRARY.'/html');

class SRHtml extends JHtml
{
	/**
	 * Method to extract a key
	 *
	 * @param   string  $key   The name of helper method to load, (prefix).(class).function
	 *                         prefix and class are optional and can be used to load custom
	 *                         html helpers.
	 *
	 * @return   array   Contains lowercase key, prefix, file, function.
	 * @since    11.1
	 */
	protected static function extract($key)
	{
		$key = preg_replace('#[^A-Z0-9_\.]#i', '', $key);

		// Check to see whether we need to load a helper file
		$parts = explode('.', $key);

		$prefix = (count($parts) == 3 ? array_shift($parts) : 'SRHtml');
		$file	= (count($parts) == 2 ? array_shift($parts) : '');
		$func	= array_shift($parts);

		return array(strtolower($prefix.'.'.$file.'.'.$func), $prefix, $file, $func);
	}
	
	/**
	 * Class loader method
	 *
	 * Additional arguments may be supplied and are passed to the sub-class.
	 * Additional include paths are also able to be specified for third-party use
	 *
	 * @param   string  $key   The name of helper method to load, (prefix).(class).function
	 *                         prefix and class are optional and can be used to load custom
	 *                         html helpers.
	 *
	 * @return   mixed  JHtml::call($function, $args) or False on error
	 * @since    11.1
	 */
	public static function _($key)
	{
		list($key, $prefix, $file, $func) = self::extract($key);

		if (array_key_exists($key, self::$registry))
		{
			$function = self::$registry[$key];
			$args = func_get_args();
			// Remove function name from arguments
			array_shift($args);
			return JHtml::call($function, $args);
		}

		$className = $prefix.ucfirst($file);

		if (!class_exists($className))
		{
			jimport('joomla.filesystem.path');
			if ($path = JPath::find(JHtml::$includePaths, strtolower($file).'.php'))
			{
				require_once $path;

				if (!class_exists($className))
				{
					JError::raiseError(500, JText::sprintf('JLIB_HTML_ERROR_NOTFOUNDINFILE', $className, $func));
					return false;
				}
			}
			else
			{
				JError::raiseError(500, JText::sprintf('JLIB_HTML_ERROR_NOTSUPPORTED_NOFILE', $prefix, $file));
				return false;
			}
		}

		$toCall = array($className, $func);
		if (is_callable($toCall))
		{
			JHtml::register($key, $toCall);
			$args = func_get_args();
			// Remove function name from arguments
			array_shift($args);
			return JHtml::call($toCall, $args);
		}
		else
		{
			JError::raiseError(500, JText::sprintf('JLIB_HTML_ERROR_NOTSUPPORTED', $className, $func));
			return false;
		}
	}
}