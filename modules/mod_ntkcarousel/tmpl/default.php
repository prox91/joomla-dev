<?php
/**
 * @package     RedTwitter.Frontend
 * @subpackage  mod_redtwitter
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="custom<?php echo $moduleclass_sfx ?>">
	<div class="ntkcarousel-content">
		<script type="text/javascript">
			jNtkCarousel = jQuery.noConflict();
			var sliderwidth="215px"
			//Specify the slider's height
			var sliderheight="100px"
			//Specify the slider's slide speed (larger is faster 1-10)
			var slidespeed=3
			//configure background color:
			slidebgcolor=""

			//Specify the slider's images
			var leftrightslide=new Array()
			var leftrightslide1= new Array()

			<?php
			if(isset($imageList) && count($imageList) > 0)
			{
				foreach($imageList as $key => $image)
				{
			?>
			leftrightslide1[<?php echo $key; ?>] = '<?php echo $image->image; ?>';
			leftrightslide[<?php echo $key; ?>]='&nbsp;&nbsp;&nbsp;<a href="client.html"><img src="<?php echo $image->image; ?>"/></a>'
			<?php
				}
			}
			?>
			////NO NEED TO EDIT BELOW THIS LINE////////////
			var copyspeed=slidespeed

			leftrightslide=leftrightslide.join(" <br>")
			var iedom=document.all||document.getElementById

			if (iedom)
				document.write('<span  id="temp" style="visibility:hidden;position:absolute;left:-10px;top:-4900px;" >'+leftrightslide+'</span>')

			var actualheight=''
			var cross_slide, ns_slide

			function fillup(){
				if (iedom){
					cross_slide=document.getElementById? document.getElementById("test2") : document.all.test2
					cross_slide2=document.getElementById? document.getElementById("test3") : document.all.test3
					cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
					actualheight=document.all? cross_slide.offsetHeight: document.getElementById("temp").offsetHeight
					cross_slide2.style.top=actualheight+5+"px"
				}
				else if (document.layers){
					ns_slide=document.ns_slidemenu.document.ns_slidemenu2
					ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
					ns_slide.document.write(leftrightslide)
					ns_slide.document.close()
					actualheight=ns_slide.document.height
					ns_slide2.top=actualheight+20
					ns_slide2.document.write(leftrightslide)
					ns_slide2.document.close()
				}
				lefttime=setInterval("slideup()",30)
			}

			window.onload=fillup

			function slideup(){
				if (iedom){
					if (parseInt(cross_slide.style.top)>(actualheight*(-1)+50))
						cross_slide.style.top=parseInt(cross_slide.style.top)-copyspeed+"px"
					else
						cross_slide.style.top=parseInt(cross_slide2.style.top)+actualheight+5+"px"

					if (parseInt(cross_slide2.style.top)>(actualheight*(-1)+50))
						cross_slide2.style.top=parseInt(cross_slide2.style.top)-copyspeed+"px"
					else
						cross_slide2.style.top=parseInt(cross_slide.style.top)+actualheight+5+"px"
				}
				else if (document.layers){
					if (ns_slide.top>(actualheight*(-1)+50))
						ns_slide.top-=copyspeed
					else
						ns_slide.top=ns_slide2.top+actualheight+30

					if (ns_slide2.top>(actualheight*(-1)+50))
						ns_slide2.top-=copyspeed
					else
						ns_slide2.top=ns_slide.top+actualheight+30
				}
			}

			if (iedom||document.layers){
				with (document){
					var h = jNtkCarousel('#main-content').height();
					h+='px';
					//alert(h);
					document.write('<table border="0" height="'+h+'" cellspacing="0" cellpadding="0"><tr><td>')
					if (iedom){
						write('<div class="Slide" style="position:relative;width:'+sliderwidth+';height:'+h+';overflow:hidden">')
						write('<div style="position:absolute;width:'+sliderwidth+';height:'+h+';background-color:'+slidebgcolor+'" onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed">')
						write('<div id="test2" style="position:absolute;left:0px;top:0px"></div>')
						write('<div id="test3" style="position:absolute;top:0px;left:0px"></div>')
						write('</div></div>')
					}
					else if (document.layers){
						write('<ilayer width='+sliderwidth+' height='+h+' name="ns_slidemenu" bgColor='+slidebgcolor+'>')
						write('<layer name="ns_slidemenu2" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
						write('<layer name="ns_slidemenu3" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
						write('</ilayer>')
					}
					document.write('</td></tr></table>')
				}
			}

			jNtkCarousel( document ).ready(function() {
				var h = jNtkCarousel('#main-content').height();
				h+='px';
				jNtkCarousel('.Slide').css('height',h)
			});
		</script>
	</div>
</div>
