<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 * @license  GNU Lesser General Public License v3
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Provides an abstract way of specifying recipients for batch sending.
 *
 * @package    Swift
 * @subpackage Mailer
 * @author     Chris Corbyn
 */

defined('_JEXEC') or die;

interface Swift_Mailer_RecipientIterator
{
    /**
     * Returns true only if there are more recipients to send to.
     *
     * @return boolean
     */
    public function hasNext();

    /**
     * Returns an array where the keys are the addresses of recipients and the
     * values are the names. e.g. ('foo@bar' => 'Foo') or ('foo@bar' => NULL)
     *
     * @return array
     */
    public function nextRecipient();
}
