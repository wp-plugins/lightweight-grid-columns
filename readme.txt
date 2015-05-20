=== Lightweight Grid Columns ===
Contributors: edge22
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UVPTY2ZJA68S6
Tags: columns, columns shortcode, grid columns
Requires at least: 4.0
Tested up to: 4.2.2
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add desktop, tablet and mobile friendly columns to your content using an easy to use shortcode.

== Description ==

Lightweight Grid Columns are super easy to use! Install and activate the plugin, then look for the columns icon within your TinyMCE toolbar (see screenshots).

Specify your desired desktop, tablet and mobile widths of the columns, add your content and then insert your shortcode into your content.

Lightweight Grid Columns uses the awesome Unsemantic Framework: (http://unsemantic.com/)

Check out GeneratePress, our awesome WordPress theme! (http://wordpress.org/themes/generatepress)

= Features include: =

* Desktop grid width
* Tablet grid width
* Mobile grid width
* Add custom classes
* Add custom inline styles

== Installation ==

There's two ways to install Lightweight Grid Columns.

1. Go to "Plugins > Add New" in your Dashboard and search for: Lightweight Grid Columns
2. Download the .zip from WordPress.org, and upload the folder to the `/wp-content/plugins/` directory via FTP.

In most cases, #1 will work fine and is way easier.

== Frequently Asked Questions ==

= How do I add the shortcodes? =

* Make sure Lightweight Grid Columns is activated.
* While editing your post or page, go into the "Visual Editor".
* Look for the columns icon (see screenshots tab).
* Choose your desktop, tablet and mobile grid widths.
* If you're adding the last column in a row, check the "Last" checkbox (this is important).

= What if I don't want to use the TinyMCE button? =

Fair enough! Simply add the shortcode to your content.

For example, the below will output 4 columns on desktop, 2 columns on tablet and 1 column on mobile

	[lgc_column grid="25" tablet_grid="50" mobile_grid="100"]Some content[/lgc_column]
	
	[lgc_column grid="25" tablet_grid="50" mobile_grid="100"]Some content[/lgc_column]
	
	[lgc_column grid="25" tablet_grid="50" mobile_grid="100"]Some content[/lgc_column]
	
	[lgc_column grid="25" tablet_grid="50" mobile_grid="100" last="true"]Some content[/lgc_column]
	
Take note of our last column - see the last="true" part? Don't forget ;)

= What are my options for percentages? =

This is taken directly from (http://unsemantic.com):

There are grid classes named grid-x where "x" is a number that represents the percentage width of each grid unit. These cover multiples of 5, up to 100 (grid-5, grid-10 … grid-95, grid-100). There are also classes for dividing a page into thirds: grid-33 and grid-66 which are 33.3333% and 66.6667% wide, respectively. 

= Are there any other options I can use in the shortcode? =

Yes!

You can use:

= class =
	
	[lgc_column grid="25" tablet_grid="50" mobile_grid="100" class="push-25"]Some content[/lgc_column]

= style =

	[lgc_column grid="25" tablet_grid="50" mobile_grid="100" style="padding-left:0px;"]Some content[/lgc_column]

== Screenshots ==

1. The columns icon in your TinyMCE editor.
2. The options inside the columns shortcode generator.
3. A look at some awesome columns!

== Changelog ==

= 0.1 =
* Initial release

== Upgrade Notice ==

= 0.1 =
* Initial release