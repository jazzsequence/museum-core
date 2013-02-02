<?php

/**
 * Register theme settings
 * @since 0.4.0
 * @author Chris Reynolds
 * registers the settings
 */
if (!function_exists('ap_core_theme_options_init')) {
	function ap_core_theme_options_init() {
	    register_setting( 'AP_CORE_OPTIONS', 'ap_core_theme_options', 'ap_core_theme_options_validate' );
	}
	add_action ( 'admin_init', 'ap_core_theme_options_init' );
}

/**
 * Theme options page
 * @since 0.1
 * @author Chris Reynolds
 * this creates the admin page
 * this also calls the ap_core_admin_scripts() function and adds those scripts to admin_print_scripts for that page
 */
if (!function_exists('ap_core_theme_options_add_page')) {
	function ap_core_theme_options_add_page() {
	    $page = add_theme_page( __('Theme Options','museum-core'), __('Theme Options','museum-core'), 'edit_theme_options', 'theme_options', 'ap_core_theme_options_page' );
	    add_action( 'admin_print_scripts-'.$page, 'ap_core_admin_scripts' );
	}
	add_action ( 'admin_menu', 'ap_core_theme_options_add_page' );
}

/**
 * Load admin scripts
 * @since 0.4.5
 * @author Chris Reynolds
 * @link http://theme.fm/blog/2011/08/30/using-the-color-picker-in-your-wordpress-theme-options/
 * loads the farbtastic color picker and other scripts and styles on the theme options page
 */
if (!function_exists('ap_core_admin_scripts')) {
	function ap_core_admin_scripts() {
		wp_register_style('ap_core_admin_css', get_template_directory_uri() .'/inc/admin.css',false,'1.1.1');
		wp_enqueue_style( 'ap_core_admin_css' );
		wp_enqueue_style( 'farbtastic' );
	    wp_enqueue_script( 'farbtastic' );
	    wp_enqueue_script( 'ap_core_color_picker', get_template_directory_uri() . '/js/color-picker.js', array( 'farbtastic', 'jquery' ) );
	    wp_enqueue_script( 'jquery-ui-tabs' );
	    wp_enqueue_style( 'jquery-ui-tabs' );
	    wp_enqueue_script( 'media-upload' );
	    wp_enqueue_script( 'thickbox' );
	    wp_enqueue_style( 'thickbox' );
	    wp_enqueue_script ( 'ap_core_uploader', get_template_directory_uri() . '/js/uploader.js', array( 'jquery', 'media-upload', 'thickbox' ) );
	}
}

/**
 * Side box
 * @since 0.4.5
 * @author Chris Reynolds
 * this adds some side boxes for news and twitter feed for the theme options page
 */
if (!function_exists('ap_core_side_box')) {
	function ap_core_side_box() {
		if ( get_bloginfo('version') < '3.4' ) { // if we're not using 3.4 (or higher), set this up the old way
			$postbox_before = '	<div id="side-info-column" class="inner-sidebar">';
			$postbox_before .= '		<div id="side-sortables" class="meta-box-sortables ui-sortable">';
			$postbox_before .= '			<div class="padding">';
			$postbox_before .= '				<div class="infolinks">';
			$postbox_after = '					</div>';
			$postbox_after .= '				</div>';
			$postbox_after .= '			</div>';
			$postbox_after .= '	</div>';
		} else { // otherwise, set this up the new way (see how much cleaner this is?)
			$postbox_before = '	<div id="postbox-container-1" class="postbox-container">';
			$postbox_after = '	</div>';
		} // this conditional should be taken out for 3.5
			echo $postbox_before;
						echo '<h2 style="margin:0">' . __('What\'s new at Museum Themes', 'museum-core') . '</h2>';

						// Get RSS Feed(s)
						wp_widget_rss_output('http://museumthemes.com/feed/', array('show_date' => 0, 'items' => 3));

						echo '<h2 style="margin:0">' . __('Follow us on Twitter', 'museum-core') . '</h2>';
						?>
							<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
							<script>
							new TWTR.Widget({
							  version: 2,
							  type: 'profile',
							  rpp: 1,
							  interval: 30000,
							  width: 280,
							  height: 150,
							  theme: {
							    shell: {
							      background: '#ffffff',
							      color: '#333333'
							    },
							    tweets: {
							      background: '#ffffff',
							      color: '#333333',
							      links: '#21749b'
							    }
							  },
							  features: {
							    scrollbar: false,
							    loop: false,
							    live: false,
							    behavior: 'default'
							  }
							}).render().setUser('arcanepalette').start();
							</script>
			<?php echo $postbox_after; ?>

		<script type="text/javascript" charset="utf-8">
		  var is_ssl = ("https:" == document.location.protocol);
		  var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
		  document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
		</script>

		<script type="text/javascript" charset="utf-8">
		  var feedback_widget_options = {};

		  feedback_widget_options.display = "overlay";
		  feedback_widget_options.company = "museum_themes";
		  feedback_widget_options.placement = "right";
		  feedback_widget_options.color = "#444444";
		  feedback_widget_options.style = "question";

		  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
		</script>
		<?php
	}
}

