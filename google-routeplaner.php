<?php
/*
Plugin Name: Google Routeplaner
Plugin URI: http://plugins.deformed-design.de
Description: Allows you to add one or more route planners based on Google Maps to help your users to find a specific place. 
Version: 2.2
Author: Deformed Design
Author URI: http://plugins.deformed-design.de
Min WP Version: 3.0
*/



/*
 * Load Language
 */
load_plugin_textdomain('google_routeplaner', WP_PLUGIN_DIR . '/google-routeplaner/', dirname(plugin_basename(__FILE__)));

/*
 * Install the needed database table
 */
 
function google_routeplaner_check_table() {
	global $wpdb, $table_prefix;
		
	$tables = $wpdb->get_col('SHOW TABLES');

	if (in_array($table_prefix . 'google_routeplaner', $tables)) {
		return true;
	} else {
		return false;
	}
}
 
function google_routeplaner_install() {
	global $wpdb, $table_prefix;	
	
	if(!google_routeplaner_check_table()) {
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
					 `planer_zoom` INT NOT NULL,
					 `planer_type` VARCHAR(120) NOT NULL,
					 `planer_zoom_control` VARCHAR(120) NOT NULL,
					 `planer_type_control` VARCHAR(120) NOT NULL,
					 `planer_language` VARCHAR( 2 ),
					 PRIMARY KEY (`planer_id`)
					 )%s';
		$wpdb->query(sprintf($sql_routeplaner, $charset_collate));
		
	} else {
		/* 
		 * Update old information in the database for version 2
		 */
		$wpdb->query('ALTER TABLE  `' . $table_prefix . 'google_routeplaner` ADD  `planer_zoom` INT NOT NULL DEFAULT  \'8\' AFTER  `planer_height`');
		
		/* 
		 * Update old information in the database for version 2.2
		 */
		$cur_donate = get_option('google_routeplaner_donate');
		if('link' == $cur_donate) {
			update_option("google_routeplaner_donate", 'personal_link');
		} elseif('articel' == $cur_donate) {
			update_option("google_routeplaner_donate", 'personal_no_link');
		} elseif('paypal' == $cur_donate) {
			update_option("google_routeplaner_donate", 'commercial_paypal');
		} elseif('none' == $cur_donate) {
			update_option("google_routeplaner_donate", 'personal_no_link');
		}
	
	
	}
}

function google_routeplaner_install_start() {
	google_routeplaner_install();
}

/*
 * Install plugin
 */
if ( function_exists('register_activation_hook') )
    register_activation_hook(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner.php', 'google_routeplaner_install_start');

/*
 * Uninstall plugin
 */	
function google_routeplaner_uninstall() {
	global $wpdb, $table_prefix;

	delete_option('google_routeplaner_api_key');
	delete_option('google_routeplaner_donate');
	delete_option('google_routeplaner_language');
	
	$wpdb->query(sprintf('DROP TABLE `' . $table_prefix . 'google_routeplaner`'));
	
	/*
	 * Deactivate the Plugin
	 */
	if('full_uninstall_google_routeplaner' == $_POST['action']) {
		$current = get_option('active_plugins');
		if(in_array("google-routeplaner/google-routeplaner.php", $current))
			array_splice($current, array_search("google-routeplaner/google-routeplaner.php", $current), 1);
		update_option('active_plugins', $current);
		update_option('recently_activated', array("google-routeplaner/google-routeplaner.php" => time()) + (array)get_option('recently_activated'));
		if(function_exists($wp_redirect)) {
			wp_redirect('plugins.php');
		} else {
			header("Location: plugins.php");
			exit;
		}	
	}
}

/*
 * Uninstall
 */	
if ( function_exists('register_uninstall_hook') )
    register_uninstall_hook(__FILE__, 'google_routeplaner_uninstall');

if('full_uninstall_google_routeplaner' == $_POST['action']) {
	google_routeplaner_uninstall();
}

/*
 * Search for plugin code and replace
 */	
function google_routeplaner_output($data) {
	if(!preg_match_all("/\[googlerouteplaner=([0-9]*)\]/", $data, $matches)) {
		return $data;
	} else {
		foreach($matches[1] as $match) {
			$map = google_routeplaner_build_map($match);
			$data = str_replace("[googlerouteplaner=" . $match . "]", $map, $data);
		}
		return $data;
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
	<!-- Start Google Routeplaner Plugin Output -->' . "\n";
	
	if(2 == strlen($planer['planer_language'])) {
		$map .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=' . $planer['planer_language'] . '"></script>' . "\n";
	} else {
		$map .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=' . get_option("google_routeplaner_language") . '"></script>' . "\n";
	}

	$map .= '<script type="text/javascript" src="' . WP_PLUGIN_URL . '/google-routeplaner/google-routeplaner-main-js.php?planer_id=' . $planer['planer_id'] . '&amp;planer_type=' . urlencode($planer['planer_type']) . '&amp;planer_zoom_control=' . urlencode($planer['planer_zoom_control']) . '&amp;planer_type_control=' . urlencode($planer['planer_type_control']) . '&amp;start_location=' . urlencode($planer['start_location']) . '&amp;planer_zoom=' . $planer['planer_zoom'] . '"></script>' . "\n";
	
	if('' !== $planer['planer_css'] && strlen($planer['planer_css']) > 55) {
		$map .= '<style type="text/css" media="all">
			' . $planer['planer_css'] . '	
		</style>' . "\n";
	}
	
	$map .= 
	'<form action="#" onsubmit="calcRoute' . $planer['planer_id'] . '(); return false">
	 <div id="map_controls' . $planer['planer_id'] . '" class="google_map_controls"><label for="fromAddress' . $planer['planer_id'] . '">' . __('Your location', 'google_routeplaner') . '</label> <input type="text" size="25" id="fromAddress' . $planer['planer_id'] . '" name="from" value=""/><input name="calc" type="submit" value="' . __('Create route', 'google_routeplaner') . '" /></div>
	 <div id="map_canvas' . $planer['planer_id'] . '" class="google_map_canvas" style="overflow: hidden; width: ' . $planer['planer_width'] . 'px; height: ' . $planer['planer_height'] . 'px;"></div>
	 <div id="map_directions' . $planer['planer_id'] . '" class="google_map_directions"></div>
	</form>' . "\n";
	
	$map .= '<script type="text/javascript" src="' . WP_PLUGIN_URL . '/google-routeplaner/google-routeplaner-js.php?planer_id=' . $planer['planer_id'] . '"></script>';
	
	if('personal_link' == get_option("google_routeplaner_donate") || 'commercial_link' == get_option("google_routeplaner_donate")) {
		$map .= '<div style="clear: both; margin-top: 10px;">Powered by <a href="http://wordpress.org/extend/plugins/google-routeplaner/">Google Routeplaner</a>, 
		brought to you by <a href="http://deformed-design.de">Deformed Design</a></div>' . "\n";
	}
	$map .= '<!-- End Google Routeplaner Plugin Output --><p>' . "\n";

	return $map;
}


/*
 * Content Filter
 */	
if( function_exists('add_filter') ) {
	add_filter('the_content', 'google_routeplaner_output'); 
}


function google_routeplaner_admin_head() {
	echo '<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css" media="screen">
	@import url("' . WP_PLUGIN_URL . '/google-routeplaner/google-routeplaner.css");
	</style>';
}
add_action('admin_head', 'google_routeplaner_admin_head');

function google_routeplaner_head() {
	echo '<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />';
}
add_action('wp_head', 'google_routeplaner_head');

/*
 * Include pages
 */	
require_once(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner-pages.php');


?>