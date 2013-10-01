<?php
if (!function_exists('ap_core_register_sidebars')) {
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
}

/**
 * clear shortcode
 * @since 0.1
 * @author Chris Reynolds
 * @uses add_shortcode
 * a quick shortcode that clears floats
 * usage example: [clear]
 */
if (!function_exists('ap_core_clear')) {
    function ap_core_clear() {
    	return '<div class="clear"></div>';
    }
    add_shortcode('clear','ap_core_clear');
}

/**
 * load scripts
 * @since 0.1
 * @author Chris Reynolds
 * @uses wp_register_script()
 * @uses wp_enqueue_script()
 * @uses wp_register_style()
 * @uses wp_enqueue_style
 * loads all the styles and scripts for the theme
*/
if (!function_exists('ap_core_load_scripts')) {
    function ap_core_load_scripts() {
      if ( !is_admin() ) { // instruction to only load if it is not the admin area
        global $is_IE;

        $theme = wp_get_theme();
        // load the theme options and defaults
        $defaults = ap_core_get_theme_defaults();
        $options = get_option( 'ap_core_theme_options' );
        if ( isset( $options['font_subset'] ) ) {
            $font_subset = $options['font_subset'];
        } else {
            $font_subset = $defaults['font_subset'];
        }

        // this loads jquery (for bootstrap, among other things)
        wp_enqueue_script('jquery');
        // load boostrap
        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.0.0', true );
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, '3.0.0' );
        // loads modernizr for BPH5
        wp_register_script('modernizr',get_template_directory_uri() . '/assets/js/modernizr-2.5.3.min.js',false,'2.5.3');
        wp_enqueue_script('modernizr');
        // register fonts
        wp_register_style('droidsans','http://fonts.googleapis.com/css?family=Droid+Sans&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('ptserif','http://fonts.googleapis.com/css?family=PT+Serif&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('inconsolata','http://fonts.googleapis.com/css?family=Inconsolata&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('ubuntu','http://fonts.googleapis.com/css?family=Ubuntu&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('lato','http://fonts.googleapis.com/css?family=Lato&subset=' . $font_subset,false,$theme['Version'] );
        wp_register_style( 'notoserif','http://fonts.googleapis.com/css?family=Noto+Serif&subset=' . $font_subset,false, $theme['Version']  );
        wp_register_style( 'opensans', 'http://fonts.googleapis.com/css?family=Open+Sans&subset=' . $font_subset, false, $theme['Version'] );
        // only enqueue fonts that are actually being used
        $corefonts = array( $options['heading'], $options['body'], $options['alt'] );
        //var_dump($corefonts);
        // if any of these fonts are selected, load their stylesheets
        if ( in_array( 'Droid Sans', $corefonts ) ) {
            wp_enqueue_style( 'droidsans' );
        }
        if ( in_array( 'PT Serif', $corefonts ) ) {
            wp_enqueue_style( 'ptserif' );
        }
        if ( in_array( 'Inconsolata', $corefonts ) ) {
            wp_enqueue_style( 'inconsolata' );
        }
        if ( in_array( 'Ubuntu', $corefonts ) ) {
            wp_enqueue_style( 'ubuntu' );
        }
        if ( in_array( 'Lato', $corefonts ) ) {
            wp_enqueue_style( 'lato' );
        }
        if ( in_array( 'Open Sans', $corefonts ) ) {
            wp_enqueue_style( 'opensans' );
        }
        if ( in_array( 'Noto Serif', $corefonts ) ) {
            wp_enqueue_style( 'notoserif' );
        }
        // this loads the style.css
        wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false, '3.2.1' );
        if ( $is_IE )
            wp_enqueue_style( 'fontawesome-ie7', get_template_directory_uri() . '/assets/css/font-awesome-ie7.min.css', array( 'fontawesome' ), '3.2.1' );
        wp_register_style('corecss', get_stylesheet_uri(),false,$theme['Version']);
        wp_enqueue_style('corecss');
        // loads the comment reply script
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
      }
    }
    add_action( 'wp_enqueue_scripts', 'ap_core_load_scripts' );
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
if (!function_exists('ap_core_setup')) {
    function ap_core_setup() {

        define( "AP_CORE_OPTIONS", get_template_directory() . '/inc/load-options.php' );
        // load up the theme options
        require_once ( get_template_directory() . '/inc/theme-options.php' );

        // i18n stuff
        load_theme_textdomain('museum-core', get_template_directory() .'/lang');

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
        if (!function_exists('ap_core_home_page_menu_args')) {
            function ap_core_home_page_menu_args( $args ) {
                $args['show_home'] = true;
                return $args;
            }
            add_filter( 'wp_page_menu_args', 'ap_core_home_page_menu_args' );
        }

        // This theme allows users to set a custom background
        add_theme_support( 'custom-background', array() );  // 'nuff said. there are no defaults here, so we'll move on to headers

        add_theme_support( 'custom-header', array(
            // default header image
            'default-image' => get_template_directory_uri() . '/images/headers/nature.jpg',
            // header text? no, because we're doing it a different way (though it would probably be good to fix this later)
            'header-text' => false,
            // header image width
            'width' => 1140,
            // flexible height?  sure
            'flex-height' => true,
            // header image height
            'height' => 200,
            // admin head callback
            'admin-head-callback' => 'core_admin_header_style' )
        );

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
        if (!function_exists('ap_core_comment')) {
        	function ap_core_comment($comment, $args, $depth) {
                $GLOBALS['comment'] = $comment; ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
                <div id="comment-<?php comment_ID(); ?>" class="the_comment">
                    <div class="comment-author vcard">
                        <?php echo get_avatar($comment,$size='64',$default='' ); ?>
                        <?php echo sprintf(__('On %1$s at %2$s %3$s said:','museum-core'), get_comment_date(), get_comment_time(), get_comment_author_link()) ?>
                    </div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php _e('Your comment is awaiting moderation.', 'museum-core') ?></em>
                        <br />
                    <?php endif; ?>
                    <?php comment_text() ?>
                    <div class="comment-meta commentmetadata"><?php edit_comment_link(__('(Edit)', 'museum-core'),'  ','') ?></div>
                    <?php if ( comments_open() ) { ?>
                        <div class="reply"><button>
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text' => __('Respond to this','museum-core'), 'max_depth' => $args['max_depth']))) ?>
                        </button></div>
                    <?php } ?>
                </div>
                <?php
            }
        }

    	// this changes the default [...] to be a read more hyperlink
        if (!function_exists('ap_core_new_excerpt_more')) {
        	function ap_core_new_excerpt_more($more) {
                global $post;
        		return '...&nbsp;(<a href="'. get_permalink($post->ID) . '">' . __('read more','museum-core') . '</a>)';
        	}
        	add_filter('excerpt_more', 'ap_core_new_excerpt_more');
        }

    }
    add_action('after_setup_theme','ap_core_setup');
}

