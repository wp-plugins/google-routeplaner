<?php

/* 
 * GENERATE PAGES
 */

// About page
function google_routeplaner_about_page() {
?>
  <style type="text/css" media="screen">
  @import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
  </style>
  <div class="wrap google_routeplaner">
   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Overview', 'google_routeplaner'); ?></h2>
	<div id="poststuff">
		<div class="postbox" style="width: 30%; float: right;">
			<h3><?php _e('Changelog', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<h5>Version 1.0</h5>
					<ul>
						<li>Updated to Google Maps API V3</li>
						<li>No more API Key required</li>
						<li>Overview Map no longer available due to it's not available in Google Maps API V3</li>
						<li>Improved design</li>
					</ul>
				<h5>Version 0.6</h5>
					<ul>
						<li>Displays the code for each route in the admin section</li>
						<li>Added a preview function to the admin section</li>
					</ul>
				<h5>Version 0.5</h5>
					<ul>
						<li>Plugin release</li>
					</ul>
		   </div>
	   </div>
		
		<div style="width: 30%; float: left;">
		<div class="postbox">
			<h3><?php _e('The Plugin', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<p><?php _e('Google Routeplaner generates a routeplaner based on the <a href="http://code.google.com/apis/maps/">Google Maps API</a>.', 'google_routeplaner'); ?></p>
				<p><?php _e('We suggest adding a printer friendly stylesheet to your Wordpress design to allow your users to print the route without the need to print design elements. A tutorial how to do this can be found <a href="http://codex.wordpress.org/Styling_for_Print">here</a>.', 'google_routeplaner'); ?></p>	
				<p><?php _e('Plugin developed by <a href="http://deformed-design.de">Deformed Design</a>.', 'google_routeplaner'); ?></p>
			</div>
		</div>
		<div class="postbox">
			<h3><?php _e('Support', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<p><?php _e('If you encounter any problems feel free to use our <a href="http://support.deformed-design.de">Help Desk</a>.', 'google_routeplaner'); ?></p>
			</div>
		</div>
		</div>
	   
	   <div class="postbox" style="width: 30%; float: left; margin-left: 5%;">
		   <h3><?php _e('Enjoy the plugin?', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<p><?php _e('If you enjoy the plugin we would be glad about a small donation. If you donated, please feel free to remove the authors notice below the map in the settings menu.'); ?></p>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="6505842">
					<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
	   </div>
	   
		<div class="postbox" style="clear: both;">
			<h3><?php _e('Uninstall', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<form method="post" action="">
					<p><?php _e('To completly remove this plugin and all database entries you need to use this uninstall feature. If you only deactivate the plugin a lot of stuff will remain in your database.', 'google_routeplaner'); ?></p>
					<p><?php _e('Yes, I want to uninstall Google Routeplaner', 'google_routeplaner'); ?> <input name="uninstall_shure" value="y" type="checkbox" /></p>
					<p><input type="submit" class="button" value="<?php _e('Full Uninstall Google Routeplaner', 'google_routeplaner'); ?>" />
					<input name="action" value="full_uninstall_google_routeplaner" type="hidden" /></p>
				</form>
			</div>
		</div>
  </div>
<?php

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

// Settings page
function google_routeplaner_option_page() {
?>
  <style type="text/css" media="screen">
  @import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
  </style>
  <div class="wrap google_routeplaner">
   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Settings', 'google_routeplaner'); ?></h2>
   <?php
   // Save settings
	if ('google_routeplaner_save_settings' == $_POST['action'])
	{
		update_option("google_routeplaner_language", $_POST['google_routeplaner_language']);
		update_option("google_routeplaner_donate", $_POST['google_routeplaner_donate']);
		echo '<p class="success">' . __('Settings saved!', 'google_routeplaner') . '</p>';
	}
	?>
   <form method="post" action="">
	<p><label for="google_routeplaner_language"><?php _e('Language', 'google_routeplaner'); ?></label><br />
	<select name="google_routeplaner_language" id="google_routeplaner_language">
	    <option value="en"<?php if('en' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('English', 'google_routeplaner'); ?></option>
		<option value="de"<?php if('de' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('German', 'google_routeplaner'); ?></option>
		<option value="fr"<?php if('fr' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('French', 'google_routeplaner'); ?></option>
		<option value="es"<?php if('es' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Spanish', 'google_routeplaner'); ?></option>
		<option value="nl"<?php if('nl' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Dutch', 'google_routeplaner'); ?></option>
		<option value="it"<?php if('it' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Italian', 'google_routeplaner'); ?></option>
		<option value="pl"<?php if('pl' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Polish', 'google_routeplaner'); ?></option>
		<option value="ca"<?php if('ca' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Catalan', 'google_routeplaner'); ?></option>
		<option value="eu"<?php if('eu' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Euskara', 'google_routeplaner'); ?></option>
		<option value="ru"<?php if('ru' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Russian', 'google_routeplaner'); ?></option>
		<option value="ja"<?php if('ja' == get_option("google_routeplaner_language")) { echo ' selected=""'; } ?>><?php _e('Japanese', 'google_routeplaner'); ?></option>
	</select><br />
    <i><?php _e('Set language for driving information.', 'google_routeplaner'); ?></i></p>
	<p><?php _e('Donate this plugin', 'google_routeplaner'); ?><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_link" value="link"<?php if('link' == get_option("google_routeplaner_donate")) { echo ' checked=""'; } ?> />
	<label for="google_routeplaner_donate_link"><?php _e('Show a link under the maps', 'google_routeplaner'); ?></label><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_articel" value="articel"<?php if('articel' == get_option("google_routeplaner_donate")) { echo ' checked=""'; } ?> />
	<label for="google_routeplaner_donate_articel"><?php _e('I write an articel about it', 'google_routeplaner'); ?></label><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_paypal" value="paypal"<?php if('paypal' == get_option("google_routeplaner_donate")) { echo ' checked=""'; } ?> />
	<label for="google_routeplaner_donate_paypal"><?php _e('I donated with Paypal', 'google_routeplaner'); ?></label><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_none" value="none"<?php if('none' == get_option("google_routeplaner_donate")) { echo ' checked=""'; } ?> />
	<label for="google_routeplaner_donate_none"><?php _e('I will not donate this project (you will not get support)', 'google_routeplaner'); ?></label></p>
	<p><input type="submit" class="button-primary" value="<?php _e('Save settings', 'google_routeplaner'); ?>" />
	<input name="action" value="google_routeplaner_save_settings" type="hidden" /></p>
   </form>
  </div>
<?php

}


// List routes page
function google_routeplaner_list_routes() {
	global $wpdb, $table_prefix;

	$planers = $wpdb->get_results("SELECT * FROM " . $table_prefix . "google_routeplaner ORDER BY planer_id", ARRAY_A); 
?>
  <style type="text/css" media="screen">
  @import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
  </style>
  <div class="wrap google_routeplaner">
   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Routes', 'google_routeplaner'); ?></h2>
   <p><a href="admin.php?page=google_routeplaner_routes&routeplaner_action=google_routeplaner_add_route" class="button-primary"><?php _e('Create Route', 'google_routeplaner'); ?></a>
   <table class="widefat" cellspacing="0" cellpadding="0">
	<thead>
    <tr scope="col" class="column-cb">
	 <th scope="col"><?php _e('ID', 'google_routeplaner'); ?></th>
	 <th scope="col"><?php _e('Destination', 'google_routeplaner'); ?></th>
	 <th scope="col"><?php _e('Code', 'google_routeplaner'); ?></th>
	 <th scope="col"><?php _e('Actions', 'google_routeplaner'); ?></th>
	</tr>
   </thead>
   <tfoot>
    <tr scope="col" class="column-cb">
	 <th scope="col"><?php _e('ID', 'google_routeplaner'); ?></th>
	 <th scope="col"><?php _e('Destination', 'google_routeplaner'); ?></th>
	 <th scope="col"><?php _e('Code', 'google_routeplaner'); ?></th>
	 <th scope="col"><?php _e('Actions', 'google_routeplaner'); ?></th>
	</tr>
   </tfoot>
   
   <?php
	if(is_array($planers)) {
		$rownum = 1;
		foreach($planers as $planer) {
			if($rownum == 1) {
				echo '<tr>' . "\n";
				$rownum = 0;
			} else {
				echo '<tr class="alternate">' . "\n";
				$rownum = 1;
			}
			echo '<td>' . $planer['planer_id'] . '</td>
			<td>' . $planer['start_location'] . '</td>
			<td>[googlerouteplaner=' . $planer['planer_id'] . ']</td>
			<td>
			<a href="admin.php?page=google_routeplaner_routes&routeplaner_action=preview_route&route_id=' . $planer['planer_id'] . '" class="button">' . __('preview', 'google_routeplaner') . '</a>
			<a href="admin.php?page=google_routeplaner_routes&routeplaner_action=edit_route&route_id=' . $planer['planer_id'] . '" class="button">' . __('edit', 'google_routeplaner') . '</a>
			<a href="admin.php?page=google_routeplaner_routes&routeplaner_action=delete_route&route_id=' . $planer['planer_id'] . '" class="button">' . __('delete', 'google_routeplaner') . '</a>
			</td>
			</tr>' . "\n";
		}
	} else {
		echo '<tr>
		<td colspan="3" class="error">' . __('You have not created any routes yet!', 'google_routeplaner') . '</td>
		</tr>';
	}
   ?>
   </table>
 <?php
}

// Delete Route
function google_routeplaner_delete_route($route_id) {
	global $wpdb, $table_prefix;
	
	$wpdb->query("DELETE FROM " . $table_prefix . "google_routeplaner 
	WHERE planer_id='" . $route_id . "' LIMIT 1");
	
	?>
	<style type="text/css" media="screen">
	@import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
	</style>
	<div class="wrap google_routeplaner">
    <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Delete Route', 'google_routeplaner'); ?></h2>
	<p class="success"><?php _e('The route has been deleted!', 'google_routeplaner'); ?></p>
	<p><a href="admin.php?page=google_routeplaner_routes" class="button"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
	</div>
	<?php
}

// Preview Route
function google_routeplaner_preview_route($route_id) {
	?>
	<style type="text/css" media="screen">
	@import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
	</style>
	<div class="wrap google_routeplaner">
	<div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Preview Route', 'google_routeplaner'); ?></h2>
	<p><a href="admin.php?page=google_routeplaner_routes" class="button"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
    <?php echo google_routeplaner_build_map($route_id); ?>
	</div>
	<?php
}


// Add route page
function google_routeplaner_add_route() {
	global $wpdb, $table_prefix;
	
	// Save route
	if ('google_routeplaner_add_route' == $_POST['action'])
	{
			
		$wpdb->query("INSERT INTO " . $table_prefix . "google_routeplaner 
		VALUES (
		'',
		'" . $_POST['google_routeplaner_destination'] . "',
		'" . $_POST['google_routeplaner_map_width'] . "',
		'" . $_POST['google_routeplaner_map_height'] . "',
		'" . $_POST['google_routeplaner_map_type'] . "',
		'" . $_POST['google_routeplaner_zoom_control'] . "',
		'" . $_POST['google_routeplaner_type_control'] . "',
		'" . $_POST['google_routeplaner_css'] . "')");
		
		?>	  
		<style type="text/css" media="screen">
		@import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
		</style>
		<div class="wrap google_routeplaner">
	    <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Add Route', 'google_routeplaner'); ?></h2>
		<p class="success"><?php _e('Your route has been saved!', 'google_routeplaner'); ?><br />
		<?php _e('The code for this route is: ', 'google_routeplaner'); ?> [googlerouteplaner=<?php echo mysql_insert_id(); ?>]</p>
		<p><a href="admin.php?page=google_routeplaner_routes" class="button"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
		</div>
		<?php
	} else {


?>
	  <style type="text/css" media="screen">
	  @import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
	  </style>
	  <div class="wrap google_routeplaner">
	   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Add Route', 'google_routeplaner'); ?></h2>
	   <form method="post" action="">
		<p><label for="google_routeplaner_destination"><?php _e('Destination', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_destination" id="google_routeplaner_destination" style="width: 300px;" value="<?php echo get_option("google_routeplaner_destination"); ?>" /><br />
		<i><?php _e('Add a search string for the destination. Adress, company name or something like this.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_width"><?php _e('Map width', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_width" id="google_routeplaner_map_width" style="width: 70px;" value="500" /><br />
		<i><?php _e('Enter the width for the map.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_height"><?php _e('Map heigth', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_height" id="google_routeplaner_map_height" style="width: 70px;" value="400" /><br />
		<i><?php _e('Enter the height for the map.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_type"><?php _e('Map type', 'google_routeplaner'); ?></label><br />
		<select name="google_routeplaner_map_type" id="google_routeplaner_map_type">
			<?php $google_routeplaner_map_type = get_option("google_routeplaner_map_type"); ?>
			<option value="ROADMAP" selected=""><?php _e('Road map', 'google_routeplaner'); ?></option>
			<option value="SATELLITE"><?php _e('Satellite map', 'google_routeplaner'); ?></option>
			<option value="HYBRID"><?php _e('Hybrid map', 'google_routeplaner'); ?></option>
			<option value="TERRAIN"><?php _e('Physical map', 'google_routeplaner'); ?></option>	
		</select><br />
		<i><?php _e('Select how the map should look like.', 'google_routeplaner'); ?></i></p>
		
		<p><?php _e('Map Zoom Control', 'google_routeplaner'); ?><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_large" value="DEFAULT" checked="" />
		<label for="google_routeplaner_zoom_control_large"><?php _e('Large', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_small" value="SMALL" />
		<label for="google_routeplaner_zoom_control_small"><?php _e('Small', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_zoom" value="ZOOM_PAN" />
		<label for="google_routeplaner_zoom_control_zoom"><?php _e('Zoom only', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_none" value="NONE" />
		<label for="google_routeplaner_zoom_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select the type of zoom and direction control you want.', 'google_routeplaner'); ?></i></p>
		
		<p><?php _e('Map Type Control', 'google_routeplaner'); ?><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_standard" value="HORIZONTAL_BAR"  checked="" />
		<label for="google_routeplaner_type_control_standard"><?php _e('Normal', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_hierachical" value="DROPDOWN_MENU" />
		<label for="google_routeplaner_type_control_hierachical"><?php _e('Hierarchical', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_none" value="NONE" />
		<label for="google_routeplaner_type_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select if users can change the map type.', 'google_routeplaner'); ?></i></p>
		
		<p><label for="google_routeplaner_css"><?php _e('Advance CSS', 'google_routeplaner'); ?></label><br />
		<textarea name="google_routeplaner_css" id="google_routeplaner_css" style="width: 300px; height: 200px;"><?php echo '#map_controls{}' . "\n"; 
		echo '#map_canvas{}' . "\n"; 
		echo '#map_directions{}';  ?>
		</textarea><br />
		<i><?php _e('You can add css information for any element.', 'google_routeplaner'); ?></i></p>
		
		<p><input type="submit" class="button-primary" value="<?php _e('Save route', 'google_routeplaner'); ?>" />
		<input name="action" value="google_routeplaner_add_route" type="hidden" /></p>
	   </form>
	  </div>
<?php
	}
}



// Edit route page
function google_routeplaner_edit_route($route_id) {
	global $wpdb, $table_prefix;
	
	// Save route
	if ('google_routeplaner_edit_route' == $_POST['action'])
	{
			
		$wpdb->query("UPDATE " . $table_prefix . "google_routeplaner 
		SET
		start_location='" . $_POST['google_routeplaner_destination'] . "',
		planer_width='" . $_POST['google_routeplaner_map_width'] . "',
		planer_height='" . $_POST['google_routeplaner_map_height'] . "',
		planer_type='" . $_POST['google_routeplaner_map_type'] . "',
		planer_zoom_control='" . $_POST['google_routeplaner_zoom_control'] . "',
		planer_type_control='" . $_POST['google_routeplaner_type_control'] . "',
		planer_css='" . $_POST['google_routeplaner_css'] . "'
		WHERE planer_id='" . $_POST['route_id'] . "' LIMIT 1");
		
		?>
		<style type="text/css" media="screen">
		@import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
		</style>
		<div class="wrap google_routeplaner">
	    <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Edit Route', 'google_routeplaner'); ?></h2>
		<p class="success"><?php _e('Your changes has been saved!', 'google_routeplaner'); ?></p>
		<p><a href="admin.php?page=google_routeplaner_routes"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
		</div>		
		<?php
		
	} else {

		$planer = $wpdb->get_row("SELECT * FROM " . $table_prefix . "google_routeplaner WHERE planer_id='" . $route_id . "' LIMIT 1", ARRAY_A);

?>
	  <style type="text/css" media="screen">
	  @import url("<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/google-routeplaner.css");
	  </style>
	  <div class="wrap google_routeplaner">
	   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Edit Route', 'google_routeplaner'); ?></h2>
	   <form method="post" action="">
		<p><label for="google_routeplaner_destination"><?php _e('Destination', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_destination" id="google_routeplaner_destination" style="width: 300px;" value="<?php echo $planer['start_location']; ?>" /><br />
		<i><?php _e('Add a search string for the destination. Adress, company name or something like this.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_width"><?php _e('Map width', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_width" id="google_routeplaner_map_width" style="width: 70px;" value="<?php echo $planer['planer_width']; ?>" /><br />
		<i><?php _e('Enter the width for the map.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_height"><?php _e('Map heigth', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_height" id="google_routeplaner_map_height" style="width: 70px;" value="<?php echo $planer['planer_height']; ?>" /><br />
		<i><?php _e('Enter the height for the map.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_type"><?php _e('Map type', 'google_routeplaner'); ?></label><br />
		<select name="google_routeplaner_map_type" id="google_routeplaner_map_type">
			<?php $google_routeplaner_map_type = get_option("google_routeplaner_map_type"); ?>
			<option value="ROADMAP" selected=""><?php _e('Road map', 'google_routeplaner'); ?></option>
			<option value="SATELLITE"><?php _e('Satellite map', 'google_routeplaner'); ?></option>
			<option value="HYBRID"><?php _e('Hybrid map', 'google_routeplaner'); ?></option>
			<option value="TERRAIN"><?php _e('Physical map', 'google_routeplaner'); ?></option>	
		</select><br />
		<i><?php _e('Select how the map should look like.', 'google_routeplaner'); ?></i></p>
		
		<p><?php _e('Map Zoom Control', 'google_routeplaner'); ?><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_large" value="DEFAULT"<?php if('DEFAULT' == $planer['planer_zoom_control']) { echo ' checked=""'; } ?> />
		<label for="google_routeplaner_zoom_control_large"><?php _e('Large', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_small" value="SMALL"<?php if('SMALL' == $planer['planer_zoom_control']) { echo ' checked=""'; } ?> />
		<label for="google_routeplaner_zoom_control_small"><?php _e('Small', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_zoom" value="ZOOM_PAN"<?php if('ZOOM_PAN' == $planer['planer_zoom_control']) { echo ' checked=""'; } ?> />
		<label for="google_routeplaner_zoom_control_zoom"><?php _e('Zoom only', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_none" value="NONE"<?php if('NONE' == $planer['planer_zoom_control']) { echo ' checked=""'; } ?> />
		<label for="google_routeplaner_zoom_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select the type of zoom and direction control you want.', 'google_routeplaner'); ?></i></p>
		
		<p><?php _e('Map Type Control', 'google_routeplaner'); ?><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_standard" value="HORIZONTAL_BAR"<?php if('HORIZONTAL_BAR' == $planer['planer_type_control']) { echo ' checked=""'; } ?> />
		<label for="google_routeplaner_type_control_standard"><?php _e('Normal', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_hierachical" value="DROPDOWN_MENU"<?php if('DROPDOWN_MENU' == $planer['planer_type_control']) { echo ' checked=""'; } ?> />
		<label for="google_routeplaner_type_control_hierachical"><?php _e('Hierarchical', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_none" value="NONE"<?php if('NONE' == $planer['planer_type_control']) { echo ' checked=""'; } ?> />
		<label for="google_routeplaner_type_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select if users can change the map type.', 'google_routeplaner'); ?></i></p>
		
		<p><label for="google_routeplaner_css"><?php _e('Advance CSS', 'google_routeplaner'); ?></label><br />
		<textarea name="google_routeplaner_css" id="google_routeplaner_css" style="width: 300px;"><?php echo $planer['planer_css']; ?></textarea><br />
		<i><?php _e('You can add css information for any element.', 'google_routeplaner'); ?></i></p>
		
		<p><input type="submit" class="button-primary" value="<?php _e('Save changes', 'google_routeplaner'); ?>" />
		<input name="action" value="google_routeplaner_edit_route" type="hidden" />
		<input name="route_id" value="<?php echo $planer['planer_id']; ?>" type="hidden" /></p>
	   </form>
	  </div>
<?php
	}
}


// Adds the option page for admin menu
function google_routeplaner_add_menu() {
	add_option("google_routeplaner_donate","link");	
	add_option("google_routeplaner_language","en");	

	add_menu_page(__('Overview', 'google_routeplaner'), __('Routeplaner', 'google_routeplaner'), 8, __FILE__, 'google_routeplaner_about_page', WP_PLUGIN_URL . '/google-routeplaner/images/routeplanner_icon16.png');
	add_submenu_page(__FILE__, __('Routes', 'google_routeplaner'), __('Routes', 'google_routeplaner'), 8, 'google_routeplaner_routes', 'google_routeplaner_routes_page');
	add_submenu_page(__FILE__, __('Settings', 'google_routeplaner'), __('Settings', 'google_routeplaner'), 8, 'google_routeplaner_settings', 'google_routeplaner_option_page');
}

add_action('admin_menu', 'google_routeplaner_add_menu');

?>