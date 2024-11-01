=== wp-autosuggest ===
Contributors: eliekhoury, jake1981
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=RDWSGQXGQEBNA&lc=US&item_name=WP%2dAutoSuggest%20WordPress%20Plugin&item_number=wpautosuggest&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: search, autosuggest, ajax
Requires at least: 2.7
Tested up to: 2.8
Stable tag: 0.24

WP AutoSuggest adds the Auto Suggest support to the WordPress search.

== Description ==

WP AutoSuggest adds the `Auto Suggest` support to the WordPress search. The visitor can enter a keyword and the plugin will show him a few suggestion via an AJAX request before submitting the search query. The visitor can continue his search by pressing enter or he/she can use the keyboard arrows (up and down) to visit directly a suggested post.

== Installation ==

Installing WP AutoSuggest is very straight forward:

1. Upload `wp-autosuggest` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. We're done!

Some templates have the search input ID changed which is by default `s`, you change it from the `WP AutoSuggest` settings page.

== Screenshots ==

1. Here is a screenshot of plugin in action with browser that has support for CSS3.
2. A screenshot of plugin in action with browser that does not support CSS3 or has CSS3 support disabled.

== Changelog - from 0.23 to 0.24 ==
 - CSS has been fixed to validate. ( background-image: transparent; -> background: transparent; )
== Changelog - from 0.22 to 0.23 ==
 - Move images to plugin's root directory/images and update CSS accordingly
   to this location. Most wp extensions store images like this and while this
   is completely invisible to end user - it makes it simpler for developers.
 - Pressing enter on search field did not submit form earlierly on all
   browsers. This now has been changed and advantage is that when wp-autosuggest
   is enabled, user can have a form without submit button and form is submitted
   by pressing ENTER when cursor is on search field. (Some browsers would do
   this behavior even without the code)
== Changelog - from 0.21 to 0.22 ==
 - Changed loading of javascript and css to new way which was introduced in
   wordpress 2.7 and should be used since then - this new way to define loading
   of scripts and styles avoids them from loading twice - and there also are
   plugins that allow installation to use google hosted scripts if available
   as well - but they only work if you use this new way.
   Unfortunately this breaks compatibility to older WP installations than 2.7
   - although this COULD be made backwards compatible by checking first if
   wp_enqueue_script and wp_enqueue_style functions are missing and in that
   case software would use the old way. This has not been done in 0.22.
   If you are using older than 2.7 - Do not upgrade to v0.22

== Changelog - from 0.2 to 0.21 ==
 - Changed readme.txt

== Changelog - from 0.1 to 0.2 ==

 - Round corners only worked nicely with white background (images didn't have transparency);
   Removed round corner images for container and made corners round with CSS3.
 - Changed "tip" graphic
 - wp-autosuggest html: layout has been simplified
 - wp-autosuggest css: removed unnecessary parts
 - Localization support added:
	- tested that it works with and without languageswitcher plugin
	- removed setting that contained "no results" text, this now on is fetched from localization file
	- fixed broken support for international characters
 - Fixed a typo in the beginning of javascript file (there was extra "7" before comments in beginning of file)
 - Removed some unnecessary files.