/**
 * customized wp_title
 * @since 1.0.5
 * @author Chris Reynolds
 * @uses wp_title
 * @link http://wordpress.stackexchange.com/questions/32622/when-calling-wp-title-do-you-have-to-create-some-kind-of-title-php-file
 * replaces default wp_title with a modified version
 */
if (!function_exists('ap_core_wp_title')) {
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
}

/**
 * Meta generator
 * @since 0.4.5
 * @author Chris Reynolds
 * @uses wp_get_theme()
 * returns a generator meta tag that is added in the header which pulls automatically from the theme version
 * (replaces the original method which was updating this generator tag manually)
 * generator tag is used for troubleshooting to identify what version of the theme people are using by looking at the source
 */
if (!function_exists('ap_core_generator')) {
    function ap_core_generator() {
        $theme = wp_get_theme();
        $ap_core_version = '<meta name="generator" content="' . $theme['Name'] . ' ' . $theme['Version'] . '">';

        echo $ap_core_version;
    }
    $options = get_option( 'ap_core_theme_options' );
    if ($options['generator'] == true) {
        add_action( 'wp_head', 'ap_core_generator' );
    }
}

/**
 * Get default options
 * @since 0.4.0
 * @author Chris Reynolds
 * defines the options and some defaults
 */
if (!function_exists('ap_core_get_theme_defaults')) {
    function ap_core_get_theme_defaults(){
        // default options settings
        $defaults = array(
            // sidebar
        	'sidebar' => 'left',
            // theme tracking
            'presstrends' => 0,
        	// typography options
        	'heading' => 'notoserif',
        	'body' => 'opensans',
        	'alt' => 'lato',
            // link color
            'link' => '#428bca',
            'hover' => '#2a6496',
            // content area colors
            'content-color' => '#fff',
            'font-color' => '#111',
            // excerpts or full posts
            'excerpts' => 1,
            // use alt for h1?
            'alth1' => 0,
            // footer text
            'footer' => sprintf( _x( '%1$s %2$s %3$s', '1: copyright, 2: year, 3: blog title', 'museum-core' ), '&copy;',  date('Y'), get_bloginfo('title') ) . ' . ' . sprintf( __( 'Museum Core by %1$sMuseum Themes%2$s is proudly powered by %3$sWordPress%2$s.', 'museum-core' ), '<a href="http://museumthemes.com/" target="_blank" title="Museum Themes">', '</a>', '<a href="http://wordpress.org" target="_blank">' ),
            // advanced settings
            'author' => 0,
            'generator' => 0,
            'archive-excerpt' => 1,
            'hovercards' => 1,
            'favicon' => '',
            'site-title' => 1,
            'post-author' => 1,
            'font_subset' => 'latin'
        );
        return $defaults;
    }
}

