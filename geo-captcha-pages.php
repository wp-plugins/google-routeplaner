<?php

// Save Settings
$geo_captcha_legal = get_option('geo_captcha_legal');
 
// Change Settings
if ('changesettings' == $_POST['action'])
{
    update_option("geo_captcha_legal", $_POST['geo_captcha_legal']);
	update_option("geo_captcha_log_ips", $_POST['geo_captcha_log_ips']);
	update_option("geo_captcha_comments", $_POST['geo_captcha_comments']);
	update_option("geo_captcha_registration", $_POST['geo_captcha_registration']);
}

// Clear Log
if ('clear_log' == $_POST['action'])
{
	$sql_stats = 'TRUNCATE `' . $table_prefix . 'geo_captcha_log`';
		$wpdb->query(sprintf($sql_stats));
}

// Uninstall
function geo_captcha_uninstall() {
	global $wpdb, $table_prefix;

	delete_option('geo_captcha_legal');
	delete_option('geo_captcha_blocked_spam');
	delete_option('geo_captcha_not_whitelisted_comments');
	delete_option('geo_captcha_not_whitelisted_comments');
	delete_option('geo_captcha_whitelisted_comments');
	delete_option('geo_captcha_registered_comments');
	delete_option('geo_captcha_log_ips');
	
	$wpdb->query(sprintf('DROP TABLE `' . $table_prefix . 'geo_captcha_stats`'));
	$wpdb->query(sprintf('DROP TABLE `' . $table_prefix . 'geo_captcha_log`'));

	deactivate_plugin();
	update_option('recently_activated', array("geo-captcha/geo-captcha.php" => time()) + (array)get_option('recently_activated'));
	if(function_exists($wp_redirect)) {
		wp_redirect('index.php');
	} else {
		header("Location: index.php");
		exit;
	}
}

// Activate Uninstall
if ('full_uninstall_geo_captcha' == $_POST['action'] && 'y' == $_POST['uninstall_shure'])
{
	geo_captcha_uninstall();
}

// Deactivate Plugin
function deactivate_plugin() {
    $current = get_option('active_plugins');
    if(in_array("geo-captcha/geo-captcha.php", $current))
		array_splice($current, array_search("geo-captcha/geo-captcha.php", $current), 1);
    update_option('active_plugins', $current);
}

// Include pages
require_once(WP_PLUGIN_DIR . '/geo-captcha/geo-captcha-page-settings.php');
require_once(WP_PLUGIN_DIR . '/geo-captcha/geo-captcha-page-about.php');
require_once(WP_PLUGIN_DIR . '/geo-captcha/geo-captcha-page-log.php');
require_once(WP_PLUGIN_DIR . '/geo-captcha/geo-captcha-page-stats.php');

 
// Adds the option page for admin menu
function geo_captcha_add_menu() {
	add_option("geo_captcha_legal","DE\nAT\nCH");
	add_option("geo_captcha_blocked_spam","0");
	add_option("geo_captcha_not_whitelisted_comments","0");
	add_option("geo_captcha_whitelisted_comments","0");
	add_option("geo_captcha_registered_comments","0");
	add_option("geo_captcha_log_ips","1");
	add_option("geo_captcha_comments","1");
	add_option("geo_captcha_registration","1");
	
	add_option("geo_captcha_manuell_spam","0");
	add_option("geo_captcha_whitelisted_spam","0");

	add_menu_page(__('About', 'geo-captcha'), 'Geo Captcha', 8, __FILE__, 'geo_captcha_about_page');
	add_submenu_page(__FILE__, __('Settings', 'geo-captcha'), __('Settings', 'geo-captcha'), 8, 'geo-captcha-settings', 'geo_captcha_option_page');
	add_submenu_page(__FILE__, __('Log', 'geo-captcha'), __('Log', 'geo-captcha'), 8, 'geo-captcha-logs', 'geo_captcha_log_page');
	add_submenu_page(__FILE__, __('Stats', 'geo-captcha'), __('Stats', 'geo-captcha'), 8, 'geo-captcha-stats', 'geo_captcha_stats_page');
}

// Uninstall
if ( function_exists('register_uninstall_hook') )
    register_uninstall_hook(__FILE__, 'geo_captcha_uninstall');

// Register the WordPress-Hooks 
add_action('admin_menu', 'geo_captcha_add_menu');
?>