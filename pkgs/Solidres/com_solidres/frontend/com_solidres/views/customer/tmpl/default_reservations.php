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

<h3>All reservations</h3>

<table class="table">
	<thead>
		<tr>
			<th>Code</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Total price</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->reservations as $reservation) : ?>
<tr>
    <td><?php echo $reservation->code ?></td>
    <td><?php echo $reservation->checkin ?></td>
    <td><?php echo $reservation->checkout ?></td>
    <td><?php echo $reservation->total_price_tax_incl ?></td>
</tr>
<?php endforeach; ?>
	</tbody>
</table>