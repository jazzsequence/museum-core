<?php
if ( function_exists('register_sidebars') )
    register_sidebar(array(
		'name' => 'Sidebar',
		'description' => 'This is the regular, widgetized sidebar for everything else',	
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
		'name' => 'Left Footer Box',
		'description' => 'This is the left box in the footer.',	
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
		'name' => 'Center Footer Box',
		'description' => 'This is the center box in the footer.',	
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));
    register_sidebar(array(
		'name' => 'Right Footer Box',
		'description' => 'This is the right box in the footer.',	
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));


// clear shortcode
// a quick shortcode that clears floats
function clear() {
	return '<div class="clear"></div>';
}
add_shortcode('clear','clear');

/* load styles and scripts */
/*
   twitter_anywhere = loads the twitter @anywhere framework
   twitter_hovercards = loads twitter hovercards from @anywhere
   suckerfish = loads suckerfish from the theme's /js files  
*/
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
   // this loads the font stack
   wp_register_style('corefonts',get_bloginfo('template_directory').'/fonts/fonts.css',false,$theme['Version']);
   wp_enqueue_style('corefonts');
   // this loads the style.css
   wp_register_style('corecss',get_bloginfo('stylesheet_url'),false,$theme['Version']);
   wp_enqueue_style('corecss');
   wp_register_style( 'coreie', get_bloginfo( 'template_directory' ) . '/css/ie.css', false, $theme['Version'] );
   $GLOBALS['wp_styles']->add_data( 'coreie', 'conditional', 'lte IE 8' );
   wp_enqueue_style( 'coreie' );   
}



/* WordPress core functionality */
function ap_core_setup() {
	// post thumbnail support
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 175, 175 ); // 175 pixels wide by 175 pixels tall, box resize mode

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
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'core_header_image_width', 940 ) );
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
		'leaves' => array(
			'url' => '%s/images/headers/leaves.jpg',
			'thumbnail_url' => '%s/images/headers/leaves-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Leaves', 'cg' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'cg' )
		),
		'beach' => array(
			'url' => '%s/images/headers/beach.jpg',
			'thumbnail_url' => '%s/images/headers/beach-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Beach', 'cg' )
		),
		'blueberries' => array(
			'url' => '%s/images/headers/blueberries.jpg',
			'thumbnail_url' => '%s/images/headers/blueberries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Blueberries', 'cg' )
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
     <div id="comment-<?php comment_ID(); ?>">
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
      <div class="reply"><h4>
         <?php comment_reply_link(array_merge
		 ( $args, array('depth' => $depth, 'reply_text' => 'Respond to this', 'max_depth' => $args['max_depth']))) ?>
      </h4></div>
     </div>
	<?php
        }
		
	// this changes the default [...] to be a read more hyperlink
	function new_excerpt_more($more) {
		return '...&nbsp;(<a href="'. get_permalink($post->ID) . '">' . 'read more' . '</a>)';
	}
	add_filter('excerpt_more', 'new_excerpt_more');		
}
add_action('after_setup_theme','ap_core_setup');

?>