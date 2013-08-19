<?php
/**
 * @package     redSocialstream
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class RedsocialstreamsViewRedsocialstreams extends JView
{
	function display($tpl = null)
	{
		//Load pane behavior
		jimport('joomla.html.pane');

		$pane = JPane::getInstance('sliders');
		JToolBarHelper::title(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'), 'redsocialstream');
		//DEVNOTE: set document title
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSOCIALSTREAM_REDSOCIALSTREAMS'));
		$this->assignRef('pane', $pane);

		parent::display($tpl);
	}

	/**
	 * Creates the buttons view
	 *
	 * @param string  $link  targeturl
	 * @param string  $image path to image
	 * @param string  $text  image description
	 * @param boolean $modal 1 for loading in modal
	 */
	function quickiconButton($link, $image, $text, $modal = 0)
	{
		//initialise variables
		$lang = JFactory::getLanguage();
		?>

		<div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
			<div class="icon">
				<?php
				if ($modal == 1)
				{
				JHTML::_('behavior.modal');
				?>
				<a href="<?php echo $link . '&amp;tmpl=component'; ?>" style="cursor:pointer" class="modal"
				   rel="{handler: 'iframe', size: {x: 650, y: 400}}">
					<?php
					}
					else
					{
					?>
					<a href="<?php echo $link; ?>">
						<?php
						}

						echo JHTML::_('image', 'administrator/components/com_redsocialstream/assets/images/' . $image, $text);
						?>
						<span><?php echo $text; ?></span>
					</a>
			</div>
		</div>
	<?php
	}
}
