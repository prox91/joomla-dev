<?php
defined('_JEXEC') or die;

final class RComponentHelper
{
	public static function getRedcoreComponents()
	{
		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator(JPATH_ADMINISTRATOR . '/components')
		);

		$components = array();

		/** @var SplFileInfo $fileInfo */
		foreach ($iterator as $fileInfo)
		{
			if ($fileInfo->isFile() && 'xml' === pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION))
			{
				$content = @file_get_contents($fileInfo->getRealPath());

				if (!is_string($content))
				{
					continue;
				}

				$element = new SimpleXMLElement($content);

				if ('com_redcore' === trim(strtolower($element->name)))
				{
					continue;
				}

				if ($element->xpath('//redcore'))
				{
					$components[] = 'com_' . strstr($fileInfo->getFilename(), '.xml', true);
				}
			}
		}

		return $components;
	}
}
