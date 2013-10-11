<?php
/**
 * @package     WebService.Model
 * @subpackage  Model
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Web Service Api Model class.
 *
 * @package     WebService.Model
 * @subpackage  Model
 * @since       1.0
 */
abstract class WebServiceModelsBase extends JModelBase
{
	/**
	 * The content factory.
	 *
	 * @var    JContentFactory
	 * @since  1.0
	 */
	protected $factory;

	/**
	 * The database driver.
	 *
	 * @var    JDatabaseDriver
	 * @since  1.0
	 */
	protected $db;


    protected $map;

	/**
	 * Method to instantiate the model.
	 *
	 * @param   JContentFactory  $factory  The content factory.
	 * @param   JDatabaseDriver  $db       The database adpater.
	 * @param   JRegistry        $state    The model state.
	 *
	 * @since   1.0
	 */
	public function __construct(JContentFactory $factory = null, JDatabaseDriver $db = null, JRegistry $state = null, $mappingFile = null)
	{
		parent::__construct($state);

		// Set factory
		if ($factory == null)
		{
			$this->factory = JContentFactory::getInstance();
		}
		else
		{
			$this->factory = $factory;
		}

		// Set database
		if ($db == null)
		{
			$this->db = JFactory::getDbo();
		}
		else
		{
			$this->db = $db;
		}

        $this->readMappingData($mappingFile);
	}

    /**
     * Fetch data from mapping file
     *
     * @param   string  $path  The file path
     *
     * @return  array
     *
     * @since   1.0
     * @throws   RuntimeException if file cannot be read.
     */
    protected function readMappingData($path)
    {
        // Check if file is readable
        if (!is_readable($path))
        {
            throw new RuntimeException(sprintf('File %s is unreadable.', $path));
        }

        // Load the mapping file into an object.
        $this->map = json_decode(file_get_contents($path));

        // Check if mapping file hasn't any error
        if ($this->map == null)
        {
            throw new RuntimeException(sprintf('Mapping file %s cannot be decoded.', $path));
        }
    }

	/**
	 * Method to get a list of content items.
	 *
	 * @return  array  An array JContent objects.
	 *
	 * @since   1.0
	 * @throws  RuntimeException
	 * @throws  UnexpectedValueException
	 */
	abstract protected function getList();

	/**
	 * Count items
	 *
	 * @return  integer  The number of rows that match the sql
	 *
	 * @since   1.0
	 * @throws  RuntimeException
	 * @throws  UnexpectedValueException
	 */
	abstract protected function countItems();

	/**
	 * Method to get a database query object to load a list of items.
	 *
	 * @return  object  A JDatabaseQuery object.
	 *
	 * @since   1.0
	 */
	abstract protected function getListQuery();

	/**
	 * Method to get a content item.
	 *
	 * @return  JContent  A content object.
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 * @throws  UnexpectedValueException
	 */
	abstract protected function getItem();

	/**
	 * Method to delete a content item.
	 *
	 * @return  JContent  A content object.
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 * @throws  UnexpectedValueException
	 */
	abstract protected function deleteItem();

	/**
	 * Method to delete a content item.
	 *
	 * @return  JContent  A content object.
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 * @throws  UnexpectedValueException
	 */
	abstract protected function deleteList();

	/**
	 * Method to check existance of an item by ID
	 *
	 * @param   int  $contentId  The id of the content to test if exists
	 *
	 * @return  boolean  True or false if the item exists or not in database
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 * @throws  UnexpectedValueException
	 */
	abstract protected function existsItem($contentId);

	/**
	 * Method to get the content types for one or more content items.
	 *
	 * @param   mixed  $contentIds  An integer or array of integer content ids.
	 *
	 * @return  array  An array of JContentType objects.
	 *
	 * @since   1.0
	 * @throws  RuntimeException
	 */
	abstract protected function getTypes($contentIds);

	/**
	 * Method to delete a content item.
	 *
	 * @return  JContent  A content object.
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 * @throws  UnexpectedValueException
	 */
	abstract protected function updateItem();

	/**
	 * Method to update one item
	 *
	 * @return  JContent  A JContent object
	 *
	 * @since   1.0
	 * @throws  UnexpectedValueException
	 */
	abstract protected function createItem();

	/**
	 * Map two contnet
	 *
	 * @param   string   $content_id1  The id of content 1
	 * @param   array    $content_ids  An array of content ids to map
	 * @param   boolean  $updateAll    Update all map fields or only one
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	abstract protected function map($content_id1, $content_ids, $updateAll = false);

	/**
	 * Unmap two contnet
	 *
	 * @param   string  $content_id1  The id of content 1
	 * @param   string  $content_id2  The id of content 2
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	abstract protected function unmap($content_id1, $content_id2 = null);
}
