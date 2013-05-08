<?php

defined('_JEXEC') or die('You are not allowed to directly access this file');

require_once(dirname(__FILE__) . '/lessc.inc.php');

class BuildBootstrap extends lessc
{
	static function getInstance()
	{
		static $instance = null;
		if ($instance === null)
		{
			$instance = new Wright();
		}

		return $instance;
	}

	function start()
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');

		$document = JFactory::getDocument();

		$style = $document->params->get('style');
		$version = explode('.', JVERSION);
        $version = $version[0].$version[1];

		$less_path = JPATH_THEMES . '/' . $document->template . '/less';

		//check rebuild less
		$rebuild = false;

		if (is_file(JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '.css'))
		{
			$cachetime = filemtime(JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '.css');

			$files = JFolder::files($less_path, '.less', true, true);

			if(count($files) > 0)
			{
				foreach ($files as $file)
				{
					if (filemtime($file) > $cachetime)
					{
						$rebuild = true;
						break;
					}
				}
			}
		}
		else
		{
			$rebuild = true;
		}

		//build LESS
		if($rebuild)
		{
			// get column configuration
			$left_columns = 1;
			if($document->countModules('sidebar1') == 0)
			{
				$left_columns = 0;
			}

			$right_columns = 1;
			if($document->countModules('sidebar2') == 0)
			{
				$right_columns = 0;
			}


			$this->setFormatter("compressed");

			$this->setVariables(array(
					"leftColumns" => $left_columns,
					"rightColumns" => $right_columns,
			));

			if (is_file(JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '.css'))
			{
				unlink(JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '.css');
			}

			if (is_file(JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '-responsive.css')) {
				unlink(JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '-responsive.css');
			}

			$df =  dirname(__FILE__) . '/less/build.less';

			$ds = '@import "../../../less/variables-' . $style . '.less"; ';
			$ds .= '@import "../less/bootstrap.less"; ';
			$ds .= '@import "../less/typography.less"; ';
			$ds .= '@import "../less/joomla' . $version . '.less"; ';
			$ds .= '@import "../../../less/template.less"; ';

			if (is_file(JPATH_THEMES . '/' . $document->template . '/less/' . 'style-' . $style . '.less'))
			{
				$ds .= '@import "../../../less/style-' . $style . '.less"; ';
			}

			file_put_contents($df, $ds);

			$this->compileFile($df, JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '.css');

			//responsive
			$ds = '@import "../../../less/variables-' . $style . '.less"; ';
			$ds .= '@import "../less/responsive.less"; ';
			$ds .= '@import "../less/joomla' . $version . '-responsive.less"; ';

			if (is_file(JPATH_THEMES . '/' . $document->template . '/less/template-responsive.less'))
			{
				$ds .= '@import "../../../less/template-responsive.less"; ';
			}

			if (is_file(JPATH_THEMES . '/' . $document->template . '/less/' . 'style-' . $style . '-responsive.less'))
			{
				$ds .= '@import "../../../less/style-' . $style . '-responsive.less"; ';
			}

			file_put_contents($df, $ds);

			$this->compileFile($df, JPATH_THEMES . '/' . $document->template . '/css/' . 'joomla' . $version . '-' . $style . '-responsive.css');

			unlink($df);

		}

	}

}