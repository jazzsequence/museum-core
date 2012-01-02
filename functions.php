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
    // this loads jquery (for formalize, among other things)
    wp_enqueue_script('jquery');
   // this loads the formalize js
   wp_register_script('formalize',get_bloginfo('template_directory').'/js/jquery.formalize.min.js',false,$theme['Version']);
   wp_enqueue_script('formalize');
   // loads modernizr for BPH5
   wp_register_script('modernizr',get_bloginfo('template_directory').'/js/modernizr-2.0.6.min.js',false,'2.0.6');
   wp_enqueue_script('modernizr');
   // this loads the font stack
   wp_register_style('corefonts',get_bloginfo('template_directory').'/fonts/fonts.css',false,$theme['Version']);
   wp_enqueue_style('corefonts');
   // this loads the style.css
   wp_register_style('corecss',get_bloginfo('stylesheet_url'),false,$theme['Version']);
   wp_enqueue_style('corecss');
}

/* WordPress core functionality */
function ap_core_setup() {
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
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'core_header_image_width', 1120 ) );
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
		return '...&nbsp;(<a href="'. get_permalink($post->ID) . '">' . 'read more' . '</a>)';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

}
add_action('after_setup_theme','ap_core_setup');

/* Build a Theme Options page */
function ap_core_register_settings() {
	register_setting( 'ap_core_theme_options', 'ap_core_options', 'ap_core_validate_options' );
}
add_action ( 'admin_init', 'ap_core_register_settings' );

// default options settings
$ap_core_options = array(
	'sidebar' => 'left',
	// typography options
	'headings' => 'PTSerif',
	'body' => 'DroidSans',
	'alt' => 'Ubuntu'
);
$ap_core_sidebar = array(
	'left' => array(
		'value' => 'left',
		'label' => 'Left Sidebar'),
	'right' => array(
		'value' => 'right',
		'label' => 'Right Sidebar')
);

function ap_core_theme_options() {
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'ap_core_theme_options_page' );
}
add_action ( 'admin_menu', 'ap_core_theme_options' );

function ap_core_theme_options_page() {
	global $ap_core_options, $ap_core_sidebar;
	if ( ! isset( $_REQUEST['updated'] ) )
    $_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>
	<div class="wrap">

    <?php screen_icon(); echo "<h2>Core Options</h2>";
    // This shows the page's name and an icon if one has been provided ?>

    <?php if ( false !== $_REQUEST['updated'] ) : ?>
    <div><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
    <?php endif; // If the form has just been submitted, this shows the notification ?>

    <form method="post" action="options.php">

    <?php $settings = get_option( 'ap_core_options', $ap_core_options ); ?>

    <?php settings_fields( 'ap_core_theme_options' );
    /* This function outputs some hidden fields required by the form,
    including a nonce, a unique number used to ensure the form has been submitted from the admin page
    and not somewhere else, very important for security */ ?>
	<table class="form-table">
	<tr valign="top"><th scope="row"><label for="sidebar">Sidebar</label></th>
	<td>
		<?php  foreach( $ap_core_sidebar as $sidebar ) : ?>
			<input type="radio" id="<?php echo $sidebar['value']; ?>" name="ap_core_options[sidebar]" value="<?php esc_attr_e( $sidebar['value'] ); ?>" <?php checked( $settings['sidebar'], $sidebar['value'] ); ?> />
			<label for="<?php echo $sidebar['value']; ?>"><?php echo $sidebar['label']; ?></label><br />
			<?php endforeach; ?>
	</td>
	</tr>
<?php /*
    <table><!-- Grab a hot cup of coffee, yes we're using tables! -->

    <tr valign="top"><th scope="row"><label for="footer_copyright">Footer Copyright Notice</label></th>
    <td>
    <input id="footer_copyright" name="ap_core_options[footer_copyright]" type="text" value="<?php  esc_attr_e($settings['footer_copyright']); ?>" />
    </td>
    </tr>

    <tr valign="top"><th scope="row"><label for="intro_text">Intro Text</label></th>
    <td>
    <textarea id="intro_text" name="ap_core_options[intro_text]" rows="5" cols="30"><?php echo stripslashes($settings['intro_text']); ?></textarea>
    </td>
    </tr>

    <tr valign="top"><th scope="row"><label for="featured_cat">Featured Category</label></th>
    <td>
    <select id="featured_cat" name="ap_core_options[featured_cat]">
    <?php
    foreach ( $categories as $category ) :
        $label = $category['label'];
        $selected = '';
        if ( $category['value'] == $settings['featured_cat'] )
            $selected = 'selected="selected"';
        echo '<option style="padding-right: 10px;" value="' . esc_attr( $category['value'] ) . '" ' . $selected . '>' . $label . '</option>';
    endforeach;
    ?>
    </select>
    </td>
    </tr>

    <tr valign="top"><th scope="row">Layout View</th>
    <td>
    <?php foreach( $layouts as $layout ) : ?>
    <input type="radio" id="<?php echo $layout['value']; ?>" name="ap_core_options[layout_view]" value="<?php esc_attr_e( $layout['value'] ); ?>" <?php checked( $settings['layout_view'], $layout['value'] ); ?> />
    <label for="<?php echo $layout['value']; ?>"><?php echo $layout['label']; ?></label><br />
    <?php endforeach; ?>
    </td>
    </tr>

    <tr valign="top"><th scope="row">Author Credits</th>
    <td>
    <input type="checkbox" id="author_credits" name="ap_core_options[author_credits]" value="1" <?php checked( true, $settings['author_credits'] ); ?> />
    <label for="author_credits">Show Author Credits</label>
    </td>
    </tr>

    </table> */ ?>
	</table>
    <p class="submit"><input type="submit" id="submit" class="button-primary" value="Save Options" /></p>

    </form>

    </div>

<?php }
function ap_core_validate_options( $input ) {
    global $ap_core_options, $ap_core_sidebar;

    $settings = get_option( 'ap_core_options', $ap_core_options );

    // We select the previous value of the field, to restore it in case an invalid entry has been given
    $prev = $settings['sidebar'];
    // We verify if the given value exists in the layouts array
    if ( !array_key_exists( $input['sidebar'], $ap_core_sidebar ) )
    $input['sidebar'] = $prev;


    return $input;
}
?>