=== Duplicate Post ===
Contributors: lopo
Donate link: http://lopo.it/duplicate-post-plugin/
Tags: duplicate post, copy, clone
Requires at least: 3.0
Tested up to: 3.3
Stable tag: 2.0.2

Clone posts and pages.

== Description ==

This plugin allows to clone a post or page, or edit it as a new draft.

1. In 'Edit Posts'/'Edit Pages', you can click on 'Clone' link below the post/page title: this will immediately create a copy and return to the list.

2. In 'Edit Posts'/'Edit Pages', you can click on 'New Draft' link below the post/page title.

3. On the post edit screen, you can click on 'Copy to a new draft' above "Cancel"/"Move to trash". 

2 and 3 will lead to the edit page for the new draft: change what you want, click on 'Publish' and you're done.

**Pay attention to the new behaviour!** The first way now allows you to clone a post with a single click, speeding up your work if you have many posts to duplicate.

There is also a **template tag**, so you can put it in your templates and clone your posts/pages from the front-end. Clicking on the link will lead you to the edit page for the new draft, just like the second way above.

In the Options page under Settings it is now possible to choose what to copy:

* the original post/page date
* the original post/page status (draft, published, pending), when cloning from the posts list.
* the original post/page excerpt
* which taxonomies and custom fields

You can also set a prefix (or a suffix) to place before (or after) the title of the cloned post/page, and the minimum user level to clone posts or pages.

Duplicate post is natively in English, but it's shipped with translations in several other languages (though some are incomplete). Now there is a [Launchpad translation project](https://translations.launchpad.net/duplicate-post/) available to help translating this plugin: feel free to contribute (you can also send me an e-mail using the form on my website).

**If you're a plugin developer**, I suggest to read the section made just for you under "Other Notes", to ensure compatibility between your plugin(s) and mine!

The plugin has been tested against versions 3.0 -> 3.3, both in single site and network mode.

Thanks for all the suggestions, bug reports, translations and donations, they're frankly too many to be listed here!

An example of use: I started this for a small movie theater website which I was building. Every Friday there's a new movie showing with a new timetable, and thus a new post: but sometimes a movie stays for more than a week, so I need to copy the last post and change only the dates, leaving movie title, director's and actors' names etc. unchanged.
The website is http://www.kino-desse.org and the cinema is located in Livorno, Italy.

== Installation ==

Use WordPress' Add New Plugin feature, searching "Duplicate Post", or download the archive and:

1. Upload `duplicate-post` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Options -> Duplicate Post and customize behaviour as needed

== Frequently Asked Questions ==

= The plugin doesn't work, why? =

First, check your version of WordPress: the plugin is not supposed to work on old versions anymore.

Then try to deactivate and re-activate it, some user have reported that this fixes the problem.

If not, maybe there is some kind of conflict with other plugins: feel free to write me and we'll try to discover a solution (it will be *really* helpful if you try to deactivate all your other plugins one by one to see which one conflicts with mine... But do it only if you know what you're doing, I will not be responsible of any problem you may experience).

= Can you add it to the bulk actions in the post/page list? =

I can't. There is no way to do it without hacking the core code of WordPress.
There is an open ticket in WordPress Trac, as other plugin developers too are interested to this feature: we can only hope that eventually our wish will be fulfilled.


== Screenshots ==

1. Here you can copy the post you're editing to a new draft.
2. By clicking on "Clone" the post is cloned immediately. "New draft" leads to the edit screen.
3. The options page.
4. The template tag manually added to Twenty Ten theme. Click on the "Copy to a new draft" link and you're redirected to the edit screen for a new draft copy of your post. 

== Upgrade Notice ==

= 2.0.2 =
Fixed permalink bug + double choice on posts list

= 2.0.1 =
Bug fix + new option

= 2.0 =
Several improvements and new features, see changelog. Requires WP 3.0+.

= 1.1.1 =
Some users have experienced a fatal error when upgrading to v1.1: this may fix it, if it's caused by a plugin conflict.

= 1.1 =
New features and customization, WP 3.0 compatibility: you should upgrade if you want to copy Custom Posts with Custom Taxonomies.

