<?php
	global $wpdb, $google_routeplaner_langs;
	
	/*
	 * Save Route
	 */
	if ('google_routeplaner_edit_route' == $_POST['action'])
	{
			
		$wpdb->query("UPDATE " . $wpdb->prefix . "google_routeplaner 
		SET
		start_location = '" . $_POST['google_routeplaner_destination'] . "',
		planer_width = '" . $_POST['google_routeplaner_map_width'] . "',
		planer_width_unit = '" . $_POST['google_routeplaner_map_width_unit'] . "',
		planer_height = '" . $_POST['google_routeplaner_map_height'] . "',
		planer_height_unit = '" . $_POST['google_routeplaner_map_height_unit'] . "',
		planer_zoom = '" . $_POST['google_routeplaner_zoom'] . "',
		planer_type = '" . $_POST['google_routeplaner_map_type'] . "',
		planer_zoom_control = '" . $_POST['google_routeplaner_zoom_control'] . "',
		planer_type_control = '" . $_POST['google_routeplaner_type_control'] . "',
		planer_autofill = '" . $_POST['google_routeplaner_autofill'] . "',
		planer_language = '" . $_POST['google_routeplaner_language'] . "'
		WHERE planer_id = '" . $_POST['route_id'] . "' LIMIT 1");
		
		?>
		<div class="wrap google_routeplaner">
	    <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplanner', 'google_routeplaner'); ?> V<?php echo get_option("google_routeplaner_version"); ?> &bull; <?php _e('Edit Route', 'google_routeplaner'); ?></h2>
		<p class="success"><?php _e('Your changes has been saved!', 'google_routeplaner'); ?></p>
		<p><a href="admin.php?page=google_routeplaner_routes"><?php _e('Back to overview', 'google_routeplaner'); ?></a></p>
		</div>		
		<?php
		
	} else {
		/*
		 * Output Form
		 */
		$planer = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "google_routeplaner WHERE planer_id='" . $route_id . "' LIMIT 1", ARRAY_A);

?>
	<div class="wrap google_routeplaner">
		<div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplanner', 'google_routeplaner'); ?> &bull; <?php _e('Edit Route', 'google_routeplaner'); ?></h2>
		<div id="poststuff"> 
			<form method="post" action="">
				<div style="width: 48%; float: right;">
					<div class="postbox">
						<h3><?php _e('Detail settings', 'google_routeplaner'); ?></h3>
						<div class="inside">
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
						</div>
					</div>
					
					<div class="postbox">
						<h3><?php _e('CSS Hooks', 'google_routeplaner'); ?></h3>
						<div class="inside">
							<code>
								/* The area with the input field for map <?php echo $planer['planer_id']; ?> */<br />
								#map_controls<?php echo $planer['planer_id']; ?> {<br />
								}<br />
								<br />
								/* Map <?php echo $planer['planer_id']; ?> itself */<br />
								#map_canvas<?php echo $planer['planer_id']; ?> {<br />
								}<br />
								<br />
								/* The driving directions displayed below map <?php echo $planer['planer_id']; ?> */<br />
								#map_directions<?php echo $planer['planer_id']; ?> {<br />
								}
							</code>
						</div>
					</div>
				</div>
				
				<div class="postbox" style="width: 48%; float: left;">
				<h3><?php _e('General settings', 'google_routeplaner'); ?></h3>
					<div class="inside">
						<p><label for="google_routeplaner_destination" class="formbold"><?php _e('Destination', 'google_routeplaner'); ?></label><br />
						<input type="text" name="google_routeplaner_destination" id="google_routeplaner_destination" style="width: 300px;" value="<?php echo $planer['start_location']; ?>" /><br />
						<i><?php _e('Add a search string for the destination. Adress, company name or something like this.', 'google_routeplaner'); ?></i></p>
						<p><label for="google_routeplaner_map_width" class="formbold"><?php _e('Map width', 'google_routeplaner'); ?></label><br />
						<input type="text" name="google_routeplaner_map_width" id="google_routeplaner_map_width" style="width: 70px;" value="<?php echo $planer['planer_width']; ?>" />
						<select name="google_routeplaner_map_width_unit" id="google_routeplaner_map_width_unit">
							<option value="px"<?php if('px' == $planer['planer_width_unit']) { echo ' selected=""'; } ?>>px</option>
							<option value="%"<?php if('%' == $planer['planer_width_unit']) { echo ' selected=""'; } ?>>%</option>
							<option value="em"<?php if('em' == $planer['planer_width_unit']) { echo ' selected=""'; } ?>>em</option>
						</select>
						<br />
						<i><?php _e('Enter the width for the map.', 'google_routeplaner'); ?></i></p>
						<p><label for="google_routeplaner_map_height" class="formbold"><?php _e('Map heigth', 'google_routeplaner'); ?></label><br />
						<input type="text" name="google_routeplaner_map_height" id="google_routeplaner_map_height" style="width: 70px;" value="<?php echo $planer['planer_height']; ?>" />
						<select name="google_routeplaner_map_height_unit" id="google_routeplaner_map_height_unit">
							<option value="px"<?php if('px' == $planer['planer_height_unit']) { echo ' selected=""'; } ?>>px</option>
							<option value="%"<?php if('%' == $planer['planer_height_unit']) { echo ' selected=""'; } ?>>%</option>
							<option value="em"<?php if('em' == $planer['planer_height_unit']) { echo ' selected=""'; } ?>>em</option>
						</select>
						<br />
						<i><?php _e('Enter the height for the map.', 'google_routeplaner'); ?></i></p>
						
						<p><label for="google_routeplaner_zoom" class="formbold"><?php _e('Map Zoom', 'google_routeplaner'); ?></label><br />
						<select name="google_routeplaner_zoom" id="google_routeplaner_zoom">
							<?php
							$z_level = 0;
							while($z_level <= 18) {
								if($planer['planer_zoom'] == $z_level) {
									echo '<option value="' . $z_level . '" selected="">' . $z_level . '</option>';
								} else {
									echo '<option value="' . $z_level . '">' . $z_level . '</option>';
								}
								$z_level++;
							}
							?>
							
						</select></p>
						
						
						<p><span class="formbold"><?php _e('Auto-Detect users location', 'google_routeplaner'); ?></span><br />
						<input type="radio" name="google_routeplaner_autofill" id="google_routeplaner_autofill_coords" value="1"<?php if(1 == intval($planer['planer_autofill'])) { echo ' checked=""'; } ?> />
						<label for="google_routeplaner_autofill_coords"><?php _e('Get coordinates', 'google_routeplaner'); ?></label><br />
						
						<input type="radio" name="google_routeplaner_autofill" id="google_routeplaner_autofill_city" value="2"<?php if(2 == intval($planer['planer_autofill'])) { echo ' checked=""'; } ?> />
						<label for="google_routeplaner_autofill_city"><?php _e('Get address', 'google_routeplaner'); ?></label><br />
						
						<input type="radio" name="google_routeplaner_autofill" id="google_routeplaner_autofill_no" value="0"<?php if(0 == intval($planer['planer_autofill'])) { echo ' checked=""'; } ?> />
						<label for="google_routeplaner_autofill_no"><?php _e('No detection', 'google_routeplaner'); ?></label><br />
						<i><?php _e('This is based on HTML5 and will work best with mobile devices.', 'google_routeplaner'); ?></i></p>
						
						<p><label for="google_routeplaner_language" class="formbold"><?php _e('Language', 'google_routeplaner'); ?></label><br />
						<select name="google_routeplaner_language" id="google_routeplaner_language">
							<option value=""><?php _e('Default', 'google_routeplaner'); ?></option>
							<?php
							if(is_array($google_routeplaner_langs)) {
								foreach($google_routeplaner_langs as $code => $lang) {
									if($planer['planer_language'] == $code) {
										echo '<option value="' . $code . '" selected="">' . $lang . '</option>';
									} else {
										echo '<option value="' . $code . '">' . $lang . '</option>';
									}
								
								}							
							}							
							?>						
							
						</select><br />
						<i><?php _e('This only effects the route output, not the interface!', 'google_routeplaner'); ?></i></p>
					</div>
				</div>
			
				<p style="clear: both;"><input type="submit" class="button-primary" value="<?php _e('Save changes', 'google_routeplaner'); ?>" />
				<input name="action" value="google_routeplaner_edit_route" type="hidden" />
				<input name="route_id" value="<?php echo $planer['planer_id']; ?>" type="hidden" /></p>
			</form>
		</div>
	</div>
<?php
	}
?>