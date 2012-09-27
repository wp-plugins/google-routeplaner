<?php

echo '
var geocoder' . $_GET['planer_id'] . ';
var directionDisplay' . $_GET['planer_id'] . ';
var directionsService = new google.maps.DirectionsService();
var map' . $_GET['planer_id'] . ';

function initialize' . $_GET['planer_id'] . '() {
	directionsDisplay' . $_GET['planer_id'] . ' = new google.maps.DirectionsRenderer();
	geocoder' . $_GET['planer_id'] . ' = new google.maps.Geocoder();
	var startplace' . $_GET['planer_id'] . ' = new google.maps.LatLng(52.52340510, 13.41139990);
	var myOptions' . $_GET['planer_id'] . ' = {' . "\n";
		
		if($_GET['planer_zoom'] && '' !== $_GET['planer_zoom']) {
			echo 'zoom:' . $_GET['planer_zoom'] . ',' . "\n";
		} else {
			echo 'zoom:8,';
		}
		echo 'disableDefaultUI: true,' . "\n";
		if($_GET['planer_type'] && '' !== $_GET['planer_type']) {
			echo 'mapTypeId: google.maps.MapTypeId.' . urldecode($_GET['planer_type']) . ',' . "\n";
		} else {
			echo 'mapTypeId: google.maps.MapTypeId.ROADMAP,' . "\n";
		}
		
		/*
		 * Zoom control options
		 */
		if('NONE' == urldecode($_GET['planer_zoom_control'])) {
			echo 'navigationControl: false,' . "\n";
		} else {
			echo 'navigationControl: true,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.' . urldecode($_GET['planer_zoom_control']) . '},' . "\n";
		}
			
		/*
		 * Mapstyle control options
		 */	
		if('NONE' == urldecode($_GET['planer_type_control'])) {
			echo 'mapTypeControl: false,' . "\n";
		} else {
			echo 'mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.' . urldecode($_GET['planer_type_control']) . '},' . "\n";
		}

		echo 'center: startplace' . $_GET['planer_id'] . '
	}
	map' . $_GET['planer_id'] . ' = new google.maps.Map(document.getElementById("map_canvas' . $_GET['planer_id'] . '"), myOptions' . $_GET['planer_id'] . ');
	directionsDisplay' . $_GET['planer_id'] . '.setMap(map' . $_GET['planer_id'] . ');
	directionsDisplay' . $_GET['planer_id'] . '.setPanel(document.getElementById("map_directions' . $_GET['planer_id'] . '"));

	google.maps.NavigationControlStyle.SMALL;
	codeAddress' . $_GET['planer_id'] . '(\'' . urldecode($_GET['start_location']) . '\');
	
}

function codeAddress' . $_GET['planer_id'] . '(address) {
	if (geocoder' . $_GET['planer_id'] . ') {
		geocoder' . $_GET['planer_id'] . '.geocode( { \'address\': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map' . $_GET['planer_id'] . '.setCenter(results[0].geometry.location);
				
				var infowindow = new google.maps.InfoWindow({
					content: "' . urldecode($_GET['start_location']) . '"
				});
				
				var marker = new google.maps.Marker({
					position: results[0].geometry.location,
					title:"' . urldecode($_GET['start_location']) . '"
				});
						  
				marker.setMap(map' . $_GET['planer_id'] . '); 
				
				google.maps.event.addListener(marker, \'click\', function() {
					infowindow.open(map' . $_GET['planer_id'] . ',marker);
				});

			} else {
				alert("' . 'Could not find the start location. Please be more specific!' . '");
			}
		});
	}
}
	
function calcRoute' . $_GET['planer_id'] . '() {
	var start = document.getElementById("fromAddress' . $_GET['planer_id'] . '").value;
	var end = \'' . $_GET['start_location'] . '\';
	var request = {
		origin:start, 
		destination:end,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
	directionsService.route(request, function(result, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay' . $_GET['planer_id'] . '.setDirections(result);
		}
	});
}';
	
?>