<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptControllerLessons extends JControllerLegacy
{
    /**
     * Proxy for getModel.
     * @since       2.5
     */
    public function getModel($name = 'Lessons', $prefix = 'EnglishConceptModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }
}
