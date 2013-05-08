<?php
/**
 * @copyright      Copyright (C) 2013 redComponent
 * @author         redComponent
 * @package        Template
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the framework
require(dirname(__FILE__).'/'.'wright'.'/'.'wright.php');

// Initialize the framework and
$tpl = Wright::getInstance();
$tpl->addJSScript(JURI::root().'templates/' . $this->template . '/js/js.js');
$tpl->display();
