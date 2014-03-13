<?php
defined('JPATH_OPENHRM') or die;

class RToolbarButtonLink extends RToolbarButton
{
	/**
	 * The button url.
	 *
	 * @var  string
	 */
	protected $url;

	/**
	 * Constructor.
	 *
	 * @param   string  $text       The button text.
	 * @param   string  $url        The button task.
	 * @param   string  $class      The button class.
	 * @param   string  $iconClass  The icon class.
	 */
	public function __construct($text = '', $url = '', $class = '', $iconClass = '')
	{
		parent::__construct($text, $iconClass, $class);

		$this->url = $url;
	}

	/**
	 * Get the button url.
	 *
	 * @return  string  The url.
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Render the button.
	 *
	 * @return  string  The rendered button.
	 */
	public function render()
	{
		return RLayoutHelper::render('toolbar.button.link', array('button' => $this));
	}
}
