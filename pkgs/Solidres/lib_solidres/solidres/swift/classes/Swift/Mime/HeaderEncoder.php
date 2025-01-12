<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 * @license  GNU Lesser General Public License v3
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Interface for all Header Encoding schemes.
 *
 * @package    Swift
 * @subpackage Mime
 * @author     Chris Corbyn
 */

defined('_JEXEC') or die;

interface Swift_Mime_HeaderEncoder extends Swift_Encoder
{
    /**
     * Get the MIME name of this content encoding scheme.
     *
     * @return string
     */
    public function getName();
}
