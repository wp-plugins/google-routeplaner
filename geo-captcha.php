<?php
/*
Plugin Name: Geo Captcha
Plugin URI: http://deformed-design.de/downloads/wordpress-plugins/geo-captcha-plugin
Description: Geo Captcha protects your comments and registration with a captcha image. The main difference between Geo Captcha and all other captcha plugins is, that Geo Captcha can check the geographic location of your visitor and will not annoy visitors from the countries on your whitelist with a captcha.
Version: 1.9
Author: Deformed Design
Author URI: http://deformed-design.de
Min WP Version: 3.0
*/

/* This script uses GeoLite Country from MaxMind (http://www.maxmind.com) which is available under terms of GPL/LGPL */

/*  This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>. */


if (!class_exists('geo_captcha')) {
	if( !isset( $_SESSION ) ) {
		session_start();
	}
}

load_plugin_textdomain('geo-captcha', WP_PLUGIN_DIR . '/geo-captcha/', dirname(plugin_basename(__FILE__)));

// Include pages
require_once(WP_PLUGIN_DIR . '/geo-captcha/geo-captcha-pages.php');
	 
class geo_captcha {

	public $country_list = array();
	
	function init() {
		global $wpdb, $table_prefix;
		if (isset($_GET['activate']) and $_GET['activate'] == 'true') {
			$tables = $wpdb->get_col('SHOW TABLES');
			if (!in_array($table_prefix . 'geo_captcha_stats', $tables)) {
				$this->install();
			} elseif (!in_array($table_prefix . 'geo_captcha_log', $tables)) {
				$this->install();
			}
		}

		// Create country list array
		$geo_captcha_legal = get_option('geo_captcha_legal');
		$legal_countries = explode("\n", $geo_captcha_legal);
		if(is_array($legal_countries)) {
			foreach($legal_countries as $country) {
				$country = trim($country);
				if($country !== '') {
					$this->country_list[] = $country;
				}
			}
		}
	}
	
	// Try to get the charset of the mysql tables
	function get_charset () {
		global $wpdb, $table_prefix;
		
		// Check Charset
		$charset_collate = '';
		if ( version_compare(mysql_get_server_info(), '4.1.0', '>=') ) {
			if (!empty($wpdb->charset)) {
				$charset_collate .= sprintf(' DEFAULT CHARACTER SET %s', $wpdb->charset);
			}
			if (!empty($wpdb->collate)) {
				$charset_collate .= ' COLLATE $wpdb->collate';
			}
		}
		return $charset_collat;
	}
	
	// Installs the plugin and creates the needed tables
	function install() {
		global $wpdb, $table_prefix;
		
		$charset_collate = $this->get_charset();
		
		// Create Stats-Table
		$sql_stats = 'CREATE TABLE `' . $table_prefix . 'geo_captcha_stats` (
					 `country` VARCHAR(100) NOT NULL,
					 `positiv_count` INT,
					 `negativ_count` INT
					 )%s';
		$wpdb->query(sprintf($sql_stats, $charset_collate));
		
