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
 * Solidres Component Controller
 *
 * @package     Solidres
 * @since 		0.1.0
 */
class SolidresController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			$cachable If true, the view output will be cached
	 * @param	boolean			$urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JControllerLegacy		This object to support chaining.
	 * @since	1.5
	 */
	function display($cachable = false, $urlparams = false)
	{
		$cachable = true;

		$lang = JFactory::getLanguage();
		$lang->load('com_solidres', JPATH_ADMINISTRATOR);

		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		// TODO: need to review these params, make sure only allowed params can be set
		$safeurlparams = array('catid'=>'INT','id'=>'INT','cid'=>'ARRAY','year'=>'INT','month'=>'INT','limit'=>'INT','limitstart'=>'INT',
			'showall'=>'INT','return'=>'BASE64','filter'=>'STRING','filter_order'=>'CMD','filter_order_Dir'=>'CMD','filter-search'=>'STRING','print'=>'BOOLEAN','lang'=>'CMD');


		$viewName = $this->input->get('view');

		switch ($viewName)
		{
			case 'customer':
				// If the user is a guest, redirect to the login page.
				$user = JFactory::getUser();
				if ($user->get('guest') == 1)
				{
					// Redirect to login page.
					$this->setRedirect(JRoute::_('index.php?option=com_users&view=login', false));
					return;
				}
				parent::display($cachable, $safeurlparams);
				break;
			case 'reservationasset':
				// Redirect the menu to use controller
				$this->setRedirect(JRoute::_('index.php?option=com_solidres&task=reservationasset.display', false));
				break;
			default:
				parent::display($cachable, $safeurlparams);
				break;
		}

		return $this;
	}
}