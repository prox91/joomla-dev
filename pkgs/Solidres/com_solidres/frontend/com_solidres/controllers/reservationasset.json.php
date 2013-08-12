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

JLoader::register('SRCalendar', SRPATH_LIBRARY . '/utilities/calendar.php');

/**
 * @package     Solidres
 * @subpackage	ReservationAsset
 * @since		0.4.0
 */
class SolidresControllerReservationAsset extends JControllerLegacy
{
    public function getAvailabilityCalendar()
    {
        $roomTypeId = $this->input->get('id', 0, 'int');
		$params = JComponentHelper::getParams('com_solidres');

		$calendar = new SRCalendar;
		$html = '';
		$html .= '<span class="legend-busy"></span> ' . JText::_('SR_AVAILABILITY_CALENDAR_BUSY');
		$period = $params->get('availability_calendar_month_number', 6);
		for ($i = 0; $i < $period; $i ++)
		{
			if ($i % 3 == 0 && $i == 0)
			{
				$html .= '<div class="row-fluid">';
			}
			else if ($i % 3 == 0)
			{
				$html .= '</div><div class="row-fluid">';
			}

			$year = date('Y', strtotime('+' . $i . ' month'));
			$month = date('n', strtotime('+' . $i . ' month'));
			$html .= '<div class="span4">' . $calendar->generate($year, $month, $roomTypeId ) . '</div>';
		}

		echo $html;
		die(1);
    }
}