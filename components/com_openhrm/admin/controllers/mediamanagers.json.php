<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/22/13
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class OpenHrmControllerMediaManagers extends JControllerAdmin
{
	public function image()
	{
		$input = JFactory::getApplication()->input;
		$image = $input->get('image', '', 'STRING');

		if (isset($image))
		{
			return OpenHrmHelpersOpenhrm::resize(html_entity_decode($image, ENT_QUOTES, 'UTF-8'), 100, 100);
		}
	}

	public function directory()
	{
		$json = array();

		$input = JFactory::getApplication()->input;
		$directory = $input->post('directory', '', 'STRING');

		if (isset($directory))
		{
			$directories = glob(rtrim(DIR_IMAGE . str_replace('../', '', $directory), '/') . '/*', GLOB_ONLYDIR);

			if ($directories)
			{
				$i = 0;

				foreach ($directories as $directory)
				{
					$json[$i]['data'] = basename($directory);
					$json[$i]['attributes']['directory'] = utf8_substr($directory, strlen(DIR_IMAGE));

					$children = glob(rtrim($directory, '/') . '/*', GLOB_ONLYDIR);

					if ($children)
					{
						$json[$i]['children'] = ' ';
					}

					$i++;
				}
			}
		}

		return json_encode($json);
	}

	public function files()
	{
		$json = array();

		$input = JFactory::getApplication()->input;
		$directory = $input->post('directory', '', 'STRING');

		if (isset($directory))
		{
			$directory = DIR_IMAGE . str_replace('../', '', $directory);
		}
		else
		{
			$directory = DIR_IMAGE;
		}

		$allowed = array(
			'.jpg',
			'.jpeg',
			'.png',
			'.gif'
		);

		$files = glob(rtrim($directory, '/') . '/*');

		if ($files)
		{
			foreach ($files as $file)
			{
				if (is_file($file))
				{
					$ext = strrchr($file, '.');
				}
				else
				{
					$ext = '';
				}

				if (in_array(strtolower($ext), $allowed))
				{
					$size = filesize($file);

					$i = 0;

					$suffix = array(
						'B',
						'KB',
						'MB',
						'GB',
						'TB',
						'PB',
						'EB',
						'ZB',
						'YB'
					);

					while (($size / 1024) > 1)
					{
						$size = $size / 1024;
						$i++;
					}

                    $fileData = utf8_substr($file, strlen(DIR_IMAGE) + 1);
                    $filename = basename($file);
                    $size = round(utf8_substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i];
                    $thumb = OpenHrmHelpersOpenhrm::resize($file, 100, 100);

                    $json[] = array(
                        'file'     => $fileData,
                        'filename' => $filename,
                        'size'     => $size,
                        'thumb'    => $thumb
                    );
				}
			}
		}

		return json_encode($json);
	}

	public function create()
	{
		$json = array();

		$input = JFactory::getApplication()->input;
		$directory = $input->post('directory', '', 'STRING');
		$name = $input->post('name', '', 'STRING');

		if (isset($directory))
		{
			if (isset($name) || $name)
			{
				$directory = rtrim(DIR_IMAGE . str_replace('../', '', $directory), '/');

				if (!is_dir($directory))
				{
					$json['error'] = JText::_('error_directory');
				}

				if (file_exists($directory . '/' . str_replace('../', '', $name)))
				{
					$json['error'] = JText::_('error_exists');
				}
			}
			else
			{
				$json['error'] = JText::_('error_name');
			}
		}
		else
		{
			$json['error'] = JText::_('error_directory');
		}

		//if (!$this->user->hasPermission('modify', 'common/filemanager'))
		//{
		//	$json['error'] = JText::_('error_permission');
		//}

		if (!isset($json['error']))
		{
			mkdir($directory . '/' . str_replace('../', '', $name), 0777);

			$json['success'] = JText::_('text_create');
		}

		return json_encode($json);
	}

	public function delete()
	{
		$json = array();
		$input = JFactory::getApplication()->input;
		$path = $input->post('path', '', 'STRING');

		if (isset($path))
		{
			$path = rtrim(DIR_IMAGE . str_replace('../', '', html_entity_decode($path, ENT_QUOTES, 'UTF-8')), '/');

			if (!file_exists($path))
			{
				$json['error'] = JText::_('error_select');
			}

			if ($path == rtrim(DIR_IMAGE, '/'))
			{
				$json['error'] = JText::_('error_delete');
			}
		}
		else
		{
			$json['error'] = JText::_('error_select');
		}

		//if (!$this->user->hasPermission('modify', 'common/filemanager')) {
		//	$json['error'] = JText::_('error_permission');
		//}

		if (!isset($json['error']))
		{
			if (is_file($path))
			{
				unlink($path);
			}
			elseif (is_dir($path))
			{
				$this->recursiveDelete($path);
			}

			$json['success'] = JText::_('text_delete');
		}

		return json_encode($json);
	}

	protected function recursiveDelete($directory)
	{
		if (is_dir($directory))
		{
			$handle = opendir($directory);
		}

		if (!$handle)
		{
			return false;
		}

		while (false !== ($file = readdir($handle)))
		{
			if ($file != '.' && $file != '..')
			{
				if (!is_dir($directory . '/' . $file))
				{
					unlink($directory . '/' . $file);
				}
				else
				{
					$this->recursiveDelete($directory . '/' . $file);
				}
			}
		}

		closedir($handle);

		rmdir($directory);

		return true;
	}

	public function move()
	{
		$json = array();
		$input = JFactory::getApplication()->input;
		$from = $input->post('from', '', 'STRING');
		$to = $input->post('to', '', 'STRING');

		if (isset($from) && isset($to))
		{
			$from = rtrim(DIR_IMAGE . str_replace('../', '', html_entity_decode($from, ENT_QUOTES, 'UTF-8')), '/');

			if (!file_exists($from))
			{
				$json['error'] = JText::_('error_missing');
			}

			if ($from == DIR_IMAGE)
			{
				$json['error'] = JText::_('error_default');
			}

			$to = rtrim(DIR_IMAGE . str_replace('../', '', html_entity_decode($to, ENT_QUOTES, 'UTF-8')), '/');

			if (!file_exists($to))
			{
				$json['error'] = JText::_('error_move');
			}

			if (file_exists($to . '/' . basename($from)))
			{
				$json['error'] = JText::_('error_exists');
			}
		}
		else
		{
			$json['error'] = JText::_('error_directory');
		}

		//if (!$this->user->hasPermission('modify', 'common/filemanager'))
		//{
		//	$json['error'] = JText::_('error_permission');
		//}

		if (!isset($json['error']))
		{
			rename($from, $to . '/' . basename($from));
			$json['success'] = JText::_('text_move');
		}

		return json_encode($json);
	}

	public function copy()
	{
		$json = array();
		$input = JFactory::getApplication()->input;
		$path = $input->post('path', '', 'STRING');
		$name = $input->post('name', '', 'STRING');

		if (isset($path) && isset($name))
		{
			if ((utf8_strlen($name) < 3) || (utf8_strlen($name) > 255))
			{
				$json['error'] = JText::_('error_filename');
			}

			$old_name = rtrim(DIR_IMAGE . str_replace('../', '', html_entity_decode($path, ENT_QUOTES, 'UTF-8')), '/');

			if (!file_exists($old_name) || $old_name == DIR_IMAGE)
			{
				$json['error'] = JText::_('error_copy');
			}

			if (is_file($old_name))
			{
				$ext = strrchr($old_name, '.');
			}
			else
			{
				$ext = '';
			}

			$new_name = dirname($old_name) . '/' . str_replace('../', '', html_entity_decode($name, ENT_QUOTES, 'UTF-8') . $ext);

			if (file_exists($new_name))
			{
				$json['error'] = JText::_('error_exists');
			}
		}
		else
		{
			$json['error'] = JText::_('error_select');
		}

		///if (!$this->user->hasPermission('modify', 'common/filemanager'))
		//{
		//	$json['error'] = JText::_('error_permission');
		//}

		if (!isset($json['error']))
		{
			if (is_file($old_name))
			{
				copy($old_name, $new_name);
			}
			else
			{
				$this->recursiveCopy($old_name, $new_name);
			}

			$json['success'] = JText::_('text_copy');
		}

		return json_encode($json);
	}

	function recursiveCopy($source, $destination)
	{
		$directory = opendir($source);
		@mkdir($destination);

		while (false !== ($file = readdir($directory)))
		{
			if (($file != '.') && ($file != '..'))
			{
				if (is_dir($source . '/' . $file))
				{
					$this->recursiveCopy($source . '/' . $file, $destination . '/' . $file);
				}
				else
				{
					copy($source . '/' . $file, $destination . '/' . $file);
				}
			}
		}

		closedir($directory);
	}

	public function folders()
	{
		return $this->recursiveFolders(DIR_IMAGE);
	}

	protected function recursiveFolders($directory)
	{
		$output = '';

		$output .= '<option value="' . utf8_substr($directory, strlen(DIR_IMAGE)) . '">' . utf8_substr($directory, strlen(DIR_IMAGE)) . '</option>';

		$directories = glob(rtrim(str_replace('../', '', $directory), '/') . '/*', GLOB_ONLYDIR);

		foreach ($directories  as $directory)
		{
			$output .= $this->recursiveFolders($directory);
		}

		return $output;
	}

	public function rename()
	{
		$json = array();
		$input = JFactory::getApplication()->input;
		$path = $input->post('path', '', 'STRING');
		$name = $input->post('name', '', 'STRING');

		if (isset($path) && isset($name))
		{
			if ((utf8_strlen($name) < 3) || (utf8_strlen($name) > 255))
			{
				$json['error'] = JText::_('error_filename');
			}

			$old_name = rtrim(DIR_IMAGE . str_replace('../', '', html_entity_decode($path, ENT_QUOTES, 'UTF-8')), '/');

			if (!file_exists($old_name) || $old_name == DIR_IMAGE)
			{
				$json['error'] = JText::_('error_rename');
			}

			if (is_file($old_name))
			{
				$ext = strrchr($old_name, '.');
			}
			else
			{
				$ext = '';
			}

			$new_name = dirname($old_name) . '/' . str_replace('../', '', html_entity_decode($name, ENT_QUOTES, 'UTF-8') . $ext);

			if (file_exists($new_name))
			{
				$json['error'] = JText::_('error_exists');
			}
		}

		//if (!$this->user->hasPermission('modify', 'common/filemanager'))
		//{
		//	$json['error'] = JText::_('error_permission');
		//}

		if (!isset($json['error']))
		{
			rename($old_name, $new_name);

			$json['success'] = JText::_('text_rename');
		}

		return json_encode($json);
	}

	public function upload()
	{
		$json = array();
		$input = JFactory::getApplication()->input;
		$directory = $input->post('directory', '', 'STRING');
		$files = $input->files->get('Filedata', '', 'array');

		if (isset($directory))
		{
			if (isset($files['image']) && $files['image']['tmp_name'])
			{
				$filename = basename(html_entity_decode($files['image']['name'], ENT_QUOTES, 'UTF-8'));

				if ((strlen($filename) < 3) || (strlen($filename) > 255))
				{
					$json['error'] = JText::_('error_filename');
				}

				$directory = rtrim(DIR_IMAGE . str_replace('../', '', $directory), '/');

				if (!is_dir($directory))
				{
					$json['error'] = JText::_('error_directory');
				}

				if ($files['image']['size'] > 300000)
				{
					$json['error'] = JText::_('error_file_size');
				}

				$allowed = array(
					'image/jpeg',
					'image/pjpeg',
					'image/png',
					'image/x-png',
					'image/gif',
					'application/x-shockwave-flash'
				);

				if (!in_array($files['image']['type'], $allowed))
				{
					$json['error'] = JText::_('error_file_type');
				}

				$allowed = array(
					'.jpg',
					'.jpeg',
					'.gif',
					'.png',
					'.flv'
				);

				if (!in_array(strtolower(strrchr($filename, '.')), $allowed))
				{
					$json['error'] = JText::_('error_file_type');
				}

				if ($files['image']['error'] != UPLOAD_ERR_OK)
				{
					$json['error'] = 'error_upload_' . $files['image']['error'];
				}
			}
			else
			{
				$json['error'] = JText::_('error_file');
			}
		}
		else
		{
			$json['error'] = JText::_('error_directory');
		}

		//if (!$this->user->hasPermission('modify', 'common/filemanager'))
		//{
		//	$json['error'] = JText::_('error_permission');
		//}

		if (!isset($json['error']))
		{
			if (@move_uploaded_file($files['image']['tmp_name'], $directory . '/' . $filename))
			{
				$json['success'] = JText::_('text_uploaded');
			}
			else
			{
				$json['error'] = JText::_('error_uploaded');
			}
		}

		return json_encode($json);
	}
}
