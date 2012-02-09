<?php
	global $wpdb, $table_prefix;
	
	/*
	 * Save Route
	 */
	if ('google_routeplaner_edit_route' == $_POST['action'])
	{
			
		$wpdb->query("UPDATE " . $table_prefix . "google_routeplaner 
		SET
		start_location = '" . $_POST['google_routeplaner_destination'] . "',
		planer_width = '" . $_POST['google_routeplaner_map_width'] . "',
		planer_height = '" . $_POST['google_routeplaner_map_height'] . "',
		planer_type = '" . $_POST['google_routeplaner_map_type'] . "',
		planer_zoom_control = '" . $_POST['google_routeplaner_zoom_control'] . "',
		planer_type_control = '" . $_POST['google_routeplaner_type_control'] . "',
		planer_language = '" . $_POST['google_routeplaner_language'] . "'
		WHERE planer_id = '" . $_POST['route_id'] . "' LIMIT 1");
		
		?>
		<div class="wrap google_routeplaner">
	    <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Edit Route', 'google_routeplaner'); ?></h2>
		<p class="success"><?php _e('Your changes has been saved!', 'google_routeplaner'); ?></p>
		<p><a href="admin.php?page=google_routeplaner_routes"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
		</div>		
		<?php
		
	} else {
		/*
		 * Output Form
		 */
		$planer = $wpdb->get_row("SELECT * FROM " . $table_prefix . "google_routeplaner WHERE planer_id='" . $route_id . "' LIMIT 1", ARRAY_A);

?>
	  <div class="wrap google_routeplaner">
	   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Edit Route', 'google_routeplaner'); ?></h2>
	   <form method="post" action="">
		<p><label for="google_routeplaner_destination" class="formbold"><?php _e('Destination', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_destination" id="google_routeplaner_destination" style="width: 300px;" value="<?php echo $planer['start_location']; ?>" /><br />
		<i><?php _e('Add a search string for the destination. Adress, company name or something like this.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_width" class="formbold"><?php _e('Map width', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_width" id="google_routeplaner_map_width" style="width: 70px;" value="<?php echo $planer['planer_width']; ?>" /><br />
		<i><?php _e('Enter the width for the map.', 'google_routeplaner'); ?></i></p>
		<p><label for="google_routeplaner_map_height" class="formbold"><?php _e('Map heigth', 'google_routeplaner'); ?></label><br />
		<input type="text" name="google_routeplaner_map_height" id="google_routeplaner_map_height" style="width: 70px;" value="<?php echo $planer['planer_height']; ?>" /><br />
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
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_large" value="DEFAULT"<?php if('DEFAULT' == $planer['planer_zoom_control']) { echo ' checked="checked"'; } ?> />
		<label for="google_routeplaner_zoom_control_large"><?php _e('Large', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_small" value="SMALL"<?php if('SMALL' == $planer['planer_zoom_control']) { echo ' checked="checked"'; } ?> />
		<label for="google_routeplaner_zoom_control_small"><?php _e('Small', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_zoom" value="ZOOM_PAN"<?php if('ZOOM_PAN' == $planer['planer_zoom_control']) { echo ' checked="checked"'; } ?> />
		<label for="google_routeplaner_zoom_control_zoom"><?php _e('Zoom only', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_zoom_control" id="google_routeplaner_zoom_control_none" value="NONE"<?php if('NONE' == $planer['planer_zoom_control']) { echo ' checked="checked"'; } ?> />
		<label for="google_routeplaner_zoom_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select the type of zoom and direction control you want.', 'google_routeplaner'); ?></i></p>
		
		<p><span class="formbold"><?php _e('Map Type Control', 'google_routeplaner'); ?></span><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_standard" value="HORIZONTAL_BAR"<?php if('HORIZONTAL_BAR' == $planer['planer_type_control']) { echo ' checked="checked"'; } ?> />
		<label for="google_routeplaner_type_control_standard"><?php _e('Normal', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_hierachical" value="DROPDOWN_MENU"<?php if('DROPDOWN_MENU' == $planer['planer_type_control']) { echo ' checked="checked"'; } ?> />
		<label for="google_routeplaner_type_control_hierachical"><?php _e('Hierarchical', 'google_routeplaner'); ?></label><br />
		<input type="radio" name="google_routeplaner_type_control" id="google_routeplaner_type_control_none" value="NONE"<?php if('NONE' == $planer['planer_type_control']) { echo ' checked="checked"'; } ?> />
		<label for="google_routeplaner_type_control_none"><?php _e('None', 'google_routeplaner'); ?></label><br />
		<i><?php _e('Select if users can change the map type.', 'google_routeplaner'); ?></i></p>
		
		<label for="google_routeplaner_language" class="formbold"><?php _e('Language', 'google_routeplaner'); ?></label><br />
		<select name="google_routeplaner_language" id="google_routeplaner_language">
			<option value=""><?php _e('Default', 'google_routeplaner'); ?></option>
			<option value="en"<?php if('en' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('English', 'google_routeplaner'); ?></option>
			<option value="de"<?php if('de' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('German', 'google_routeplaner'); ?></option>
			<option value="fr"<?php if('fr' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('French', 'google_routeplaner'); ?></option>
			<option value="es"<?php if('es' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Spanish', 'google_routeplaner'); ?></option>
			<option value="nl"<?php if('nl' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Dutch', 'google_routeplaner'); ?></option>
			<option value="it"<?php if('it' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Italian', 'google_routeplaner'); ?></option>
			<option value="pl"<?php if('pl' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Polish', 'google_routeplaner'); ?></option>
			<option value="ca"<?php if('ca' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Catalan', 'google_routeplaner'); ?></option>
			<option value="eu"<?php if('eu' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Euskara', 'google_routeplaner'); ?></option>
			<option value="ru"<?php if('ru' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Russian', 'google_routeplaner'); ?></option>
			<option value="ja"<?php if('ja' == $planer['planer_language']) { echo ' selected="selected"'; } ?>><?php _e('Japanese', 'google_routeplaner'); ?></option>
		</select>
		<p><input type="submit" class="button-primary" value="<?php _e('Save changes', 'google_routeplaner'); ?>" />
		<input name="action" value="google_routeplaner_edit_route" type="hidden" />
		<input name="route_id" value="<?php echo $planer['planer_id']; ?>" type="hidden" /></p>
	   </form>
	  </div>
<?php
	}
?>