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
		//alert(position.coords.latitude);
		//alert(position.coords.longitude);
	}
	
	navigator.geolocation.getCurrentPosition(setUserPos);';
}

?>