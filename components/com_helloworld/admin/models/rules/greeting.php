<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/14/13
 * Time: 5:17 PM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla formrule library
//jimport('joomla.form.rule');
JFormHelper::loadRuleClass('greeting');

/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleGreeting extends JFormRule
{
	/**
	 * The regular expression.
	 *
	 * @access      protected
	 * @var         string
	 * @since       2.5
	 */
	protected $regex = '^[^0-9]+$';
}