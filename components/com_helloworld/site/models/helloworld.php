<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/4/13
 * Time: 11:52 PM
 * To change this template use File | Settings | File Templates.
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('legacy.model.item');

class HelloWorldModelHelloWorld extends JModelItem
{
	/**
	 * @var array messages
	 */
	protected $messages;

	/**
	 * @var object item
	 */
	protected $item;

	/**
	 *
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();
		// Get the message id
		$input = JFactory::getApplication()->input;
		$id    = $input->getInt('id');
		$this->setState('message.id', $id);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
		parent::populateState();
	}

	/**
	 * @param string $type
	 * @param string $prefix
	 * @param array $config
	 * @return JTable|mixed
	 */
	public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * @return mixed
	 */
	public function getMsg()
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}

		if (!isset($this->msg))
		{

			$id = JFactory::getApplication()->input->get('id', 1, 'INT');

			$table = $this->getTable();
			$table->load($id);

			// Assign the message
			$this->messages[$id] = $table->greeting;
		}

		return $this->messages[$id];
	}

	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
	public function getItem()
	{
		if (!isset($this->item))
		{
			$id = $this->getState('message.id');
			$this->_db->setQuery($this->_db->getQuery(true)
				->from('#__helloworld as h')
				->leftJoin('#__categories as c ON h.catid=c.id')
				->select('h.greeting, h.params, c.title as category')
				->where('h.id=' . (int) $id));
			if (!$this->item = $this->_db->loadObject())
			{
				$this->setError($this->_db->getError());
			}
			else
			{
				// Load the JSON string
				$params = new JRegistry;
				// loadJSON is @deprecated    12.1  Use loadString passing JSON as the format instead.
				//$params->loadString($this->item->params, 'JSON');
				$params->loadJSON($this->item->params);
				$this->item->params = $params;

				// Merge global params with item params
				$params = clone $this->getState('params');
				$params->merge($this->item->params);
				$this->item->params = $params;
			}
		}

		return $this->item;
	}
}

?>