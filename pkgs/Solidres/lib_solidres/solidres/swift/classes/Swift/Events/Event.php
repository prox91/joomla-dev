<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 * @license  GNU Lesser General Public License v3
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * The minimum interface for an Event.
 *
 * @package    Swift
 * @subpackage Events
 * @author     Chris Corbyn
 */

defined('_JEXEC') or die;

interface Swift_Events_Event
{
    /**
     * Get the source object of this event.
     *
     * @return object
     */
    public function getSource();

    /**
     * Prevent this Event from bubbling any further up the stack.
     *
     * @param boolean $cancel, optional
     */
    public function cancelBubble($cancel = true);

    /**
     * Returns true if this Event will not bubble any further up the stack.
     *
     * @return boolean
     */
    public function bubbleCancelled();
}
