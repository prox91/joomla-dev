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

require_once JPATH_LIBRARIES.'/solidres/media/helper.php';
require_once JPATH_LIBRARIES.'/solidres/media/zebra/Zebra_Image.php';

/**
 * Media JSON controller class.
 *
 * @package     Solidres
 * @subpackage	Media
 * @since		0.1.0
 */
class SolidresControllerMedia extends JControllerForm
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
	 * Method to upload a file from client side, storing and making thumbnail for images
	 *
	 * TODO add token check for file uploading
	 *
	 * @return JSON
	 */
	public function upload()
	{
		// Check for request forgeries
		if (!JSession::checkToken('request'))
		{
			die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "'.JText::_('JINVALID_TOKEN').'"}, "id" : "id"}');
		}

		$user = JFactory::getUser();
		$srMedia = SRFactory::get('solidres.media.media');
		$date = JFactory::getDate();
		$model = $this->getModel('media');
		$err = NULL;
		$targetDir = SRPATH_MEDIA_IMAGE_SYSTEM;
		$targetThumbDir = SRPATH_MEDIA_IMAGE_SYSTEM.'/thumbnails';

		static $log;

		if ($log == null)
		{
			$options['format'] = '{DATE}\t{TIME}\t{LEVEL}\t{CODE}\t{MESSAGE}';
			$options['text_file'] = 'media.php';
			$log = JLog::addLogger($options);
		}

		JLog::add('Start uploading', JLog::DEBUG );

		if (!$user->authorise('core.create', 'com_solidres'))
		{
			JError::raiseWarning(403, JText::_('SR_ERROR_CREATE_NOT_PERMITTED'));
			return;
		}

		// HTTP headers for no cache etc
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		// 5 minutes execution time
		@set_time_limit(5 * 60);

		// Uncomment this one to fake upload time
		// usleep(5000);

		// Get parameters
		$chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
		$chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
		$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

		JLog::add('Original file name '. $fileName, JLog::DEBUG );

		// Clean the fileName for security reasons
		$_FILES['file']['name'] = JFile::makeSafe($_FILES['file']['name']);
		$fileName = $_FILES['file']['name'];

		JLog::add('Cleaned file name '. $_FILES['file']['name'], JLog::DEBUG );

		// Look for the content type header
		if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
			$contentType = $_SERVER["HTTP_CONTENT_TYPE"];

		if (isset($_SERVER["CONTENT_TYPE"]))
			$contentType = $_SERVER["CONTENT_TYPE"];

		// Check the target file against our rules to see if it is allow to be uploaded
		// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
		// Do not check the chunk since it is not valid
		if (strpos($contentType, "multipart") !== false && $chunks == 0)
		{
			if (!SRMediaHelper::canUpload($_FILES['file'], $err))
			{
				die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "'.JText::_($err).'"}, "id" : "id"}');
				//return;
			}
		}

		// Make sure the fileName is unique but only if chunking is disabled
		if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
			$ext = strrpos($fileName, '.');
			$fileName_a = substr($fileName, 0, $ext);
			$fileName_b = substr($fileName, $ext);

			$count = 1;
			while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
				$count++;

			$fileName = $fileName_a . '_' . $count . $fileName_b;
		}

		// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
		if (strpos($contentType, "multipart") !== false) {
			if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
				// Open temp file
				$out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
				if ($out) {
					// Read binary input stream and append it to temp file
					$in = fopen($_FILES['file']['tmp_name'], "rb");

					if ($in) {
						while ($buff = fread($in, 4096))
							fwrite($out, $buff);
					} else
						die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
					fclose($in);
					fclose($out);
					@unlink($_FILES['file']['tmp_name']);
				} else
					die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
		} else {
			// Open temp file
			$out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
			if ($out) {
				// Read binary input stream and append it to temp file
				$in = fopen("php://input", "rb");
				if ($in) {
					while ($buff = fread($in, 4096))
						fwrite($out, $buff);
				} else
					die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

				fclose($in);
				fclose($out);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		// ONLY PERFORM THESE LAST OPERATIONS WHEN THE FILE IS TOTALLY UPLOADED (NOT PARTLY UPLOADED)
		if ($chunks == 0 || ($chunk == $chunks - 1) )
		{
			$uploadedFilePath = $targetDir .'/'. $fileName;

			// Prepare some data for db storing
			$data = array(
				'type'  		=> 'IMAGE', // TODO: do we need to store this 'type'
				'value' 		=> $fileName,
				'name'  		=> $fileName,
				'created_date' 	=> $date->toSql(),
				'created_by'	=> $user->get('id'),
				'mime_type'		=> $srMedia->getMime($uploadedFilePath),
				'size'			=> filesize($uploadedFilePath)
			);

			// Attempt to save the data.
			if (!$model->save($data))
			{
				JLog::add('Can not save this file to db: '. $fileName, JLog::DEBUG );
				die('{"jsonrpc" : "2.0", "error" : {"code": 105, "message": "'.JText::_('SR_ERROR_CAN_NOT_SAVE_DB').'"}, "id" : "id"}');
			}

			// If media is image, create thumbnail for it
			if (SRMediaHelper::isImage($uploadedFilePath))
			{
				$media = new Zebra_Image();
				$media->source_path = $uploadedFilePath;
				$media->target_path = $targetThumbDir.'/1/'.$fileName;
				$media->resize(300, 250);
				$media->target_path = $targetThumbDir.'/2/'.$fileName;
				$media->resize(75, 75);
			}
		}

		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}') ;
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