<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 11:12 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// Load tooltip behaviour
//JHtml::_('behaviour.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_hellworld'); ?>" method="post" name="adminForm">
	<table class="adminList">
		<thead><?php echo $this->loadTemplate('head'); ?></thead>
		<tbody><?php echo $this->loadTemplate('body'); ?></tbody>
		<tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
	</table>
</form>