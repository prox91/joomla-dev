<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptControllerGrammarExercise extends JControllerForm
{
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	public function saveexercise()
	{
		// Check for request forgeries
//        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
//
//        $user   = JFactory::getUser();
//        $ids    = $this->input->get('cid', array(), 'array');
//        $values = array('featured' => 1, 'unfeatured' => 0);
//        $task   = $this->getTask();
//        $value  = JArrayHelper::getValue($values, $task, 0, 'int');
//
//        // Get the model.
//        $model  = $this->getModel();
//
//        // Access checks.
//        foreach ($ids as $i => $id)
//        {
//            $item = $model->getItem($id);
//            if (!$user->authorise('core.edit.state', 'com_contact.category.'.(int) $item->catid))
//            {
//                // Prune items that you can't change.
//                unset($ids[$i]);
//                JError::raiseNotice(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
//            }
//        }
//
//        if (empty($ids))
//        {
//            JError::raiseWarning(500, JText::_('COM_CONTACT_NO_ITEM_SELECTED'));
//        }
//        else
//        {
//            // Publish the items.
//            if (!$model->featured($ids, $value))
//            {
//                JError::raiseWarning(500, $model->getError());
//            }
//        }
		$this->setMessage('Text', 'WARNING');
		//$this->setRedirect('index.php?option=com_englishconcept&view=grammar&layout=edit&id=2');
		$this->setRedirect('index.php?option=com_englishconcept&task=grammarexercise.edit&id=1&tmpl=component&view=grammarexercise&layout=modal');
	}
}
