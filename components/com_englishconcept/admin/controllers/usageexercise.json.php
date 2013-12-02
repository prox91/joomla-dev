<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptControllerUsageExercise extends JControllerForm
{
    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    public function delete()
    {
        // Check for request forgeries
        //JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));

        // Get items to remove from the request.
        $id = JFactory::getApplication()->input->get('id', array(), 'array');

        if (!is_array($id) || count($id) < 1)
        {
            $msg = JText::_($this->text_prefix . '_NO_ITEM_SELECTED');
            $deleteFlg = false;
        }
        else
        {
            // Get the model.
            $model = $this->getModel();

            // Make sure the item ids are integers
            jimport('joomla.utilities.arrayhelper');
            JArrayHelper::toInteger($id);

            $db = JFactory::getDbo();

            $db->transactionStart();
            // Remove the items.
            if ($model->delete($id))
            {
                // Delete question of exercise
                $query = $db->getQuery(true);

                if(is_array($id) && count($id))
                {
                    foreach($id as $v)
                    {
                        $query->delete("#__ec_lessons_usages_exercises_questions");
                        $query->where("exercise_id={$v}");

                        $db->setQuery($query);
                        $result = $db->execute();

                        if($result)
                        {
                            $msg = JText::plural($this->text_prefix . '_N_ITEMS_DELETED', count($id));
                            $deleteFlg = true;
                        }
                        else
                        {
                            $msg = $model->getError();
                            $deleteFlg = false;
                            break;
                        }
                    }
                }
                else
                {
                    $deleteFlg = false;
                }

            }
            else
            {
                $msg = $model->getError();
                $deleteFlg = false;
            }

            if($deleteFlg)
            {
                $db->transactionCommit();
            }
            else
            {
                $db->transactionRollback();
            }
        }

        echo json_encode(
            array(
                'status' => $deleteFlg,
                'msg' => $msg
            )
        );
        die(1);
    }
}
