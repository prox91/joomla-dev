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

$doc = JFactory::getDocument();

$doc->addScript('http://maps.google.com/maps/api/js?sensor=true');
$doc->addScriptDeclaration('
	var geocoder, map;
	function initialize() {
		var latlng = new google.maps.LatLng("'.$this->info->lat.'", "'.$this->info->lng.'");
		var options = {
			zoom: 15,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("inline_map"), options);

		var image = new google.maps.MarkerImage("'.SRURI_MEDIA.'/assets/images/icon-hotel-'.$this->info->rating.'.png",
            new google.maps.Size(32, 37),
            new google.maps.Point(0,0),
            new google.maps.Point(0, 32));

		var marker = new google.maps.Marker({
			map: map,
			position: latlng,
			icon: image,
		});

		var windowContent = "<h4>'.$this->info->name.'</h4>" +
			"'.$this->info->description.'" +
			"<ul>" +
				"<li>'.$this->info->address_1 . "  " . $this->info->city.'</li>" +
				"<li>'.$this->info->phone.'</li>" +
				"<li>'.$this->info->email.'</li>" +
				"<li>'.$this->info->website.'</li>" +
			"</ul>";

		var infowindow = new google.maps.InfoWindow({
			content: windowContent,
			maxWidth: 350
		});

		google.maps.event.addListener(marker, "click", function() {
			infowindow.open(map,marker);
		});
	}

	jQuery(document).ready(function () {
			initialize();
	});
');


?>
<div id="inline_map"></div>
