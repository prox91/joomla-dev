<?php
defined('JPATH_OPENHRM') or die;

class RToolbarButtonModal extends RToolbarButton
{
	/**
	 * The data-target attribute.
	 *
	 * @var  string
	 */
	protected $dataTarget;

	/**
	 * Constructor.
	 *
	 * @param   string  $text        The button text.
	 * @param   string  $dataTarget  The data-target attribute.
	 * @param   string  $class       The button class.
	 * @param   string  $iconClass   The icon class.
	 */
	public function __construct($text = '', $dataTarget = '', $class = '', $iconClass = '')
	{
		parent::__construct($text, $iconClass, $class);

		$this->dataTarget = $dataTarget;
	}

	/**
	 * Get the data target attribute.
	 *
	 * @return  string  The data-target attribute.
	 */
	public function getDataTarget()
	{
		return $this->dataTarget;
	}

	/**
	 * Render the button.
	 *
	 * @return  string  The rendered button.
	 */
	public function render()
	{
		return RLayoutHelper::render('toolbar.button.modal', array('button' => $this));
	}
}