/**
 * Theme options page
 * @since 0.4.0
 * @author Chris Reynolds
 * this displays the actual options page
 */
if (!function_exists('ap_core_theme_options_page')) {
	function ap_core_theme_options_page() {

		require_once(get_template_directory() . '/inc/option-setup.php');
		wp_nonce_field( 'ap-core-settings-page' );
		if ( ! isset( $_REQUEST['settings-updated'] ) )
			$_REQUEST['settings-updated'] = false;
		?>
		<script>
			jQuery(function() {
				jQuery( "#tabs" ).tabs({ fx: { opacity: 'toggle', duration:'fast'} });
			});
		</script>
		<div class="wrap">
			<?php if ( function_exists( 'wp_get_theme' ) ) {
				$theme_name = wp_get_theme()->Name;
			} else {
				$theme_name = get_current_theme();
			} ?>
			<h2><?php echo sprintf( __('%s Theme Options','museum-core'), $theme_name ); ?></h2>

			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'museum-core' ); ?></strong></p></div>
			<?php endif; ?>
			<div id="poststuff" class="metabox-holder has-right-sidebar">
				<div id="post-body" class="metabox-holder columns-2">
				<?php ap_core_side_box(); ?>
				<div id="post-body-content">
						<form method="post" action="options.php">
							<div id="tabs">
								<?php settings_fields( 'AP_CORE_OPTIONS' ); ?>
								<?php ap_core_do_theme_options(); ?>
							</div>
							<p class="submit">
								<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Options', 'museum-core' ); ?>" />
								<input type="hidden" name="ap-core-settings-submit" value="Y" />
							</p>
						</form>
					</div><!-- closes post-body-content -->
				</div><!-- closes post-body -->
			</div><!-- closes poststuff -->
		</div><!-- closes wrap -->
		<?php
	}
}

