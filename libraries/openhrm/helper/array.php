<?php
defined('JPATH_OPENHRM') or die;

final class RHelperArray
{
	/**
	 * Quote an array of values.
	 *
	 * @param   array  $values  The values.
	 *
	 * @return  array  The quoted values
	 */
	public static function quote(array $values)
	{
		$db = JFactory::getDbo();

		return array_map(
			function ($value) use ($db) {
				return $db->quote($value);
			},
			$values
		);
	}
}
