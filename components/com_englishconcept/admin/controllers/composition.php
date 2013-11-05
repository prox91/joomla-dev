<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');

class EnglishConceptControllerComposition extends JControllerForm
{
	function __construct($config = array())
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
            ->update($db->quoteName('#__ec_lesson_compositions'))
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
        $query = $db->getQuery(true);

        $query->clear()
            ->delete($db->quoteName('#__ec_lesson_compositions'))
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
}
