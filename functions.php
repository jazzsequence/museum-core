<?php

define( "AP_CORE_OPTIONS", get_template_directory() . '/inc/load-options.php' );

if ( function_exists('register_sidebars') )
    register_sidebar(array(
		'name' => 'Sidebar',
		'description' => 'This is the regular, widgetized sidebar for everything else',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
		'name' => 'Left Footer Box',
		'description' => 'This is the left box in the footer.',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
		'name' => 'Center Footer Box',
		'description' => 'This is the center box in the footer.',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
		'name' => 'Right Footer Box',
		'description' => 'This is the right box in the footer.',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));


// clear shortcode
// a quick shortcode that clears floats
function clear() {
	return '<div class="clear"></div>';
}
add_shortcode('clear','clear');

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
  }
}
add_action( 'init', 'ap_core_load_scripts' );

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
    // load up the theme options
    require_once ( get_template_directory() . '/inc/theme-options.php' );

	// post thumbnail support
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 ); // 150 pixels wide by 150 pixels tall, box resize mode
	if ( ! isset( $content_width ) ) $content_width = 1140;

	// custom nav menus
	// This theme uses wp_nav_menu() in three (count them, three!) locations.
	register_nav_menus( array(
		'top' => __( 'Top Header Navigation', 'core' ),
		'main' => __( 'Main Navigation', 'core' ),
		'footer' => __( 'Footer Navigation', 'core' ),
	) );

	// This adds a home link option in the Menus
	function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
	}
	add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

	// This theme allows users to set a custom background
	add_custom_background();

	// this theme has a custom header thingie
	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/leaves.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'core_header_image_width', 1140 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'core_header_image_height', 200 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
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
			'description' => __( 'Nature', 'core' )
		),
		'smoke' => array(
			'url' => '%s/images/headers/smoke.jpg',
			'thumbnail_url' => '%s/images/headers/smoke-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Smoke', 'core' )
		),
		'lights1' => array(
			'url' => '%s/images/headers/lights1.jpg',
			'thumbnail_url' => '%s/images/headers/lights1-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lights 1', 'core' )
		),
    'lights2' => array(
      'url' => '%s/images/headers/lights2.jpg',
      'thumbnail_url' => '%s/images/headers/lights2-thumbnail.jpg',
      /* translators: header image description */
      'description' => __( 'Lights 2', 'core' )
    ),
		'lights3' => array(
			'url' => '%s/images/headers/lights3.jpg',
			'thumbnail_url' => '%s/images/headers/lights3-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lights 3', 'core' )
		)
	) );

	// post formats
	// register all post formats -- child themes can remove some post formats as they so desire
	add_theme_support('post-formats',array('aside','gallery','link','image','quote','status','video','audio','chat'));

	// automatic feed links
	add_theme_support('automatic-feed-links');

	// this changes the output of the comments
	function ap_core_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="the_comment">
      <div class="comment-author vcard">
         <?php echo get_avatar
	($comment,$size='64',$default='<path_to_url>' ); ?>
	On <?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?>
     <?php printf(__('<cite>%s</cite> <span class="says">said:</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
      <?php comment_text() ?>
      <div class="comment-meta commentmetadata"><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
      <div class="reply"><button>
         <?php comment_reply_link(array_merge
		 ( $args, array('depth' => $depth, 'reply_text' => 'Respond to this', 'max_depth' => $args['max_depth']))) ?>
      </button></div>
     </div>
	<?php
        }

	// this changes the default [...] to be a read more hyperlink
	function new_excerpt_more($more) {
        global $post;
		return '...&nbsp;(<a href="'. get_permalink($post->ID) . '">' . 'read more' . '</a>)';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

}
add_action('after_setup_theme','ap_core_setup');

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
        'hover' => '#333333'
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
            'label' => 'Left Sidebar'),
        'right' => array(
            'value' => 'right',
            'label' => 'Right Sidebar')
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
 * PressTrends settings
 * @since 0.4.4
 * @author Chris Reynolds, George Ortiz
 * @link http://presstrends.io
 * PressTrends enables theme tracking and analytics. This gives the user an option to disable it
 */
function ap_core_presstrends() {
    $ap_core_presstrends = array(
        'true' => array(
            'value' => 'true',
            'label' => 'Yes'
        ),
        'false' => array(
            'value' => 'false',
            'label' => 'No'
        )
    );
    return $ap_core_presstrends;
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
    /* debug */
    //$output = 'The heading is ' . $heading . '. The body is ' . $body . '.  The alt is ' . $alt . '. The link color is ' . $link . '.';
    $output = "<style type=\"text/css\" media=\"print,screen\">h1, h2, h3 { font-family: $heading, sans-serif; } h4, h5, h6, .alt, h3 time { font-family: $alt, sans-serif; } body { font-family: $body, sans-serif; } a, a:link, a:visited { color: $link; } a:hover, a:active { color: $hover; }</style>";
    echo $output;
}
add_action( 'wp_head', 'ap_core_custom_styles' );

?>