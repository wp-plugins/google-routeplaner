 <div class="wrap google_routeplaner">
   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplanner', 'google_routeplaner'); ?> &bull; <?php _e('Settings', 'google_routeplaner'); ?></h2>
	<?php
	/*
	 * Save Settings
	 */
	if ('google_routeplaner_save_settings' == $_POST['action'])
	{
		update_option("google_routeplaner_language", $_POST['google_routeplaner_language']);
		update_option("google_routeplaner_donate", $_POST['google_routeplaner_donate']);
		update_option("google_routeplaner_viewport", $_POST['google_routeplaner_viewport']);
		echo '<p class="success">' . __('Settings saved!', 'google_routeplaner') . '</p>';
	}
	?>
	<script>
	jQuery(document).ready(function(){
		jQuery("#google_routeplaner_donate_no_link").click(function() {
			jQuery("#donate_note").slideDown('slow', function() {
			});
		});
	});
	</script>
	<div id="poststuff"> 
	<form method="post" action="">
		<div style="width: 48%; float: right;">
			<div class="postbox">
				<h3><?php _e('Donation settings', 'google_routeplaner'); ?></h3>
				<div class="inside">
					<p><?php _e('Developing this plugin and helping those who have trouble with it costs a lot of time. Please consider a small donation using PayPal or Amazon.', 'google_routeplaner'); ?></p>
					<p><input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_link" value="show_link"<?php if('show_link' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
					<label for="google_routeplaner_donate_link"><?php _e('Show <em>Powered-by</em> below maps to support the developer.', 'google_routeplaner'); ?></label><br />
					
					<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_no_link" value="no_link"<?php if('no_link' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
					<label for="google_routeplaner_donate_no_link"><?php _e('No <em>Powered-by</em> below maps, please consider another way to support the developer.', 'google_routeplaner'); ?></label></p>
					
					<div id="donate_note"<?php if('show_link' == get_option("google_routeplaner_donate")) { echo ' style="display: none;"'; } ?> class="gr_notice">
						<p><?php _e('Developing this plugin is a lot of work and completly free for you. You can also get free support if you need help.', 'google_routeplaner'); ?></p>
						<p><?php _e('Please consider a small donation for my work.', 'google_routeplaner'); ?></p>
						<ul style="list-style-type: none;">
							<li><img src="<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/images/icon_paypal.png" alt="" /> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=VAFAKGCDQ2GHU"> <?php _e('Donate using PayPal', 'google_routeplaner'); ?></a></li>
							<li><img src="<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/images/icon_amazon.png" alt="" /> <a href="http://www.amazon.de/registry/wishlist/2ZWBSTFQJ9PDU"> <?php _e('Take a look at my Amazon wishlist', 'google_routeplaner'); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		
			<div class="postbox">
				<h3><?php _e('Viewport settings', 'google_routeplaner'); ?></h3>
				<div class="inside">
					<p><?php _e('If you have set your viewport with another plugin you can disable the viewport output from this plugin.', 'google_routeplaner'); ?></p>
					<p><input type="radio" name="google_routeplaner_viewport" id="google_routeplaner_viewport_yes" value="yes"<?php if('yes' == get_option("google_routeplaner_viewport")) { echo ' checked="checked"'; } ?> />
					<label for="google_routeplaner_viewport_yes"><?php _e('Yes, use viewport.'); ?></label><br />
					
					<input type="radio" name="google_routeplaner_viewport" id="google_routeplaner_viewport_no" value="no"<?php if('no' == get_option("google_routeplaner_viewport")) { echo ' checked="checked"'; } ?> />
					<label for="google_routeplaner_viewport_no"><?php _e('No, do NOT use viewport.', 'google_routeplaner'); ?></label></p>
				</div>
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
				<i><?php _e('Set language for driving information, this does not effect the interface.', 'google_routeplaner'); ?></i></p>
			</div>
		</div>
	
		<p style="clear: both;"><input type="submit" class="button-primary" value="<?php _e('Save settings', 'google_routeplaner'); ?>" />
		<input name="action" value="google_routeplaner_save_settings" type="hidden" /></p>
	   </form>
   </div>
</div>