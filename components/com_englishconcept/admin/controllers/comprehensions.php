<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

// Import Joomla admin controller from the library
jimport('joomla.application.component.controlleradmin');

class EnglishConceptControllerComprehensions extends JControllerAdmin
{
    /**
     * Proxy for getModel.
     * @since       2.5
     */
    public function getModel($name = 'Comprehension', $prefix = 'EnglishConceptModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }
}
