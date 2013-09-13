<?php

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class redsocialstreamController extends JController
{
	function display()
	{
		//get a refrence of the page instance in joomla
		$document = JFactory::getDocument();
		//get the view name from the query string
		$viewName = JRequest::getVar('view', 'profiles');

		$viewType = $document->getType();
		//get our view
		$view =  $this->getView($viewName, $viewType);
		//get the model
		$model =  $this->getModel($viewName, 'ModelBlog');

		//some error chec
		if (!JError::isError($model))
		{
			$view->setModel($model, true);
		}
		//set the template and display it
		$view->setLayout('default');
		$view->display();
	}

	/**
	 * Custom Constructor
	 */
	function __construct($default = array())
	{
		parent::__construct($default);

	}


	function save()
	{
		$post = JRequest::get('post');
		$viewName = JRequest::getVar('view', 'profiles');
		$model =  $this->getModel($viewName, 'ModelBlog');

		if ($model->store($post))
		{
			$msg = JText::_('BLOG SAVED');

			//$model->checkin();

		}
		else
		{
			$msg = JText::_('ERROR SAVING BLOG');
		}

		$link = $_SERVER['HTTP_REFERER'];

		$this->setRedirect($link, $msg);
	}
}
