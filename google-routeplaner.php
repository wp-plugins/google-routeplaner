<?php
/*
Plugin Name: Google Routeplanner
Plugin URI: http://support.derwebschmied.de
Description: Allows you to add one or more route planners based on Google Maps to help your users to find a specific place. 
Version: 3.1
Author: DerWebschmied
Author URI: http://support.derwebschmied.de
Min WP Version: 3.2
*/



/*
 * Load Language
 */
load_plugin_textdomain('google_routeplaner', WP_PLUGIN_DIR . '/google-routeplaner/', dirname(plugin_basename(__FILE__)) . '/languages/');

require_once(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner-lang-config.php');

$template_dir = get_template_directory();
if(file_exists($template_dir . '/google-routeplaner-translations.php')) {
	require_once($template_dir . '/google-routeplaner-translations.php');
} else {
	require_once(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner-translations.php');
}

/*
 * Install the needed database table
 */
 
function google_routeplaner_check_table() {
	global $wpdb;
	
	$tables = $wpdb->get_col('SHOW TABLES');

	if (in_array($wpdb->prefix . 'google_routeplaner', $tables)) {
		return true;
	} else {
		return false;
	}
}

function google_routeplaner_install() {
	global $wpdb;

	$isNetwork = ($_SERVER['SCRIPT_NAME'] == '/wp-admin/network/plugins.php')?true:false;
	
	if (function_exists('is_multisite') && is_multisite()) {
		if ($isNetwork) {
			
			$old_blog = $wpdb->blogid;
			$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM " . $wpdb->blogs));
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				google_routeplaner_install_create();
			}
			switch_to_blog($old_blog);
			return;
		}	
	}
	google_routeplaner_install_create();
}
 
function google_routeplaner_install_create() {
	global $wpdb;
	
	if(!google_routeplaner_check_table()) {
		$charset_collate = '';
		if ( version_compare(mysql_get_server_info(), '4.1.0', '>=') ) {
			if (!empty($wpdb->charset)) {
				$charset_collate .= sprintf(' DEFAULT CHARACTER SET %s', $wpdb->charset);
			}
			if (!empty($wpdb->collate)) {
				$charset_collate .= ' COLLATE ' . $wpdb->collate;
			}
		}

		$sql_routeplaner = 'CREATE TABLE `' . $wpdb->prefix . 'google_routeplaner` (
					 `planer_id` INT NOT NULL AUTO_INCREMENT,
					 `start_location` VARCHAR(120) NOT NULL,
					 `planer_width` INT NOT NULL,
					 `planer_width_unit` VARCHAR( 5 ) DEFAULT \'px\',
					 `planer_height` INT NOT NULL,
					 `planer_height_unit` VARCHAR( 5 ) DEFAULT \'px\',
					 `planer_zoom` INT NOT NULL,
					 `planer_type` VARCHAR(120) NOT NULL,
					 `planer_zoom_control` VARCHAR(120) NOT NULL,
					 `planer_type_control` VARCHAR(120) NOT NULL,
					 `planer_autofill` INT NOT NULL DEFAULT  \'0\',
					 `planer_language` VARCHAR( 5 ),
					 PRIMARY KEY (`planer_id`)
					 )%s';
		$wpdb->query(sprintf($sql_routeplaner, $charset_collate));
		
	} else {
		google_routeplaner_update();	
	}
}

