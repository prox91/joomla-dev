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

?>

<ul class="nav nav-tabs" id="customer-nav">
    <li class="active"><a href="#customer-home">Home</a></li>
    <li><a href="#your-reservations">Your reservations</a></li>
    <li><a href="#your-feedbacks">Your feedbacks</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="customer-home">
		<?php echo $this->loadTemplate('home'); ?>
    </div>
    <div class="tab-pane" id="your-reservations">
		<?php echo $this->loadTemplate('reservations'); ?>
    </div>
    <div class="tab-pane" id="your-feedbacks">
		<?php echo $this->loadTemplate('feedbacks'); ?>
    </div>
</div>

<script>
    Solidres.jQuery(function ($) {
        $('#customer-nav a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
    })
</script>