/**
 * Sidebar settings
 * @since 0.4.0
 * @author Chris Reynolds
 * this is the array for the sidebar setting
 */
if (!function_exists('ap_core_sidebar')) {
    function ap_core_sidebar() {
        $sidebar = array(
            'left' => __( 'Left Sidebar', 'museum-core' ),
            'right' => __( 'Right Sidebar', 'museum-core' )
        );
        return $sidebar;
    }
}

/**
 * Font settings
 * @since 0.4.4
 * @author Chris Reynolds
 * this array handles the font selection
 */
if (!function_exists('ap_core_fonts')) {
    function ap_core_fonts() {
        $ap_core_fonts = array(
            'PT Serif' => 'PT Serif',
            'Inconsolata' => 'Inconsolata',
            'Droid Sans' => 'Droid Sans',
            'Ubuntu' => 'Ubuntu',
            'Lato' => 'Lato',
            'Noto Serif' => 'Noto Serif',
            'Open Sans' => 'Open Sans',
        );
        return $ap_core_fonts;
    }
}

/**
 * Font subset
 * @since 2.0.0
 * @author Chris Reynolds
 * allows the user to choose a specific font subset for i18n
 */
if ( !function_exists( 'ap_core_font_subset' ) ) {
    function ap_core_font_subset() {

        $font_subsets = array(
            'latin' => __( 'Latin', 'museum-core' ),
            'latin-ext' => __( 'Latin Extended', 'museum-core' ),
            'cyrillic' => __( 'Cyrillic', 'museum-core' ),
            'cyrillic-ext' => __( 'Cyrillic Extended', 'museum-core' ),
            'greek' => __( 'Greek', 'museum-core' ),
            'greek-ext' => __( 'Greek Extended', 'museum-core' ),
            'vietnamese' => __( 'Vietnamese', 'museum-core' )
        );

        return $font_subsets;

    }
}

/**
 * Show excerpts
 * @since 0.5
 * @author Chris Reynolds
 * option to show excerpts or full posts
 */
if (!function_exists('ap_core_show_excerpts')) {
    function ap_core_show_excerpts() {
        $ap_core_show_excerpts = array(
            true => __('Show Post Excerpts','museum-core'),
            false => __('Show Full Posts','museum-core')
        );
        return $ap_core_show_excerpts;
    }
}

/**
 * True/False option
 * @since 1.0.2
 * @author Chris Reynolds
 * generic yes/no function used for true/false options
 */
if (!function_exists('ap_core_true_false')) {
    function ap_core_true_false() {
        $ap_core_true_false = array(
            true => __('Yes','museum-core'),
            false => __('No','museum-core')
        );
        return $ap_core_true_false;
    }
}

/**
 * Custom styles
 * @since 0.4.5
 * @author Chris Reynolds
 * this fetches the custom color options from the database and spits them out into the header
 */
