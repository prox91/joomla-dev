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
 * View to manage media.
 *
 * @package     Solidres
 * @subpackage	Media
 * @since		0.1.0
 */
class SolidresViewMediaList extends JViewLegacy
{
	protected $state;
	protected $items;

	public function display($tpl = null)
	{
		$model = $this->getModel();
		$this->state = $model->getState();
		$this->items = $model->getItems();
		$this->total = $model->getTotal();

		$this->comMediaParams = JComponentHelper::getParams('com_media');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		parent::display($tpl);
	}
}
