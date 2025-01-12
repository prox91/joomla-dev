<?php
defined('JPATH_OPENHRM') or die;

class RToolbarButtonStandard extends RToolbarButton
{
	/**
	 * The button task.
	 *
	 * @var  string
	 */
	protected $task;

	/**
	 * Is this applying on a list ?
	 *
	 * @var  boolean
	 */
	protected $list;

	/**
	 * Constructor.
	 *
	 * @param   string   $text       The button text.
	 * @param   string   $task       The button task.
	 * @param   string   $class      The button class.
	 * @param   string   $iconClass  The icon class.
	 * @param   boolean  $list       Is the button applying on a list ?
	 */
	public function __construct($text = '', $task = '', $class = '', $iconClass = '', $list = true)
	{
		parent::__construct($text, $iconClass, $class);

		$this->task = $task;
		$this->list = $list;
	}

	/**
	 * Get the button task.
	 *
	 * @return  string  The task.
	 */
	public function getTask()
	{
		return $this->task;
	}

	/**
	 * Check if the button applies on a list.
	 *
	 * @return  boolean  True if applying on a list, false otherwise.
	 */
	public function isList()
	{
		return $this->list;
	}

	/**
	 * Render the button.
	 *
	 * @return  string  The rendered button.
	 */
	public function render()
	{
		return RLayoutHelper::render('toolbar.button.standard', array('button' => $this));
	}
}
