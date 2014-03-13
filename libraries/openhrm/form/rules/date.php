<?php
defined('JPATH_OPENHRM') or die;

class JFormRuleDate extends RFormRule
{
	/**
	 * Method to test if two values are not equal. To use this rule, the form
	 * XML needs a validate attribute of equals and a field attribute
	 * that is equal to the field to test against.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 * @param   JRegistry         $input    An optional JRegistry object with the entire data set to validate against the entire form.
	 * @param   JForm             $form     The form object for which the field is being tested.
	 *
	 * @return  boolean  True if the value is valid, false otherwise.
	 *
	 * @throws  InvalidArgumentException
	 * @throws  UnexpectedValueException
	 */
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
		// Date format.
		if (!isset($element['format']))
		{
			throw new InvalidArgumentException('No date "format" specified for the date rule.');
		}

		try
		{
			$date = DateTime::createFromFormat($element['format'], $value);
		}
		catch (Exception $e)
		{
			return false;
		}

		return $date instanceof DateTime;
	}
}
