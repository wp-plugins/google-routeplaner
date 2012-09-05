 <div class="wrap google_routeplaner">
   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Settings', 'google_routeplaner'); ?></h2>
	<?php
	/*
	 * Save Settings
	 */
	if ('google_routeplaner_save_settings' == $_POST['action'])
	{
		update_option("google_routeplaner_language", $_POST['google_routeplaner_language']);
		update_option("google_routeplaner_donate", $_POST['google_routeplaner_donate']);
		echo '<p class="success">' . __('Settings saved!', 'google_routeplaner') . '</p>';
	}
	?>
	
	<div id="poststuff"> 
	<form method="post" action="">
		<div class="postbox" style="width: 48%; float: right;">
			<h3><?php _e('Donation settings', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<p><?php _e('Developing this plugin and helping those who have trouble with it costs a lot of time. Please consider a small donation using PayPal or Amazon.', 'google_routeplaner'); ?></p>
				<p><strong><?php _e('Personal use', 'google_routeplaner'); ?></strong><br />
				<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_personal_link" value="personal_link"<?php if('personal_link' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
				<label for="google_routeplaner_donate_personal_link"><?php _e('Show <em>Powered-by</em> below maps (Support available)', 'google_routeplaner'); ?></label><br />
				
				<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_personal_no_link" value="personal_no_link"<?php if('personal_no_link' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
				<label for="google_routeplaner_donate_personal_no_link"><?php _e('Remove <em>Powered-by</em> (Support NOT available)', 'google_routeplaner'); ?></label><br />
				
				<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_personal_paypal" value="personal_paypal"<?php if('personal_paypal' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
				<label for="google_routeplaner_donate_personal_paypal"><?php _e('I donated with PayPal or Amazon, remove <em>Powered-by</em> (Support available)', 'google_routeplaner'); ?></label></p>
				
				<p><strong><?php _e('Commercial use', 'google_routeplaner'); ?></strong><br />
				<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_commercial_link" value="commercial_link"<?php if('commercial_link' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
				<label for="google_routeplaner_donate_commercial_link"><?php _e('Show <em>Powered-by</em> below maps (Support NOT available)', 'google_routeplaner'); ?></label><br />
				
				<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_commercial_paypal" value="commercial_paypal"<?php if('commercial_paypal' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
				<label for="google_routeplaner_donate_commercial_paypal"><?php _e('I donated with PayPal or Amazon, remove <em>Powered-by</em> (Support available)', 'google_routeplaner'); ?></label></p>
			</div>
		</div>
		
 	   <div class="postbox" style="width: 48%; float: left;">
		   <h3><?php _e('Language', 'google_routeplaner'); ?></h3>
		   <div class="inside">
				<p><?php _e('You can set the language for the Google driving directions for all maps. You can overwrite this setting for every map.', 'google_routeplaner'); ?></p>
				<p><select name="google_routeplaner_language" id="google_routeplaner_language">
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
				</select><br />
				<i><?php _e('Set language for driving information.', 'google_routeplaner'); ?></i></p>
			</div>
		</div>
	
		<p style="clear: both;"><input type="submit" class="button-primary" value="<?php _e('Save settings', 'google_routeplaner'); ?>" />
		<input name="action" value="google_routeplaner_save_settings" type="hidden" /></p>
	   </form>
   </div>
</div>