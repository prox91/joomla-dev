<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted Access');


class EnglishConceptControllerMedia extends JControllerForm
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
		} else {
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
	 * Upload a file
	 *
	 * @return  void
	 *
	 * @since   1.5
	 */
	function upload()
	{
		$params = JComponentHelper::getParams('com_media');

		// Check for request forgeries
		if (!JSession::checkToken('request'))
		{
			$response = array(
				'status' => '0',
				'error' => JText::_('JINVALID_TOKEN')
			);
			echo json_encode($response);
			return;
		}

		// Get the user
		$user  = JFactory::getUser();
		JLog::addLogger(array('text_file' => 'upload.error.php'), JLog::ALL, array('upload'));

		// Get some data from the request
		$file   = $this->input->files->get('Filedata', '', 'array');
		$folder = $this->input->get('folder', '', 'path');

		if (
			$_SERVER['CONTENT_LENGTH']>($params->get('upload_maxsize', 0) * 1024 * 1024) ||
			$_SERVER['CONTENT_LENGTH']>(int)(ini_get('upload_max_filesize'))* 1024 * 1024 ||
			$_SERVER['CONTENT_LENGTH']>(int)(ini_get('post_max_size'))* 1024 * 1024 ||
			$_SERVER['CONTENT_LENGTH']>(int)(ini_get('memory_limit'))* 1024 * 1024
		)
		{
			$response = array(
				'status' => '0',
				'error' => JText::_('COM_MEDIA_ERROR_WARNFILETOOLARGE')
			);
			echo json_encode($response);
			return;
		}

		// Set FTP credentials, if given
		JClientHelper::setCredentialsFromRequest('ftp');

		// Make the filename safe
		$file['name'] = JFile::makeSafe($file['name']);

		if (isset($file['name']))
		{
			// The request is valid
			$err = null;

			$filepath = JPath::clean(COM_MEDIA_BASE . '/' . $folder . '/' . strtolower($file['name']));

			if (!MediaHelper::canUpload($file, $err))
			{
				JLog::add('Invalid: ' . $filepath . ': ' . $err, JLog::INFO, 'upload');

				$response = array(
					'status' => '0',
					'error' => JText::_($err)
				);

				echo json_encode($response);
				return;
			}

			// Trigger the onContentBeforeSave event.
			JPluginHelper::importPlugin('content');
			$dispatcher	= JEventDispatcher::getInstance();
			$object_file = new JObject($file);
			$object_file->filepath = $filepath;
			$result = $dispatcher->trigger('onContentBeforeSave', array('com_media.file', &$object_file));

			if (in_array(false, $result, true))
			{
				// There are some errors in the plugins
				JLog::add('Errors before save: ' . $object_file->filepath . ' : ' . implode(', ', $object_file->getErrors()), JLog::INFO, 'upload');

				$response = array(
					'status' => '0',
					'error' => JText::plural('COM_MEDIA_ERROR_BEFORE_SAVE', count($errors = $object_file->getErrors()), implode('<br />', $errors))
				);

				echo json_encode($response);
				return;
			}

			if (JFile::exists($object_file->filepath))
			{
				// File exists
				JLog::add('File exists: ' . $object_file->filepath . ' by user_id ' . $user->id, JLog::INFO, 'upload');

				$response = array(
					'status' => '0',
					'error' => JText::_('COM_MEDIA_ERROR_FILE_EXISTS')
				);

				echo json_encode($response);
				return;
			}
			elseif (!$user->authorise('core.create', 'com_media'))
			{
				// File does not exist and user is not authorised to create
				JLog::add('Create not permitted: ' . $object_file->filepath . ' by user_id ' . $user->id, JLog::INFO, 'upload');

				$response = array(
					'status' => '0',
					'error' => JText::_('COM_MEDIA_ERROR_CREATE_NOT_PERMITTED')
				);

				echo json_encode($response);
				return;
			}

			if (!JFile::upload($object_file->tmp_name, $object_file->filepath))
			{
				// Error in upload
				JLog::add('Error on upload: ' . $object_file->filepath, JLog::INFO, 'upload');

				$response = array(
					'status' => '0',
					'error' => JText::_('COM_MEDIA_ERROR_UNABLE_TO_UPLOAD_FILE')
				);

				echo json_encode($response);
				return;
			}
			else
			{
				// Trigger the onContentAfterSave event.
				$dispatcher->trigger('onContentAfterSave', array('com_media.file', &$object_file, true));
				JLog::add($folder, JLog::INFO, 'upload');

				$response = array(
					'status' => '1',
					'error' => JText::sprintf('COM_MEDIA_UPLOAD_COMPLETE', substr($object_file->filepath, strlen(COM_MEDIA_BASE)))
				);

				echo json_encode($response);
				return;
			}
		}
		else
		{
			$response = array(
				'status' => '0',
				'error' => JText::_('COM_MEDIA_ERROR_BAD_REQUEST')
			);

			echo json_encode($response);
			return;
		}
	}

	public function delete()
	{
		JSession::checkToken('request') or jexit(JText::_('JINVALID_TOKEN'));

		$mediaIds = $this->input->post->get('media', array(), 'array');
		$dbo = JFactory::getDbo();
		$query = $dbo->getQuery(true);
		$model = $this->getModel();

		$response = array();

		if (count($mediaIds))
		{
			foreach ($mediaIds as $mediaId)
			{
				$query->clear();
				$query->select('name')->from($dbo->quoteName('#__sr_media'))->where('id = '.$mediaId);
				$dbo->setQuery($query);
				$mediaName = $dbo->loadResult();

				if ($mediaName !== JFile::makeSafe($mediaName))
				{
					$filename = htmlspecialchars($mediaName, ENT_COMPAT, 'UTF-8');
					JError::raiseWarning(100, JText::sprintf('COM_MEDIA_ERROR_UNABLE_TO_DELETE_FILE_WARNFILENAME', $filename));
					continue;
				}

				$fullPath = SRPATH_MEDIA_IMAGE_SYSTEM.'/'.$mediaName;
				$thumbPath1 = SRPATH_MEDIA_IMAGE_SYSTEM.'/thumbnails/1/'.$mediaName;
				$thumbPath2 = SRPATH_MEDIA_IMAGE_SYSTEM.'/thumbnails/2/'.$mediaName;

				$removeList = array($fullPath, $thumbPath1, $thumbPath2);
				if (is_file($fullPath))
				{
					$result = $model->delete($mediaId);
					if ($result && JFile::delete($removeList))
					{
						$response[] = $mediaId;
					}
				}
			}
		}

		echo json_encode($response);

		die(1);
	}
}