<?php
	global $wpdb, $table_prefix;

	$planers = $wpdb->get_results("SELECT * FROM " . $table_prefix . "google_routeplaner ORDER BY planer_id", ARRAY_A); 
?>
  <div class="wrap google_routeplaner">
   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Routes', 'google_routeplaner'); ?></h2>
   <p><a href="admin.php?page=google_routeplaner_routes&amp;routeplaner_action=google_routeplaner_add_route" class="button-primary"><?php _e('Create Route', 'google_routeplaner'); ?></a></p>
   <table class="widefat" cellspacing="0" cellpadding="0">
	<thead>
    <tr class="column-cb">
	 <th><?php _e('ID', 'google_routeplaner'); ?></th>
	 <th><?php _e('Destination', 'google_routeplaner'); ?></th>
	 <th><?php _e('Code', 'google_routeplaner'); ?></th>
	 <th><?php _e('Actions', 'google_routeplaner'); ?></th>
	</tr>
   </thead>
   <tfoot>
    <tr class="column-cb">
	 <th><?php _e('ID', 'google_routeplaner'); ?></th>
	 <th><?php _e('Destination', 'google_routeplaner'); ?></th>
	 <th><?php _e('Code', 'google_routeplaner'); ?></th>
	 <th><?php _e('Actions', 'google_routeplaner'); ?></th>
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
			<a href="admin.php?page=google_routeplaner_routes&amp;routeplaner_action=preview_route&amp;route_id=' . $planer['planer_id'] . '" class="button">' . __('preview', 'google_routeplaner') . '</a>
			<a href="admin.php?page=google_routeplaner_routes&amp;routeplaner_action=edit_route&amp;route_id=' . $planer['planer_id'] . '" class="button">' . __('edit', 'google_routeplaner') . '</a>
			<a href="admin.php?page=google_routeplaner_routes&amp;routeplaner_action=delete_route&amp;route_id=' . $planer['planer_id'] . '" class="button">' . __('delete', 'google_routeplaner') . '</a>
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
   </div>