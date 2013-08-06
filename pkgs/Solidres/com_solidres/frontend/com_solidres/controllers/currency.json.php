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
 * @package     Solidres
 * @subpackage	Currency
 * @since		0.1.0
 */
class SolidresControllerCurrency extends JControllerLegacy
{
    public function setId()
    {
        $currencyId = $this->input->get('id', 0, 'int');

        // add check if we already set cookie or not, if yes, retrieve them, otherwise set new cookie to store currency_id
        $currentCurrencyId = $this->input->cookie->get('solidres_currency', 0, 'int');

        if (empty($currentCurrencyId) || $currentCurrencyId != $currencyId)
        {
            $config = JFactory::getConfig();
            $cookie_domain  = $config->get('cookie_domain', '');
            $cookie_path    = $config->get('cookie_path', '/');
            // TODO add an option to allow configuring the cookie expire period here
            $this->input->cookie->set('solidres_currency', $currencyId, time()+60*60*24*30, $cookie_path, $cookie_domain );
        }

		JFactory::getApplication()->setUserState('current_currency_id', $currencyId);

		die(1);
    }
}