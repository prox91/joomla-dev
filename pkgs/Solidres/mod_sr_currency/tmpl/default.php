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

$setCurrencyLink = JRoute::_('index.php?option=com_solidres&task=currency.setId&id=');
?>
<div class="solidres-module">
	<form action="">
		<ul>
			<?php
			if ($currencyList) :
				foreach ($currencyList as $c) :
					echo '<li><a href="javascript:Solidres.setCurrency('.$c->id.')" >'.$c->currency_code.'</a></li>';
				endforeach;
			endif;
			?>
		</ul>
	</form>
</div>