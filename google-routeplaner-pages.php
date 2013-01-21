<?php

/* 
 * GENERATE PAGES
 */

/*
 * About Page
 */
function google_routeplaner_about_page() {
	global $wpdb;
	
	include 'google-routeplaner-main-page.php';
}

/* 
 * List of routes
 */
function google_routeplaner_routes_page() {
	switch($_GET['routeplaner_action']) {
		case 'google_routeplaner_add_route':
			google_routeplaner_add_route();
			break;
		case 'delete_route':
			google_routeplaner_delete_route($_GET['route_id']);
			break;
		case 'edit_route':
			google_routeplaner_edit_route($_GET['route_id']);
			break;
		case 'preview_route':
			google_routeplaner_preview_route($_GET['route_id']);
			break;
		default:
			google_routeplaner_list_routes();
			break;
	}
}

/*
 * Settings Page
 */
function google_routeplaner_option_page() {
	global $google_routeplaner_langs;
	include 'google-routeplaner-settings-page.php';
}


/*
 * List Routes
 */
function google_routeplaner_list_routes() {
	include 'google-routeplaner-list-routes.php';
}

/*
 * Delete Route
 */
function google_routeplaner_delete_route($route_id) {
	global $wpdb;
	
	$wpdb->query("DELETE FROM " . $wpdb->prefix . "google_routeplaner 
	WHERE planer_id='" . $route_id . "' LIMIT 1");
	
	?>
	<div class="wrap google_routeplaner">
    <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplanner', 'google_routeplaner'); ?> V<?php echo get_option("google_routeplaner_version"); ?> &bull; <?php _e('Delete Route', 'google_routeplaner'); ?></h2>
	<p class="success"><?php _e('The route has been deleted!', 'google_routeplaner'); ?></p>
	<p><a href="admin.php?page=google_routeplaner_routes" class="button"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
	</div>
	<?php
}

/*
 * Previw Route
 */
function google_routeplaner_preview_route($route_id) {
	?>
	<div class="wrap google_routeplaner">
	<div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplanner', 'google_routeplaner'); ?> &bull; <?php _e('Preview Route', 'google_routeplaner'); ?></h2>
	<p><a href="admin.php?page=google_routeplaner_routes" class="button"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
    <?php echo google_routeplaner_build_map($route_id); ?>
	</div>
	<?php
}


/*
 * Add Route Page
 */
function google_routeplaner_add_route() {
	include 'google-routeplaner-add-route.php';
}

/*
 * Edit Route Page
 */
function google_routeplaner_edit_route($route_id) {
	include 'google-routeplaner-edit-route.php';
}

/*
 * Documentation Page
 */
function google_routeplaner_doc_page() {
	include 'google-routeplaner-doc-page.php';
}

/*
 * Troubleshooting Page
 */
function google_routeplaner_trouble_page() {
	include 'google-routeplaner-trouble-page.php';
}

/*
 * Adds the option page for admin menu
 */
function google_routeplaner_add_menu() {
	global $submenu;
	add_option("google_routeplaner_donate","personal_link");	
	add_option("google_routeplaner_language","en");	
	add_option("google_routeplaner_version","1.0");	
	add_option("google_routeplaner_viewport","yes");	
	
	add_action( 'admin_menu' , 'admin_menu_new_items' );


	add_menu_page(__('Overview', 'google_routeplaner'), __('Routeplaner', 'google_routeplaner'), 8, 'google-routeplaner.php', 'google_routeplaner_about_page', WP_PLUGIN_URL . '/google-routeplaner/images/routeplanner_icon16.png');
	add_submenu_page('google-routeplaner.php', __('Routes', 'google_routeplaner'), __('Routes', 'google_routeplaner'), 8, 'google_routeplaner_routes', 'google_routeplaner_routes_page');
	add_submenu_page('google-routeplaner.php', __('Settings', 'google_routeplaner'), __('Settings', 'google_routeplaner'), 8, 'google_routeplaner_settings', 'google_routeplaner_option_page');
	add_submenu_page('google-routeplaner.php', __('Documentation', 'google_routeplaner'), __('Documentation', 'google_routeplaner'), 8, 'google_routeplaner_doc', 'google_routeplaner_doc_page');
	add_submenu_page('google-routeplaner.php', __('Troubleshooting', 'google_routeplaner'), __('Troubleshooting', 'google_routeplaner'), 8, 'google_routeplaner_trouble', 'google_routeplaner_trouble_page');
	$submenu['google-routeplaner.php'][500] = array( 'Support', 'read' , 'http://support.derwebschmied.de' );
}

add_action('admin_menu', 'google_routeplaner_add_menu');
?>