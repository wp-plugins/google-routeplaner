<?php
// About-Page
function geo_captcha_about_page() {
?>
<style type="text/css">
@import url("<?php echo WP_PLUGIN_URL; ?>/geo-captcha/geo-captcha.css");
</style>
<div class="wrap geocaptcha">
   <h2><?php _e('Geo Captcha', 'geo-captcha'); ?> &bull; <?php _e('About', 'geo-captcha'); ?></h2>
   <div id="poststuff">
		<div class="postbox" style="width: 30%; float: right;">
			<h3><?php _e('Changelog', 'geo-captcha'); ?></h3>
			<div class="inside">
				<h5>Version 1.5</h5>
					<ul class="lister">
						<li>Manually as spam marked comments will now affect the statistics</li>
						<li>Latest country database added</li>
						<li>Improved design</li>
						<li>I did NOT replace securimage because the latest version did not work as expected</li>
					</ul>
				<h5>Version 1.2</h5>
					<ul>
						<li>Now works for comments and registration</li>
						<li>Improved log function</li>
						<li>IP logging possible</li>
						<li>Included country code list</li>
						<li>Latest country database added</li>
					</ul>
				<h5>Version 1.0</h5>
					<ul>
						<li>Small bugfixes</li>
					</ul>
				<h5>Version 0.9</h5>
					<ul>
						<li>Plugin release</li>
					</ul>
		   </div>
		</div>
		
		<div style="width: 30%; float: left;">
			<div class="postbox">
				<h3><?php _e('About', 'geo-captcha'); ?></h3>
				<div class="inside">
					<p><?php _e('There are a lot of great plugins to prevent spam but especially the effectiv captcha images can annoy your human visitors. Geo Captcha uses the knowledge that a lot of spam is caused from a few countries and prevents them from spamming.', 'geo-captcha'); ?></p>
					<p><?php _e('Visitors from the countries on your whitelist will never see a captcha image and will not be annoyed. Visitors from other countries will have to type in the captcha code or their comments and registrations will be blocked.', 'geo-captcha'); ?></p>
				</div>
			</div>
			
			<div class="postbox">
				<h3><?php _e('Credits', 'geo-captcha'); ?></h3>
				<div class="inside">
				   <p><?php _e('The location of the visitors is checked using the GeoLite Country-Library from <a href="http://www.maxmind.com">MaxMind</a>.', 'geo-captcha'); ?></p>
				   <p><?php _e('The captcha image is generated using <a href="http://www.phpcaptcha.org">SecurImage</a> from drew010.', 'geo-captcha'); ?></p>
				</div>
			</div>
		</div>
		
		<div style="width: 30%; float: left; margin-left: 5%;">
			<div class="postbox">
				<h3><?php _e('Enjoy the plugin?', 'geo-captcha'); ?></h3>
				<div class="inside">
					<p><?php _e('If you like the plugin you can support my work in different ways:!', 'geo-captcha'); ?></p>
					<ul>
						<li><a href="http://wordpress.org/extend/plugins/geo-captcha/"><?php _e('Rate it on WordPress.org', 'geo-captcha'); ?></a></li>
						<li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2H38X62RW86SL"><?php _e('Donate using PayPal', 'geo-captcha'); ?></a></li>
						<li><a href="http://www.amazon.de/registry/wishlist/2ZWBSTFQJ9PDU"><?php _e('Take a look at my Amazon wishlist', 'geo-captcha'); ?></a></li>
				</div>
			</div>
			
			<div class="postbox">
				<h3><?php _e('Support', 'geo-captcha'); ?></h3>
				<div class="inside">
					<p><?php _e('If you encounter any problems feel free to use our <a href="http://support.deformed-design.de">Help Desk</a>.', 'geo-captcha'); ?></p>
				</div>
			</div>
		</div>
		
		<div class="postbox" style="clear: both;">
			<h3><?php _e('Uninstall', 'geo-captcha'); ?></h3>
			<div class="inside">
				<form method="post" action="">
					<p><?php _e('Yes, I want to uninstall Geo Captcha', 'geo-captcha'); ?> <input name="uninstall_shure" value="y" type="checkbox" /></p>
					<p><input type="submit" class="button" value="<?php _e('Full Uninstall Geo Captcha', 'geo-captcha'); ?>" />
					<input name="action" value="full_uninstall_geo_captcha" type="hidden" /></p>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
} // End of function geo_captcha_about_page()
?>