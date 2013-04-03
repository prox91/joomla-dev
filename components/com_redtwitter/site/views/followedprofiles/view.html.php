<?php
defined('_JEXEC') or die ('restricted access');

jimport('joomla.application.component.view');

class redtwitterViewfollowedprofiles extends JView
{ 
      
   	function display ($tpl=null)
   	{
   		$document =& JFactory::getDocument();
   		$document->addStyleSheet(JURI::root()."administrator/components/com_redtwitter/assets/css/redtwitter_frontend.css");
   		
   	    global $option,$mainframe;
   	    $app = &JFactory::getApplication();
	    $params = $app->getParams();
		$uri =& JFactory::getURI();
		$user =& JFactory::getUser();
		//echo $user->id;exit;
		
		$model		=& $this->getModel('followedprofiles');

		$lists = array();
		$lists	=& $this->get('data');

		$slink ="index.php?option=com_redtwitter&view=redtwitter";
		$this->assignRef('slink', $slink);
		$this->assignRef('lists', $lists);
	
		$this->assignRef('request_url',	$uri->toString());
		
		$model		=& $this->getModel('followedprofiles');
		$red_detail = array();
		$red_detail = $model->getDetail();

		
		$this->assignRef('red_detail', $red_detail);
		//print_r($params);exit;
		$this->assignRef('params', $params);
		
		$this->setLayout('default');
		
		
	     parent::display($tpl);
   }
   
}
?> 

