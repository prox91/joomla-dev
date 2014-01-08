<?php

defined('JPATH_OPENHRM') or die;

JFormHelper::loadFieldClass('rpredefinedlist');

class JFormFieldRpublished extends JFormFieldRpredefinedList
{
	/**
	 * The form field type.
	 *
	 * @var  string
	 */
	protected $type = 'Rpublished';

	/**
	 * The array of values
	 *
	 * @var  string
	 */
	protected $predefinedOptions = array(
		1   => 'JPUBLISHED',
		0   => 'JUNPUBLISHED',
		2   => 'JARCHIVED',
		-2  => 'JTRASHED',
		'*' => 'JALL'
	);
}
