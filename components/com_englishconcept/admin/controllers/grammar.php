<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptControllerGrammar extends JControllerForm
{
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

    public function trash()
    {
        $cidArr = JFactory::getApplication()->input->get('cid', '', 'ARRAY');
        $id = $cidArr[0];
        $date = JFactory::getDate();
        $user = JFactory::getUser();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->clear()
            ->update($db->quoteName('#__ec_lessons_grammars'))
            ->set($db->quoteName('deleted_flg') . ' = ' . $db->quote(1))
            ->set($db->quoteName('deleted') . ' = ' . $db->quote($date->toSql()))
            ->set($db->quoteName('deleted_by') . ' = ' . $db->quote($user->id))
            ->where($db->quoteName('id') . ' = ' . $db->quote($id));
        $db->setQuery($query);

        try
        {
            if($db->execute())
            {
                $this->setMessage('Trashed success');
                $this->setRedirect(JRoute::_(
                    'index.php?option=' . $this->option . '&view=' . $this->view_list
                    . $this->getRedirectToListAppend(), false
                ));
            }

        }
        catch (RuntimeException $e)
        {
            $this->setMessage($db->getMessage());
            $this->setRedirect(JRoute::_(
                'index.php?option=' . $this->option . '&view=' . $this->view_list
                . $this->getRedirectToListAppend(), false
            ));
        }
    }

    public function delete()
    {
        $cidArr = JFactory::getApplication()->input->get('cid', '', 'ARRAY');
        $id = $cidArr[0];

        $db = JFactory::getDbo();
        $db->transactionStart();

        $gramQuery = $db->getQuery(true);
        $gramQuery->clear()
            ->delete($db->quoteName('#__ec_lessons_grammars'))
            ->where($db->quoteName('id') . ' = ' . $db->quote($id));

        $gramExeListQuery = $db->getQuery(true);
        $gramExeListQuery->clear()
            ->select('id')
            ->from('#__ec_lessons_grammars_exercises')
            ->where($db->quoteName('grammar_id') . ' = ' . $db->quote($id));
        $db->setQuery($gramExeListQuery);
        $exerciseList = $db->loadObjectList();

        $exerciseIdList = array();
        if(is_array($exerciseList) && count($exerciseList))
        {
            foreach($exerciseList as $exercise)
            {
                $exerciseIdList[] = $exercise->id;
            }
        }

        $gramExeQuery = $db->getQuery(true);
        $gramExeQuery->clear()
            ->delete($db->quoteName('#__ec_lessons_grammars_exercises'))
            ->where($db->quoteName('grammar_id') . ' = ' . $db->quote($id));

        $success = true;
        try
        {
            $db->setQuery($gramQuery);
            if(!$db->execute())
            {
                $success = false;
            }

            $db->setQuery($gramExeQuery);
            if(!$db->execute())
            {
                $success = false;
            }

            if(!empty($exerciseIdList))
            {
                $gramExeQuesQuery = $db->getQuery(true);
                $gramExeQuesQuery->clear()
                    ->delete($db->quoteName('#__ec_lessons_grammars_exercises_questions'))
                    ->where($db->quoteName('exercise_id') . ' IN (' . implode(',', $exerciseIdList) .')');
                $db->setQuery($gramExeQuesQuery);
                if(!$db->execute())
                {
                    $success = false;
                }
            }

            if($success)
            {
                $db->transactionCommit();

                $this->setMessage('Trashed success');
                $this->setRedirect(JRoute::_(
                    'index.php?option=' . $this->option . '&view=' . $this->view_list
                    . $this->getRedirectToListAppend(), false
                ));
            }
            else
            {
                $db->transactionRollback();

                $this->setMessage($db->getMessage());
                $this->setRedirect(JRoute::_(
                    'index.php?option=' . $this->option . '&view=' . $this->view_list
                    . $this->getRedirectToListAppend(), false
                ));
            }

        }
        catch (RuntimeException $e)
        {
            $db->transactionRollback();

            $this->setMessage($db->getMessage());
            $this->setRedirect(JRoute::_(
                'index.php?option=' . $this->option . '&view=' . $this->view_list
                . $this->getRedirectToListAppend(), false
            ));
        }
    }

	public function searchAjax()
	{
		$app = JFactory::getApplication();
		$condition = trim($app->input->get('like', ''));

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id, lesson_id, keystruct_no')
			->from('#__ec_lessons_grammars');
		if(!empty($condition))
		{
			$query->where("keystruct_no LIKE '%" . $condition . "%'");
		}

		$db->setQuery($query);
		$result = $db->loadObjectList();

		if(!empty($result))
		{
			$data = array();
			foreach($result as $grammar)
			{
				$ks = array();
				$ks['value'] = $grammar->lesson_id;
				$ks['text'] = $grammar->keystruct_no;

				$data[] = $ks;
			}
		}
		else
		{
			$data = array();
		}

		echo json_encode($data);
		$app->close();
	}
}