function google_routeplaner_update($force_update = false) {
	global $wpdb;

	$gr_version = get_option("google_routeplaner_version");
	if('' == $gr_version) {
		$gr_version = 0;
	}
	
	if(floatval($gr_version) < 2.5 || $force_update) {
		/* 
		 * Update old information in the database for version 2
		 */
		$wpdb->query('ALTER TABLE  `' . $wpdb->prefix . 'google_routeplaner` ADD  `planer_zoom` INT NOT NULL DEFAULT  \'8\' AFTER  `planer_height`');
			
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
		
		/* 
		 * Update old information in the database for version 2.5
		 */
		$wpdb->query('ALTER TABLE  `' . $wpdb->prefix . 'google_routeplaner` ADD  `planer_width_unit` VARCHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  \'px\' AFTER  `planer_width`');
		$wpdb->query('ALTER TABLE  `' . $wpdb->prefix . 'google_routeplaner` ADD  `planer_height_unit` VARCHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  \'px\' AFTER  `planer_height`');
		$wpdb->query('ALTER TABLE  `' . $wpdb->prefix . 'google_routeplaner` ADD  `planer_autofill` INT NOT NULL DEFAULT  \'0\' AFTER  `planer_type_control`');
	}
	
	if(floatval($gr_version) < 3.0 || $force_update) {
		/* 
		 * Update old information in the database for version 3.0
		 */
		$old_donate_option = get_option("google_routeplaner_donate");
		if('personal_link' == $old_donate_option || 'commercial_link' == $old_donate_option) {
			update_option("google_routeplaner_donate", 'show_link');
		} elseif('personal_no_link' == $old_donate_option || 'personal_paypal' == $old_donate_option || 'commercial_paypal' == $old_donate_option) {
			update_option("google_routeplaner_donate", 'no_link');
		}
		
		update_option("google_routeplaner_version", '3.0');
	}
	
	if(floatval($gr_version) < 3.1 || $force_update) {
		/* 
		 * Update old information in the database for version 3.1
		 */
		$wpdb->query('ALTER TABLE  `' . $wpdb->prefix . 'google_routeplaner` CHANGE `planer_language`  `planer_language` VARCHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL');
	
		update_option("google_routeplaner_version", '3.1');
	}
	
}

