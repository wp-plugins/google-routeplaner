<?php

echo '
if (document.all && window.attachEvent) { 
	window.attachEvent("onload", initialize' . $_GET['planer_id'] . ');
// Non-IE load and unload            
} else if (window.addEventListener) { 
	window.addEventListener("load", initialize' . $_GET['planer_id'] . ', false);
}';
	
?>