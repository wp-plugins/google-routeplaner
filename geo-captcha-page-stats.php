<?php
// Stats-Page
function geo_captcha_stats_page() {
	$geocaptcha_evenodd = true;

	global $wpdb, $table_prefix;
	
	$country_stats = $wpdb->get_results("SELECT * FROM " . $table_prefix . "geo_captcha_stats ORDER BY country", ARRAY_A); 
	
?>
<style type="text/css">
@import url("<?php echo WP_PLUGIN_URL; ?>/geo-captcha/geo-captcha.css");
</style>
<div class="wrap geocaptcha">
	<h2><?php _e('Geo Captcha', 'geo-captcha'); ?> &bull; <?php _e('Stats', 'geo-captcha'); ?></h2>
	<div id="poststuff">
		<div class="postbox" style="width: 30%; float: right;">
		  <h3><?php _e('General Stats', 'geo-captcha'); ?></h3>
		  <div class="inside">
			  <table class="widefat" cellpadding="0" cellspacing="0">
			   <tr class="<?php if($geocaptcha_evenodd) { echo 'alt'; $geocaptcha_evenodd = false; } else { $geocaptcha_evenodd = true; } ?>">
				<th><?php _e('Spam comments blocked by Geo Captcha:', 'geo-captcha'); ?></td>
				<td><?php echo nl2br(get_option('geo_captcha_blocked_spam')); ?></td>
			  </tr>
			  <tr class="<?php if($geocaptcha_evenodd) { echo 'alt'; $geocaptcha_evenodd = false; } else { $geocaptcha_evenodd = true; } ?>">
			   <th><?php _e('Commentators entered correct Captcha:', 'geo-captcha'); ?></td>
			   <td><?php echo nl2br(get_option('geo_captcha_not_whitelisted_comments')); ?></td>
			  </tr>
			  <tr class="<?php if($geocaptcha_evenodd) { echo 'alt'; $geocaptcha_evenodd = false; } else { $geocaptcha_evenodd = true; } ?>">
			   <th><?php _e('Comments from whitelisted countries:', 'geo-captcha'); ?></td>
			   <td><?php echo nl2br(get_option('geo_captcha_whitelisted_comments')); ?></td>
			  </tr>
			  <tr class="<?php if($geocaptcha_evenodd) { echo 'alt'; $geocaptcha_evenodd = false; } else { $geocaptcha_evenodd = true; } ?>">
			   <th><?php _e('Comments from registered users:', 'geo-captcha'); ?></td>
			   <td><?php echo nl2br(get_option('geo_captcha_registered_comments')); ?></td>
			  </tr>
			  <tr class="<?php if($geocaptcha_evenodd) { echo 'alt'; $geocaptcha_evenodd = false; } else { $geocaptcha_evenodd = true; } ?>">
			   <th><?php _e('Comments manuelly marked as spam:', 'geo-captcha'); ?></td>
			   <td><?php echo nl2br(get_option('geo_captcha_manuell_spam')); ?></td>
			  </tr>
			  <tr class="<?php if($geocaptcha_evenodd) { echo 'alt'; $geocaptcha_evenodd = false; } else { $geocaptcha_evenodd = true; } ?>">
			   <th><?php _e('Spam comments from whitelisted countries:', 'geo-captcha'); ?></td>
			   <td><?php echo nl2br(get_option('geo_captcha_whitelisted_spam')); ?></td>
			  </tr>
			 </table>
			</div>
		</div>
		 <?php $geocaptcha_evenodd = true; ?>
		<div class="postbox" style="width: 60%; float: left;">
			<h3><?php _e('Country Stats', 'geo-captcha'); ?></h3>
			<div class="inside">
				<table class="widefat" cellpadding="5" cellspacing="0">
				  <tr>
				   <th><?php _e('Country', 'geo-captcha'); ?></th>
				   <th><?php _e('Correct Captcha', 'geo-captcha'); ?></th>
				   <th><?php _e('Wrong Captcha', 'geo-captcha'); ?></th>
				   <th><?php _e('Percentage', 'geo-captcha'); ?></th>
				  </tr>
				   <?php if(is_array($country_stats)) { foreach($country_stats as $country_s) { ?>
				   <tr<?php if($geocaptcha_evenodd) { echo ' class="alternate"'; $geocaptcha_evenodd = false; } else { $geocaptcha_evenodd = true; } ?>">
					 <?php
					 $resultsum = intval($country_s['positiv_count']) + intval($country_s['negativ_count']);
					 $percent = $resultsum / 100;
					 $pospercent = round(intval($country_s['positiv_count']) / $percent);
					 ?>
					 <td><?php echo $country_s['country']; ?></td>
					 <td><?php echo $country_s['positiv_count']; ?></td>
					 <td><?php echo $country_s['negativ_count']; ?></td>
					 <td><div style="width: 100px; height: 11px; background: #FFF url(<?php echo WP_PLUGIN_URL; ?>/geo-captcha/bar.gif) no-repeat; background-position: -<?php echo $pospercent; ?>px 0px;"></div></td>
				   </tr>
				  <?php }} ?>
				 </table>
			</div>
		</div>
</div>
<?php
} // End of function geo_captcha_log_page()
?>