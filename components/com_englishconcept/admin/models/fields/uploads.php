<?php
defined('_JEXEC') or die;

class JFormFieldUploads extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Uploads';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Retrieve file details from uploaded file, sent from upload form
		$file = JFactory::getApplication()->input->get($this->name, null, 'files', 'array');

		// Import filesystem libraries. Perhaps not necessary, but does not hurt
		jimport('joomla.filesystem.file');

		// Clean up filename to get rid of strange characters like spaces etc
		$filename = JFile::makeSafe($file['name']);

		// Set up the source and destination of the file
		$src = $file['tmp_name'];
		$dest = JPATH_COMPONENT . '/' . $filename;

		// First check if the file has the right extension, we need jpg only
		if ( strtolower(JFile::getExt($filename) ) == 'mp3') {
			if ( JFile::upload($src, $dest) ) {
				// Redirect to a page of your choice
			} else {
				// Redirect and throw an error message
			}
		} else {
			// Redirect and notify user file is not right extension
		}

		return '<input type="file" name="' . $this->name . '" id="audio_upload_id" />';
	}
}
