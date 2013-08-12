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
 * Custom script to hook into installation process
 *
 */
class pkg_solidresInstallerScript
{
	function install($parent)
	{
	}

	function uninstall($parent)
	{
		// Also uninstall sample media file package
		$this->dbo = JFactory::getDbo();
		$query = $this->dbo->getQuery(true);
		$query->delete()->from('#__extensions')->where('name LIKE '.$this->dbo->quote('files_solidres_media'));
		$this->dbo->setQuery($query);
		$this->dbo->execute();
		$mediaLangFile = JPATH_SITE.'/language/en-GB/en-GB.files_solidres_media.sys.ini';
		if (JFile::exists($mediaLangFile))
		{
			JFile::delete($mediaLangFile);
		}

		// Remove content elements files
		$destinationDir = JPATH_SITE . '/administrator/components/com_falang/contentelements/';
		$contentElementFiles = array('sr_coupons.xml', 'sr_extras.xml', 'sr_reservation_assets.xml', 'sr_room_types.xml');
		foreach($contentElementFiles as $file)
		{
			$target = $destinationDir . $file;
			if (JFile::exists($target))
			{
				JFile::delete($target);
			}
		}

	}

	function update($parent)
	{
	}

	function preflight($type, $parent)
	{
	}

	function postflight($type, $parent, $results)
	{
		// Install content elements files
		$destinationDir = JPATH_SITE . '/administrator/components/com_falang/contentelements/';
		$sourceDir = JPATH_SITE . '/administrator/components/com_solidres/falang/';

		if (JFolder::exists($destinationDir))
		{
			$files = JFolder::files($sourceDir);
			if(!empty($files))
			{
				foreach($files as $file)
				{
					JFile::copy($sourceDir . $file, $destinationDir . $file);
				}
			}
		}


		echo '
		<style>
			.solidres-installation-result {
				margin: 15px 0;
			}
			.solidres-installation-result .solidres-ext {
				padding: 8px;
				border-left: 3px solid #63B75D;
				background: #EEE;
				margin: 0 0 2px 0;
			}
			.solidres-installation-result label {
				font-weight: bold;
				margin-bottom: 0;
				display: inline-block;

			}
			.solidres-installation-result ul {
				margin: 20px 0 20px 10px;
			}

			.solidres-installation-result ul li {
				list-style: none;
			}
		</style>
		';

		echo '<div class="row-fluid solidres-installation-result">
				<div class="span6">
					<img src="'. JUri::root() .'/media/com_solidres/assets/images/logo_black.png" width="250" height="52" alt="Solidres\'s logo"/>
					<ul>
						<li><label>Homepage:</label><a href="http://solidres.com" target="_blank">http://solidres.com</a></li>
						<li><label>Documentation:</label><a href="http://solidres.com/documentation" target="_blank">http://solidres.com/documentation</a></li>
						<li><label>Community forum:</label><a href="http://solidres.com/forum" target="_blank">http://solidres.com/forum</a></li>
					</ul>
					<p><a href="'.JUri::root().'/administrator/index.php?option=com_solidres" class="btn btn-primary"><i class="icon-out "></i> Go to Solidres now</a></p>
			   	</div>
				<div class="span6">';
		foreach ($results as $result)
		{
			echo '<div class="solidres-ext '.($result['result'] == true ? 'ok' : 'not-ok' ).'">';
			echo '<label>' . $result['name'] . '</label>';
			echo ' has been ' . ($type == 'install' ? 'installed' : 'upgraded' );
			echo ($result['result'] == true ?  ' successfully' : ' failed'  ) . '</div>';
		}
		echo ' </div>
			</div>';
	}
}