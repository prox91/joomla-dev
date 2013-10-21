<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 11:20 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<div class="btn-toolbar">
    <div class="btn-group">
        <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('grammarexercise.save');">
            <?php echo JText::_('JSAVE');?></button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn" onclick="window.parent.SqueezeBox.close();">
            <?php echo JText::_('JCANCEL');?></button>
    </div>
    <div class="clearfix"></div>
</div>

<?php
$this->setLayout('edit');
echo $this->loadTemplate();
