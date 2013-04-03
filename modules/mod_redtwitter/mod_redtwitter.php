<?php
/**
 * @version    Id: mod_redtwitter.php
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 *             Developed by email@recomponent.com - redCOMPONENT.com
 */

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$document = JFactory::getDocument();
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

if($params->get('twitter_id'))
{
	$order_type = $params->get('order_type');
	$max_item_displayed = $params->get('item_max_display');
	$twitters = modRedTwitterHelper::getTwitterList($params->get('twitter_id'), $order_type, $max_item_displayed);
}

require JModuleHelper::getLayoutPath('mod_redtwitter', $params->get('layout', 'default'));
