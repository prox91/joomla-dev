<?php
/**
 * @package     RedTwitter.Frontend
 * @subpackage  mod_redtwitter
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$document = JFactory::getDocument();
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

if ($params->get('twitter_id'))
{
	$twitters = ModRedTwitterHelper::getTwitterList($params);
}

require JModuleHelper::getLayoutPath('mod_redtwitter', $params->get('layout', 'default'));
