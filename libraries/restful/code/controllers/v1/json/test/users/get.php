<?php
/**
 * @package     WebService.Controller
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * The class for User GET requests
 *
 * @package     WebService.Controller
 * @subpackage  Controller
 *
 * @since       1.0
 */
class WebServiceControllersV1JsonTestUsersGet extends WebServiceControllersV1JsonBaseGet
{
    /**
     * Do the mapping with of tags with applications
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function doMap()
    {
        // Get user id
        $userId = $this->input->get->getString('user_id');

        // Check if application was passed to input
        if (isset($userId))
        {
            // Check if application exists in database
            if ($this->itemExists($userId, 'application'))
            {
                // Get content state
                $modelState = $this->model->getState();

                // Set content type that we need
                $modelState->set('users.id', $userId);
            }
            else
            {
                $this->app->errors->addError('204', array('application_id', $userId));
            }
        }
    }
}
