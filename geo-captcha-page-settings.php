<?php
// Settings-Page
function geo_captcha_option_page() {
?>
	<script type="text/javascript">
	function copyover() {
		content = document.getElementById("listing").options[document.getElementById("listing").options.selectedIndex].value;
		document.getElementById("geo_captcha_legal").value = document.getElementById("geo_captcha_legal").value + "\n" + content;
	}
	</script>

  <div class="wrap">
    <h2><?php _e('Geo Captcha', 'geo-captcha'); ?> &bull; <?php _e('Settings', 'geo-captcha'); ?></h2>
    <form method="post" action="">
	  <h3><?php _e('Captcha-free Countries', 'geo-captcha'); ?>*</h3>
	  <div style="float: left;"><textarea cols="5" rows="5" id="geo_captcha_legal" name="geo_captcha_legal"><?php echo get_option("geo_captcha_legal"); ?></textarea></div>
	  <div>
	  <input type="button" name="copy" value="<=" onclick="copyover();" />
	  <select id="listing">
		<option value="AF">Afghanistan</option>
		<option value="AX">&Aring;land</option>
		<option value="AL">Albania</option>
		<option value="DZ">Algeria</option>
		<option value="AS">American Samoa</option>
		<option value="AD">Andorra</option>
		<option value="AO">Angola</option>
		<option value="AI">Anguilla</option>
		<option value="AQ">Antarctica</option>
		<option value="AG">Antigua and Barbuda</option>
		<option value="AR">Argentina</option>
		<option value="AM">Armenia</option>
		<option value="AW">Aruba</option>
		<option value="AU">Australia</option>
		<option value="AT">Austria</option>
		<option value="AZ">Azerbaijan</option>
		<option value="BS">Bahamas</option>
		<option value="BH">Bahrain</option>
		<option value="BD">Bangladesh</option>
		<option value="BB">Barbados</option>
		<option value="BY">Belarus</option>
		<option value="BE">Belgium</option>
		<option value="BZ">Belize</option>
		<option value="BJ">Benin</option>
		<option value="BM">Bermuda</option>
		<option value="BT">Bhutan</option>
		<option value="BO">Bolivia</option>
		<option value="BA">Bosnia and Herzegovina</option>
		<option value="BW">Botswana</option>
		<option value="BV">Bouvet Island</option>
		<option value="BR">Brazil</option>
		<option value="IO">British Indian Ocean<br />Territory</option>
		<option value="BN">Brunei Darussalam</option>
		<option value="BG">Bulgaria</option>
		<option value="BF">Burkina Faso</option>
		<option value="BI">Burundi</option>
		<option value="KH">Cambodia</option>
		<option value="CM">Cameroon</option>
		<option value="CA">Canada</option>
		<option value="CV">Cape Verde</option>
		<option value="KY">Cayman Islands</option>
		<option value="CF">Central African Republic</option>
		<option value="TD">Chad</option>
		<option value="CL">Chile</option>
		<option value="CN">China</option>
		<option value="CX">Christmas Island</option>
		<option value="CC">Cocos (Keeling) Islands</option>
		<option value="CO">Colombia</option>
		<option value="KM">Comoros</option>
		<option value="CG">Congo (Brazzaville)</option>
		<option value="CD">Congo (Kinshasa)</option>
		<option value="CK">Cook Islands</option>
		<option value="CR">Costa Rica</option>
		<option value="CI">C&ocirc;te d&#39;Ivoire</option>
		<option value="HR">Croatia</option>
		<option value="CU">Cuba</option>
		<option value="CY">Cyprus</option>
		<option value="CZ">Czech Republic</option>
		<option value="DK">Denmark</option>
		<option value="DJ">Djibouti</option>
		<option value="DM">Dominica</option>
		<option value="DO">Dominican Republic</option>
		<option value="EC">Ecuador</option>
		<option value="EG">Egypt</option>
		<option value="SV">El Salvador</option>
		<option value="GQ">Equatorial Guinea</option>
		<option value="ER">Eritrea</option>
		<option value="EE">Estonia</option>
		<option value="ET">Ethiopia</option>
		<option value="FK">Falkland Islands</option>
		<option value="FO">Faroe Islands</option>
		<option value="FJ">Fiji</option>
		<option value="FI">Finland</option>
		<option value="FR">France</option>
		<option value="GF">French Guiana</option>
		<option value="PF">French Polynesia</option>
		<option value="TF">French Southern Lands</option>
		<option value="GA">Gabon</option>
		<option value="GM">Gambia</option>
		<option value="GE">Georgia</option>
		<option value="DE">Germany</option>
		<option value="GH">Ghana</option>
		<option value="GI">Gibraltar</option>
		<option value="GR">Greece</option>
		<option value="GL">Greenland</option>
		<option value="GD">Grenada</option>
		<option value="GP">Guadeloupe</option>
		<option value="GU">Guam</option>
		<option value="GT">Guatemala</option>
		<option value="GG">Guernsey</option>
		<option value="GN">Guinea</option>
		<option value="GW">Guinea-Bissau</option>
		<option value="GY">Guyana</option>
		<option value="HT">Haiti</option>
		<option value="HM">Heard and McDonald Islands</option>
		<option value="HN">Honduras</option>
		<option value="HK">Hong Kong</option>
		<option value="HU">Hungary</option>
		<option value="IS">Iceland</option>
		<option value="IN">India</option>
		<option value="ID">Indonesia</option>
		<option value="IR">Iran</option>
		<option value="IQ">Iraq</option>
		<option value="IE">Ireland</option>
		<option value="IM">Isle of Man</option>
		<option value="IL">Israel</option>
		<option value="IT">Italy</option>
		<option value="JM">Jamaica</option>
		<option value="JP">Japan</option>
		<option value="JE">Jersey</option>
		<option value="JO">Jordan</option>
		<option value="KZ">Kazakhstan</option>
		<option value="KE">Kenya</option>
		<option value="KI">Kiribati</option>
		<option value="KP">Korea, North</option>
		<option value="KR">Korea, South</option>
		<option value="KW">Kuwait</option>
		<option value="KG">Kyrgyzstan</option>
		<option value="LA">Laos</option>
		<option value="LV">Latvia</option>
		<option value="LB">Lebanon</option>
		<option value="LS">Lesotho</option>
		<option value="LR">Liberia</option>
		<option value="LY">Libya</option>
		<option value="LI">Liechtenstein</option>
		<option value="LT">Lithuania</option>
		<option value="LU">Luxembourg</option>
		<option value="MO">Macau</option>
		<option value="MK">Macedonia</option>
		<option value="MG">Madagascar</option>
		<option value="MW">Malawi</option>
		<option value="MY">Malaysia</option>
		<option value="MV">Maldives</option>
		<option value="ML">Mali</option>
		<option value="MT">Malta</option>
		<option value="MH">Marshall Islands</option>
		<option value="MQ">Martinique</option>
		<option value="MR">Mauritania</option>
		<option value="MU">Mauritius</option>
		<option value="YT">Mayotte</option>
		<option value="MX">Mexico</option>
		<option value="FM">Micronesia</option>
		<option value="MD">Moldova</option>
		<option value="MC">Monaco</option>
		<option value="MN">Mongolia</option>
		<option value="ME">Montenegro</option>
		<option value="MS">Montserrat</option>
		<option value="MA">Morocco</option>
		<option value="MZ">Mozambique</option>
		<option value="MM">Myanmar</option>
		<option value="NA">Namibia</option>
		<option value="NR">Nauru</option>
		<option value="NP">Nepal</option>
		<option value="NL">Netherlands</option>
		<option value="AN">Netherlands Antilles</option>
		<option value="NC">New Caledonia</option>
		<option value="NZ">New Zealand</option>
		<option value="NI">Nicaragua</option>
		<option value="NE">Niger</option>
		<option value="NG">Nigeria</option>
		<option value="NU">Niue</option>
		<option value="NF">Norfolk Island</option>
		<option value="MP">Northern Mariana Islands</option>
		<option value="NO">Norway</option>
		<option value="OM">Oman</option>
		<option value="PK">Pakistan</option>
		<option value="PW">Palau</option>
		<option value="PS">Palestine</option>
		<option value="PA">Panama</option>
		<option value="PG">Papua New Guinea</option>
		<option value="PY">Paraguay</option>
		<option value="PE">Peru</option>
		<option value="PH">Philippines</option>
		<option value="PN">Pitcairn</option>
		<option value="PL">Poland</option>
		<option value="PT">Portugal</option>
		<option value="PR">Puerto Rico</option>
		<option value="QA">Qatar</option>
		<option value="RE">Reunion</option>
		<option value="RO">Romania</option>
		<option value="RU">Russian Federation</option>
		<option value="RW">Rwanda</option>
		<option value="BL">Saint Barth&eacute;lemy</option>
		<option value="SH">Saint Helena</option>
		<option value="KN">Saint Kitts and Nevis</option>
		<option value="LC">Saint Lucia</option>
		<option value="MF">Saint Martin (French part)</option>
		<option value="PM">Saint Pierre and Miquelon</option>
		<option value="VC">Saint Vincent and the<br />Grenadines</option>
		<option value="WS">Samoa</option>
		<option value="SM">San Marino</option>
		<option value="ST">Sao Tome and Principe</option>
		<option value="SA">Saudi Arabia</option>
		<option value="SN">Senegal</option>
		<option value="RS">Serbia</option>
		<option value="SC">Seychelles</option>
		<option value="SL">Sierra Leone</option>
		<option value="SG">Singapore</option>
		<option value="SK">Slovakia</option>
		<option value="SI">Slovenia</option>
		<option value="SB">Solomon Islands</option>
		<option value="SO">Somalia</option>
		<option value="ZA">South Africa</option>
		<option value="GS">South Georgia and South<br />Sandwich Islands</option>
		<option value="ES">Spain</option>
		<option value="LK">Sri Lanka</option>
		<option value="SD">Sudan</option>
		<option value="SR">Suriname</option>
		<option value="SJ">Svalbard and Jan Mayen<br />Islands</option>
		<option value="SZ">Swaziland</option>
		<option value="SE">Sweden</option>
		<option value="CH">Switzerland</option>
		<option value="SY">Syria</option>
		<option value="TW">Taiwan</option>
		<option value="TJ">Tajikistan</option>
		<option value="TZ">Tanzania</option>
		<option value="TH">Thailand</option>
		<option value="TL">Timor-Leste</option>
		<option value="TG">Togo</option>
		<option value="TK">Tokelau</option>
		<option value="TO">Tonga</option>
		<option value="TT">Trinidad and Tobago</option>
		<option value="TN">Tunisia</option>
		<option value="TR">Turkey</option>
		<option value="TM">Turkmenistan</option>
		<option value="TC">Turks and Caicos Islands</option>
		<option value="TV">Tuvalu</option>
		<option value="UG">Uganda</option>
		<option value="UA">Ukraine</option>
		<option value="AE">United Arab Emirates</option>
		<option value="GB">United Kingdom</option>
		<option value="UM">United States Minor<br />Outlying Islands</option>
		<option value="US">United States of America</option>
		<option value="UY">Uruguay</option>
		<option value="UZ">Uzbekistan</option>
		<option value="VU">Vanuatu</option>
		<option value="VA">Vatican City</option>
		<option value="VE">Venezuela</option>
		<option value="VN">Vietnam</option>
		<option value="VG">Virgin Islands, British</option>
		<option value="VI">Virgin Islands, U.S.</option>
		<option value="WF">Wallis and Futuna Islands</option>
		<option value="EH">Western Sahara</option>
		<option value="YE">Yemen</option>
		<option value="ZM">Zambia</option>
		<option value="ZW">Zimbabwe</option>
		</select>
		</div>
	
	  <p style="clear: both;"><small>* <?php _e('Insert the country codes (ISO 3166-1, A-2) for the countries which donot need to insert a captcha code seperated with new lines.', 'geo-captcha'); ?></small></p>
	  
	  <h3><?php _e('Use Geo Captcha for comments?', 'geo-captcha'); ?></h3>
	  <?php if(1 == get_option("geo_captcha_comments")) :  ?>
		<p><label for="geo_captcha_comments_yes"><?php _e('Yes', 'geo-captcha'); ?></label> <input type="radio" id="geo_captcha_comments_yes" name="geo_captcha_comments" value="1" checked="checked" /> 
		<label for="geo_captcha_comments_no"><?php _e('No', 'geo-captcha'); ?></label> <input type="radio" id="geo_captcha_comments_no" name="geo_captcha_comments" value="0" />
	  <?php else : ?>	  
		<p><label for="geo_captcha_comments_yes"><?php _e('Yes', 'geo-captcha'); ?></label> <input type="radio" id="geo_captcha_comments_yes" name="geo_captcha_comments" value="1" /> 
		<label for="geo_captcha_comments_no"><?php _e('No', 'geo-captcha'); ?></label> <input type="radio" id="geo_captcha_comments_no" name="geo_captcha_comments" value="0" checked="checked" />
	  <?php endif; ?>
	  </p>
	  
	  <h3><?php _e('Use Geo Captcha for registration?', 'geo-captcha'); ?></h3>
	  <?php if(1 == get_option("geo_captcha_registration")) :  ?>
		<p><label for="geo_captcha_registration_yes"><?php _e('Yes', 'geo-captcha'); ?></label> <input type="radio" id="captcha_registration_yes" name="geo_captcha_registration" value="1" checked="checked" /> 
		<label for="geo_captcha_registration_no"><?php _e('No', 'geo-captcha'); ?></label> <input type="radio" id="geo_captcha_registration_no" name="geo_captcha_registration" value="0" />
	  <?php else : ?>	  
		<p><label for="geo_captcha_registration_yes"><?php _e('Yes', 'geo-captcha'); ?></label> <input type="radio" id="geo_captcha_registration_yes" name="geo_captcha_registration" value="1" /> 
		<label for="geo_captcha_registration_no"><?php _e('No', 'geo-captcha'); ?></label> <input type="radio" id="geo_captcha_registration_no" name="geo_captcha_registration" value="0" checked="checked" />
	  <?php endif; ?>
	  </p>
	  
	  <h3><?php _e('Log ips?', 'geo-captcha'); ?></h3>
	  <?php if(1 == get_option("geo_captcha_log_ips")) :  ?>
		<p><label for="log_ips_yes"><?php _e('Yes', 'geo-captcha'); ?></label> <input type="radio" id="log_ips_yes" name="geo_captcha_log_ips" value="1" checked="checked" /> 
		<label for="log_ips_no"><?php _e('No', 'geo-captcha'); ?></label> <input type="radio" id="log_ips_no" name="geo_captcha_log_ips" value="0" />
	  <?php else : ?>	  
		<p><label for="log_ips_yes"><?php _e('Yes', 'geo-captcha'); ?></label> <input type="radio" id="log_ips_yes" name="geo_captcha_log_ips" value="1" /> 
		<label for="log_ips_no"><?php _e('No', 'geo-captcha'); ?></label> <input type="radio" id="log_ips_no" name="geo_captcha_log_ips" value="0" checked="checked" />
	  <?php endif; ?>
	  <br />
	  <small><?php _e('Please turn this setting to No if you are not allowed to log ips in your country!', 'geo-captcha'); ?></small></p>
	  
      <input type="submit" class="button-primary" value="<?php _e('Save', 'geo-captcha'); ?>" />
      <input name="action" value="changesettings" type="hidden" />
    </form>
   </div>

<?php
} // End of function geo_captcha_option_page()
?>