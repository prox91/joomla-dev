<?php
/**
 * @copyright Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license GNU/GPL, see license.txt or http://www.gnu.org/copyleft/gpl.html
 * Developed by email@recomponent.com - redCOMPONENT.com
 *
 * redSHOP can be downloaded from www.redcomponent.com
 * redSHOP is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.
 *
 * You should have received a copy of the GNU General Public License
 * along with redSHOP; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
defined ('_JEXEC') or die ('restricted access');
JHTML::_('behavior.tooltip');
JHTMLBehavior::modal();

require_once( JPATH_COMPONENT.DS.'helpers'.DS.'product.php' );

require_once( JPATH_THEMES.DS.JFactory::getApplication()->getTemplate().DS.'lib'.DS.'lib.php' );

$producthelper = new producthelper();
$redTemplate = new Redtemplate();
$extraField = new extraField();
$config = new Redconfiguration();
$url= JURI::base();
$print = JRequest::getVar('print');
$option = JRequest::getVar('option');
$Itemid = JRequest::getVar('Itemid');
$redhelper   = new redhelper();
//$document =& JFactory::getDocument();

/*$a = new data();

$b = $a->getAllCategoryRedshop(0);

print_r($b);*/


//get category
$manufacturers_model = JModelLegacy::getInstance('Manufacturers', 'ManufacturersModel');
$category_model = JModelLegacy::getInstance('Category', 'CategoryModel');
$category_model->setId($this->params->get('cid'));

$categories = $category_model->getData();

$detail = array();
if($categories > 0)
{
	foreach($categories as $category)
	{
		$category_model->setId($category->category_id);
		$detail[$category->category_id]['category_detail'] = $category;
		
		$products = $category_model->getCategoryProduct();
		
		//get manufacturer_id
		foreach($products as $product)
		{
			$manufacturers_model->setId($product->manufacturer_id);
			$d = $manufacturers_model->getData();
			$detail[$category->category_id]['manufacturers'][$product->manufacturer_id] = $d[0];
		}
		
		$data_obj = new data();
		$data_obj->getAllCategoryManufacturersRedshop($category->category_id, $category->category_id, $detail);
		
	}
}


// Page Title Start
$pagetitle = JText::_('COM_REDSHOP_MANUFACTURER');
if($this->pageheadingtag!='')
{
	$pagetitle = $this->pageheadingtag;
}?>
<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
<?php
if ($this->params->get('show_page_heading',1))
{
	if($this->params->get('page_title') != $pagetitle)
	{
		echo $this->escape($this->params->get('page_title'));
	} else {
		echo $pagetitle;
	}
}?>
</h1>
<?php
// Page title end
$manufacturers_template = $redTemplate->getTemplate("manufacturer");

if(count($manufacturers_template)>0 && $manufacturers_template[0]->template_desc!="")
{
	$template_desc = $manufacturers_template[0]->template_desc;
} else {
	$template_desc = "<div class=\"category_print\">{print}</div>\r\n<div style=\"clear: both;\"></div>\r\n<div id=\"category_header\">\r\n<div class=\"category_order_by\">{order_by} </div>\r\n</div>\r\n<div class=\"manufacturer_box_wrapper\">{manufacturer_loop_start}\r\n<div class=\"manufacturer_box_outside\">\r\n<div class=\"manufacturer_box_inside\">\r\n<div class=\"manufacturer_image\">{manufacturer_image}</div>\r\n<div class=\"manufacturer_title\">\r\n<h3>{manufacturer_name}</h3>\r\n</div>\r\n<div class=\"manufacturer_desc\">{manufacturer_description}</div>\r\n<div class=\"manufacturer_link\"><a href=\"{manufacturer_link}\">{manufacturer_link_lbl}</a></div>\r\n<div class=\"manufacturer_product_link\"><a href=\"{manufacturer_allproductslink}\">{manufacturer_allproductslink_lbl}</a></div>\r\n</div>\r\n</div>\r\n{manufacturer_loop_end}<div class=\"category_product_bottom\" style=\"clear: both;\"></div></div>";
}
// Replace Product Template
if ($print)
{
	$onclick = "onclick='window.print();'";
} else {
	$print_url = $url."index.php?option=com_redshop&view=manufacturers&print=1&tmpl=component&Itemid=".$Itemid;
	$onclick = "onclick='window.open(\"$print_url\",\"mywindow\",\"scrollbars=1\",\"location=1\")'";
}
$print_tag = "<a ".$onclick." title='".JText::_('COM_REDSHOP_PRINT_LBL')."'>";
$print_tag .= "<img src='".JSYSTEM_IMAGES_PATH."printButton.png' alt='".JText::_('COM_REDSHOP_PRINT_LBL')."' title='".JText::_('COM_REDSHOP_PRINT_LBL')."' />";
$print_tag .= "</a>";