// Start of PressTrends Magic
if (!function_exists('ap_core_presstrends')) {
	function ap_core_presstrends() {

/**
* PressTrends Theme API
*/
function presstrends_theme() {

		// PressTrends Account API Key
		$api_key = 'i93727o4eba1lujhti5bjgiwfmln5xm5o0iv';
		$auth = 'INSERT THEME AUTH CODE';

		// Start of Metrics
		global $wpdb;
		$data = get_transient( 'presstrends_theme_cache_data' );
		if ( !$data || $data == '' ) {
			$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
			$url      = $api_base . $auth . '/api/' . $api_key . '/';

			$count_posts    = wp_count_posts();
			$count_pages    = wp_count_posts( 'page' );
			$comments_count = wp_count_comments();

			// wp_get_theme was introduced in 3.4, for compatibility with older versions.
			if ( function_exists( 'wp_get_theme' ) ) {
				$theme_data    = wp_get_theme();
				$theme_name    = urlencode( $theme_data->Name );
				$theme_version = $theme_data->Version;
			} else {
				$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
				$theme_name = $theme_data['Name'];
				$theme_versino = $theme_data['Version'];
			}

			$plugin_name = '&';
			foreach ( get_plugins() as $plugin_info ) {
				$plugin_name .= $plugin_info['Name'] . '&';
			}
			$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
			$data                = array(
				'url'             => stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) ),
				'posts'           => $count_posts->publish,
				'pages'           => $count_pages->publish,
				'comments'        => $comments_count->total_comments,
				'approved'        => $comments_count->approved,
				'spam'            => $comments_count->spam,
				'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
				'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
				'theme_version'   => $theme_version,
				'theme_name'      => $theme_name,
				'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
				'plugins'         => count( get_option( 'active_plugins' ) ),
				'plugin'          => urlencode( $plugin_name ),
				'wpversion'       => get_bloginfo( 'version' ),
				'api_version'	  => '2.4',
			);

			foreach ( $data as $k => $v ) {
				$url .= $k . '/' . $v . '/';
			}
			wp_remote_get( $url );
			set_transient( 'presstrends_theme_cache_data', $data, 60 * 60 * 24 );
		}

	$options = get_option( 'ap_core_theme_options' );
	if ( $options['presstrends'] == true ) {
	add_action('admin_init', 'ap_core_presstrends');
	}
}

/**
 * Validate options
 * completely rewritten @since 0.4.0
 */
if (!function_exists('ap_core_theme_options_validate')) {
	function ap_core_theme_options_validate( $input ) {
		define('TYPE_WHITELIST', serialize(array(
		  'image/jpeg',
		  'image/jpg',
		  'image/png',
		  'image/gif',
		  'image/ico'
		  )));
	    if ( !array_key_exists( $input['sidebar'], ap_core_sidebar() ) )
	    $input['sidebar'] = $input['sidebar'];
		if ( !array_key_exists( $input['presstrends'], ap_core_true_false() ) )
		$input['presstrends'] = $input['presstrends'];
		if ( !array_key_exists( $input['heading'], ap_core_fonts() ) )
		$input['heading'] = $input['heading'];
		if ( !array_key_exists( $input['body'], ap_core_fonts() ) )
		$input['body'] = $input['body'];
		if ( !array_key_exists( $input['alt'], ap_core_fonts() ) )
		$input['alt'] = $input['alt'];
		if ( !array_key_exists( $input['alth1'], ap_core_true_false() ) )
		$input['alth1'] = $input['alth1'];
		if ( !array_key_exists( $input['meta'], ap_core_true_false() ) )
		$input['meta'] = $input['meta'];
		if ( !array_key_exists( $input['author'], ap_core_true_false() ) )
		$input['author'] = $input['author'];
		if ( !array_key_exists( $input['generator'], ap_core_true_false() ) )
		$input['generator'] = $input['generator'];
		if ( !array_key_exists( $input['hovercards'], ap_core_true_false() ) )
		$input['hovercards'] = $input['hovercards'];
		if ( !array_key_exists( $input['site-title'], ap_core_true_false() ) )
		$input['site-title'] = $input['site-title'];
		if ( !array_key_exists( $input['excerpts'], ap_core_show_excerpts() ) )
		$input['excerpts'] = $input['excerpts'];
		if ( !array_key_exists( $input['archive-excerpt'], ap_core_show_excerpts() ) )
		$input['archive-excerpt'] = $input['archive-excerpt'];
		$input['link'] = wp_filter_nohtml_kses( $input['link'] );
		$input['hover'] = wp_filter_nohtml_kses( $input['hover'] );
		$input['footer'] = wp_filter_post_kses( stripslashes($input['footer']) );
		$input['css'] = wp_filter_nohtml_kses( stripslashes($input['css']) );
		if ( $input['favicon'] ) {
			$favicon = $input['favicon'];
			$favicon = getimagesize($favicon);
			if (in_array($favicon['mime'], unserialize(TYPE_WHITELIST))) {
				$input['favicon'] = esc_url_raw( $input['favicon'] );
			} else { $input['favicon'] = ''; }
		}

	    return $input;
	}
}

?>