if (!function_exists('ap_core_custom_styles')) {
    function ap_core_custom_styles() {
        $output = null;
        $output_heading = null;
        $output_alt = null;
        $output_body = null;
        $output_content_bg = null;
        $output_font = null;
        $output_link = null;
        $output_hover = null;
        $heading = null;
        $body = null;
        $alt = null;
        $link = null;
        $hover = null;
        $font = null;
        $content_bg = null;

        $defaults = ap_core_get_theme_defaults();
        $options = get_option( 'ap_core_theme_options' );
        // set the heading font
        if ( isset( $options['heading'] ) && $options['heading'] != $defaults['heading'] ) {
            $heading = sanitize_text_field($options['heading']);
            $output_heading = "h1, h2, h3 { font-family: '$heading', sans-serif; }";
        }
        // set the body font
        if ( isset( $options['body'] ) && $options['body'] != $defaults['body'] || isset( $options['font-color'] ) && $options['font-color'] != $defaults['font-color'] ) {
            $output_body = 'body {';

            if ( isset( $options['body'] ) ) {
                $body = sanitize_text_field($options['body']);
                $output_body .= "font-family: '$body', sans-serif;";
            }

            if ( isset( $options['font-color'] ) ) {
                $font = sanitize_text_field( $options['font-color'] );
                $output_body .= "color: $font;";
            }

            $output_body .= '}';
        }
        // set the alt font
        if ( isset( $options['alt'] ) && $options['alt'] != $defaults['alt'] ) {
            $alt = sanitize_text_field($options['alt']);
            $output_alt = "h4, h5, h6, .alt, h3 time { font-family: '$alt', sans-serif; }";
        }
        // set the content background color
        if ( isset( $options['content-color'] ) && $options['content-color'] != $defaults['content-color'] ) {
            $content_bg = sanitize_text_field( $options['content-color'] );
            $output_content_bg = ".container { background: $content_bg; }";
        }
        // set the link color
        if ( isset( $options['link'] ) && $options['link'] != $defaults['link'] ) {
            $link = sanitize_text_field($options['link']);
            $output_link = "a, a:link, a:visited { color: $link; -webkit-transition: all 0.3s ease!important; -moz-transition: all 0.3s ease!important; -o-transition: all 0.3s ease!important; transition: all  0.3s ease!important; }";
        }
        if ( isset( $options['hover'] ) && $options['hover'] != $defaults['hover'] || $options['link'] ) {
            $hover = sanitize_text_field($options['hover']);
            $output_hover = "a:hover, a:active { color: $hover; -webkit-transition: all 0.3s ease!important; -moz-transition: all 0.3s ease!important; -o-transition: all 0.3s ease!important; transition: all  0.3s ease!important; }";
        }
        $output = "<style type=\"text/css\" media=\"print,screen\">";
        $output .= $output_heading;
        $output .= $output_alt;
        $output .= $output_body;
        $output .= $output_content_bg;
        $output .= $output_link;
        $output .= $output_hover;

        if ( isset( $options['site-title'] ) && $options['site-title'] == false ) {
            $output .= ".headerimg hgroup h2, .headerimg hgroup h3 { float: left; position: absolute; left: -999em; height: 0px; }";
        }

        $output .= "</style>";
        if ( $heading || $body || $alt || $link || $hover || $options['site-title'] == false ) {
            echo $output;
        }
    }
    add_action( 'wp_head', 'ap_core_custom_styles' );
}

/**
 * Header meta
 * @since 1.1.2
 * @author Chris Reynolds
 * serves up meta data if enabled
 */
if (!function_exists('ap_core_header_meta')) {
    function ap_core_header_meta() {
        global $post;
        $options = get_option( 'ap_core_theme_options' );
        $author_id = null;
        $author = null;

        /* author meta */
        if ($options['author'] == true) {
            if (!is_404()) {
                // if there is no post author, this stuff doesn't exist
                if ( $post->post_author ) {
                    $author_id = $post->post_author;
                    $author = get_userdata($author_id);
                }
                if ( $author ) {
                    ?>
                    <meta name="author" content="<?php echo sanitize_text_field($author->display_name); ?>">
                    <?php
                } // ends author check
            } // ends 404 check
        } // ends author option check
    }
    add_action( 'wp_head', 'ap_core_header_meta' );
}

/**
 * favicon
 * @since 1.1.2
 * @author Chris Reynolds
 * outputs the favicon if set in the options
 */
if (!function_exists('ap_core_favicon')) {
    function ap_core_favicon() {
        $options = get_option( 'ap_core_theme_options' );

        if ( isset($options['favicon']) ) {
            $favicon = esc_url($options['favicon']); ?>
            <link rel="Shortcut Icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
        <?php }
    }
    add_action( 'wp_head', 'ap_core_favicon' );
}
?>