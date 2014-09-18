=== Plugin Name ===
Contributors: drywallbmb
Tags: thumbnail, featured image, field
Requires at least: 3.5.0
Tested up to: 4.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Exposes two new functions theme developers can use to retrieve information about a post's featured image, such as the caption or description.

== Description ==

Thumbnail Field's purpose is simple and straightforward: It creates two new functions, `the_thumbnail_field()` and `get_thumbnail_field()`, to facilitate retrieving information from a post's featured image, such as the title, alt, description, or caption. Theme and plugin developers are welcome to strip these functions out of this plugin and use them directly in their work, or require this plugin.

In keeping with WordPress style, `the_thumbnail_field()` echoes the field value, whereas `get_thumbnail_field()` merely returns it.

Both functions take up to three arguments, all of which are optional:

*   $field is the name of the field to retrieve. Defaults to 'caption'. Custom meta fields **are** supported.
*   $post_id is an integer specifying the ID of the post to retrieve featured image information for. Defaults to current $post
*   $suppress_filters is a boolean TRUE|FALSE value indicating whether to run the returned field through get_thumbnail_field filters that might be defined somewhere. Defaults to false. Note that this plugin provides this filter hook as a courtesy but does not use it; out of the box this setting will therefore have no effect.

Thus, outputting the description for the featured image of post ID 45 would look like this:

`<?php the_thumbnail_field( 'description', 45 ); ?>`

Installing this plugin will make no visible changes to your WordPress admin.

== Installation ==

1. Upload the `thumbnail-field` directory to your plugins directory (typically wp-content/plugins)
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use code like `<?php if ( function_exists('get_thumbnail_field') ) get_thumbnail_field(); ?>` or `<?php if ( function_exists('the_thumbnail_field') ) the_thumbnail_field(); ?>` in your templates

== Frequently Asked Questions ==

= What fields can I retrieve from this plugin's functions? =

This can retrieve the following information from a post's featured image, all of which are considered 'fields' for the purposes of passing the first argument to one of the functions:

*   id
*   title
*   filename
*   url
*   alt
*   author (ID of the user who uploaded the attachment)
*   description
*   caption
*   name
*   status
*   uploadedTo (the post ID it was first attached to, I think?)
*   date
*   modified
*   menuOrder
*   mime
*   type
*   subtype
*   icon
*   dateFormatted
*   editLink
*   sizes (an array of all the sizes the image exists in)


= What about custom fields? =

No problem. If the field you're interested in isn't one of WordPress's defaults but is defined as a standard meta field, this should be able to grab it.

= What about multi-fields? =

Mostly this plugin assumes fields will have single, textual values. But you may have a custom field, or be fetching a built-in key such as 'sizes', that isn't. Not to fear! This will happily return a maybe-unserialized array for you if it finds something of that sort. In these cases, using `the_thumbnail_field()` will be pretty useless -- you'll want to use `get_thumbnail_field()` to fetch the array and manipulate/echo values within it.


== Changelog ==

= 1.0.3 =
Changing authorship credit and implementing plugin icon for WP >= 4.0

= 1.0 =
Initial release, includes got the_ and get_ versions of functions and support for meta fields.