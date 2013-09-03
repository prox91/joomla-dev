<?php
defined('_JEXEC') or die;

class EnglishConceptTableLesson extends JTable
{
	function __construct($_db)
	{
		parent::__construct('#__ec_lessons', 'id', $_db);
	}

	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure
	 * they are safe to store in the database.  Child classes should override this
	 * method to make sure the data they are storing in the database is safe and
	 * as expected before storage.
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 *
	 * @link    http://docs.joomla.org/JTable/check
	 * @since   11.1
	 */
	public function check()
	{
		$file = JFactory::getApplication()->input->files->get('jform', '', 'array');
		$file = $file['audio_upload'];
        if(empty($file['error']))
        {
            // Make the filename safe
            $audioFile = JFile::makeSafe($file['name']);
            $fileExt = explode('.', $audioFile);
            if(isset($audioFile))
            {
                $filepath = JPath::clean(JPATH_SITE . '/media/englishconcept/audio/' . strtolower(md5($file['name'])) . '.' . $fileExt[1]);
                $objectFile = new JObject($file);
                $objectFile->filepath = $filepath;

                if (JFile::exists($objectFile->filepath))
                {
                    JFile::delete($objectFile->filepath);
                }

                if (!JFile::upload($objectFile->tmp_name, $objectFile->filepath))
                {
                    return false;
                }
            }
        }

        return true;
	}
}
