<?php
/*
Plugin Name: Google Routeplaner
Plugin URI: http://deformed-design.de
Description: Generates a routeplaner based on Google Maps. 
Version: 1.0
Author: Thomas Probach
Author URI: http://deformed-design.de
Min WP Version: 3.0
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
					 `planer_css` TEXT,
					 PRIMARY KEY (`planer_id`)
					 )%s';
		$wpdb->query(sprintf($sql_routeplaner, $charset_collate));
	} else {
		/*
		 * Delete and Update old stuff
		 */
		delete_option('google_routeplaner_api_key');

		
		$wpdb->query('ALTER TABLE `' . $table_prefix . 'google_routeplaner` DROP `planer_overview`');
		
		/* 
		 * Update old information in the database!
		 */
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_type = 'ROADMAP' WHERE planer_type = 'G_NORMAL_MAP'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_type = 'SATELLITE' WHERE planer_type = 'G_SATELLITE_MAP'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_type = 'HYBRID' WHERE planer_type = 'G_HYBRID_MAP'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_type = 'TERRAIN' WHERE planer_type = 'G_PHYSICAL_MAP'");
		
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_zoom_control = 'DEFAULT' WHERE planer_zoom_control = 'GLargeMapControl'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_zoom_control = 'SMALL' WHERE planer_zoom_control = 'GSmallMapControl'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_zoom_control = 'ZOOM_PAN' WHERE planer_zoom_control = 'GSmallZoomControl'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_zoom_control = 'NONE' WHERE planer_zoom_control = 'none'");
		
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_type_control = 'HORIZONTAL_BAR' WHERE planer_type_control = 'GMapTypeControl'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_type_control = 'DROPDOWN_MENU' WHERE planer_type_control = 'GHierarchicalMapTypeControl'");
		$wpdb->query("UPDATE `" . $table_prefix . "google_routeplaner` SET planer_type_control = 'NONE' WHERE planer_type_control = 'none'");
	}
}

/*
 * Install plugin
 */
if ( function_exists('register_activation_hook') )
    register_activation_hook(__FILE__, 'google_routeplaner_install');

/*
 * Uninstall plugin
 */	
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

if('full_uninstall_google_routeplaner' == $_POST['action']) {
	google_routeplaner_uninstall();
}

/*
 * Search for plugin code and replace
 */	

function google_routeplaner_output($data) {
	if(!preg_match("/\[googlerouteplaner=([0-9]*)\]/", $data, $matches)) {
		return $data;
	} else {
		$map = google_routeplaner_build_map($matches[1]);
		return str_replace("[googlerouteplaner=" . $matches[1] . "]", $map, $data);
	}
}

/*
 * Output map
 */	
function google_routeplaner_build_map($route_id) {
	global $wpdb, $table_prefix;

	$planer = $wpdb->get_row("SELECT * FROM " . $table_prefix . "google_routeplaner WHERE planer_id='" . $route_id . "' LIMIT 1", ARRAY_A);
	$check_updated = $wpdb->get_results('SHOW COLUMNS FROM `' . $table_prefix . 'google_routeplaner`');

	$map = '
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=' . get_option("google_routeplaner_language") . '"></script>

	<script type="text/javascript">
    var geocoder;
	var directionDisplay;
	var directionsService = new google.maps.DirectionsService();
	var map;

	function initialize() {
		directionsDisplay = new google.maps.DirectionsRenderer();
		geocoder = new google.maps.Geocoder();
		var startplace = new google.maps.LatLng(52.52340510, 13.41139990);
		var myOptions = {
			zoom:8,
			disableDefaultUI: true,

			mapTypeId: google.maps.MapTypeId.' . $planer['planer_type'] . ',' . "\n";
			
			/*
			 * Zoom control options
			 */
			if('NONE' == $planer['planer_zoom_control']) {
				$map .= 'navigationControl: false,' . "\n";
			} else {
				$map .= 'navigationControl: true,
				navigationControlOptions: {style: google.maps.NavigationControlStyle.' . $planer['planer_zoom_control'] . '},' . "\n";
			}
			
			if('NONE' == $planer['planer_type_control']) {
				$map .= 'mapTypeControl: false,' . "\n";
			} else {
				$map .= 'mapTypeControl: true,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.' . $planer['planer_type_control'] . '},' . "\n";
			}

			$map .= 'center: startplace
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById("map_directions"));

		google.maps.NavigationControlStyle.SMALL;
		codeAddress(\'' . $planer['start_location'] . '\');
	}

	function codeAddress(address) {
		if (geocoder) {
			geocoder.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
				} else {
					alert("' . __('Could not find the start location. Please be more specific!') . '");
				}
			});
		}
	}
	
	function calcRoute() {
		
		var start = document.getElementById("fromAddress").value;
		var end = \'' . $planer['start_location'] . '\';
		var request = {
			origin:start, 
			destination:end,
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		directionsService.route(request, function(result, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(result);
			}
		});
	}

    </script>
	<style type="text/css" media="all">
	' . $planer['planer_css'] . '	
	</style>
	<form action="#" onsubmit="calcRoute(); return false">
	 <div id="map_controls"><label for="fromAddress">' . __('Your location', 'google_routeplaner') . '</label> <input type="text" size="25" id="fromAddress" name="from" value=""/><input name="calc" type="submit" value="' . __('Create route', 'google_routeplaner') . '" /></div>
	 <div id="map_canvas" style="overflow: hidden; width: ' . $planer['planer_width'] . 'px; height: ' . $planer['planer_height'] . 'px;"></div>
	 <div id="map_directions"></div>
	</form>
	<script type="text/javascript">
	if (document.all && window.attachEvent) { 
		window.attachEvent("onload", initialize);
	// Non-IE load and unload            
	} else if (window.addEventListener) { 
		window.addEventListener("load", initialize, false);
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