if ( function_exists('register_update_hook') )
	register_update_hook(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner.php', 'google_routeplaner_update');

/*
 * Install plugin
 */
if ( function_exists('register_activation_hook') )
    register_activation_hook(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner.php', 'google_routeplaner_install');

/*
 * Uninstall plugin
 */	
function google_routeplaner_uninstall() {
	global $wpdb;
	
	if (function_exists('is_multisite') && is_multisite()) {
		$old_blog = $wpdb->blogid;
		// Get all blog ids
		$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
		foreach ($blogids as $blog_id) {
			switch_to_blog($blog_id);
			google_routeplaner_uninstall_delete();
		}
		switch_to_blog($old_blog);
		return;	
	} 
	google_routeplaner_uninstall_delete();	
}

function google_routeplaner_uninstall_delete() {
	global $wpdb;
	
	delete_option('google_routeplaner_api_key');
	delete_option('google_routeplaner_donate');
	delete_option('google_routeplaner_language');
	
	$wpdb->query(sprintf('DROP TABLE `' . $wpdb->prefix . 'google_routeplaner`'));
}

if ( function_exists('register_uninstall_hook') )
    register_uninstall_hook(__FILE__, 'google_routeplaner_uninstall');


/*
 * Add new Multisite Blog
 */	
add_action( 'wpmu_new_blog', 'google_routeplaner_new_blog', 10, 6); 		
 
function google_routeplaner_new_blog($blog_id, $user_id, $domain, $path, $site_id, $meta ) {
	global $wpdb;
 
	if (is_plugin_active_for_network('google-routeplaner/google-routeplaner.php')) {
		$old_blog = $wpdb->blogid;
		switch_to_blog($blog_id);
		google_routeplaner_install_create();
		switch_to_blog($old_blog);
	}
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
	global $wpdb, $google_routeplaner_trans;

	$planer = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "google_routeplaner WHERE planer_id='" . $route_id . "' LIMIT 1", ARRAY_A);
	$check_updated = $wpdb->get_results('SHOW COLUMNS FROM `' . $wpdb->prefix . 'google_routeplaner`');

	$map = '
	<!-- Start Google Routeplanner Plugin Output -->' . "\n";
	
	if(1 < strlen($planer['planer_language'])) {
		$map .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=' . $planer['planer_language'] . '"></script>' . "\n";
		
		if(isset($google_routeplaner_trans[$planer['planer_language']])) {
			$label = $google_routeplaner_trans[$planer['planer_language']]['label'];
			$button = $google_routeplaner_trans[$planer['planer_language']]['button'];
		} else {
			$label = $google_routeplaner_trans['en']['label'];
			$button = $google_routeplaner_trans['en']['button'];
		}
		
	} else {
		$map .= '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=' . get_option("google_routeplaner_language") . '"></script>' . "\n";
		$gr_config_lang = get_option("google_routeplaner_language");
		if(isset($google_routeplaner_trans[$gr_config_lang])) {
			$label = $google_routeplaner_trans[$gr_config_lang]['label'];
			$button = $google_routeplaner_trans[$gr_config_lang]['button'];
		} else {
			$label = $google_routeplaner_trans['en']['label'];
			$button = $google_routeplaner_trans['en']['button'];
		}
	
	}

	$map .= '<script type="text/javascript" src="' . WP_PLUGIN_URL . '/google-routeplaner/google-routeplaner-main-js.php?planer_id=' . $planer['planer_id'] . '&amp;planer_type=' . urlencode($planer['planer_type']) . '&amp;planer_zoom_control=' . urlencode($planer['planer_zoom_control']) . '&amp;planer_type_control=' . urlencode($planer['planer_type_control']) . '&amp;start_location=' . urlencode($planer['start_location']) . '&amp;planer_zoom=' . $planer['planer_zoom'] . '"></script>' . "\n";
	
	$map .= 
	'<form action="#" onsubmit="calcRoute' . $planer['planer_id'] . '(); return false">
	 <div id="map_controls' . $planer['planer_id'] . '" class="google_map_controls"><label for="fromAddress' . $planer['planer_id'] . '">' . $label . '</label> <input type="text" size="25" id="fromAddress' . $planer['planer_id'] . '" name="from" value=""/><input name="calc" type="submit" value="' . $button . '" /></div>
	 <div id="map_canvas' . $planer['planer_id'] . '" class="google_map_canvas" style="overflow: hidden; width: ' . $planer['planer_width'] . $planer['planer_width_unit'] . '; height: ' . $planer['planer_height'] . $planer['planer_height_unit'] . ';"></div>
	 <div id="map_directions' . $planer['planer_id'] . '" class="google_map_directions"></div>
	</form>' . "\n";
	
	$map .= '<script type="text/javascript" src="' . WP_PLUGIN_URL . '/google-routeplaner/google-routeplaner-js.php?planer_id=' . $planer['planer_id'] . '&autofill=' . $planer['planer_autofill'] . '"></script>';
	
	if('show_link' == get_option("google_routeplaner_donate")) {
		$map .= '<div style="clear: both; margin-top: 10px;">Powered by <a href="http://wordpress.org/extend/plugins/google-routeplaner/">Google Routeplanner</a>, 
		brought to you by <a href="http://derwebschmied.de">DerWebschmied</a></div>' . "\n";
	}
	$map .= '<!-- End Google Routeplanner Plugin Output --><p>' . "\n";

	return $map;
}


/*
 * Content Filter
 */	
if( function_exists('add_filter') ) {
	add_filter('the_content', 'google_routeplaner_output'); 
}


function google_routeplaner_admin_head() {
	if('yes' == get_option("google_routeplaner_viewport")) {
		echo '<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />';
	}	
	echo '
	<style type="text/css" media="screen">
	@import url("' . WP_PLUGIN_URL . '/google-routeplaner/google-routeplaner.css");
	</style>';
}
add_action('admin_head', 'google_routeplaner_admin_head');

function google_routeplaner_head() {
	if('yes' == get_option("google_routeplaner_viewport")) {
		echo '<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />';
	}
}
add_action('wp_head', 'google_routeplaner_head');

/*
 * Include pages
 */	
require_once(WP_PLUGIN_DIR . '/google-routeplaner/google-routeplaner-pages.php');


?>