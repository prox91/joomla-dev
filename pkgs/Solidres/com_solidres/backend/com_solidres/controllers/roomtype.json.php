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

/**
 * RoomType JSON controller class.
 *
 * @package     Solidres
 * @subpackage	RoomType
 * @since		0.1.0
 */
class SolidresControllerRoomType extends JControllerForm
{
	/**
	 * Method override to check if you can add a new record.
	 *
	 * @param	array $data An array of input data.
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowAdd($data = array())
	{
		$allow		= null;

		if ($allow === null)
        {
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd($data);
		}
        else
        {
			return $allow;
		}
	}

	/**
	 * Method to check if you can add a new record.
	 *
	 * @param	array $data An array of input data.
	 * @param	string $key The name of the key for the primary key.
	 * @return	boolean
	 * @since	1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		return parent::allowEdit($data, $key);
	}

	/**
	 * Check a room to determine whether it can be deleted or not
	 *
	 * @return boolean
	 */
	public function checkRoomReservation()
	{
		$roomId = JFactory::getApplication()->input->get('id', 0, 'int');
		$result = SRFactory::get('solidres.roomtype.roomtype')->canDeleteRoom($roomId);

		echo json_encode($result);
		die(1);
	}

    /**
     * Find Room that belong to a RoomType
     *
     * @return void
     */
    public function findRoom()
    {
        $roomTypeId = JFactory::getApplication()->input->get('id', 0, 'int');
        $result = SRFactory::get('solidres.roomtype.roomtype')->getListRooms($roomTypeId);
        $i = 0;
        $json = array();

        if (!empty($result))
        {
            foreach($result as $rs)
            {
                $json[$i]['id'] = $rs->id;
                $json[$i]['name'] = $rs->label;
                $i ++;
            }
        }
        
        echo json_encode($json);
        die(1);
    }

	public function removeRoomPermanently()
	{
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_solidres/tables', 'SolidresTable');
		$roomId = JFactory::getApplication()->input->get('id', 0, 'int');
		$table =  JTable::getInstance('Room', 'SolidresTable', $config = array());
		$result = false;

		if ($roomId > 0)
		{
			$result = $table->delete($roomId);
		}

		echo json_encode($result);
		die(1);
	}
}