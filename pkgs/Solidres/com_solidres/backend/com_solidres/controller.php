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
 * Main controller for Solidres
 *
 * @package    Solidres
 * @since	   0.1.0
 */
class SolidresController extends JControllerLegacy
{
	/**
	 * @var		string	The default view.
	 */
	protected $default_view = 'reservationassets';

	/**
	 * Checks whether a user can see this view.
	 *
	 * @param	string	$view	The view name.
	 *
	 * @return	boolean
	 */
	protected function canView($view)
	{
		$canDo	= SolidresHelper::getActions();

		switch ($view)
		{
			// Special permissions.
			case 'groups':
			case 'group':
			case 'levels':
			case 'level':
				return $canDo->get('core.admin');
				break;

			// Default permissions.
			default:
				return true;
		}
	}

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable If true, the view output will be cached
	 * @param	boolean			$urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$input = JFactory::getApplication()->input;

		if (SR_PLUGIN_STATISTICS_ENABLED)
		{
			$this->default_view = 'statistics';
		}
		
		$view = $input->get('view', $this->default_view, 'word');
		
		if (!$this->canView($view))
		{
			JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
			return;
		}

		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		return parent::display();
	}
}