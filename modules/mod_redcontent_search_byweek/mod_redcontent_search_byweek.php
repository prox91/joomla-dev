<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once 'administrator/components/com_redcontent/helpers/helpers.php';
$helper = new RedContent_Helper();

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$categoryList = $params->get('category_id', '');

$session = JFactory::getSession();
$session->set('categoryIdList', $categoryList, 'SearchByWeekModule');

$limit	= $params->get('limit');
$Itemid	= $params->get('itemid');


require JModuleHelper::getLayoutPath('mod_redcontent_search_byweek', $params->get('layout', 'default'));
