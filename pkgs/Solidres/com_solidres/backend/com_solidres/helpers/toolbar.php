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

/**
 * Solidres Helper class
 *
 * @package     Solidres
 */
abstract class SRToolBarHelper
{
	/**
	 * Writes a configuration button and invokes a cancel operation (eg a checkin).
	 *
	 * @param	string	$url	The url that open in a modal
	 * @param	string	$text   The button text
	 * @param	string	$class	The button class
	 *
	 * @return  void
	 * @since	1.0
	 */
	public static function mediaManager($url = 'index.php?option=com_solidres&view=medialist&tmpl=component', $text = 'SR_MEDIA_MANAGER', $class = 'sr-iframe btn btn-small')
	{
		$bar = JToolBar::getInstance('toolbar');
		SRHtml::_('jquery.colorbox');

		$html = '<a class="'.$class.'" href="'.JRoute::_($url).'">';
		$html .= '<i class="icon-pictures"></i> ';
		$html .= JText::_($text);
		$html .= '</a>';
		$bar->appendButton('Custom', $html);
	}
}

