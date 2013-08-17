<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * Utilities handler class
 * 
 * @package 	Solidres
 * @subpackage	utilities
 */
class SRUtilities
{
	/**
     * Implode array of fields to sql
     * 
     * @param array $list The table fields
     * 
     * @return string
     */
    function myImplodeField($list = array())
    {
    	$result = '';
    	for($i = 0; $i < count($list) - 1; $i++)
    	{
    		$result .= '`'.$list[$i].'`, ';
    	}
    	$result .= '`'.$list[count($list) - 1].'`';
    	return $result;
    }
    
    /**
     * Quote the text and escape all sing quote with " '' "
     * 
     * @param string $text
     *
     * @return string
     */
    function myQuote($text)
    {
    	$return = str_replace('\'',  '\'\'', $text);
    	return $return;
    }
    
    /**
     * Implode the list of table field's values
     *
     * @param   array $list The table field's values
     *
     * @return  string
     */
    function myImplode($list = array())
    {
    	$result = '';
    	for($i = 0; $i < count($list) - 1; $i++)
    	{
    		if(is_numeric($list[$i])) {
    			$result .= $list[$i].', ';
    		} elseif ($list[$i] == null) {
    			$result .= 'NULL'.', ';
    		} else {
    			$result .= '\''.$this->myQuote($list[$i]).'\', ';
    		}
    	}
    	
    	if(is_numeric($list[count($list) - 1])) {
    		$result .= $list[count($list) - 1];
    	} elseif ($list[count($list) - 1] == null) {
    		$result .= 'NULL';
    	} else {
    		$result .= '\''.$this->myQuote($list[count($list) - 1]).'\'';
    	}
    	
    	return $result;
    }
}