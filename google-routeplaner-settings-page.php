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
   <form method="post" action="">
	<p><label for="google_routeplaner_language" class="formbold"><?php _e('Language', 'google_routeplaner'); ?></label><br />
	<select name="google_routeplaner_language" id="google_routeplaner_language">
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
	<p><span class="formbold"><?php _e('Donate this plugin', 'google_routeplaner'); ?></span><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_link" value="link"<?php if('link' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
	<label for="google_routeplaner_donate_link"><?php _e('Show a link under the maps', 'google_routeplaner'); ?></label><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_articel" value="articel"<?php if('articel' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
	<label for="google_routeplaner_donate_articel"><?php _e('I write an articel about it', 'google_routeplaner'); ?></label><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_paypal" value="paypal"<?php if('paypal' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
	<label for="google_routeplaner_donate_paypal"><?php _e('I donated with Paypal', 'google_routeplaner'); ?></label><br />
	<input type="radio" name="google_routeplaner_donate" id="google_routeplaner_donate_none" value="none"<?php if('none' == get_option("google_routeplaner_donate")) { echo ' checked="checked"'; } ?> />
	<label for="google_routeplaner_donate_none"><?php _e('I will not donate this project (you will not get support)', 'google_routeplaner'); ?></label></p>
	<p><input type="submit" class="button-primary" value="<?php _e('Save settings', 'google_routeplaner'); ?>" />
	<input name="action" value="google_routeplaner_save_settings" type="hidden" /></p>
   </form>
  </div>