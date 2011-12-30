# Museum Core
Contributors: <a href="https://github.com/jazzsequence">jazzsequence</a>
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=AWM2TG3D4HYQ6
Tags: two-columns, white, custom-menu, threaded-comments, sticky-post, fixed-width, custom-background, featured-image-header, featured-images, post-formats, right-sidebar
Requires at least: 3.1
Tested up to: 3.2.1
Stable tag: 0.3.6-beta

A simple WordPress theme/framework with support for post formats, thumbnails, background, header, menus and more...

## Description

AP Museum Core will be the core framework behind all commercially-released <a href="http://museumthemes.com">Museum Themes</a>.  It supports all built-in WordPress theme options like post thumbnails, post formats, custom backgrounds, etc.

## Installation

1. Unpack and upload the contents of `AP-Museum_Core.zip` to the `/wp-content/themes/` directory.
2. Activate the theme through the *Themes* menu in WordPress.
3. That's it!

## Screenshots

There are currently no screenshots.

## Changelog

### Version 0.3.6
#### 11/08/2011

* removed whitespace from readme files, style.css, header.php
* added generator tag to header.php (for troubleshooting)

### Version 0.3.5
#### 10/26/2011

* inverted changelog (newest updates on top)
* added content width to functions.php
* added language attributes to html tag
* added wp_link_pages to all post formats (some of these aren't really applicable, like link posts, but adding it to everything to be thorough)
* removed old comments form and replaced with comment_form function
* enqueueing comment-reply script on single posts
* updated post formats with dynamic date format where post time displays (time tag still has a hard-coded timestamp to comply with HTML5 date/time standard)
* added footernav styling
* added footer box styling

to do:
	REQUIRED: .sticky css class is needed in your theme css.
	REQUIRED: .gallery-caption css class is needed in your theme css.
	REQUIRED: .bypostauthor css class is needed in your theme css.
	Post format styles/layouts
	Admin Options page functions

### Version 0.3.4
#### 9/22/2011

* split out template parts for post formats and content types
* changed version
* added license uri
* updated aside format
* updated status format
* humanized date for status (will probably do this for asides as well)
* replaced bloginfo('url') with echo home_url() in header.php
* replaced bloginfo('template_directory') with echo get_template_directory_uri() in header.php
* added Tags: to style.css (but left blank for now)

### Version 0.3.3
#### 9/16/2011

* changed version
* added some css3 sliding transition to topnav
* added some css formatting
* changed link color
* duplicated topnav styles for mainnav
* added content styles

### Version 0.3.2
#### 9/15/2011

* updated version
* added support for wp-pagenavi
* moved get_sidebar to above get_footer for SEO
* added <hgroup> to site headings
* added HTML5 tags to single.php
* added <time> tag to single.php
* added HTML5 tags to archive.php
* added post thumbnails to archive.php
* changed post thumbnail size
* added HTML5 tags to page.php
* added HTML5 tags to search.php
* changed deprecated bloginfo('url') to current echo home_url() in searchform.php
* changed h1 to alt (this will be a toggle eventually)
* changed alt class to use embedded PTSans as primary font in stack
* started css fixing
* changed container for wp_nav_menus to <nav> and removed <nav> tag
* added topnav menu styling

### Version 0.3.1
#### 9/14/2011

* updated version
* added viewport meta tag
* added modernizr js
* added HTML5 <header> tag and formatted markup
* added HTML5 <footer> tag and formatted markup
* removed redundant </div>
* added <time> tag to post date and removed <div>
* replaced multiple <divs> with HTML5 equivalents for content
* replaced <divs> with HTML5 equivalents to 404 page
* added frowny face and span[frown] from BPH5 404.html
* applied text-shadow to body type

### Version 0.3
#### 9/13/2011

* NOW USING BOILERPLATE HTML5!
* replaced blueprint resets and print styles with BPH5 css
* removed ie conditional stylesheet (in favor of BPH5 conditional classes)
* removed separate typography stylesheet (replaced with inline css in style.css)
* leaving the embedded typography in a separate stylesheet but changing the call to 'stylesheet_directory' rather than 'template_directory' -- this is so each child theme can define its own styles without loading the fonts from the parent theme
* added readme.md for the benefit of Git
* added typography styles from blueprintCSS
* added icons plugin from blueprintCSS (but removed the external link icons)
* changed name to AP Museum Core (from AP-Museum_Core)
* added formalize.css styles
* added formalize js & enqueued jquery
* updated doctype (from BPH5)
* added conditional _classes_ (as opposed to conditional stylesheets) (from BPH5)
* added meta description (pulls from taxonomy description if on a taxonomy page (custom taxonomies, tags, categories) or page/post excerpt (if on single post or any page that supports the_excerpt)
* added author meta tag

### Version 0.2
#### 9/12/2011

* fixed ap_core_setup (using wrong hook)
* added nav menus to header.php
* removed nav menu fallback default (set to no fallback)
* removed old twitter callback scripts
* changed do_action('wp_footer') to wp_footer.php()
* changed footer text
* added footer menu
* added Inconsolata font for monospaced elements (pre, tt, code and .code class)
* added more typography classes for potential typography settings options
* added new theme options page and sidebar options (still a work in progress)
* updated version
* removed sharing options from single posts

### Version 0.1.2
#### 7/22/2011

* updated version
* added menu support
* added automatic feed links
* added custom header stuff
* added custom background support
* added post formats support
* added ap_core_setup
* added fonts
* added style.css call to the functions.php file
* added screen.css and print.css to the style.css
* removed css calls in header.php
* added ie conditional to functions.php
* added versioning relative to theme version to wp_register_style and wp_register_script calls

### Version 0.1.1
#### 6/15/2011

* changed version
* added readme.txt with changelog

### Version 0.1
#### 6/14/2011

* initial commit (forked from AP-blueprint)
* updated style.css with name, new version # and description
* removed landing sites
* removed theme options
* removed git README
* removed calls to get-theme-options.php
* removed twitter widget from footer (discontinuing hard-coded twitter feeds in the theme since this is easily added with Jetpack or any of a million other plugins)
* removed left/right if statement (may bring this back in some revised form)
*  removed social media links (may bring these back but probably won't)
* removed twitter widget (see note on last footer commit)
* uncommented the dynamic title tags in the header (will change these around later)
* changed path to reset styles
* removed link to non-existant fonts.css (but may add another one later)
* renamed /blueprint to /css
* removed tweet button and dynamic twitter variable in sharing block (might remove the sharing block entirely, anyway, since -- again -- sharedaddy is included in Jetpack)