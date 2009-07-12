<?php
/*
Plugin Name: Google Routeplaner
Plugin URI: http://deformed-design.de/scripte/wordpress-plugins/google-routeplaner/
Description: Generates a routeplaner based on Google Maps. 
Version: 0.6
Author: Thomas Heger
Author URI: http://deformed-design.de
Min WP Version: 2.7
*/

if( !isset( $_SESSION ) ) {
	session_start();
}

/* Load language */
load_plugin_textdomain('google_routeplaner', WP_PLUGIN_DIR . '/google-routeplaner/', dirname(plugin_basename(__FILE__)));


// Install the needed database table
function google_routeplaner_install() {
	global $wpdb, $table_prefix;
	$tables = $wpdb->get_col('SHOW TABLES');
	if (!in_array($table_prefix . 'google_routeplaner', $tables)) {
	
		$charset_collate = '';
		if ( version_compare(mysql_get_server_info(), '4.1.0', '>=') ) {
			if (!empty($wpdb->charset)) {
				$charset_collate .= sprintf(' DEFAULT CHARACTER SET %s', $wpdb->charset);
			}
			if (!empty($wpdb->collate)) {
				$charset_collate .= ' COLLATE $wpdb->collate';
			}
		}
		$sql_routeplaner = 'CREATE TABLE `' . $table_prefix . 'google_routeplaner` (
					 `planer_id` INT NOT NULL AUTO_INCREMENT,
					 `start_location` VARCHAR(120) NOT NULL,
					 `planer_width` INT NOT NULL,
					 `planer_height` INT NOT NULL,
					 `planer_type` VARCHAR(120) NOT NULL,
					 `planer_zoom_control` VARCHAR(120) NOT NULL,
					 `planer_type_control` VARCHAR(120) NOT NULL,
					 `planer_overview` VARCHAR(3) NOT NULL,
					 `planer_css` TEXT,
					 PRIMARY KEY (`planer_id`)
					 )%s';
		$wpdb->query(sprintf($sql_routeplaner, $charset_collate));
	}
}

// Install
if ( function_exists('register_activation_hook') )
    register_activation_hook(__FILE__, 'google_routeplaner_install');

	
function google_routeplaner_uninstall() {
	global $wpdb, $table_prefix;

	delete_option('google_routeplaner_api_key');
	delete_option('google_routeplaner_language');
	$wpdb->query(sprintf('DROP TABLE `' . $table_prefix . 'google_routeplaner`'));
	
	// Deactivate the Plugin
	if('full_uninstall_google_routeplaner' == $_POST['action']) {
		$current = get_option('active_plugins');
		if(in_array("google-routeplaner/google-routeplaner.php", $current))
			array_splice($current, array_search("google-routeplaner/google-routeplaner.php", $current), 1);
		update_option('active_plugins', $current);
		update_option('recently_activated', array("google-routeplaner/google-routeplaner.php" => time()) + (array)get_option('recently_activated'));
		if(function_exists($wp_redirect)) {
			wp_redirect('index.php');
		} else {
			header("Location: index.php");
			exit;
		}	
	}
}

// Uninstall
if ( function_exists('register_uninstall_hook') )
    register_uninstall_hook(__FILE__, 'google_routeplaner_uninstall');


// Check if API key is entered
function hook_admin_notices() {        
	if ($_POST['google_routeplaner_api_key']) {
		
	} else {
        
	if ('' == get_option("google_routeplaner_api_key")) {
		echo '<div id="error" class="error"><p>' .
		__('Google Routeplaner isn\'t ready yet. Please enter your Google Maps API Key on the <a href="admin.php?page=google_routeplaner_settings">settings screen</a>.')
		. '</p></div>';
				
		return;
		}
	}
}

// Check if API key is entered
add_action('admin_notices', 'hook_admin_notices');


if('full_uninstall_google_routeplaner' == $_POST['action']) {
	google_routeplaner_uninstall();
}

function google_routeplaner_output($data) {
	if(!preg_match("/\[googlerouteplaner=([0-9]*)\]/", $data, $matches)) {
		return $data;
	} else {
		$map = google_routeplaner_build_map($matches[1]);
		return str_replace("[googlerouteplaner=" . $matches[1] . "]", $map, $data);
	}
}

