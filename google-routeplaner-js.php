<?php

echo '
if (document.all && window.attachEvent) { 
	window.attachEvent("onload", initialize' . $_GET['planer_id'] . ');
// Non-IE load and unload            
} else if (window.addEventListener) { 
	window.addEventListener("load", initialize' . $_GET['planer_id'] . ', false);
}';

if(1 == intval($_GET['autofill'])) {

	echo 'function setUserPos(position) {
		document.getElementById(\'fromAddress' . $_GET['planer_id'] . '\').value = position.coords.latitude + \', \' + position.coords.longitude;
	}
	
	navigator.geolocation.getCurrentPosition(setUserPos);';
}

if(2 == intval($_GET['autofill'])) {

	echo 'function setUserPos(position) {
		var getcity = new google.maps.Geocoder();
		
		var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		
		getcity.geocode({\'latLng\': latlng}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
			if (results[1]) {
			 document.getElementById(\'fromAddress' . $_GET['planer_id'] . '\').value = results[1].formatted_address;
			}
		  } else {
			alert("Geocoder failed due to: " + status);
		  }
		});
	
		
	}
	
	navigator.geolocation.getCurrentPosition(setUserPos);';
}

?>