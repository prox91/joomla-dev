<?php
defined('JPATH_OPENHRM') or die;

class RMenu
{
	/**
	 * The trees composing the menu.
	 *
	 * @var  RMenuTree[]
	 */
	protected $trees = array();

	/**
	 * Constructor.
	 *
	 * @param   RMenuTree[]  $trees  An array of trees.
	 */
	public function __construct(array $trees = array())
	{
		foreach ($trees as $tree)
		{
			$this->addTree($tree);
		}
	}

	/**
	 * Add a tree to the menu.
	 *
	 * @param   RMenuTree  $tree  The tree to add.
	 *
	 * @return  RMenu  This method is chainable.
	 */
	public function addTree(RMenuTree $tree)
	{
		$this->trees[$tree->getName()] = $tree;

		return $this;
	}

	/**
	 * Get the trees in the menu.
	 *
	 * @return  RMenuTree[]  An array of trees.
	 */
	public function getTrees()
	{
		return $this->trees;
	}
}
