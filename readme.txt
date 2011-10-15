=== Google Routeplaner ===
Contributors: Deformed Design
Tags: route, google, map, route planer, planer
Requires at least: 2.7
Tested up to: 3.2.1
Stable tag: 1.0

Creates a route planer based on google maps.

== Description ==

You can create multiple routeplaners and define the ending position. 
You can give your readers the ability to plan a route from where they live to your location, an event you promote or another place you have written about.

== Installation ==

1. Upload `google_routeplaner`-folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

= Usage =

After activating the plugin there is a new menu in your admin interface of WordPress called `Routeplaner`. Open the menu and choose `routes` from the submenu. 
Now click on `Create Route` and insert a destination. Change the rest of the settings like you want the map to look like. You can add advance CSS information for the different
section of the route planer.

map_controls - location field and submit button
map_canvas - the map itself
map_directions - the driving information

Save the route and you will recieve a code to insert into your page. The code looks like [googlerouteplaner=1] (the number is your routes id and changes for every route). Just insert this code to your page or post - done.

== Frequently Asked Questions ==

= Why can't I define the zoom? =

It seems Google Maps is unable to recieve custom zoom information when used as routeplaner. If you have any idea how to solve this problem, please contact me.

= Can I add multiple maps to a single page? =

No, this is not possible at the moment.

== Changelog ==

= 1.0 =
* Updated to Google Maps API V3
* No more API Key required
* Overview Map no longer available due to it's not available in Google Maps API V3
* Improved design

= 0.6 =
* Displays the code for each route in the admin section
* Added a preview function to the admin section

= 0.5 =
* Plugin release

== Screenshots ==

1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg
4. screenshot-4.jpg