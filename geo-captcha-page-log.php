<?php
// Log-Page
function geo_captcha_log_page() {
	global $wpdb, $table_prefix;
	
	$logs = $wpdb->get_results("SELECT * FROM " . $table_prefix . "geo_captcha_log ORDER BY date DESC", ARRAY_A); 
	
?>
<style type="text/css">
@import url("<?php echo WP_PLUGIN_URL; ?>/geo-captcha/geo-captcha.css");
</style>
  <div class="wrap">
   <h2><?php _e('Geo Captcha', 'geo-captcha'); ?> &bull; <?php _e('Logs', 'geo-captcha'); ?></h2>
   <p><?php _e('The log shows you all comments and registrations checked by Geo Captcha. Entries marked with a warning sign have failed entering the captcha corretly.', 'geo-captcha'); ?></p>
   <table class="widefat geocaptcha_log">
     <thead>
       <tr>
	     <th><?php _e('Country', 'geo-captcha'); ?></th>
		 <th><?php _e('Date', 'geo-captcha'); ?></th>
		 <th><?php _e('Location', 'geo-captcha'); ?></th>
		 <th><?php _e('IP-Address', 'geo-captcha'); ?></th>
	   </tr>   
     </thead>
	 <tfoot>
       <tr>
	     <th><?php _e('Country', 'geo-captcha'); ?></th>
		 <th><?php _e('Date', 'geo-captcha'); ?></th>
		 <th><?php _e('Location', 'geo-captcha'); ?></th>
		 <th><?php _e('IP-Address', 'geo-captcha'); ?></th>
	   </tr>   
     </tfoot>
     <tbody>
	<?php 
	if(is_array($logs)) {
		foreach($logs as $log) {
		?>
		<tr>
		  <td><img src="<?php echo WP_PLUGIN_URL; ?>/geo-captcha/icon_<?php echo $log['type']; ?>.png" alt="" border="0" /> <?php echo $log['country']; ?></td>
		  <td><?php echo date("d.m.Y H:i:s", strtotime($log['date'])); ?></td>
		  <td>
		  <?php
		  if('comments' == $log['where']) {
			_e('Comments', 'geo-captcha');
		  } elseif ('registration' == $log['where']) {
			_e('Registration', 'geo-captcha');
		  } else {
			_e('Unknown', 'geo-captcha');
		  }
		  ?>
		  </td>
		  <td><?php echo $log['ip']; ?></td>
		</tr>
		<?php
		}
	}
	 ?>
	 </tbody>
   </table>
   <p>
   <form method="post" action="">
      <input type="submit" class="button" value="<?php _e('Clear Log', 'geo-captcha'); ?>" />
      <input name="action" value="clear_log" type="hidden" />
    </form>
	</p>
  </div>
<?php
} // End of function geo_captcha_log_page()
?>