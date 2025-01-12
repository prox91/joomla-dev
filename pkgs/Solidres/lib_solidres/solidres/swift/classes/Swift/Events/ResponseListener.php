<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 * @license  GNU Lesser General Public License v3
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Listens for responses from a remote SMTP server.
 *
 * @package    Swift
 * @subpackage Events
 * @author     Chris Corbyn
 */

defined('_JEXEC') or die;

interface Swift_Events_ResponseListener extends Swift_Events_EventListener
{
    /**
     * Invoked immediately following a response coming back.
     *
     * @param Swift_Events_ResponseEvent $evt
     */
    public function responseReceived(Swift_Events_ResponseEvent $evt);
}
