<?php
/**
 * @package LiveUpdate
 * @copyright Copyright ©2011 Nicholas K. Dionysopoulos / AkeebaBackup.com
 * @license GNU LGPLv3 or later <http://www.gnu.org/copyleft/lesser.html>
 */

defined('_JEXEC') or die();

/**
 * Configuration class for your extension's updates. Override to your liking.
 */
class LiveUpdateConfig extends LiveUpdateAbstractConfig
{
	var $_extensionName			= 'pkg_solidres';
	var $_extensionTitle		= 'Solidres';
	var $_updateURL				= 'http://solidres.com/index.php?option=com_ars&view=update&format=ini&id=1';
	var $_requiresAuthorization	= false;
	var $_versionStrategy		= 'different';
	var $_minStability			= 'stable';

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Override this ethod to load customized CSS and media files instead of the stock
	 * CSS and media provided by Live Update. If you override this class it MUST return
	 * true, otherwise LiveUpdate's CSS will be loaded after yours and will override your
	 * settings.
	 *
	 * @return bool Return true to stop Live Update from loading its own CSS files.
	 */
	public function addMedia()
	{
		JFactory::getDocument()->addStyleSheet(SRURI_MEDIA . '/assets/css/main.css');

		return true;
	}
}