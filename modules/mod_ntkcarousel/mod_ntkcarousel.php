<?php
/**
 * @package     Mod_NtkCarousel.Frontend
 * @subpackage  mod_nktcarousel
 *
 * @copyright   Copyright (C) 2013 ntksoft.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$document = JFactory::getDocument();
$document->addScript('');

$moduleclass_sfx    = htmlspecialchars($params->get('moduleclass_sfx'));
$ctype			    =  $params->get('ctype', 1);

if($ctype==1) {
	$imageList 		= modNtkCarouselHelper::getImageList($params);
}

require JModuleHelper::getLayoutPath('mod_ntkcarousel', $params->get('layout', 'default'));
