<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 5:45 PM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import Joomla Form Controller library
jimport('legacy.controller.form');

/**
 * Class HelloWorldControllerHelloWorld
 */
class HelloWorldControllerHelloWorld extends JControllerForm
{
	/**
	 * Implement to allowAdd or not
	 *
	 * Not used at this time (but you can look at how other components use it....)
	 * Overwrites: JControllerForm::allowAdd
	 *
	 * @param array $data
	 * @return bool
	 */
	protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}

	/**
	 * Implement to allow edit or not
	 * Overwrites: JControllerForm::allowEdit
	 *
	 * @param array $data
	 * @param string $key
	 * @return bool
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) ){
			$user = JFactory::getUser();
			return $user->authorise( "core.edit", "com_helloworld.message." . $id );
		}
	}
}