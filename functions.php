<?php

if ( !isset( $content_width ) )
    $content_width = 698;

if ( !isset( $themecolors ) )
    $themecolors = array( 'bg' => 'f5f5f5', 'border' => 'f5f5f5', 'text' => '111111' );

if (!function_exists('ap_core_register_sidebars')) {
    function ap_core_register_sidebars() {
        register_sidebar(array(
            'id' => 'main-sidebar-box',
            'name' => __('Sidebar','museum-core'),
            'description' => __('This is the regular, widgetized sidebar','museum-core'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'id' => 'left-footer-box',
        	'name' => __('Left Footer Box','museum-core'),
        	'description' => __('This is the left box in the footer.','museum-core'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'id' => 'center-footer-box',
    		'name' => __('Center Footer Box','museum-core'),
        	'description' => __('This is the center box in the footer.','museum-core'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'id' => 'right-footer-box',
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
        wp_register_style('droidsans','//fonts.googleapis.com/css?family=Droid+Sans&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('ptserif','//fonts.googleapis.com/css?family=PT+Serif&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('inconsolata','//fonts.googleapis.com/css?family=Inconsolata&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('ubuntu','//fonts.googleapis.com/css?family=Ubuntu&subset=' . $font_subset,false,$theme['Version']);
        wp_register_style('lato','//fonts.googleapis.com/css?family=Lato&subset=' . $font_subset,false,$theme['Version'] );
        wp_register_style( 'notoserif','//fonts.googleapis.com/css?family=Noto+Serif&subset=' . $font_subset,false, $theme['Version']  );
        wp_register_style( 'opensans', '//fonts.googleapis.com/css?family=Open+Sans&subset=' . $font_subset, false, $theme['Version'] );
        // only enqueue fonts that are actually being used
        $heading = ( isset( $options['heading'] ) ) ? $options['heading'] : $defaults['heading'];
        $body = ( isset( $options['body'] ) ) ? $options['body'] : $defaults['body'];
        $alt = ( isset( $options['alt'] ) ) ? $options['alt'] : $defaults['alt'];
        $corefonts = array( $heading, $body, $alt );
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
        wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false, $theme['Version'] );

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

        // load up the theme options
        require_once ( get_template_directory() . '/inc/theme-options.php' );
        // include theme hook alliance hooks
        require_once( get_template_directory() . '/inc/hooks.php' );
        // include bootstrap nav walker class
        require_once( get_template_directory() . '/inc/class-bootstrap-nav-walker.php' );

        // i18n stuff
        load_theme_textdomain('museum-core', get_template_directory() .'/lang');

        // Add title tag support.
        add_theme_support( 'title-tag' );
        
        // html5 theme support
        add_theme_support( 'html5' );

        // post thumbnail support
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 150, 150 ); // 150 pixels wide by 150 pixels tall, box resize mode
        // post formats
        // register all post formats -- child themes can remove some post formats as they so desire
        add_theme_support('post-formats',array('aside','gallery','link','image','quote','status','video','audio','chat'));

        // automatic feed links
        add_theme_support('automatic-feed-links');

        // custom nav menus
        // This theme uses wp_nav_menu() in three (count them, three!) locations.
        register_nav_menus( array(
        	'top' => __( 'Top Header Navigation', 'museum-core' ),
        	'main' => __( 'Main Navigation', 'museum-core' ),
        	'footer' => __( 'Footer Navigation', 'museum-core' ),
        ) );

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
                <li <?php comment_class( 'media' ); ?> id="li-comment-<?php comment_ID() ?>">
                    <div id="comment-<?php comment_ID(); ?>" class="the_comment">
                        <div class="comment-author vcard">
                            <?php if ( get_avatar($comment) ) : ?>
                                <div class="thumbnail media-object"><?php echo get_avatar($comment,$size='64',$default='' ); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="media-body">
                            <label><?php echo sprintf(_x('On %1$s at %2$s, %3$s said:', '1: date, 2: time, 3:author', 'museum-core'),
                                esc_html( get_comment_date() ),
                                esc_html( get_comment_time() ),
                                wp_kses_post( get_comment_author_link() )
                                ); ?></label>
                            <?php if ($comment->comment_approved == '0') : ?>
                                <em><?php _e('Your comment is awaiting moderation.', 'museum-core') ?></em>
                                <br />
                            <?php endif; ?>
                            <?php comment_text() ?>
                            <?php if ( comments_open() ) {
                                if ( $depth < $args['max_depth'] ) { ?>
                                    <div class="reply"><button class="btn btn-default btn-sm">
                                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text' => __('Respond to this','museum-core'), 'max_depth' => $args['max_depth']))) ?>
                                    </button></div>
                            <?php }
                            } ?>
                            <small>
                                <div class="comment-meta commentmetadata"><?php edit_comment_link( '<span class="text-danger">' . __('(Edit)', 'museum-core') . '</span>','','') ?></div>
                                <a href="<?php comment_link(); ?>"><?php _e( 'Permalink', 'museum-core' ); ?></a>
                            </small>
                        </div>
                    </div>
                </li>
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
            if ( !is_attachment() ) {
                $ap_core_title = single_post_title( '', false ) . ' | ' . $category[0]->cat_name;
            } else {
                global $post;
                $parent = get_post( $post->post_parent );
                $ap_core_title = single_post_title( '', false ) . ' : ' . get_the_title( $parent );
            }
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
 * Link Pages
 * @author toscha
 * @since 2.0.0
 * @link http://wordpress.stackexchange.com/questions/14406/how-to-style-current-page-number-wp-link-pages
 * @param  array $args
 * @return void
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 */
function ap_core_link_pages( $args = array () ) {
    $defaults = array(
        'before'      => '<p>' . __('Pages:', 'museum-core'),
        'after'       => '</p>',
        'before_link' => '',
        'after_link'  => '',
        'current_before' => '',
        'current_after' => '',
        'link_before' => '',
        'link_after'  => '',
        'pagelink'    => '%',
        'echo'        => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    if ( ! $multipage )
    {
        return;
    }

    $output = $before;

    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
    {
        $j       = str_replace( '%', $i, $pagelink );
        $output .= ' ';

        if ( $i != $page || ( ! $more && 1 == $page ) )
        {
            $output .= "{$before_link}" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>{$after_link}";
        }
        else
        {
            $output .= "{$current_before}{$link_before}<a>{$j}</a>{$link_after}{$current_after}";
        }
    }

    print wp_kses_post( $output ) . $after;
}

/**
 * Add the meta tags with a filter
 * This function outputs the (potentially filtered) content of the meta tag filter
 * @author Chris Reynolds
 * @since 2.0.4
 */
add_action( 'tha_head_bottom', 'ap_core_do_meta_tags' );
function ap_core_do_meta_tags() {
    echo wp_kses_post( ap_core_meta_tags() );
}

/**
 * Build the meta tags and allow other people to filter them
 * @author Chris Reynolds
 * @since 2.0.4
 */
function ap_core_meta_tags() {
    $output = '<meta name="viewport" content="width=device-width, initial-scale=1">';
    $output .= '<link rel="pingback" href="' . get_bloginfo('pingback_url') . '" />';

    if ( has_filter( 'ap_core_filter_meta_tags' ) ) {
        $output = apply_filters( 'ap_core_filter_meta_tags', 10, 2 );
    }
    return $output;
}
/*
    example filter:
    function my_cool_filter( $output ) {
        $output = '<meta name="viewport" content="width="device-width">';
        return $output;
    }
    add_filter( 'ap_core_filter_meta_tags', 'my_cool_filter' );
*/


/* Filter the content of chat posts. */
add_filter( 'the_content', 'ap_core_chat_content' );

/* Auto-add paragraphs to the chat text. */
add_filter( 'ap_core_chat_text', 'wpautop' );

/**
 * This function filters the post content when viewing a post with the "chat" post format.  It formats the
 * content with structured HTML markup to make it easy for theme developers to style chat posts.  The
 * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can
 * have 100s of speakers in your chat post, each with their own, unique classes for styling.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $ap_core_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
function ap_core_chat_content( $content ) {
    global $ap_core_post_format_chat_ids;

    /* If this is not a 'chat' post, return the content. */
    if ( !has_post_format( 'chat' ) )
        return $content;

    /* Set the global variable of speaker IDs to a new, empty array for this chat. */
    $ap_core_post_format_chat_ids = array();

    /* Allow the separator (separator for speaker/text) to be filtered. */
    $separator = apply_filters( 'ap_core_chat_separator', ':' );

    /* Open the chat transcript div and give it a unique ID based on the post ID. */
    $chat_output = "\n\t\t\t" . '<ul id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript list-group">';

    /* Split the content to get individual chat rows. */
    $chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

    /* Loop through each row and format the output. */
    foreach ( $chat_rows as $chat_row ) {

        /* If a speaker is found, create a new chat row with speaker and text. */
        if ( strpos( $chat_row, $separator ) ) {

            /* Split the chat row into author/text. */
            $chat_row_split = explode( $separator, trim( $chat_row ), 2 );

            /* Get the chat author and strip tags. */
            $chat_author = strip_tags( trim( $chat_row_split[0] ) );

            /* Get the chat text. */
            $chat_text = trim( $chat_row_split[1] );

            /* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
            $speaker_id = ap_core_chat_row_id( $chat_author );

            /* Open the chat row. */
            $chat_output .= "\n\t\t\t\t" . '<li class="list-group-item chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

            /* Add the chat row author. */
            $chat_output .= "\n\t\t\t\t\t" . '<div class="pull-left chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'ap_core_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';

            /* Add the chat row text. */
            $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'ap_core_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

            /* Close the chat row. */
            $chat_output .= "\n\t\t\t\t" . '</li><!-- .chat-row -->';
        }

        /**
         * If no author is found, assume this is a separate paragraph of text that belongs to the
         * previous speaker and label it as such, but let's still create a new row.
         */
        else {

            /* Make sure we have text. */
            if ( !empty( $chat_row ) ) {

                /* Open the chat row. */
                $chat_output .= "\n\t\t\t\t" . '<li class="list-group-item chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

                /* Don't add a chat row author.  The label for the previous row should suffice. */

                /* Add the chat row text. */
                $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'ap_core_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

                /* Close the chat row. */
                $chat_output .= "\n\t\t\t</li><!-- .chat-row -->";
            }
        }
    }

    /* Close the chat transcript div. */
    $chat_output .= "\n\t\t\t</ul><!-- .chat-transcript -->\n";

    /* Return the chat content and apply filters for developers. */
    return apply_filters( 'ap_core_chat_content', $chat_output );
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John"
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $ap_core_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function ap_core_chat_row_id( $chat_author ) {
    global $ap_core_post_format_chat_ids;

    /* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
    $chat_author = strtolower( strip_tags( $chat_author ) );

    /* Add the chat author to the array. */
    $ap_core_post_format_chat_ids[] = $chat_author;

    /* Make sure the array only holds unique values. */
    $ap_core_post_format_chat_ids = array_unique( $ap_core_post_format_chat_ids );

    /* Return the array key for the chat author and add "1" to avoid an ID of "0". */
    return absint( array_search( $chat_author, $ap_core_post_format_chat_ids ) ) + 1;
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

        echo wp_kses_post( $ap_core_version );
    }
    $options = get_option( 'ap_core_theme_options' );
    if ( isset( $options['generator'] ) && $options['generator'] == true) {
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
            'footer' => sprintf( _x( '%1$s %2$s %3$s', '1: copyright, 2: year, 3: blog title', 'museum-core' ), '&copy;',  date('Y'), get_bloginfo('title') ) . ' . ' . sprintf( __( 'Museum Core is proudly powered by %1$sWordPress%2$s.', 'museum-core' ), '<a href="http://wordpress.org" target="_blank">', '</a>' ),
            // advanced settings
            'author' => 0,
            'generator' => 0,
            'archive-excerpt' => 1,
            'hovercards' => 1,
            'favicon' => '',
            'site-title' => 1,
            'post-author' => 1,
            'font_subset' => 'latin',
            'nav-menu' => 0,
            'navbar-inverse' => 0,
            'navbar-color' => '',
            'navbar-link' => '',
            'breadcrumbs' => 0
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
        $output_navbar = null;
        $output_navbar_link = null;
        $heading = null;
        $body = null;
        $alt = null;
        $link = null;
        $hover = null;
        $font = null;
        $content_bg = null;
        $navbar_color = null;
        $navbar_link = null;

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
        if ( isset( $options['hover'] ) && $options['hover'] !== $defaults['hover'] || isset( $options['hover'] ) && isset( $options['link'] ) ) {
            $hover = sanitize_text_field($options['hover']);
            $output_hover = "a:hover, a:active { color: $hover; -webkit-transition: all 0.3s ease!important; -moz-transition: all 0.3s ease!important; -o-transition: all 0.3s ease!important; transition: all  0.3s ease!important; }";
        }
        if ( isset( $options['navbar-color'] ) ) {
            $navbar_color = sanitize_text_field( $options['navbar-color'] );
            $output_navbar = ".topnav { background-color: $navbar_color; }";
        }
        if ( isset( $options['navbar-link'] ) ) {
            $navbar_link = sanitize_text_field( $options['navbar-link'] );
            $output_navbar_link .= ".topnav .navbar-nav>li>a { color: $navbar_link; }";
            if ( true == $options['navbar-inverse'] ) {
                $output_navbar_link .= '.topnav .navbar-nav>li>a:hover { color: #fff; }';
            } else {
                $output_navbar_link .= '.topnav .navbar-nav>li>a:hover { color: #333; }';
            }
        }

        $output = '<style type="text/css" media="print,screen">';
        $output .= $output_heading;
        $output .= $output_alt;
        $output .= $output_body;
        $output .= $output_content_bg;
        $output .= $output_link;
        $output .= $output_hover;
        $output .= $output_navbar;
        $output .= $output_navbar_link;

        if ( isset( $options['site-title'] ) && $options['site-title'] == false ) {
            $output .= '.headerimg hgroup h2, .headerimg hgroup h3 { float: left; position: absolute; left: -999em; height: 0px; }';
        }

        $output .= '</style>';
        if ( $heading || $body || $alt || $link || $hover || isset( $options['site-title'] ) && $options['site-title'] == false ) {
            echo wp_kses( $output, array( 'style' => array( 'type' => array(), 'media' => array() ) ) );
        }
    }
    add_action( 'wp_head', 'ap_core_custom_styles' );
}

/**
 * Breadcrumbs
 * @since 2.0.0
 * @author Rachel Baker
 * @link https://github.com/rachelbaker/bootstrapwp-Twitter-Bootstrap-for-WordPress/blob/master/functions.php
 * Adds breadcrumbs and hooks them into tha_content_top if enabled.
 * Based on Rachel Baker's Twitter Bootstrap for WordPress theme
 */
if ( !function_exists( 'ap_core_breadcrumbs' ) ) {
    $options = get_option( 'ap_core_theme_options' );

    function ap_core_breadcrumbs() {
        global $post, $paged;

        $accepted_parameters = array(
            'li' => array(
                'class' => array()
            ),
            'span' => array(
                'typeof' => array(),
            ),
            'a' => array(
                'href' => array(),
                'rel' => array(),
                'property' => array()
            )
        );
        // this sets up some breadcrumbs for posts & pages that support Twitter Bootstrap styles
        echo '<ul xmlns:v="http://rdf.data-vocabulary.org/#" class="breadcrumb">';

        if ( !is_home() || !is_front_page() || !is_paged() ) {

            echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . esc_url( get_home_url() ) . '">' . __( 'Home', 'museum-core' ) . '</a></span></li>';

            if ( is_category() ) {
                $category = get_the_category();
                if ($category) {
                    foreach($category as $category) {
                    echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></span></li>';
                    }
                }
                echo '<li class="active"><span typeof="v:Breadcrumb">' . sprintf( __( 'Posts filed under <q>%s</q>', 'museum-core' ), single_cat_title( '', false ) ) . '</span></li>';
            } elseif ( is_day() ) {
                echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a></span></li>';
                echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '">' . get_the_time('F') . '</a></span></li>';
                echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_time('d') . '</span></li>';
            } elseif ( is_month() ) {
                echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a></span></li>';
                echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_time('F') . '</span></li>';
            } elseif ( is_year() ) {
                echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_time('Y') . '</span></li>';
            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object( get_post_type() );
                    $slug = $post_type->rewrite;
                    echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . home_url() . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></span></li>';
                    echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_title() . '</span></li>';
                } else {
                    $category = get_the_category();
                    if ($category) {
                        foreach($category as $category) {
                        echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></span></li>';
                        }
                    }
                    echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_title() . '</span></li>';
                }
            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object( get_post_type() );
                echo '<li class="active"><span typeof="v:Breadcrumb">' . $post_type->labels->singular_name . '</span></li>';
            } elseif ( is_attachment() ) {
                $parent = get_post( $post->post_parent );
                $category = get_the_category( $parent->ID );
                if ( $category ) {
                    foreach($category as $category) {
                    echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></span></li>';
                    }
                }
                echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_title() . '</span></li>';
            } elseif ( is_page() && !$post->post_parent ) {
                echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_title() . '</span></li>';
            } elseif ( is_page() && $post->post_parent ) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ( $parent_id != 0 ) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a></span></li>';
                        //Get next parent, walk backwards
                        $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse( $breadcrumbs );
                foreach ( $breadcrumbs as $crumb ) {
                    echo wp_kses( $crumb, $accepted_parameters );
                }
                echo '<li class="active"><span typeof="v:Breadcrumb">' . get_the_title() . '</span></li>';
            } elseif ( is_search() ) {
                echo '<li class="active"><span typeof="v:Breadcrumb">' . sprintf( __( 'Search results for <q>%s</q>', 'museum-core' ), esc_attr( get_search_query() ) ) . '</span></li>';
            } elseif ( is_tag() ) {
                echo '<li class="active"><span typeof="v:Breadcrumb">' . sprintf( __( 'Posts tagged <q>%s</q>', 'museum-core' ), single_tag_title( '', false ) ) . '</span></li>';
            } elseif ( is_author() ) {
                global $author;
                echo '<li class="active"><span typeof="v:Breadcrumb">' . sprintf( __( 'All posts by %s', 'museum-core' ), get_the_author_meta('display_name',$author) ) . '</span></li>';
            } elseif ( is_404() ) {
                echo '<li class="active"><span typeof="v:Breadcrumb">' . __( 'Error 404', 'museum-core' ) . '</span></li>';
            }
        }
        if ( is_paged() ) {
            $front_page_ID = get_option( 'page_for_posts' );
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
                echo '&nbsp;<span class="active paged">(' . sprintf( __( 'Page %s', 'museum-core' ), esc_attr( $paged ) ) . ')</li>';
            } else {
                echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . esc_url( get_home_url() ) . '">' . __( 'Home', 'museum-core' ) . '</a></span></li>';
                echo '<li><span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . esc_url( get_home_url() ) . '/?p=' . $front_page_ID . '">' . __( 'Blog', 'museum-core' ) . '</a></span></li>';
                echo '<li class="active paged">' . sprintf( __( 'Page %s', 'museum-core' ), esc_attr( $paged ) ) . '</li>';
            }
        }

        echo '</ul>';

    }

    if ( isset( $options['breadcrumbs'] )  && ( true == $options['breadcrumbs'] ) ) :

        add_action( 'tha_content_top', 'ap_core_breadcrumbs' );

    endif;
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
        if ( isset( $options['author'] ) && $options['author'] == true ) {
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
            $favicon = $options['favicon']; ?>
            <link rel="Shortcut Icon" href="<?php echo esc_url( $favicon ); ?>" type="image/x-icon" />
        <?php }
    }
    add_action( 'wp_head', 'ap_core_favicon' );
}

/**
 * Get Which Sidebar
 * @since 2.0.1
 * @author Chris Reynolds
 * returns the sidebar classes
 */
if ( !function_exists( 'ap_core_get_which_sidebar' ) ) {
    function ap_core_get_which_sidebar() {
        $defaults = ap_core_get_theme_defaults();
        $options = get_option( 'ap_core_theme_options' );
        if ( isset( $options['sidebar'] ) ) {
            $sidebar = $options['sidebar'];
            if ( 'right' == $sidebar ) {
                $sidebar .= ' last';
            }
        } else {
            $sidebar = $defaults['sidebar'];
        }

        return $sidebar;
    }
}

/**
 * Get Which Content
 * @since 2.0.1
 * @author Chris Reynolds
 * @uses ap_core_get_which_sidebar
 * returns the content classes
 */
if ( !function_exists( 'ap_core_get_which_content' ) ) {
    function ap_core_get_which_content() {
        $content = '';
        $sidebar = ap_core_get_which_sidebar();

        if ( 'left' == $sidebar ) {
            $content = 'the_right last';
        }

        return $content;
    }
}

/**
 * Blog excerpt or full post
 * @since 2.0.1
 * @author Chris Reynolds
 * returns the blog excerpt option
 */
if ( !function_exists( 'ap_core_blog_excerpts' ) ) {
    function ap_core_blog_excerpts() {
        $options = get_option( 'ap_core_theme_options' );
        $defaults = ap_core_get_theme_defaults();
        if ( !isset( $options['excerpts'] ) ) {
            $excerpt = $defaults['excerpts'];
        } else {
            $excerpt = $options['excerpts'];
        }

        return $excerpt;
    }
}

/**
 * Archive excerpt or full post
 * @since 2.0.1
 * @author Chris Reynolds
 * returns the archive excerpt option
 */
if ( !function_exists( 'ap_core_archive_excerpts' ) ) {
    function ap_core_archive_excerpts() {
        $options = get_option( 'ap_core_theme_options' );
        $defaults = ap_core_get_theme_defaults();
        if ( !isset( $options['archive-excerpt'] ) ) {
            $excerpt = $defaults['archive-excerpt'];
        } else {
            $excerpt = $options['archive-excerpt'];
        }

        return $excerpt;
    }
}
