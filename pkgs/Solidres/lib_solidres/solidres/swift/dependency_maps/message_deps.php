<?php

/**
 * @license  GNU Lesser General Public License v3
 */

defined('_JEXEC') or die;

Swift_DependencyContainer::getInstance()
    -> register('message.message')
    -> asNewInstanceOf('Swift_Message')

    -> register('message.mimepart')
    -> asNewInstanceOf('Swift_MimePart')
;
