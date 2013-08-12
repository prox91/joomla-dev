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

JLoader::register('SolidresHelper', JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php');

/**
 * HTML View class for the Solidres component
 *
 * @package     Solidres
 * @since		0.1.0
 */
class SolidresViewReservationAsset extends JViewLegacy
{
	protected $item;

    function display($tpl = null)
	{
		$model = $this->getModel();
		$this->config = JComponentHelper::getParams('com_solidres');
		$this->defaultGallery = $this->config->get('default_gallery', 'simple_gallery');
		$this->showPoweredByLink = $this->config->get('show_solidres_copyright', '1');

		$this->item	= $model->getItem();
		$this->checkin = $model->getState('checkin');
		$this->checkout = $model->getState('checkout');
		$this->adults = $model->getState('adults');
		$this->children = $model->getState('children');
		$this->countryId = $model->getState('country_id');
		$this->geoStateId = $model->getState('geo_state_id');
		$this->roomTypeObj = SRFactory::get('solidres.roomtype.roomtype');
		$this->numberOfNights = $this->roomTypeObj->calculateDateDiff($this->checkin, $this->checkout);
		$this->document = JFactory::getDocument();
		$this->context = 'com_solidres.reservation.process';
		$this->coupon  = JFactory::getApplication()->getUserState($this->context . '.coupon');

		JHtml::_('jquery.framework');
		JHtml::_('bootstrap.framework');
		SRHtml::_('jquery.colorbox', 'show_map', '700px', '650px', 'true', 'false');

		JHtml::stylesheet('com_solidres/assets/main.css', false, true, false);

		$this->document->addScriptDeclaration('
			Solidres.jQuery(document).ready(function ($) {
				$(".sr-photo").colorbox({rel:"sr-photo", transition:"fade"});
				$("#sr-change-date").colorbox({inline: true, width:"500px", height: "350px"});
			});
		');

		JText::script('SR_CAN_NOT_REMOVE_COUPON');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->_prepareDocument();
		
		parent::display($tpl);
    }
	
    /**
	 * Prepares the document like adding meta tags/site name per ReservationAsset
	 * 
	 * @return void
	 */
	protected function _prepareDocument()
	{
		if ($this->item->name)
		{
			$this->document->setTitle($this->item->name);
		}

		if ($this->item->metadesc)
		{
			$this->document->setDescription($this->item->metadesc);
		}

		if ($this->item->metakey)
		{
			$this->document->setMetadata('keywords', $this->item->metakey);
		}

		if ($this->item->metadata)
		{
			foreach ($this->item->metadata as $k => $v)
			{
				if ($v)
				{
					$this->document->setMetadata($k, $v);
				}
			}
		}
	}
}
