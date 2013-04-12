<?php
/**
 * @version    1.0.0
 * @package    Com_Redtwitter
 * @author     Ronni K. G. Christiansen<email@redweb.dk> - http://www.redcomponent.com
 * @copyright  Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * Developed by email@recomponent.com - redCOMPONENT.com
 */
defined('_JEXEC') or die ('restricted access');

jimport('joomla.application.component.view');

/**
 * Class RedtwitterViewFollowedProfiles
 */
class RedtwitterViewFollowedProfiles extends JViewLegacy
{
	/**
	 * @param   null $tpl
	 *
	 * @return mixed|void
	 */
	public function display($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::root() . "administrator/components/com_redtwitter/assets/css/redtwitter_frontend.css");

		$app    = JFactory::getApplication();
		$params = $app->getParams();
		$uri    = JFactory::getURI();

		$lists = $this->get('data');

		$slink = "index.php?option=com_redtwitter&view=redtwitter";
		$this->assignRef('slink', $slink);
		$this->assignRef('lists', $lists);

		$this->assignRef('request_url', $uri->toString());

		$model      = $this->getModel('followedprofiles');
		$red_detail = $model->getDetail();

		$this->assignRef('red_detail', $red_detail);
		$this->assignRef('params', $params);

		$this->setLayout('default');

		parent::display($tpl);
	}
}