if(strstr($template_desc,"{category_loop_start}") && strstr($template_desc,"{category_loop_end}"))
{
	$template_d1 = explode ( "{category_loop_start}", $template_desc );
	$template_d2 = explode ( "{category_loop_end}", $template_d1 [1] );
	$subcat_template = $template_d2 [0];

	$cat_detail = "";
	foreach($detail as $row)
	{
		$category = $row['category_detail'];
		$manufacturers = $row['manufacturers'];
		$data_add = $subcat_template;
		
		$cItemid = $redhelper->getCategoryItemid($category->category_id);
		if ($cItemid != "") {
			$tmpItemid = $cItemid;
		} else {
			$tmpItemid = $Itemid;
		}
		
		$link = JRoute::_ ( 'index.php?option='.$option.'&view=category&cid='.$category->category_id.'&layout=detail&Itemid='.$tmpItemid );
		$title = " title='".$category->category_name."' ";
		
		if(strstr($data_add, '{category_name}'))
		{
			$cat_name = '<a href="'.$link.'" '.$title.'>'.$category->category_name.'</a>';
			$data_add = str_replace ( "{category_name}", $cat_name, $data_add );
		}
		
		if(strstr($data_add, '{manufacturer_loop_start}') && strstr($data_add, '{manufacturer_loop_end}'))
		{
			$data_add_d1 = explode ( "{manufacturer_loop_start}", $data_add );
			$data_add_d2 = explode ( "{manufacturer_loop_end}", $data_add_d1[1]);
			$template_middle = $data_add_d2[0];
			
			$replace_middledata = "";
			if(count($manufacturers) > 0)
			{
				foreach($manufacturers as $manufacturer)
				{
					$middledata = $template_middle;
					
					$mimg_tag = '{manufacturer_image}';
					$mh_thumb = MANUFACTURER_THUMB_HEIGHT;
					$mw_thumb = MANUFACTURER_THUMB_WIDTH;
					
					$link 	= JRoute::_( 'index.php?option='.$option.'&view=manufacturers&layout=detail&mid='.$manufacturer->manufacturer_id.'&Itemid='.$Itemid);
					
					$manproducts = JRoute::_( 'index.php?option='.$option.'&view=manufacturers&layout=products&mid='.$manufacturer->manufacturer_id.'&Itemid='.$Itemid);
					$manufacturer_name = "<a href='".$manproducts."'><b>".$manufacturer->manufacturer_name."</b></a>";
					
					$manu_name = $config->maxchar ( $manufacturer_name, MANUFACTURER_TITLE_MAX_CHARS, MANUFACTURER_TITLE_END_SUFFIX );
					$middledata = str_replace("{manufacturer_name}",$manu_name, $middledata);
					
					// Extra field display
					$middledata = $producthelper->getExtraSectionTag($extraFieldName,$manufacturer->manufacturer_id,"10",$middledata);
					
					if(strstr($middledata,$mimg_tag))
					{
						$thum_image = "";
						$media_image = $producthelper->getAdditionMediaImage($manufacturer->manufacturer_id,"manufacturer");
						for($m=0; $m<count($media_image); $m++)
						{
							if ($media_image[$m]->media_name && file_exists(REDSHOP_FRONT_IMAGES_RELPATH."manufacturer/".$media_image[$m]->media_name))
							{
								$altText = $producthelper->getAltText('manufacturer', $manufacturer->manufacturer_id );
								if (! $altText)
								{
									$altText = $media_image[$m]->media_name;
								}
								
								if(WATERMARK_MANUFACTURER_IMAGE || WATERMARK_MANUFACTURER_THUMB_IMAGE)
								{
									$manufacturer_img = $redhelper->watermark('manufacturer',$media_image[$m]->media_name,$mw_thumb,$mh_thumb,WATERMARK_MANUFACTURER_IMAGE);
								}
								else
								{
									$manufacturer_img=$url."/components/".$option."/helpers/thumb.php?filename=manufacturer/".$media_image[$m]->media_name."&newxsize=".$mw_thumb."&newysize=".$mh_thumb."&swap=".USE_IMAGE_SIZE_SWAPPING;
								}
					
								if (PRODUCT_IS_LIGHTBOX == 1)
								{
									$thum_image ="<a title='".$altText."' class=\"modal\" href='".REDSHOP_FRONT_IMAGES_ABSPATH."manufacturer/".$media_image[$m]->media_name."' rel=\"{handler: 'image', size: {}}\"><img alt='".$altText."' title='".$altText."' src='".$manufacturer_img."'></a>";
								} 
								else 
								{
									$thum_image ="<a title='".$altText."' href='".$manproducts."'><img alt='".$altText."' title='".$altText."' src='".$manufacturer_img."'></a>";
								}
							}
						}
						$middledata = str_replace ( $mimg_tag, $thum_image, $middledata );
					}
					
					$middledata=str_replace("{manufacturer_description}",$row->manufacturer_desc,$middledata);
					$middledata=str_replace("{manufacturer_link}",$link,$middledata);
					$middledata=str_replace("{manufacturer_allproductslink}",$manproducts,$middledata);
					$middledata=str_replace("{manufacturer_allproductslink_lbl}",JText::_('COM_REDSHOP_MANUFACTURER_ALLPRODUCTSLINK_LBL'),$middledata);
					$middledata=str_replace("{manufacturer_link_lbl}",JText::_('COM_REDSHOP_MANUFACTURER_LINK_LBL'),$middledata);
					
					$replace_middledata .= $middledata;
				}
			
			}
			$data_add = str_replace ( "{manufacturer_loop_start}", "", $data_add );
			$data_add = str_replace ( "{manufacturer_loop_end}", "", $data_add );
			$data_add = str_replace ( $template_middle, $replace_middledata, $data_add );
		}
		
		$cat_detail .= $data_add;
		
		
	}

	$template_desc = str_replace ( "{category_loop_start}", "", $template_desc );
	$template_desc = str_replace ( "{category_loop_end}", "", $template_desc );
	$template_desc = str_replace ( $subcat_template, $cat_detail, $template_desc );
}


$template_desc = str_replace ( "{print}", $print_tag, $template_desc );

if(strstr($template_desc, '{order_by}'))
{
	$orderby_form = "<form name='orderby_form' action='' method='post'>".JText::_('COM_REDSHOP_SELECT_ORDER_BY' ).$this->lists['order_select']."</form>";
	$template_desc = str_replace("{order_by}",$orderby_form,$template_desc);
}
if(strstr($template_desc, '{pagination}'))
{
	if($print)
	{
		$template_desc = str_replace("{pagination}","",$template_desc);
	}
	else
	{
		$template_desc = str_replace("{pagination}",$this->pagination->getPagesLinks(),$template_desc);
	}
}

$template_desc = $redTemplate->parseredSHOPplugin($template_desc);
echo eval("?>".$template_desc."<?php ");
?>