== Changelog ==

= 2.0.2 =
* Fixed bug for permalinks
* Two links on posts list: clone immediately or copy to a new draft to edit.
* Tested on multisite mode.

= 2.0.1 =
* Fixed bug for action filters
* New option so you can choose if cloning from the posts list must copy the post status (draft, published, pending) too.

= 2.0 =
* WP 3.3 compatibility (still not tested against multiblog feature, so beware)
* Minimum WP version: 3.0
* Code cleanup
* Immediate cloning from post list
* Added options for taxonomies and post excerpt
* Added suffix option
* Added template tag

= 1.1.2 =
* WP 3.1.1 compatibility (still not tested against multiblog feature, so beware)
* Added complete Polish language files

= 1.1.1 =
* Plugin split in two files for faster opening in Plugins list page
* fix conflicts with a few other plugins
* Added Dutch language files

= 1.1 =
* WP 3.0 compatibility (not tested against multiblog feature, so beware)
* Option page: minimum user level, title prefix, fields not to be copied, copy post/page date also
* Added German, Swedish, Romanian, Hebrew, Catalan (incomplete) and Polish (incomplete) language files

= 1.0 =
* Better integration with WP 2.7+ interface
* Added actions for plugins which store post metadata in self-managed tables
* Added French and Spanish language files
* Dropped WP 2.6.5 compatibility

= 0.6.1 =
* Tested WP 2.9 compatibility

= 0.6 =
* Fix for WP 2.8.1
* WPMU compatibility
* Internationalization (Italian and Japanese language files shipped)

= 0.5 =
* Fix for post-meta
* WP2.7 compatibility 

= 0.4 =
* Support for new WP post revision feature



== Template tag ==

I have added the template tag `duplicate_post_clone_post_link( $link, $before, $after, $id )`, which behaves just like [edit_post_link()](http://codex.wordpress.org/Function_Reference/edit_post_link).
That means that you can put it in your template (e.g., in single.php or page.php) so you can get a "Clone" link when displaying a post or page.

The parameters are:

* *link*
    (string) (optional) The link text. Default: __('Clone','duplicate-post') 

* *before*
    (string) (optional) Text to put before the link text. Default: None 

* *after*
    (string) (optional) Text to put after the link text. Default: None 

* *id*
    (integer) (optional) Post ID. Default: Current post ID 



== For plugin developers ==

From version 1.0 onwards, thanks to [Simon Wheatley](http://www.simonwheatley.co.uk/)'s suggestion, Duplicate Post adds two actions (*dp_duplicate_post* and *dp_duplicate_page*) which can be used by other developers if their plugins store extra data for posts in non-standard WP tables.
Since Duplicate Post knows only of standard WP tables, it can't copy other data relevant to the post which is being copied if this information is stored elsewhere. So, if you're a plugin developer which acts this way, and you want to ensure compatibility with Duplicate Post, you can hook your functions to those actions to make sure that they will be called when a post (or page) is cloned.

It's very simple. Just write your function that copies post metadata to a new row of your table:
`function myplugin_copy_post($new_post_id, $old_post_object){
/* your code */
}`

Then hook the function to the action:
`add_action( "dp_duplicate_post", "myplugin_copy_post", $priority, 2);`

dp_duplicate_page is used for pages and hierarchical custom post types; for every other type of posts, dp_duplicate_post is used.

Please refer to the [Plugin API](http://codex.wordpress.org/Plugin_API) for every information about the subject.

== Contribute ==

If you find this useful and you if you want to contribute, there are three ways:

   1. You can [write me](http://lopo.it/contatti/) and submit your bug reports, suggestions and requests for features;
   2. If you want to translate it to your language (there are just a few lines of text), you can use the [Launchpad translation project](https://translations.launchpad.net/duplicate-post/), or [contact me](http://lopo.it/contatti/) and I’ll send you the .pot catalogue; your translation could be featured in next releases;
   3. Using the plugin is free, but if you want you can send me some bucks with PayPal [here](http://lopo.it/duplicate-post-plugin/)

