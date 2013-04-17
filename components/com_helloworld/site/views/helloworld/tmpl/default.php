<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/4/13
 * Time: 11:04 PM
 * To change this template use File | Settings | File Templates.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<!--<h1><?php //echo $this->msg; ?></h1>-->
<h1><?php echo $this->item->greeting.(($this->item->category and $this->item->params->get('show_category'))
		? (' ('.$this->item->category.')') : ''); ?>
</h1>