=== Complex Meta Fields ===
Contributors:      Anton Korotkoff
Donate link:       http://eney-solutions.com.ua/complex-meta-fields
Tags:              post, meta, fields, complex, multiple, repeatable, post type
Requires at least: 4.0
Tested up to:      4.0.1
Stable tag:        1.0.2
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Manage complex meta data for any post type.

== Description ==



== Installation ==

= Manual Installation =

1. Upload the entire `/complex-meta-fields` directory to the `/wp-content/plugins/` directory.
2. Activate Complex Meta Fields through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Why this plugin? =

You may notice there are a lot of plugins that do almost the same things as this one. But there always is a small difference.

In current case plugin allows to add REPEATABLE field sets for any Post Type. Meaning you can add any amount of the same field sets to a post or page while editing it.

Then you can output them in a post loop using built-in API.

Moreover, it is light, simple and useful in the same time.

= What is FieldSet? =

FieldSet is simply a set of fields that you are going to use while editing posts. FieldSet may consist of any amount of fields inside and may be repeated multiple times in order to provide multiple objects into the post.

When creating new FieldSet you will need to provide Name and select a post type to specify where you want this FieldSet to be used. FieldSet Slug is used to show FieldSet data on front-end and it is generated automatically depending on Name. See Front-end API for more.

= What is Field? =

There is nothing special about Fields. It is simply html inputs of different types inside a FieldSets. There are some predefined types for common use.

= What is Post Type? =

This question is not related to the plugin and Post Types are completely described here: http://codex.wordpress.org/Post_Types

== Screenshots ==

1. Workspace
2. New FieldSet
3. Add Fields
4. Edit Post
5. Add Sets

== Changelog ==

= 1.0.2 =
* Added ru_RU localization

= 1.0.1 =
* Different small fixes

= 1.0.0 =
* First public release

= 0.2.0 =
* Raw functionality

= 0.1.0 =
* First release

== Upgrade Notice ==

= 1.0.0 =
First public release
