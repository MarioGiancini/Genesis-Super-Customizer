=== Genesis Super Customizer ===
Contributors: Mario Giancini
Donate link: http://supercustomizer.com/donate
Tags: customizer, genesis, options, supercustomizer, design
Requires at least: 3.8
Tested up to: 4.4.2
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The easiest way to customize the design of the Genesis theme, right from the WordPress Customizer.


== Description ==

Genesis Super Customizer adds options to customize colors, create a fixed header that shrinks on scroll, upload logos, edit footer credits, and much more, all through the native Wordpress Customizer interface.
It's the easiest way to customize the design of the Genesis theme or your custom Genesis child theme.

IMPORTANT DISCLAIMER: This plugin is designed to work with the Genesis Framework and the Genesis Sample Child Theme only, not premium Genesis child themes like Author Pro, Parallax Pro, etc. It duplicates and overrides the stylesheet for the Genesis theme or Sample Child Theme (or your custom theme based off of the Sample Child Theme) as a starting point for design. It will override your current styles so it's best to try it out on a staging site first, or start off by developing your site with just Genesis and GSC.

There's over 100 options to customize and tinker with, but you can easily change the look and feel of your Genesis theme with just a few options.

NEW: Reset button is now available! Restores the default settings with a single click (after confirmation).

Shortcodes are now included for the theme colors chosen with the customizer:

* [themecolor] - Add the main theme color to text
* [themebg] - Add the main theme color to the background
* [accentcolor] - Add the accent color to text
* [accentbg] - Add the accent color to the background
* [bgcolor] - Add the background color to text
* [mainbg] - Add the main background color to the background

You can use html in the shortcodes and they are stackable as well:

[themebg]This is an [bgcolor]example[/bgcolor] of awesome genesis super customizer shortcodes. [accentbg][bgcolor]Check out this[/bgcolor] `<a href="http://supercustomizer.com">link</a>`.[/accentbg][/themebg]

For designers that want to use html you can instead use the classes that each shortcode corresponds to and add them to html elements.

* [themecolor] - theme-color
* [themebg] - theme-bg
* [accentcolor] - accent-color
* [accentbg] - accent-bg
* [bgcolor] - bg-color
* [mainbg] - main-bg

You can import and export your design templates. Use them as starter templates to speed up your design process.

More information can be found at [http://supercustomizer.com](http://supercustomizer.com "Genesis Super Customizer").

Please note this plugin requires the Genesis theme (a premium WordPress theme) to be activated.


== Installation ==

1. Upload genesis-super-customzer.zip to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the Wordpress Customizer to change and adjust settings.


== Frequently Asked Questions ==

= How do I install a customizer template? =

From your WordPress admin navigate to the Genesis > Import/Export menu. Click "Choose File"
and location your .json customizer template file. Click "Upload File and Import". You should see
a success notification on the top.

= How do I export my genesis super customizer setting to a template? =

Just like importing a template, navigate to the Genesis > Import/Export menu. Check "Customizer Settings" under the Export Genesis Settings File dialog. Then click the Download Export File button.

= How do I reset the genesis super customizer options? =

In previous versions, you needed to upload the default settings via a .json file, but not anymore. There's a simple reset button at the top of the Customizer, right next to the save button.

= Does it work with premium Genesis child themes from StudioPress? =

In short, no. Genesis Super Customizer isn't tested with premium child themes such as Parallax Pro, Author Pro, etc. It is meant to replace the need to edit your CSS file in your Genesis parent theme or custom child theme (like the Sample Child theme).
It should work fine with just about any custom child theme based off of the Sample Child theme, but options on premium themes will probably not work correctly. There are future plans to incorporate add-ons for premium child themes.

UPDATE: Enterprise Pro seems works fine since the base styles are very similar, with one known caveat. The .site-inner section floats to the left. This is because the .wrap max-width also effects the .site-inner width (meant to replace the CSS from the Genesis parent theme).
To fix it, simply add this CSS line to your wp_head() scripts (uses <style> tags) in your Genesis settings, or to your styles.css file:

.site-inner { max-width: initial !important; }


== Screenshots ==

1. Overview of customizer option sections.

== Support ==

Please follow on Twitter [@SuperCustomizer]( http:/twitter.com/SuperCustomizer ) for the latest updates.

Detailed documentation is coming soon.


== Changelog ==

= 1.1.0 - March 19, 2016 =
* Added reset button to Customizer actions (no more uploading a file to restore defaults!)
* Code and comment clean up

= 1.0.7 - March 16, 2016 =
* Fixed button class links focus state colors to adopt theme color for buttons and menu links.
* Fixed pagination link focus state colors to adopt theme color for buttons and menu links.
* Fixed misspelled variables.
* Color Style updates.
* Comment clean up.
* Only calls in fixed header scripts when needed.
* Deactivates within the appropriate hook.
* Added active callback to panels, removed active callback filters and replace with functions.

= 1.0.6 - December 5, 2015 =
* Fixed focus state colors to adopt theme color for buttons and menu links.
* Fixed flex crop feature, wasn't checking value correctly.
* Updated for WordPress 4.4 compatibility


= 1.0.5 - September 29, 2015 =
* Added Link Decoration option for hover and focus states.


= 1.0.4 - September 29, 2015 =
* Menus and Navigation section is now a under the Menus section and renamed to Menu Styles to comply with new Customizer updates.
* Fixed undefined call to genesis_get_option error.
* Fixed Enews Slick Form. Form was not assigned position: relative correctly.
* Added Link Decoration option to be able to override new Genesis 2.2.2 styles.
* Updated plugin description.


= 1.0.3 - July 10, 2015 =
* Added shortcodes for colors chosen in the customizer.
* Updated plugin description.
* Updated FAQs.


= 1.0.2 - May 28, 2015 =
* Added title area padding option to help center title & description within logo height.
* Updated FAQs.
* Typo fixes.


= 1.0.1 - May 26, 2015 =
* Header image background-size set to "contain" to utilize logo width & height.
* Fixed min-height header size (set to initialize outside of mobile query) so it overrides default 160px.
* Fixed width factor for footer widgets.
* Added alignment options for primary & secondary menus.
* Added option for eNews Extended widget "Slick Signup".
* Updated header settings descriptions.
* Updated plugin description.


= 1.0 - April 18, 2015 =
* Initial release.


== Upgrade Notice ==


== Future Updates ==

Here are some planned updates for the near future

* Instant Preview
* Filters For Developers To Add Their Own Settings
* Additional Menu customizations for submenus
* Additional Content customizations for entry meta, blockquotes, and more.
* Genesis Premium Child Theme compatibility
* Compatibility with other Featured Genesis plugins
* Change Featured Image And Title Order
* Shortcodes for adding theme colors throughout your site
* Favicon Upload
* Reset Button (instead of uploading default settings)
* WooCommerce compatibility
* More extensions for other popular plugins
* Requests by you! Send requests on Twitter @SuperCustomizer.
