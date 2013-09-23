<?php
/**
 * @package     Jab.Admin
 * @subpackage  Tables
 *
 * @copyright   Copyright (C) 2013 Roberto Segura López. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

/**
 * Speaker table for JAB
 *
 * @package     Jab.Admin
 * @subpackage  Tables
 * @since       1.0
 */
class JabTableSpeaker extends RTable
{
	/**
	 * Table name (without the prefix)
	 *
	 * @var  string
	 */
	protected $_tableName = 'jab_speakers';

	/**
	 * Field name to publish/unpublish/trash table registers. Ex: state
	 *
	 * @var  string
	 */
	protected $_tableFieldState = 'published';
}
