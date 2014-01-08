<?php
defined('JPATH_PLATFORM') or die;
define('JPATH_OPENHRM', dirname(__FILE__));

require JPATH_OPENHRM . '/functions.php';

if (!class_exists('JFormField', false))
{
	$baseField = JPATH_LIBRARIES . '/openhrm/joomla/form/field.php';

	if (file_exists($baseField))
	{
		require_once $baseField;
	}
}

// Register the classes for autoload.
JLoader::registerPrefix('R', JPATH_OPENHRM);

// Setup the RLoader.
RLoader::setup();

// Make available the openhrm fields
JFormHelper::addFieldPath(JPATH_OPENHRM . '/form/fields');

// Make available the openhrm form rules
JFormHelper::addRulePath(JPATH_OPENHRM . '/form/rules');

// HTML helpers
JHtml::addIncludePath(JPATH_OPENHRM . '/html');

// Load library language
$lang = JFactory::getLanguage();
$lang->load('lib_openhrm', JPATH_SITE);
