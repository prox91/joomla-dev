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
 * @subpackage	Media
 * @since		0.4.0
 */
class SolidresControllerMediaList extends JControllerLegacy
{
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->app = JFactory::getApplication();
	}

	public function show()
	{
		$model = $this->getModel();
		//$modelName = $model->getName();
		$start = $this->input->getUInt('start');
		$limit = $this->input->getUInt('limit');
		$model->setState('list.start', $start);
		$model->setState('list.limit', $limit);

		$results = $model->getItems();
		$srMedia = SRFactory::get('solidres.media.media');
		$html = '';

		if ($results)
		{
			$html .= '<ul class="media-container clearfix">';

			foreach($results as $item)
			{
				$html .= '<li>';

				$html .= '<input class="media-checkbox" type="checkbox" name="media[]" value="'.$item->id.'" />';

				if ( $srMedia->isImage($item->mime_type) )
				{
					$html .= '<img id="sr_media_'.$item->id.'" title="'.$item->name.'" alt="'.$item->name.'" src="'.SRURI_MEDIA.'/assets/images/system/thumbnails/2/'.$item->value.'" />';
				}
				elseif ( $srMedia->isDocument($item->mime_type) )
				{
					$html .= '<img id="sr_media_'.$item->id.'" title="'.$item->name.'" alt="'.$item->name.'" src="'.SRURI_MEDIA.'/assets/images/document.png" />';
				}
				elseif ( $srMedia->isVideo($item->mime_type))
				{
					$html .= '<img id="sr_media_'.$item->id.'" title="'.$item->name.'" alt="'.$item->name.'" src="'.SRURI_MEDIA.'/assets/images/video.png" />';
				}

				$html .= substr($item->name, 0, 20);

				$html .= '</li>';
			}

			$html .= '</ul>';
		}

		echo $html;
		exit();
	}

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param	string	$name The model name. Optional.
	 * @param	string	$prefix The class prefix. Optional.
	 * @param	array	$config Configuration array for model. Optional.
	 *
	 * @return	object	The model.
	 * @since	1.5
	 */
	public function &getModel($name = 'MediaList', $prefix = 'SolidresModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}