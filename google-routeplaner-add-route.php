<?php
	global $wpdb, $table_prefix;
	
	/*
	 * Save Route
	 */
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
		'" . $_POST['google_routeplaner_css'] . "',
		'" . $_POST['google_routeplaner_language'] . "')");
		
		?>	  
		<div class="wrap google_routeplaner">
	    <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Add Route', 'google_routeplaner'); ?></h2>
		<p class="success"><?php _e('Your route has been saved!', 'google_routeplaner'); ?><br />
		<?php _e('The code for this route is: ', 'google_routeplaner'); ?> [googlerouteplaner=<?php echo mysql_insert_id(); ?>]</p>
		<p><a href="admin.php?page=google_routeplaner_routes" class="button"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
		</div>
		<?php
	} else {
	/*
	 * Output Form
	 */

?>
	  <div class="wrap google_routeplaner">
	   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Add Route', 'google_routeplaner'); ?></h2>
	   <form method="post" action="">
		<p><label for="google_routeplaner_destination" class="formbold"><?php _e('Destination', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_destination" id="google_routeplaner_destination" style="width: 300px;" value="<?php echo get_option("google_routeplaner_destination"); ?>" /><br />
		<i><?php _e('Add a search string for the destination. Adress, company name or something like this.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_width" class="formbold"><?php _e('Map width', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_width" id="google_routeplaner_map_width" style="width: 70px;" value="500" /><br />
		<i><?php _e('Enter the width for the map.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_height" class="formbold"><?php _e('Map heigth', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_height" id="google_routeplaner_map_height" style="width: 70px;" value="400" /><br />
		<i><?php _e('Enter the height for the map.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_type" class="formbold"><?php _e('Map type', 'google_routeplaner'); ?></label><br />
		<select name="google_routeplaner_map_type" id="google_routeplaner_map_type">
			<?php $google_routeplaner_map_type = get_option("google_routeplaner_map_type"); ?>
			<option value="ROADMAP" selected="selected"><?php _e('Road map', 'google_routeplaner'); ?></option>
			<option value="SATELLITE"><?php _e('Satellite map', 'google_routeplaner'); ?></option>
			<option value="HYBRID"><?php _e('Hybrid map', 'google_routeplaner'); ?></option>
			<option value="TERRAIN"><?php _e('Physical map', 'google_routeplaner'); ?></option>	
		</select><br />
		<i><?php _e('Select how the map should look like.', 'google_routeplaner'); ?></i></p>
		
		<p><span class="formbold"><?php _e('Map Zoom Control', 'google_routeplaner'); ?></span><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_large" value="DEFAULT" checked="checked" />
		<label for="google_routeplaner_zoom_control_large"><?php _e('Large', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_small" value="SMALL" />
		<label for="google_routeplaner_zoom_control_small"><?php _e('Small', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_zoom" value="ZOOM_PAN" />
		<label for="google_routeplaner_zoom_control_zoom"><?php _e('Zoom only', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_none" value="NONE" />
		<label for="google_routeplaner_zoom_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select the type of zoom and direction control you want.', 'google_routeplaner'); ?></i></p>
		
		<p><span class="formbold"><?php _e('Map Type Control', 'google_routeplaner'); ?></span><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_standard" value="HORIZONTAL_BAR"  checked="checked" />
		<label for="google_routeplaner_type_control_standard"><?php _e('Normal', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_hierachical" value="DROPDOWN_MENU" />
		<label for="google_routeplaner_type_control_hierachical"><?php _e('Hierarchical', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_none" value="NONE" />
		<label for="google_routeplaner_type_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select if users can change the map type.', 'google_routeplaner'); ?></i></p>
		
		<p><label for="google_routeplaner_css" class="formbold"><?php _e('Advance CSS', 'google_routeplaner'); ?></label><br />
		<textarea name="google_routeplaner_css" id="google_routeplaner_css" style="width: 300px; height: 200px;" rows="10" cols="50"><?php echo '#map_controls{}' . "\n"; 
		echo '#map_canvas{}' . "\n"; 
		echo '#map_directions{}';  ?>
		</textarea><br />
		<i><?php _e('You can add css information for any element. Warning: This will result in invalid HTML output.', 'google_routeplaner'); ?></i></p>
		<label for="google_routeplaner_language" class="formbold"><?php _e('Language', 'google_routeplaner'); ?></label><br />
		<select name="google_routeplaner_language" id="google_routeplaner_language">
			<option value=""><?php _e('Default', 'google_routeplaner'); ?></option>
			<option value="en"<?php if('en' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('English', 'google_routeplaner'); ?></option>
			<option value="de"<?php if('de' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('German', 'google_routeplaner'); ?></option>
			<option value="fr"<?php if('fr' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('French', 'google_routeplaner'); ?></option>
			<option value="es"<?php if('es' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Spanish', 'google_routeplaner'); ?></option>
			<option value="nl"<?php if('nl' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Dutch', 'google_routeplaner'); ?></option>
			<option value="it"<?php if('it' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Italian', 'google_routeplaner'); ?></option>
			<option value="pl"<?php if('pl' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Polish', 'google_routeplaner'); ?></option>
			<option value="ca"<?php if('ca' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Catalan', 'google_routeplaner'); ?></option>
			<option value="eu"<?php if('eu' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Euskara', 'google_routeplaner'); ?></option>
			<option value="ru"<?php if('ru' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Russian', 'google_routeplaner'); ?></option>
			<option value="ja"<?php if('ja' == get_option("google_routeplaner_language")) { echo ' selected="selected"'; } ?>><?php _e('Japanese', 'google_routeplaner'); ?></option>
		</select>
		<p><input type="submit" class="button-primary" value="<?php _e('Save route', 'google_routeplaner'); ?>" />
		<input name="action" value="google_routeplaner_add_route" type="hidden" /></p>
	   </form>
	  </div>
<?php
	}
?>