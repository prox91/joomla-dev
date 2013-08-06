<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 * @license  GNU Lesser General Public License v3
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A MIME Header with parameters.
 *
 * @package    Swift
 * @subpackage Mime
 * @author     Chris Corbyn
 */

defined('_JEXEC') or die;

interface Swift_Mime_ParameterizedHeader extends Swift_Mime_Header
{
    /**
     * Set the value of $parameter.
     *
     * @param string $parameter
     * @param string $value
     */
    public function setParameter($parameter, $value);

    /**
     * Get the value of $parameter.
     *
     * @param string $parameter
     *
     * @return string
     */
    public function getParameter($parameter);
}
