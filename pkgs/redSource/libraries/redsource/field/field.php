<?php
/**
 * @package     Redsource.Libraries
 * @subpackage  Field
 *
 * @copyright   Copyright (C) 2012 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Field library to extend by field types
 *
 * @package     Redsource.Libraries
 * @subpackage  Field
 * @since       1.0
 */
class RedsourceField
{
	/**
	 * Type of the field. Unique string
	 *
	 * @var  string
	 */
	protected $type = null;

	/**
	 * Layout to render the field.
	 *
	 * @var  RLayout
	 */
	protected $layout = null;

	/**
	 * Form field type. Defaults to type field.
	 *
	 * @var string
	 */
	protected $fieldType = null;

	/**
	 * Form field attributes.
	 *
	 * @var array
	 */
	protected $fieldProperties = array(
		'name', 'label', 'description', 'class', 'labelclass', 'hidden', 'id', 'multiple', 'required', 'validate', 'translate_label', 'translate_description');

	/**
	 * Errors encountered
	 *
	 * @var  array
	 */
	protected $errors = array();

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		// Initialize type, just in case.
		$type = $this->getType();

		if ($this->fieldType == null)
		{
			$this->fieldType = $type;
		}
	}

	/**
	 * Add an error to the error array
	 *
	 * @param   string  $errorMessage  The error message
	 *
	 * @return  void
	 */
	protected function addError($errorMessage)
	{
		$this->errors[] = $errorMessage;
	}

	/**
	 * Return all the errors encountered
	 *
	 * @return  array
	 */
	protected function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Get the time of this data channel
	 *
	 * @return  string  Unique data channel name
	 *
	 * @throws  RuntimeException
	 */
	public function getType()
	{
		if (empty($this->type))
		{
			$className = get_class($this);
			$viewPos = strpos($className, 'Field');

			if ($viewPos === false)
			{
				throw new RuntimeException('Unknown field type!', 500);
			}

			$this->type = strtolower(substr($className, $viewPos + 5));
		}

		return $this->type;
	}

	/**
	 * Change the type of this data channel
	 *
	 * @param   string  $type  Unique type name
	 *
	 * @return  RedsourceField  Self instance for chainning
	 */
	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}

	/**
	 * Set the layout used to render the field
	 *
	 * @param   RLayoutFile  $layout  Layout to use
	 *
	 * @return  RedsourceField  Self instance for chainning
	 */
	public function setLayout(RLayoutFile $layout)
	{
		$this->layout = $layout;

		return $this;
	}

	/**
	 * Render the current field
	 *
	 * @param   mixed  $data  Data to be rendered in the layout
	 *
	 * @return  string  HTML code
	 */
	public function render($data)
	{
		if (empty($this->layout))
		{
			$this->setLayout(new RLayoutFile("field.{$this->getType()}"));
		}

		return $this->layout->render($data);
	}

	/**
	 * Attach element into the form.
	 *
	 * @param   JForm   $form     Form where attach the field
	 * @param   array   $data     Data
	 * @param   string  $group    Group of the field
	 * @param   bool    $replace  Replace the field
	 *
	 * @return  void
	 *
	 * @throws  RuntimeException
	 */
	public function setField(JForm $form, array $data, $group = null, $replace = true)
	{
		if (!isset($data['name'], $data['label']))
		{
			throw new RuntimeException("Internal error: Data field requires mandatory 'name' and 'label' attributes.");
		}

		$element = new SimpleXMLElement('<field type="' . $this->fieldType . '" />');

		foreach ($this->fieldProperties as $property)
		{
			if (!isset($data[$property]))
			{
				continue;
			}

			$element->addAttribute($property, $data[$property]);
		}

		$form->setField($element, $group, $replace);
	}

	/**
	 * Method for getting the form for editing the field.
	 *
	 * @param   array  $data  Data for the form.
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 */
	public function getForm($data = array())
	{
		// Get the form.
		$context = 'rfield_' . $this->getType();
		$form = $this->loadForm(
			$context . '.' . $this->fieldType, $this->fieldType,
			array(
				'control' => $context,
			)
		);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}
}
