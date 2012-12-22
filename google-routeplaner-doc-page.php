<div class="wrap google_routeplaner">
	<div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplanner', 'google_routeplaner'); ?> &bull; <?php _e('Documentation', 'google_routeplaner'); ?></h2>
	<div id="poststuff">
		<div class="postbox">
			<h3><?php _e('Theme the routeplanner', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<p><?php _e('You can use your themes CSS file to edit how the routeplanners output looks on your page.', 'google_routeplaner'); ?></p>
				<p><strong><?php _e('Classes', 'google_routeplaner'); ?></strong></p>
				<p><?php _e('To effect all maps on your website you can use the following classes:', 'google_routeplaner'); ?></p>
				<ul>
					<li>google_map_controls (<?php _e('The area with the input field', 'google_routeplaner'); ?>)</li>
					<li>google_map_canvas (<?php _e('The map itself', 'google_routeplaner'); ?>)</li>
					<li>google_map_directions (<?php _e('The driving directions displayed below the map', 'google_routeplaner'); ?>)</li>
				</ul>
				<p><?php _e('Example', 'google_routeplaner'); ?></p>
				<p><code>.google_map_directions {<br />
				&nbsp;&nbsp;&nbsp;background-color: #FF0000;<br />
				}</code><br />
				<?php _e('This will set the background color for the directions of all maps to red.', 'google_routeplaner'); ?></p>
				
				<p><strong><?php _e('IDs', 'google_routeplaner'); ?></strong></p>
				<p><?php _e('To effect only a specific map on your website you can use IDs.', 'google_routeplaner'); ?></p>
				<ul>
					<li>map_controls$ (<?php _e('The area with the input field', 'google_routeplaner'); ?>)</li>
					<li>map_canvas$ (<?php _e('The map itself', 'google_routeplaner'); ?>)</li>
					<li>map_directions$ (<?php _e('The driving directions displayed below the map', 'google_routeplaner'); ?>)</li>
				</ul>
				<p><?php _e('You have to replace the $ with the maps ID.', 'google_routeplaner'); ?></p>
				<p><?php _e('Example', 'google_routeplaner'); ?></p>
				<p><code>#map_directions4 {<br />
				&nbsp;&nbsp;&nbsp;color: #FFF;<br />
				}</code><br />
				<?php _e('This will set the text color for the directions of the map with the ID 4 to red.', 'google_routeplaner'); ?></p>
			
			</div>	
	</div>
</div>