function google_routeplaner_build_map($route_id) {
	global $wpdb, $table_prefix;

	$planer = $wpdb->get_row("SELECT * FROM " . $table_prefix . "google_routeplaner WHERE planer_id='" . $route_id . "' LIMIT 1", ARRAY_A);
	

	$map = '
	<script src="http://maps.google.com/?file=api&amp;v=2.x&amp;key=' . get_option("google_routeplaner_api_key") . '"
      type="text/javascript"></script>
	<script type="text/javascript">
    //<![CDATA[

    var map;
    var gdir;
    var geocoder = null;
    var addressMarker;

    function initialize() {
      if (GBrowserIsCompatible()) {      
        map = new GMap2(document.getElementById("map_canvas"));

        gdir = new GDirections(map, document.getElementById("map_directions"));
        GEvent.addListener(gdir, "load", onGDirectionsLoad);
        GEvent.addListener(gdir, "error", handleErrors);' . "\n";

		if('none' !== $planer['planer_zoom_control']) {
			$map .= 'map.addControl(new ' . $planer['planer_zoom_control'] . '());' . "\n";
		}
		if('none' !== $planer['planer_type_control']) {
			$map .= 'map.addControl(new ' . $planer['planer_type_control'] . '());' . "\n";
		}
		if('no' !== $planer['planer_overview']) {
			$map .= 'map.addControl(new GOverviewMapControl());' . "\n";
		}
		
        $map .= 'setDirections("' . $planer['start_location'] . '", "' . $planer['start_location'] . '", "en_US");
				
		map.setMapType(' . $planer['planer_type'] . ');
      }
    }
    
    function setDirections(fromAddress, toAddress, locale) {
		gdir.load("from: " + fromAddress + " to: " + toAddress,
        { "locale": "' . get_option("google_routeplaner_language") . '" });
    }

    function handleErrors(){
		if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
			alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.\nError code: " + gdir.getStatus().code);
		else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
			alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);
		else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
			alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);
		else if (gdir.getStatus().code == G_GEO_BAD_KEY)
			alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
		else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
			alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
		else alert("An unknown error occurred.");
	}

	function onGDirectionsLoad(){ 
		// Use this function to access information about the latest load()
		// results.

		// e.g.
		// document.getElementById("getStatus").innerHTML = gdir.getStatus().code;
		// and yada yada yada...
	}
	function getLoc ()
	{
		alert(map.getCenter());
		alert(map.getZoom());
	}
    //]]>
    </script>
	<style type="text/css" media="all">
	' . $planer['planer_css'] . '	
	</style>
	
	<form action="#" onsubmit="setDirections(this.from.value, \'' . $planer['start_location'] . '\', \'' . get_option("google_routeplaner_language") . '\'); return false">
	 <div id="map_controls"><label for="fromAddress">' . __('Your location', 'google_routeplaner') . '</label> <input type="text" size="25" id="fromAddress" name="from" value=""/><input name="submit" type="submit" value="' . __('Create route', 'google_routeplaner') . '" /></div>
	 <div id="map_canvas" style="overflow: hidden; width: ' . $planer['planer_width'] . 'px; height: ' . $planer['planer_height'] . 'px;"></div>
	 <div id="map_directions"></div>
	</form>

	<script type="text/javascript">
	if (document.all && window.attachEvent) { 
		window.attachEvent("onload", initialize);
		window.attachEvent("onunload", GUnload);
	// Non-IE load and unload            
	} else if (window.addEventListener) { 
		window.addEventListener("load", initialize, false);
		window.addEventListener("unload", GUnload, false);
	}
	</script>';
	
	if('link' == get_option("google_routeplaner_donate")) {
		$map .= '<div style="clear: both; margin-top: 10px;">Google Routeplaner Plugin by <a href="http://deformed-design.de">Deformed Design</a></div>';
	}

	return $map;
}



if( function_exists('add_filter') ) {
	add_filter('the_content', 'google_routeplaner_output'); 
}

require_once(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner-pages.php');


?>