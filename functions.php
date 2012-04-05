<?php

function ap_core_register_sidebars() {
    register_sidebar(array(
    	'name' => __('Sidebar','museum-core'),
    	'description' => __('This is the regular, widgetized sidebar','museum-core'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
    	'name' => __('Left Footer Box','museum-core'),
    	'description' => __('This is the left box in the footer.','museum-core'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
		'name' => __('Center Footer Box','museum-core'),
    	'description' => __('This is the center box in the footer.','museum-core'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
		'name' => __('Right Footer Box','museum-core'),
    	'description' => __('This is the right box in the footer.','museum-core'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init','ap_core_register_sidebars');

// clear shortcode
// a quick shortcode that clears floats
function ap_core_clear() {
	return '<div class="clear"></div>';
}
add_shortcode('clear','ap_core_clear');

/**
 * load scripts
 * @since 0.1
 * @author Chris Reynolds
 * @uses wp_register_script()
 * @uses wp_enqueue_script()
 * @uses wp_register_style()
 * @uses wp_enqueue_style
 * loads all the styles and scripts for the theme
 * twitter_anywhere = loads the twitter @anywhere framework
 * twitter_hovercards = loads twitter hovercards from @anywhere
 * suckerfish = loads suckerfish from the theme's /js files
*/
function ap_core_load_scripts() {
  if ( !is_admin() ) { // instruction to only load if it is not the admin area
  	$theme  = get_theme( get_current_theme() );
    // this loads the twitter anywhere framework
    wp_register_script('twitter_anywhere','http://platform.twitter.com/anywhere.js?id=3O4tZx3uFiEPp5fk2QGq1A',false,$theme['Version'] );
    wp_enqueue_script('twitter_anywhere');
    // this loads twitter hovercards, dependent upon twitter anywhere
    wp_register_script('twitter_hovercards',get_bloginfo('template_directory').'/js/hovercards.js','twitter_anywhere',$theme['Version']);
    wp_enqueue_script('twitter_hovercards');
    // this loads suckerfish.js the dropdown menus
    wp_register_script('suckerfish',get_bloginfo('template_directory').'/js/suckerfish.js',false,$theme['Version']);
    wp_enqueue_script('suckerfish');
    // this loads jquery (for formalize, among other things)
    wp_enqueue_script('jquery');
    // this loads the formalize js
    wp_register_script('formalize',get_bloginfo('template_directory').'/js/jquery.formalize.min.js',false,$theme['Version']);
    wp_enqueue_script('formalize');
    // loads modernizr for BPH5
    wp_register_script('modernizr',get_bloginfo('template_directory').'/js/modernizr-2.5.3.min.js',false,'2.5.3');
    wp_enqueue_script('modernizr');
    // this loads the font stack
    wp_register_style('corefonts',get_bloginfo('template_directory').'/fonts/fonts.css',false,$theme['Version']);
    wp_enqueue_style('corefonts');
    // this loads the style.css
    wp_register_style('corecss',get_bloginfo('stylesheet_url'),false,$theme['Version']);
    wp_enqueue_style('corecss');
    // loads the comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
  }
}
add_action( 'wp_enqueue_scripts', 'ap_core_load_scripts' );

/**
 * setup AP Core
 * @uses add_theme_support()
 * @uses register_nav_menus()
 * @uses set_post_thumbnail_size()
 * @uses add_custom_background()
 * @uses add_custom_image_header()
 * @since 0.2
 * adds core WordPress theme functionality and adds some tweaks
 */
function ap_core_setup() {

    define( "AP_CORE_OPTIONS", get_template_directory() . '/inc/load-options.php' );
    // load up the theme options
    require_once ( get_template_directory() . '/inc/theme-options.php' );

    // i18n stuff
    load_theme_textdomain('museum-core', get_template_directory() .'/lang');
    $locale = get_locale();
    $locale_file = get_template_directory() ."/lang/museum-core-$locale.php";
    if ( is_readable($locale_file) )
    require_once($locale_file);

    // post thumbnail support
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 ); // 150 pixels wide by 150 pixels tall, box resize mode
    // post formats
    // register all post formats -- child themes can remove some post formats as they so desire
    add_theme_support('post-formats',array('aside','gallery','link','image','quote','status','video','audio','chat'));

    // automatic feed links
    add_theme_support('automatic-feed-links');

	if ( ! isset( $content_width ) ) $content_width = 1140;

    // custom nav menus
    // This theme uses wp_nav_menu() in three (count them, three!) locations.
    register_nav_menus( array(
    	'top' => __( 'Top Header Navigation', 'museum-core' ),
    	'main' => __( 'Main Navigation', 'museum-core' ),
    	'footer' => __( 'Footer Navigation', 'museum-core' ),
    ) );

    // This adds a home link option in the Menus
    function ap_core_home_page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }
    add_filter( 'wp_page_menu_args', 'ap_core_home_page_menu_args' );

    // This theme allows users to set a custom background
    add_custom_background();

    // this theme has a custom header thingie
    define( 'HEADER_TEXTCOLOR', '' );
    // No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
    define( 'HEADER_IMAGE', '%s/images/headers/smoke.jpg' );

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'core_header_image_width', 1140 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'core_header_image_height', 200 ) );

    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 1140 pixels wide by 200 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

    // Don't support text inside the header image.
    define( 'NO_HEADER_TEXT', true );

    // Add a way for the custom header to be styled in the admin panel that controls
    // custom headers. See twentyten_admin_header_style(), below.
    add_custom_image_header( '', 'core_admin_header_style' );

    // ... and thus ends the changeable header business.

    // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
    register_default_headers( array(
    	'nature' => array(
    		'url' => '%s/images/headers/nature.jpg',
    		'thumbnail_url' => '%s/images/headers/nature-thumbnail.jpg',
    		/* translators: header image description */
    		'description' => __( 'Nature', 'museum-core' )
    	),
    	'smoke' => array(
    		'url' => '%s/images/headers/smoke.jpg',
    		'thumbnail_url' => '%s/images/headers/smoke-thumbnail.jpg',
    		/* translators: header image description */
    		'description' => __( 'Smoke', 'museum-core' )
    	),
    	'lights1' => array(
			'url' => '%s/images/headers/lights1.jpg',
    		'thumbnail_url' => '%s/images/headers/lights1-thumbnail.jpg',
    		/* translators: header image description */
    		'description' => __( 'Lights 1', 'museum-core' )
		),
        'lights2' => array(
            'url' => '%s/images/headers/lights2.jpg',
            'thumbnail_url' => '%s/images/headers/lights2-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Lights 2', 'museum-core' )
        ),
    	'lights3' => array(
    		'url' => '%s/images/headers/lights3.jpg',
			'thumbnail_url' => '%s/images/headers/lights3-thumbnail.jpg',
    		/* translators: header image description */
    		'description' => __( 'Lights 3', 'museum-core' )
    	)
    ) );
    function core_admin_header_style() {
        // I don't have any custom header styles...yet.
    }

	// this changes the output of the comments
	function ap_core_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="the_comment">
      <div class="comment-author vcard">
         <?php echo get_avatar
	($comment,$size='64',$default='<path_to_url>' ); ?>
	<?php sprintf(__('On %1$s at %2$s %3$s said:','museum-core'), get_comment_date(), get_comment_time(), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'museum-core') ?></em>
         <br />
      <?php endif; ?>
      <?php comment_text() ?>
      <div class="comment-meta commentmetadata"><?php edit_comment_link(__('(Edit)', 'museum-core'),'  ','') ?></div>
      <div class="reply"><button>
         <?php comment_reply_link(array_merge
		 ( $args, array('depth' => $depth, 'reply_text' => __('Respond to this','museum-core'), 'max_depth' => $args['max_depth']))) ?>
      </button></div>
     </div>
	<?php
        }

	// this changes the default [...] to be a read more hyperlink
	function ap_core_new_excerpt_more($more) {
        global $post;
		return '...&nbsp;(<a href="'. get_permalink($post->ID) . '">' . __('read more','museum-core') . '</a>)';
	}
	add_filter('excerpt_more', 'ap_core_new_excerpt_more');

}
add_action('after_setup_theme','ap_core_setup');

/**
 * customized wp_title
 * @since 1.0.5
 * @author Chris Reynolds
 * @uses wp_title
 * @link http://wordpress.stackexchange.com/questions/32622/when-calling-wp-title-do-you-have-to-create-some-kind-of-title-php-file
 * replaces default wp_title with a modified version
 */
function ap_core_wp_title( $title ) {
    if ( !is_404() )
        $category = get_the_category(); // get the category only if we aren't looking at a 404 page
    $name = get_bloginfo('name');
    $description = get_bloginfo('description');

    // if we're on the home page...
    if ( is_home() ) {
        $ap_core_title = $name;
    }

    // if we're on a category archive page...
    elseif ( is_category() ) {
        $ap_core_title = single_cat_title( '', false ) . ' | ' . $name;
    }

    // if we're on a single post...
    elseif ( is_single() ) {
        $ap_core_title = single_post_title( '', false ) . ' | ' . $category[0]->cat_name;
    }

    // if we're on a page...
    elseif ( is_page() ) {
        $ap_core_title = single_post_title( '', false );
    }

    // if we're on a 404...
    elseif ( is_404() ) {
        $ap_core_title = 'Page not found | ' . $name;
    }
    // for everything else...
    else {
        $ap_core_title = $name;
    }

    $ap_core_title .= ' | ' . $description;

    // return new title
    return $ap_core_title;
}
add_filter( 'wp_title', 'ap_core_wp_title' );

/**
 * Meta generator
 * @since 0.4.5
 * @author Chris Reynolds
 * @uses get_theme()
 * @uses get_current_theme()
 * returns a generator meta tag that is added in the header which pulls automatically from the theme version
 * (replaces the original method which was updating this generator tag manually)
 * generator tag is used for troubleshooting to identify what version of the theme people are using by looking at the source
 */
function ap_core_generator() {
    $theme  = get_theme( get_current_theme() );
    $ap_core_version = '<meta name="generator" content="' . get_current_theme() . ' ' . $theme['Version'] . '">';
    return $ap_core_version;
}
$options = get_option( 'ap_core_theme_options' );
if ($options['generator'] == 'true') {
    add_action( 'wp_head', 'ap_core_generator' );
}

/**
 * Get default options
 * @since 0.4.0
 * @author Chris Reynolds
 * defines the options and some defaults
 */
function ap_core_get_theme_defaults(){
    // default options settings
    $defaults = array(
        // sidebar
    	'sidebar' => 'left',
        // theme tracking
        'presstrends' => 'true',
    	// typography options
    	'heading' => 'PTSerif',
    	'body' => 'DroidSans',
    	'alt' => 'Ubuntu',
        // link color
        'link' => '#486D96',
        'hover' => '#333333',
        // excerpts or full posts
        'excerpts' => 'true',
        // use alt for h1?
        'alth1' => 'false',
        // footer text
        'footer' => stripslashes('&copy; ' . date('Y') . ' ' . get_bloginfo('title') . ' . <a href="http://museumthemes.com/" target="_blank" title="Museum Themes">' . __('Museum Themes','museum-core') . '</a> . <a href="http://wordpress.org" target="_blank">' . __('Powered by WordPress','museum-core') . '</a>'),
        // advanced settings
        'title' => 'true',
        'meta' => 'false',
        'author' => 'false',
        'generator' => 'false',
    );
    return $defaults;
}

/**
 * Sidebar settings
 * @since 0.4.0
 * @author Chris Reynolds
 * this is the array for the sidebar setting
 */
function ap_core_sidebar() {
    $ap_core_sidebar = array(
        'left' => array(
            'value' => 'left',
            'label' => __('Left Sidebar','museum-core')),
        'right' => array(
            'value' => 'right',
            'label' => __('Right Sidebar','museum-core'))
    );
    return $ap_core_sidebar;
}

/**
 * Font settings
 * @since 0.4.4
 * @author Chris Reynolds
 * this array handles the font selection
 */
function ap_core_fonts() {
    $ap_core_fonts = array(
        'ptserif' => array(
            'value' => 'PTSerif',
            'label' => 'PT Serif',
            'link' => 'http://www.fontsquirrel.com/fonts/pt-serif'
        ),
        'inconsolata' => array(
            'value' => 'Inconsolata',
            'label' => 'Inconsolata',
            'link' => 'http://www.fontsquirrel.com/fonts/inconsolata'
        ),
        'droidsans' => array(
            'value' => 'DroidSans',
            'label' => 'Droid Sans',
            'link' => 'http://www.fontsquirrel.com/fonts/droid-sans'
        ),
        'ubuntu' => array(
            'value' => 'Ubuntu',
            'label' => 'Ubuntu',
            'link' => 'http://www.fontsquirrel.com/fonts/ubuntu'
        )
    );
    return $ap_core_fonts;
}

/**
 * Show excerpts
 * @since 0.5
 * @author Chris Reynolds
 * option to show excerpts or full posts
 */
function ap_core_show_excerpts() {
    $ap_core_show_excerpts = array(
        'true' => array(
            'value' => 'true',
            'label' => __('Show Post Excerpts','museum-core')
        ),
        'false' => array(
            'value' => 'false',
            'label' => __('Show Full Posts','museum-core')
        )
    );
    return $ap_core_show_excerpts;
}

/**
 * True/False option
 * @since 1.0.2
 * @author Chris Reynolds
 * generic yes/no function used for true/false options
 */
function ap_core_true_false() {
    $ap_core_true_false = array(
        'true' => array(
            'value' => 'true',
            'label' => __('Yes','museum-core')
        ),
        'false' => array(
            'value' => 'false',
            'label' => __('No','museum-core')
        )
    );
    return $ap_core_true_false;
}

function ap_core_custom_styles() {
    $defaults = ap_core_get_theme_defaults();
    $options = get_option( 'ap_core_theme_options' );
    // set the heading font
    if ( isset($options['heading']) ) {
        $heading = $options['heading'];
    } else {
        $heading = $defaults['heading'];
    }
    // set the body font
    if ( isset($options['body']) ) {
        $body = $options['body'];
    } else {
        $body = $defaults['body'];
    }
    // set the alt font
    if ( isset($options['alt']) ) {
        $alt = $options['alt'];
    } else {
        $alt = $defaults['alt'];
    }
    // set the link color
    if ( isset($options['link']) ) {
        $link = $options['link'];
    } else {
        $link = $defaults['link'];
    }
    if ( isset($options['hover']) ) {
        $hover = $options['hover'];
    } else {
        $hover = $defaults['hover'];
    }
    $output = "<style type=\"text/css\" media=\"print,screen\">h1, h2, h3 { font-family: $heading, sans-serif; } h4, h5, h6, .alt, h3 time { font-family: $alt, sans-serif; } body { font-family: $body, sans-serif; } a, a:link, a:visited { color: $link; } a:hover, a:active { color: $hover; } a { text-decoration:none; -webkit-transition: all 0.3s ease!important; -moz-transition: all 0.3s ease!important; -o-transition: all 0.3s ease!important; transition: all  0.3s ease!important; }</style>";
    echo $output;
}
add_action( 'wp_head', 'ap_core_custom_styles' );

?>