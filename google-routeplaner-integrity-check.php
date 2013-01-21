<?php
$fields = $wpdb->get_results("SHOW FIELDS FROM " . $wpdb->prefix . "google_routeplaner");

if(is_array($fields)) {
	foreach($fields as $field) {
		switch($field->Field) {
			case 'planer_id':
				if('int(11)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'start_location':
				if('varchar(120)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'planer_width':
				if('int(11)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'planer_width_unit':
				if('varchar(5)' !== $field->Type) {
					$gr_error = true;
				}
				break;
			case 'planer_height':
				if('int(11)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'planer_height_unit':
				if('varchar(5)' !== $field->Type) {
					$gr_error = true;
				}
				break;
			case 'planer_zoom':
				if('int(11)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'planer_type':
				if('varchar(120)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'planer_zoom_control':
				if('varchar(120)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'planer_type_control':
				if('varchar(120)' !== $field->Type) {
					$gr_hard_error = true;
				}
				break;
			case 'planer_autofill':
				if('int(11)' !== $field->Type) {
					$gr_error = true;
				}
				break;
			case 'planer_language':
				if('varchar(5)' !== $field->Type) {
					$gr_error = true;
				}
				break;
		}
	}
	if(12 !== count($fields)) {
		$gr_hard_error = true;
	}
}
if($gr_error) {
	google_routeplaner_update(true);
	echo '<p class="error">
		' . __('Error found! Running fix... please reload this page.', 'google_routeplaner') . '
	</p>';
}elseif($gr_hard_error) {
	echo '<p class="error">
		' . __('It seems something went really wrong with your database.', 'google_routeplaner') . '<br />
		' . __('Please deactivate the plugin, delete the google_routeplaner table from your database and activate the plugin again to have a clean installation.', 'google_routeplaner') . '
	</p>';
} else {
	echo '<p class="success">' . __('Everything seems fine!', 'google_routeplaner') . '</p>';
}
?>