		// Create Log-Table
		$sql_stats = 'CREATE TABLE `' . $table_prefix . 'geo_captcha_log` (
					 `country` VARCHAR(100) NOT NULL,
					 `type` VARCHAR(4),
					 `where` VARCHAR(20),
					 `date` VARCHAR(14),
					 `ip` VARCHAR(15)
					 )%s';
		$wpdb->query(sprintf($sql_stats, $charset_collate));
		// Remove old options
		delete_option('geo_captcha_bad_log');
		delete_option('geo_captcha_good_log');

	}
	
	// Get the IP of the visitor
	function get_ip_address() {
		if (empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip_address = $_SERVER["REMOTE_ADDR"];
		} else {
			$ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		if(strpos($ip_address, ',') !== false) {
			$ip_address = explode(',', $ip_address);
			$ip_address = $ip_address[0];
		}
		return $ip_address;
	}
	
	// Get Location of current user
	function get_location($answer = 'code') {
		
		$ip_address = $this->get_ip_address();
		
		require_once WP_PLUGIN_DIR . '/geo-captcha/geoip.inc';

		$gi = geoip_open(WP_PLUGIN_DIR . '/geo-captcha/GeoIP.dat', GEOIP_STANDARD);

		if($answer == 'name') {
			$geo_location = geoip_country_name_by_addr($gi, $ip_address);
			if($geo_location == '') {
				$geo_location = 'Unknown';
			}
		} else {
			$geo_location = geoip_country_code_by_addr($gi, $ip_address);
		}
		return $geo_location;
	}
	
	// Update country stats
	function update_stats($country, $pos_neg) {
		global $wpdb, $table_prefix;
		
		if($country == '') {
			$country = 'Unknown';
		}
		
		$old_info = $wpdb->get_row("SELECT * FROM " . $table_prefix . "geo_captcha_stats WHERE country = '" . $country . "'", ARRAY_A);
		if(isset($old_info['country'])) {
			if($pos_neg == 'neg') {
				$wpdb->query("UPDATE " . $table_prefix . "geo_captcha_stats SET negativ_count = " . ($old_info['negativ_count']+1) . "
					WHERE country = '" . $country . "'");
			} elseif ($pos_neg == 'pos') {
				$wpdb->query("UPDATE " . $table_prefix . "geo_captcha_stats SET positiv_count = " . ($old_info['positiv_count']+1) . "
					WHERE country = '" . $country . "'");
			} elseif ($pos_neg == 'delpos') {
				$wpdb->query("UPDATE " . $table_prefix . "geo_captcha_stats SET positiv_count = " . ($old_info['positiv_count']-1) . ",
					negativ_count = " . ($old_info['negativ_count']+1) . "
					WHERE country = '" . $country . "'");
			} elseif ($pos_neg == 'delneg') {
				$wpdb->query("UPDATE " . $table_prefix . "geo_captcha_stats SET positiv_count = " . ($old_info['positiv_count']+1) . ",
					negativ_count = " . ($old_info['negativ_count']-1) . "
					WHERE country = '" . $country . "'");
			}
		} else {
			if($pos_neg == 'neg') {
				$new_neg = 1;
				$new_pos = 0;
			} elseif ($pos_neg == 'pos') {
				$new_neg = 0;
				$new_pos = 1;
			} elseif ($pos_neg == 'delpos') {
				$new_neg = 1;
				$new_pos = 0;
			} elseif ($pos_neg == 'delneg') {
				$new_neg = 0;
				$new_pos = 1;
			}
			$wpdb->query("INSERT INTO " . $table_prefix . "geo_captcha_stats 
			VALUES('" . $country . "',
			'" . $new_pos . "',
			'" . $new_neg . "')");
		}
	}
	
	function geo_write_log($type, $where) {
		global $wpdb, $table_prefix;
			
		$charset_collate = $this->get_charset();
	
		// Gets the ip to log
		if(1 == get_option("geo_captcha_log_ips")) {
			$log_ip_address = $this->get_ip_address();
		} else {
			$log_ip_address = ' - ';
		}
		
		$sql_stats = 'INSERT INTO `' . $table_prefix . 'geo_captcha_log` VALUES (
			"'. $this->get_location('name') . '",
			"' . $type . '",
			"' . $where . '",
			"' . date("YmdHis") . '",
			"' . $log_ip_address . '"
			)';
		$wpdb->query(sprintf($sql_stats, $charset_collate));
		
	
	}
	
	// Check for captcha when sending a comment
	function geo_comment_post($incoming_comment) {
		
		if (is_user_logged_in()) {
			// If user is loggedin, save it to stats and return comment
			update_option("geo_captcha_registered_comments", get_option('geo_captcha_registered_comments')+1);
			return $incoming_comment;
		}
		
		if (in_array($this->get_location(), $this->country_list)) {
			// If user is whitelisted, save it to stats and return comment
			update_option("geo_captcha_whitelisted_comments", get_option('geo_captcha_whitelisted_comments')+1);
			return $incoming_comment;
		}
		
		include_once WP_PLUGIN_DIR . '/geo-captcha/securimage/securimage.php';

		$securimage = new Securimage();
		
		if ($securimage->check($_POST['captcha_code']) == false) {
		
			// If captcha was correct, save it to log and return comment
			$this->geo_write_log('bad', 'comments');
			update_option("geo_captcha_blocked_spam", get_option('geo_captcha_blocked_spam')+1);
			
			$this->update_stats($this->get_location('name'), 'neg');
			
			wp_die( __('ERROR: The Code you have entered was not correct. Please try again.', 'geo-captcha'));
		} else {
			// If captcha was not correct, save it to log and die with an error
			$this->geo_write_log('good', 'comments');
			update_option("geo_captcha_not_whitelisted_comments", get_option('geo_captcha_not_whitelisted_comments')+1);
			
			$this->update_stats($this->get_location('name'), 'pos');
			
			return $incoming_comment;
		}
	}
	
	// Check for captcha when sending a comment
	function geo_register_post() {
		
		if (is_user_logged_in()) {
			// If user is loggedin, save it to stats and return comment
			update_option("geo_captcha_registered_comments", get_option('geo_captcha_registered_comments')+1);
			return $incoming_comment;
		}
		
		if (in_array($this->get_location(), $this->country_list)) {
			// If user is whitelisted, save it to stats and return comment
			update_option("geo_captcha_whitelisted_comments", get_option('geo_captcha_whitelisted_comments')+1);
			return $incoming_comment;
		}
		
		include_once WP_PLUGIN_DIR . '/geo-captcha/securimage/securimage.php';

		$securimage = new Securimage();
		
		if ($securimage->check($_POST['captcha_code']) == false) {
		
			// If captcha was correct, save it to log and return comment
			$this->geo_write_log('bad', 'registration');
			update_option("geo_captcha_blocked_spam", get_option('geo_captcha_blocked_spam')+1);
			
			$this->update_stats($this->get_location('name'), 'neg');
			
			wp_die( __('ERROR: The Code you have entered was not correct. Please try again.', 'geo-captcha'));
		} else {
			// If captcha was not correct, save it to log and die with an error
			$this->geo_write_log('good', 'registration');
			update_option("geo_captcha_not_whitelisted_comments", get_option('geo_captcha_not_whitelisted_comments')+1);
			
			$this->update_stats($this->get_location('name'), 'pos');
			
			return $incoming_comment;
		}
	}

	// Create captcha if user is not loggedin and not in whitelist
	function geo_comment_form()
	{
		if (is_user_logged_in()) return true;

		if (in_array($this->get_location(), $this->country_list)) return true;
		
		$this->geo_output_captcha();
	}
	
		// Create captcha if user is not loggedin and not in whitelist
	function geo_register_form()
	{
		if (is_user_logged_in()) return true;

		if (in_array($this->get_location(), $this->country_list)) return true;
		
		$this->geo_output_captcha();
	}
	
	// Creates the HTML output for the forms
	function geo_output_captcha() {
		?>
		<p><?php _e('Please insert the signs in the image:', 'geo-captcha') ?></p>
		<div style="width: 250px">
		 <div style="width: 220px; float: left;">
		  <img src="<?php echo WP_PLUGIN_URL; ?>/geo-captcha/securimage/securimage_show.php" id="captcha" border="0" /><br />
		  <input type="text" name="captcha_code" size="10" maxlength="6" />
		 </div>
		 <div style="width: 25px; float: right;">
		  <a href="#" onclick="document.getElementById('captcha').src = '<?php echo WP_PLUGIN_URL; ?>/geo-captcha/securimage/securimage_show.php?' + Math.random(); return false">
		   <img src="<?php echo WP_PLUGIN_URL; ?>/geo-captcha/securimage/images/refresh.gif" alt="<?php _e('Reload Image', 'geo-captcha'); ?>" border="0" />
		  </a>
		  <a href="<?php echo WP_PLUGIN_URL; ?>/geo-captcha/securimage/securimage_play.php">
		   <img src="<?php echo WP_PLUGIN_URL; ?>/geo-captcha/securimage/images/audio_icon.gif" alt="<?php _e('Play Audio-CAPTCHA', 'geo-captcha'); ?>" border="0" />
		  </a>
		 </div>
		 <p style="clear: both;"></p>
		</div>
		<?php
	}
}

/*
 * Manuell marked spam
 */
add_action('wp_set_comment_status', 'geo_test_comment', 10, 2);


function geo_test_comment($comment_id, $comment_status) {
	require_once WP_PLUGIN_DIR . '/geo-captcha/geoip.inc';
	$gi = geoip_open(WP_PLUGIN_DIR . '/geo-captcha/GeoIP.dat', GEOIP_STANDARD);

	$comment_info = get_comment($comment_id);
	
	if('spam' == $comment_status) {
		
		$geo_location = geoip_country_name_by_addr($gi, $comment_info->comment_author_IP);
		$geo_location_code = geoip_country_code_by_addr($gi, $comment_info->comment_author_IP);
		if($geo_location == '') {
			$geo_location = 'Unknown';
		}
		
		$geo_captcha_img = new geo_captcha();
		$geo_captcha_img->init();
		
		if(!in_array($geo_location_code, $geo_captcha_img->country_list)) {
			$geo_captcha_img->update_stats($geo_location, 'delpos');
			update_option("geo_captcha_manuell_spam", get_option('geo_captcha_manuell_spam')+1);
		} else {
			update_option("geo_captcha_whitelisted_spam", get_option('geo_captcha_whitelisted_spam')+1);
		}
	} elseif('spam' == $comment_info->comment_approved) {
		
		$geo_location = geoip_country_name_by_addr($gi, $comment_info->comment_author_IP);
		$geo_location_code = geoip_country_code_by_addr($gi, $comment_info->comment_author_IP);
		if($geo_location == '') {
			$geo_location = 'Unknown';
		}
		
		$geo_captcha_img = new geo_captcha();
		$geo_captcha_img->init();
		
		if(!in_array($geo_location_code, $geo_captcha_img->country_list)) {
			$geo_captcha_img->update_stats($geo_location, 'delneg');
			update_option("geo_captcha_manuell_spam", get_option('geo_captcha_manuell_spam')-1);
		} else {
			update_option("geo_captcha_whitelisted_spam", get_option('geo_captcha_whitelisted_spam')-1);
		}

	}
}

if (class_exists("geo_captcha")) {
	$geo_captcha_img = new geo_captcha();
	$geo_captcha_img->init();
}

if(1 == get_option("geo_captcha_comments")) {
	add_action('comment_form', array(&$geo_captcha_img, 'geo_comment_form'));
	add_filter('preprocess_comment', array( &$geo_captcha_img, 'geo_comment_post'));
}
if(1 == get_option("geo_captcha_registration")) {
	add_action('register_form', array(&$geo_captcha_img, 'geo_register_form'));
	add_action('register_post', array( &$geo_captcha_img, 'geo_register_post'));
}
?>