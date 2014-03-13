<?php
defined('JPATH_OPENHRM') or die;

abstract class RToolbarButton
{
	/**
	 * The button text.
	 *
	 * @var  string
	 */
	protected $text;

	/**
	 * The button icon class.
	 *
	 * @var  string
	 */
	protected $iconClass;

	/**
	 * The button class.
	 *
	 * @var  string
	 */
	protected $class;

	/**
	 * Constructor.
	 *
	 * @param   string  $text       The button text.
	 * @param   string  $iconClass  The icon class.
	 * @param   string  $class      The button class.
	 */
	public function __construct($text, $iconClass = '', $class = '')
	{
		if (!empty($text))
		{
			$this->text = JText::_($text);
		}

		$this->iconClass = $iconClass;
		$this->class = $class;
	}

	/**
	 * Get the button text.
	 *
	 * @return  string  The button text.
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * Get the button icon class.
	 *
	 * @return  string  The button icon class.
	 */
	public function getIconClass()
	{
		return $this->iconClass;
	}

	/**
	 * Get the button class.
	 *
	 * @return  string  The button class.
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 * Render the button.
	 *
	 * @return  string  The rendered button.
	 */
	abstract public function render();
}
