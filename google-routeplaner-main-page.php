 <div class="wrap google_routeplaner">
   <div id="icon-google_routeplaner" class="icon32"><br /></div><h2><?php _e('Google Routeplaner', 'google_routeplaner'); ?> &bull; <?php _e('Overview', 'google_routeplaner'); ?></h2>
	<div id="poststuff">
		<div class="postbox" style="width: 30%; float: right;">
			<h3><?php _e('Changelog', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<h5>Version 1.2</h5>
					<ul>
						<li>You can now select a different language for every map</li>
						<li>Fixed a compatiblity issues with the <a href="http://thecartpress.com">TheCartPress</a> plugin</li>
					</ul>
				<h5>Version 1.1</h5>
					<ul>
						<li>Cleaned up Sourcecode</li>
						<li>Removed some validation issues (there are still some remaining)</li>
					</ul>
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
			<h3><?php _e('Support &amp; Feedback', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<p><?php _e('If you have trouble using this plugin, submit your ideas for future development or simply want to let me know what you think please use my Help Desk.', 'google_routeplaner'); ?></p>
				<p style="text-align: center;"><a href="http://support.deformed-design.de"><img src="<?php echo WP_PLUGIN_URL; ?>/google-routeplaner/images/support.png" alt="<?php _e('Support &amp; Feedback', 'google_routeplaner'); ?>" border="0" /></a></p>
			</div>
		</div>
		</div>
	   
	   <div class="postbox" style="width: 30%; float: left; margin-left: 5%;">
		   <h3><?php _e('Enjoy the plugin?', 'google_routeplaner'); ?></h3>
			<div class="inside">
				<p><?php _e('If you like the plugin you can support my work in different ways:', 'google_routeplaner'); ?></p>
					<ul>
						<li><a href="http://wordpress.org/extend/plugins/google_routeplaner/"><?php _e('Rate it on WordPress.org', 'google_routeplaner'); ?></a></li>
						<li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=VAFAKGCDQ2GHU"><?php _e('Donate using PayPal', 'google_routeplaner'); ?></a></li>
						<li><a href="http://www.amazon.de/registry/wishlist/2ZWBSTFQJ9PDU"><?php _e('Take a look at my Amazon wishlist', 'google_routeplaner'); ?></a></li>
					</ul>
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
</div>