=== Museum Core ===
Contributors: jazzs3quence
Donate link: https://www.paypal.me/jazzsequence/
Tags: two-columns, custom-menu, threaded-comments, sticky-post, custom-background, featured-image-header, featured-images, post-formats, right-sidebar, translation-ready
Requires at least: 3.2
Tested up to: 4.9.4
Stable tag: 2.1.6

A simple, responsive WordPress theme/framework with support for internationalization, post formats, thumbnails, background, header, menus, custom favicon and more...

== Description ==

Museum Core is a clean, responsive framework with support for built-in WordPress theme options like post thumbnails, post formats, custom backgrounds & header, etc.  A theme options page lets you customize the typefaces used in the theme, footer credit, sidebar position, link colors and more.  Core can be used as a standalone theme or as a framework for other themes or child themes.

* Polish translation by [anemoone](http://kratery.com/)
* German translation by [Christian Mauderer](http://www.c-mauderer.de/)
* Spanish translatin by [Wenke Adam](http://guillermodeisler.xyz/)

**Call for contributors!**
If you like this theme and you would like to help maintain it, please get in touch with me on twitter ([@jazzs3quence](https://twitter.com/jazzs3quence)) via email (me@chrisreynolds.io) or on the [GitHub repo](https://github.com/jazzsequence/museum-core) as this is no longer a project that I am actively developing or maintaining.

== Installation ==

1. Unpack and upload the contents of `AP-Museum_Core.zip` to the `/wp-content/themes/` directory.
2. Activate the theme through the *Themes* menu in WordPress.
3. That's it!

== Screenshots ==

There are currently no screenshots.

== Changelog ==

= Version 2.1.6 =

* strip 'http:' from font URLs to improve HTTPS support [#86](https://github.com/jazzsequence/museum-core/pull/86)
* fix a PHP notice when changing link colors [#87](https://github.com/jazzsequence/museum-core/issues/87)

= Version 2.1.5 =

* fixed a bug where sidebar would not load correctly due to using name instead of ID [issue](https://github.com/jazzsequence/museum-core/issues/81) 
* use `add_theme_support( 'title-tag' )` instead of `<title><?php wp_title(); ?></title>`
* add text domain to style.css

= Version 2.1.4 =

* fixed a bug where language files would not load (thanks @c-mauderer) [issue](https://github.com/jazzsequence/museum-core/pull/78)

= Version 2.1.3 =

* added German translation
* added Spanish translation
* fixed a bug where html in the footer would display the code instead of rendering html
* added .screen-reader-text class to allow text to be read by screen readers but hidden from browsers

= Version 2.1.2 =

* fixed breadcrumbs infinite loop [issue](https://github.com/jazzsequence/museum-core/issues/74)
* fixed allowed HTML block breaking tag midword
* fixed HTML displaying for author link in comments [issue](https://github.com/jazzsequence/museum-core/issues/73)
* fixed various undefined index errors when some (but not all) options were set and WP_DEBUG was set to true [issue](https://github.com/jazzsequence/museum-core/issues/75)
* added right margin to post format icons
* removed old legacy custom css support
* proper sanitization of customizer settings
* removed support for [clear] shortcode (wp theme review requirements)

= Version 2.1.1 =

* added support for mobile navbar for either header nav (not just topnav) -- default will be top nav, with main nav being used if no top nav exists
* `icon-reorder` was lost when moving the font to a custom set. added it back.
* fixed textdomain issues
* stored WP_Customize_Color_Control in a variable
* switched to CamelCase for AP_Core_WP_Bootstrap_Navwalker class
* sanitized lots of stuff
* fixed "Expected next thing to be an escaping function" message when running VIP checks

= Version 2.1 =

* changed the post icon to a thumbtack
* switched icon pact to custom fontastic.me reduced version of fontawesome
* added support for image attachment pages
* added `html5` theme support value
* added RTL support
* added default `$themecolors` array
* added quotes around datetime values
* removed function to add a home page link to the menus (now handled by core)
* fixed `$content_width`
* updated bootstrap.js with custom version with only the plugins used by the theme
* removed a lot of old code from comments template
* bootstrapped comments
* added bootstrap pagers to previous/next comment paged links
* escapes author meta before outputting it
* removed a bunch of unused code from the search template
* moved `wp_pagenavi` check to be inside the `pager` div
* varios archive template fixes
* removed the title check on single posts
* removed double `spacer-10` divs
* allowed pages to use the postmetadata template part
* changed how the options are checked in post templates
* changed the way the date displays
* removed different handling of the date on image posts
* added a date tag to quote and status posts
* moved icon out of the postmetadata part and into the post format parts
* renamed template parts that run the loop within the template part
* removed the check for `dynamic_sidebar` since nothing is being added as a default
* replaced some bootstrap classes
* removed some redundant bootstrap classes
* adds new function that moves the meta tags to functions.php and allows other devs to modify via a filter
* adds initial scale & removed `wp_get_archives`
* removed `chrome=1` from `ua-compatibility` (updates h5bp)
* removed conditional html classes (updates h5bp)
* moved `tha_before_html` inside the doctype element

= Version 2.0.3 =

* Fixed an issue with previous/next page navigation on singlular pages

= Version 2.0.2 =

* Fixes a bug with excerpts on archive pages
* Adds support for multilevel dropdown menus

= Version 2.0.1 =

* Removed `/inc/load-options.php` and all `include` functions for that file, replaced with functions to do those checks
* Removed `function_exists` checks for pre-3.4 functions
* Moved `wp_head` directly above `</head>`
* Moved `wp_footer` directly above '</body>'
* Renamed `$_post_format_chat_ids` to `$ap_core_post_format_chat_ids`
* Prefixed EVERYTHING
* Escaped all instances of `home_url()`
* Set background color and border to top navbar to transparent

= Version 2.0 =

** Major update! Please read the Upgrade Notice for specific update notes. **

* Moved all external js, css and font files to new `/assets` directory
* Removed admin.css, color-picker.js, hovercards.js, formalize.js, suckerfish.js, uploader.js
* Added new font subset option for better font i18n handling
* Removed blueprint.css and formalize.css styles
* Removed 1140 grid layout
* Added Twitter Bootstrap 3.0 framework
* Removed custom css option (use [My Custom CSS](http://wordpress.org/plugins/my-custom-css/) or [Jetpack](http://wordpress.org/plugins/jetpack/))
* Removed default link colors (inherits from Bootstrap)
* Replaced Theme Options page with full Customizer support
* Removed `/inc/option-setup.php`
* Renamed Generator option (to identify version for troubleshooting) to "Debug Mode"
* Added support for 2 new fonts (Open Sans and Noto Serif)
* Added support for customization of content area background color and font color
* Removed old image icons and automatic filetype link images
* Fixed an issue with the permalink title attribute
* Added [Theme Hook Alliance](https://github.com/zamoose/themehookalliance) hooks
* Removed normalize.css styles that were duplicated with Bootstrap from H5BP css framework
* Updated handling of the header image and large post thumbnail support
* Bootstrap-izes various styles throughout the theme
* Added new template parts for navigation, postmeta, title, and link pages
* Added FontAwesome icon font
* Fixed an issue with captioned images going off the page if they are wider than the body container
* Updated wp-caption, gallery and calendar styles
* Added icons for all post formats
* Added Justin Tadlock & David Chandra's chat format filter for better chat post handling
* Fixed an issue where very long words would extend out of their containers
* Added Bootstrap progress bars for my [Progress Bar](http://wordpress.org/plugins/progress-bar/) plugin
* Refreshed comment styling
* If you have saved custom CSS, added an area in the customizer to copy the code & a setting to remove the message when you're done
* Removed text shadows from everything
* Added [wp-bootstrap-navwalker class](https://github.com/twittem/wp-bootstrap-navwalker) by [twittem](https://github.com/twittem) for Bootstrap nav menu support
* Added navbar customization options (positioning, colors)
* Added support for breadcrumbs

= Version 1.1.3.4 =

* fixes true/false booleans that weren't actual booleans

= Version 1.1.3.3 =

* fixes tagline displaying when site title is set to false, [reported here](http://wordpress.org/support/topic/hide-site-title-and-tag-line)

= Version 1.1.3.2 =

* fixes undefined variable notices for blank custom styles
* fixes get_template_part
* removes negative left margin on sticky posts

= Version 1.1.3.1 =

* sanitizes variable output on theme options page

= Version 1.1.3 =

* fixes error on validation if favicon is null
* removed some old blueprint.css typography styles and set preformatted code, code, and tt font size to 12px
* left padding mistakenly set as right padding instead - fixes issue reported [here](http://wordpress.org/support/topic/remove-envelope-icon-from-email-address-link?replies=2) and [here](http://wordpress.org/support/topic/theme-museum-core-change-positioning-of-icons?replies=8)
* fixed some undefined variable notices
* added link to header image if site title is being hidden in the options. fixes [this](http://wordpress.org/support/topic/museum-core-add-link-to-header-image-remove-link-from-photo?replies=4)
* turns h2s into h1s
* fixed a bug on the author page where the author name was being echoed incorrectly
* adds a post author option to display post author in the post meta section
* switches all pseudo-boolean expressions to be *actual* boolean expressions
* moves all the template parts into a `/parts` subdirectory
* minor update to language files to support new changes

= Version 1.1.2 =

* moved optional header meta out of the `header.php` and into a `wp_head` action
* sanitized and stripped tags from content being fed into meta description tags
* moves favicon out of `header.php` to a `wp_head` action and sanitizes url before output
* added a `#` to the link color input selection if it's empty for farbtastic
* only outputs the custom styles if they are set and aren't the default values
* moved admin css to its own stylesheet

= Version 1.1.1 =

* wraps all functions in `if (!function_exists())` checks (for building child themes)
* adds language_attributes() to ie conditional classes
* added an option to hide the site title (so you can use the header image by itself, instead)

= Version 1.1 =

* added more secure file validation for favicon uploads
* fixed issue with gravatars in comments
* fixed theme options layout issue in 3.3.2
* added page template for page with no sidebar
* removed base color from h tags (conflicted with themeroller stylesheets and overrode body color)
* removed thead background color (kind of ugly anyway, and looks horrible with certain color palettes)
* added an option to add custom css
* changed the version for a major revision
* rewrote the theme options page so each option is in its own separate function (to make building theme options pages for child themes & using *some* options from Core, but not *all* options easier/possible)

= Version 1.0.9 =

* adds option for full posts or excerpts on archive pages
* adds option to disable Twitter hovercards
* adds another font option (Lato, apparently good for Polish language)
* loads all fonts from Google Webfonts instead of embedding them (and supporting international character sets, when available)
* added option for uploading favicon
* removed non-GPL css framework
* updated PressTrends tracking code
* added some comment form styling
* added Polish language file
* renamed English language file
* fixed tabs so they're translatable
* adds support for WordPress 3.4 functions, if they exist

= Version 1.0.8 =

* updated theme description
* added a reset for WordPress rss feed icon (already using one in our stylesheet)
* fixes trackbacks on comments
* hides the (empty) button if there are comments/trackbacks but comments/trackbacks are not enabled (yeah, sort of an edge case but looks weird)

= Version 1.0.7.2 =

* fixes `WARNING: wp-content/themes/AP-Museum_Core/functions.php:335 - sprintf() [function.sprintf]: Too few arguments` PHP debug error

= Version 1.0.7.1 =

* removed wp.org extend link from default footer

= Version 1.0.7 =

* fixed generator
* updated language files
* added some theme tags
* fixed user meta issue in comments (thanks @anemoone & @alchymyth)
* fixes an issue with links in the footer not linking correctly (thanks @anemoone)
* updated default footer text and l10n
* added some new styles for viewports smaller than 380px (i.e. iPhones/iPods and probably most other smartphones)
* added responsive styles for embeds (particularly YouTube videos) for smaller viewports/mobile devices
* adds support for sub-submenus (thanks @MsWeaver)
* added search icon with css3 transition to slide it out of the input box onfocus

= Version 1.0.6 =

* disabled PressTrends by default
* removes function_exists check in sidebar.php
* added search box to search results page and changed search box type to "search"
* fixes a display issue with 'Leave a Reply' comment heading when comments are paginated

= Version 1.0.5 =

* moved ap_core_generator to wp_head
* moved custom title tag to wp_title
* localized footer default text & replaced footer fallback with default
* fixed postmeta
* adds a permalinked (no title) to posts without a title
* fixed archive headings
* changed sidebar selection to dropdown
* changed depth of footer menu to 1 level
* fixed responsive styles
* localized 'go' button
* removed favicon support (for now)
* added jquery-ui tabs on theme options page

= Version 1.0.4 =

* fixed page with comments not displaying comments
* prefixed all non-prefixed functions with ap_core_
* added htmlentities encoding and some stripslashes madness to the footer text input box
* hooked theme and sidebar business to widgets_init
* wrapped WP core functions in function_exists if statements
* added advanced theme options for meta tags
* added and set default settings
* removed TEMPLATEPATH constants
* moved comment-reply script call to ap_core_load_scripts
* internationalized searchform
* removed debug code
* implemented checked() and selected() for theme options
* fixed (for real this time) internationalization

= Version 1.0.3 =

* moved AP_CORE_OPTIONS to ap_core_setup (for child themes)
* fixed dropdown menu styling
* added a human-time-diff class to quote and status posts
* removed list style from comment children
* made meta charset dynamic
* updated license info
* added comment support to pages
* defined a default header image (that actually exists in the theme)
* commented out favicon support (since no favicon is included in the theme)
* defined a default $plugin_name value to eliminate undefined variable issue in presstrends function

= Version 1.0.2 =

* changed text domain to slug
* removed SEO from footer link and changed url
* added use alt font for h1 option
* added option to change footer text

= Version 1.0.1 =

* fixes an issue with the farbtastic color picker
* fixes both headers displaying if no header image is set
* changed positioning for feedback/support tab to pixels for better display on all resolutions

= Version 1.0 =

* added screenshot
* replaced `get_bloginfo('template_directory')` with `get_template_directory_uri()` in `theme-options.php`
* added smooth fade to link colors in header styles

= Version 0.5.1 =

* i18nized all files, tested with <a href="http://wordpress.org/extend/plugins/piglatin/" target="_blank">Pig Latin</a>.

= Version 0.5 =

* removed dates from changelogs (not really helpful and hindering releasing multiple versions in the same day)
* added show excerpts option/full post

= Version 0.4.5 =

* added meta generator function
* updated load-options.php to suppress php warnings
* added the rest of the font options and a link color option
* added farbtastic color picker for link color
* added custom styles function to load options in wp_head
* removed beta tag
* moved .alt class to h2 in header instead of h1
* added side box on options page with news feed, twitter and get satisfaction feedback widget
* removed old example code
* added post format styles
* added custom author page

= Version 0.4.4 =

* added options array for theme fonts
* added font examples on theme options page
* added dropdown for headings (not functional yet)
* integrated PressTrends.io tracking

= Version 0.4.3 =

* included load-options.php on all pages that need to load options
* updated header images to 1140 width and header image definition
* updated generator tag with current version
* fixed some cosmetic spacing issues in the header
* updated sticky padding/margins so it doesn't look weird against the regular posts

= Version 0.4.2 =

* defined the sidebar if 'left' is selected
* added /inc/load-options.php to keep php out of the template files

= Version 0.4.1 =

* added /inc/theme-options.php
* made sidebar options functional (beginnings of new theme options page using Settings API)

= Version 0.4.0 =

* updated style.css to current h5bp style.css
* updated modernizr to 2.5.3
* updated header.php to add some h5pb updates

= Version 0.3.9 =

* added .gallery-caption styling
* wrapped scripts and stylesheets in a function (fixes NOTICE that wp_enqueue_scripts/wp_enqueue_styles was being loaded incorrectly)
* added .sticky styling -- that takes care of the WordPress theme requirements
* added some built-in pre/tt/code styling

= Version 0.3.8 =

* added comment styling
* took care of .bypostauthor required comment class
* removed override for &lt;q&gt; tag. It's a little ridiculous to use a tag for that, but it is one of the things that's being checked in the theme test, so doing it for the sake of WP theme uniformity/compatibility
* updated #comments ol, #comments ul styling to allow margins for `ul`s/`ol`s within comments
* <em>actually</em> added human time diff to asides (was listed in notes for 0.3.4 but it wasn't actually there)

= Version 0.3.7 =

* integrated Andy Taylor's <a href="http://cssgrid.net/">1140 grid</a> layout for wider layout that's more responsive
* removed tr.even td background color (because it was ugly)
* removed some whitespace
* added header image support

= Version 0.3.6 =

* removed whitespace from readme files, style.css, header.php
* added generator tag to header.php (for troubleshooting)

= Version 0.3.5 =

* inverted changelog (newest updates on top)
* added content width to functions.php
* added language attributes to html tag
* added wp_link_pages to all post formats (some of these aren't really applicable, like link posts, but adding it to everything to be thorough)
* removed old comments form and replaced with comment_form function
* enqueueing comment-reply script on single posts
* updated post formats with dynamic date format where post time displays (time tag still has a hard-coded timestamp to comply with HTML5 date/time standard)
* added footernav styling
* added footer box styling

= Version 0.3.4 =

* split out template parts for post formats and content types
* changed version
* added license uri
* updated aside format
* updated status format
* humanized date for status (will probably do this for asides as well)
* replaced bloginfo('url') with echo home_url() in header.php
* replaced bloginfo('template_directory') with echo get_template_directory_uri() in header.php
* added Tags: to style.css (but left blank for now)

= Version 0.3.3 =

* changed version
* added some css3 sliding transition to topnav
* added some css formatting
* changed link color
* duplicated topnav styles for mainnav
* added content styles

= Version 0.3.2 =

* updated version
* added support for wp-pagenavi
* moved get_sidebar to above get_footer for SEO
* added `<hgroup>` to site headings
* added HTML5 tags to single.php
* added `<time>` tag to single.php
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

= Version 0.3.1 =

* updated version
* added viewport meta tag
* added modernizr js
* added HTML5 `<header>` tag and formatted markup
* added HTML5 `<footer>` tag and formatted markup
* removed redundant `</div>`
* added `<time>` tag to post date and removed `<div>`
* replaced multiple `<div>`s with HTML5 equivalents for content
* replaced `<div>`s with HTML5 equivalents to 404 page
* added frowny face and span[frown] from BPH5 404.html
* applied text-shadow to body type

= Version 0.3 =

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

= Version 0.2 =

* fixed ap_core_setup (using wrong hook)
* added nav menus to header.php
* removed nav menu fallback default (set to no fallback)
* removed old twitter callback scripts
* changed do_action('wp_footer') to wp_footer()
* changed footer text
* added footer menu
* added Inconsolata font for monospaced elements (pre, tt, code and .code class)
* added more typography classes for potential typography settings options
* added new theme options page and sidebar options (still a work in progress)
* updated version
* removed sharing options from single posts

= Version 0.1.2 =

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

= Version 0.1.1 =

* changed version
* added readme.txt with changelog

= Version 0.1 =

* initial commit (forked from AP-blueprint)
* updated style.css with name, new version # and description
* removed landing sites
* removed theme options
* removed git README
* removed calls to get-theme-options.php
* removed twitter widget from footer (discontinuing hard-coded twitter feeds in the theme since this is easily added with Jetpack or any of a million other plugins)
* removed left/right if statement (may bring this back in some revised form)
* removed social media links (may bring these back but probably won't)
* removed twitter widget (see note on last footer commit)
* uncommented the dynamic title tags in the header (will change these around later)
* changed path to reset styles
* removed link to non-existant fonts.css (but may add another one later)
* renamed /blueprint to /css
* removed tweet button and dynamic twitter variable in sharing block (might remove the sharing block entirely, anyway, since -- again -- sharedaddy is included in Jetpack)

== Upgrade Notice ==

= 2.1.2 Update =

2.1.2 dropped support for the [clear] shortcode that was previously built in. Shortcodes are generally plugin functionality and updated requirements of the theme review process required the removal of the `add_shortcode` function. If you were previously using the [clear] shortcode, you will need to replace those with `<div class="clear"></div>` or create your own plugin with the following function:

`
if (!function_exists('ap_core_clear')) {
    function ap_core_clear() {
    	return '<div class="clear"></div>';
    }
    add_shortcode('clear','ap_core_clear');
}
`

You can also add this to a custom child theme functions.php file. I will submit a new plugin to the plugins repository to support the clear shortcode in the near future.

= Translators wanted! =

If you can help with the translation project, please get in touch with me!
hello@chrisreynolds.io
