=== Plugin Name ===
Contributors: Deformed Design
Tags: comments, spam, captcha, geographic, antispam
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 1.9

Geo Captcha shows a captcha image only to countries you don't trust.

== Description ==

There are a lot of great plugins to prevent spam but especially the effectiv captcha images can annoy your human visitors. 
Geo Captcha uses the knowledge that a lot of spam is caused from a few countries and prevents them from spamming.

Visitors from the countries on your whitelist will never see a captcha image and will not be annoyed. 
Visitors from other countries will have to type in the captcha code or their comments and registrations will be blocked.

The location of the visitors is checked using the GeoLite Country-Library from MaxMind (http://www.maxmind.com).
The captcha image is generated using SecurImage from drew010 (http://www.phpcaptcha.org).

== Installation ==

1. Upload `geo-captcha`-folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set up the whitelist in the Geo Captcha Settings

= Usage =

You can activate and deactivate the geocaptcha function for comments and registration in the settings.
Add the country codes of the countries you don't want to insert a captcha to the list in the plugins settings.
Check you log to see the countries which cause a lot of spam or who are false positivs.

== Changelog ==
= 1.9 =
* Manually as spam marked comments will now affect the statistics
* Latest country database added
* Improved design
* I did NOT replace securimage because the latest version did not work as expected

= 1.2 =
* Now works for comments and registration
* Improved log function
* IP logging possible
* Included country code list
* Latest country database added

= 1.0 =
* Small bugfixes

= 0.9 =
* Plugin release

== Screenshots ==

1. logo.jpg
2. screenshot-1.gif
3. screenshot-2.gif
4. screenshot-3.gif