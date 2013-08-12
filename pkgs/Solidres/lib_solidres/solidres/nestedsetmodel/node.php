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

// @todo add a roll back functionality in case something wrong happen, we will be able to restore the category tree structure
class SRNode
{
  	/**
  	 * The class instance
  	 * 
  	 * @var object
  	 */
	private static $instance;
	/**
  	 * The table name 
  	 * 
  	 * @var string
  	 */
	protected $_tbl = '';
	/**
	 * The database object
	 * 
	 * @var object
	 */
	protected $_dbo = null;
	/**
	 * Indicator that the tables have been locked.
	 *
	 * @var		boolean
	 * @since	1.6
	 */
	protected $_locked = false;
    
	private function __construct()
	{
		$this->_dbo = JFactory::getDbo();
		$this->_tbl = $this->_dbo->quoteName('#__sr_categories');
	}
	
	/**
	 * Returns the global SRDatabase object, only creating it if it
	 * doesn't already exist.
	 * 
	 * @return object SRDatabase object
	 */ 
  	public static function getInstance() 
  	{ 
    	if (!isset(self::$instance))
        {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
  	} 
	
	/**
	 * Return a node in a category nested set model
	 * 
	 * @param 	int 	$id 	The node id
	 * @return 	object 	$row 	The node object 
	 */
	
	public function getNode($id) 
	{
		$query = $this->_dbo->getQuery(true);
		
		$query->select('id, parent_id, lft, rgt, title, alias');
		$query->from($this->_tbl);
		$query->where('id = '.$this->_dbo->quote($id));
		
		$this->_dbo->setQuery($query);
		$row = $this->_dbo->loadObject();
		
		if ((!$row) || ($this->_dbo->getErrorNum()))
		{
			$errorMsg = JText::sprintf('SR_DATABASE_ERROR_GETNODE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
			JError::raiseWarning('', $errorMsg);
			return false;
		}

		if( ($row->rgt - $row->lft) == 1)
        {
			$row->numChildNode = 0;		
		}
        else
        {
			$row->numChildNode = ($row->rgt - $row->lft - 1) / 2 ;
		} 
		
		return $row;
	}

	/**
	 * Get child node
	 * 
	 * @param 	int 	$id 	The parent node ID
	 * @return 	array 	$rows 	An array of all child nodes
	 */
	public function getChildNode($id)
	{
		$node = self::getNode($id);
		
		$query = $this->_dbo->getQuery(true);
		$query->select('id');
		$query->from($this->_tbl);
		$query->where('lft > '.$node->lft.' AND rgt < '.$node->rgt);
		$this->_dbo->setQuery($query);
		$rows = $this->_dbo->loadResultArray();
		
		return $rows;
	}

	/**
	 * Save a new node
	 * 
	 * @param   int     $parentId The parent node id
	 * @return  boolean
	 */
	public function saveNode($parentId) 
	{
		$query 		= $this->_dbo->getQuery(true);
		$context 	= 'com_solidres.edit.category';
		$app		= JFactory::getApplication();
		
		// get the lft value of parent id
		$query->select('lft');
		$query->from($this->_tbl);
		$query->where('id = '.$this->_dbo->quote($parentId));
		$this->_dbo->setQuery($query);
		$parentLft = $this->_dbo->loadResult();

		// Move all rgt by 2,give space for new node
		$query->clear();
		$query->update($this->_tbl);
		$query->set('rgt = rgt + 2');
		$query->where('rgt > '.$this->_dbo->quote($parentLft));
		$this->_dbo->setQuery($query);

		if (!$this->_dbo->execute())
		{
			$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
			JError::raiseWarning('', $errorMsg);
			$this->_unlock();
			return false;
		}

		// Move all lft by 2, give space for new node
		$query->clear();
		$query->update($this->_tbl);
		$query->set('lft = lft + 2');
		$query->where('lft > '.$this->_dbo->quote($parentLft));
		$this->_dbo->setQuery($query);

		if (!$this->_dbo->execute())
		{
			$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
			JError::raiseWarning('', $errorMsg);
			$this->_unlock();
			return false;
		}

		$app->setUserState($context.'.parentlft', $parentLft);
        
		return true;
	}
	
	/**
	 * Updating existing node or subtree
	 * 
	 * @param array $data The node data
	 * @return boolean
	 */
	public function updateNode($data)
	{
		$query 		= $this->_dbo->getQuery(true);
		$app		= JFactory::getApplication();
		$context 	= 'com_solidres.edit.category';
		$doUpdate	= 0;
		
		$node 			= $this->getNode($data['id']);
		$newParentNode 	= $this->getNode($data['parent_id']);
		$oldParentNode 	= $this->getNode($node->parent_id);
		$childNodes		= $this->getChildNode($data['id']); 
		
		// IF WE DO NOT MOVE THE NODE, DO NOTHING
		if( (int) $node->parent_id == (int) $data['parent_id']  )
        {
			$doUpdate	= 0;
		}
        else
        {
			$doUpdate	= 1;
			$width = ($node->numChildNode == 0 ? 2 : ($node->numChildNode * 2) + 2);
			// BEGIN MOVING
			// LEFT -> RIGHT			
			if($newParentNode->lft > $node->rgt)
            {
				// UPDATE rgt of all node between moved node and new parent node
				$query->update($this->_tbl);
				$query->set('rgt = rgt - '.$width);
				$query->where('rgt BETWEEN '.$node->rgt.' AND '.$newParentNode->lft);
				$this->_dbo->setQuery($query);
				if (!$this->_dbo->execute())
				{
					$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
					JError::raiseWarning('', $errorMsg);
					$this->_unlock();
					return false;
				}
				
				// UPDATE lft of all node between moved node and new parent node
				$query->clear();
				$query->update($this->_tbl);
				$query->set('lft = lft - '.$width);
				$query->where('lft BETWEEN '.$node->rgt.' AND '.$newParentNode->lft);
				$this->_dbo->setQuery($query);

				if (!$this->_dbo->execute())
				{
					$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
					JError::raiseWarning('', $errorMsg);
					$this->_unlock();
					return false;
				}
				
				// GET the newParentNode again with updated lft value
				$newParentNode 	= $this->getNode($data['parent_id']);
				// new lft and rgt value for this node
				$newLft = $newParentNode->lft + 1;				
				$newRgt = $newParentNode->lft + $width;
	
				// Update all child node of the moved node
				if($node->numChildNode > 0)
                {
					$query->clear();
					$query->update($this->_tbl);
					$query->set('lft = lft + '.(int)($newLft - $node->lft).', rgt = rgt + '.(int) ($newLft - $node->lft));
					$query->where('id IN ('.implode(',', $childNodes).')');
					
					$this->_dbo->setQuery($query);
					if (!$this->_dbo->execute())
					{
						$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
						JError::raiseWarning('', $errorMsg);
						return false;
					}
				}
				
				$app->setUserState($context.'.newlft', $newLft);
				$app->setUserState($context.'.newrgt', $newRgt);
				
			}
            else if ($newParentNode->lft < $node->rgt)
            { // RIGHT -> LEFT
			
				// UPDATE rgt of all node between moved node and new parent node
				$query->update($this->_tbl);
				$query->set('rgt = rgt + '.$width);
				$query->where('rgt BETWEEN '.$newParentNode->lft.' AND '.$node->lft);
				$this->_dbo->setQuery($query);

				if (!$this->_dbo->execute())
				{
					$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
					JError::raiseWarning('', $errorMsg);
					return false;
				}
				
				// UPDATE lft of all node between moved node and new parent node
				$query->clear();
				$query->update($this->_tbl);
				$query->set('lft = lft + '.$width);
				$query->where('lft > '.$newParentNode->lft.' AND lft < '.$node->lft);
				$this->_dbo->setQuery($query);

				if (!$this->_dbo->execute())
				{
					$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
					JError::raiseWarning('', $errorMsg);
					$this->_unlock();
					return false;
				}
				
				// GET the newParentNode again with updated lft value
				$newParentNode 	= $this->getNode($data['parent_id']);
				// new lft and rgt value for this node
				$newLft = $newParentNode->lft + 1;				
				$newRgt = $newParentNode->lft + $width;
				
				// Update all child node of the moved node
				if($node->numChildNode > 0)
                {
					$query->clear();
					$query->update($this->_tbl);
					$query->set('lft = lft - '.(int)($node->lft - $newLft ).', rgt = rgt - '.(int) ($node->lft - $newLft  ));
					$query->where('id IN ('.implode(',', $childNodes).')');
					$this->_dbo->setQuery($query);
					if (!$this->_dbo->execute())
					{
						$errorMsg = JText::sprintf('SR_DATABASE_ERROR_MOVE_FAILED', get_class($this), $this->_dbo->getErrorMsg());
						JError::raiseWarning('', $errorMsg);
						$this->_unlock();
						return false;
					}
				}
				$app->setUserState($context.'.newlft', $newLft);
				$app->setUserState($context.'.newrgt', $newRgt);
			}
			// END MOVING
		}

		$app->setUserState($context.'.doupdate', $doUpdate);

		return true;
	}
	/**
	 * Method to lock the database table for writing.
	 *
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	private function _lock()
	{
		// Lock the table for writing.
		$this->_dbo->setQuery('LOCK TABLES `'.$this->_tbl.'` WRITE');
		$this->_dbo->execute();

		// Check for a database error.
		if ($this->_dbo->getErrorNum())
        {
			$errorMsg = $this->_dbo->getErrorMsg();
			JError::raiseWarning('', $errorMsg);
			return false;
		}

		$this->_locked = true;

		return true;
	}

	/**
	 * Method to unlock the database table for writing.
	 *
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	private function _unlock()
	{
		// Unlock the table.
		$this->_dbo->setQuery('UNLOCK TABLES');
		$this->_dbo->execute();

		// Check for a database error.
		if ($this->_dbo->getErrorNum())
        {
			$errorMsg = $this->_dbo->getErrorMsg();
			JError::raiseWarning('', $errorMsg);
			return false;
		}

		$this->_locked = false;

		return true;
	}
}