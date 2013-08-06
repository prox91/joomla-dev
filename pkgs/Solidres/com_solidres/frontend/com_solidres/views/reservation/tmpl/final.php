<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

// Get some data from successful reservation
$app = JFactory::getApplication();
?>
<div id="solidres">
	<div class="alert alert-success">
		<p>
			<?php echo JText::sprintf('SR_RESERVATION_COMPLETE',$app->getUserState($this->context.'.code'), $app->getUserState($this->context.'.customeremail')) ?>
		</p>
	</div>
</div>


 
