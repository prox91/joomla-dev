<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 * @license  GNU Lesser General Public License v3
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A factory for creating CharacterReaders.
 *
 * @package    Swift
 * @subpackage Encoder
 * @author     Chris Corbyn
 */

defined('_JEXEC') or die;

interface Swift_CharacterReaderFactory
{
    /**
     * Returns a CharacterReader suitable for the charset applied.
     *
     * @param string $charset
     *
     * @return Swift_CharacterReader
     */
    public function getReaderFor($charset);
}
