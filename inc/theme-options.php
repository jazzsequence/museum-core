<?php

/**
 * Register theme settings
 * @since 0.4.0
 * @author Chris Reynolds
 * registers the settings
 */
if (!function_exists('ap_core_theme_options_init')) {
	function ap_core_theme_options_init() {
	    register_setting( 'AP_CORE_OPTIONS', 'ap_core_theme_options' );
	}
	add_action ( 'admin_init', 'ap_core_theme_options_init', 'ap_core_theme_options_validate' );
}


/**
 * Use the theme customizer
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * uses the customizer for all the settings
 */
if ( !function_exists( 'ap_core_theme_customizer_init' ) ) {

	function ap_core_theme_customizer_init( $wp_customize ) {

		$defaults = ap_core_get_theme_defaults();


	class AP_Core_Textarea_Control extends WP_Customize_Control {

		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="10" style="width:100%; font-family: monospace;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}

	}

	class AP_Core_Legacy_CSS_Control extends WP_Customize_Control {

		public $type = 'ap-legacy-css';

		public function render_content() {

			$options = get_option( 'ap_core_theme_options' );

			if ( isset( $options['css'] ) ) {
				echo '<label>';
				echo '<span class="customize-control-title">' . __( 'Custom CSS is no longer supported by this theme.', 'museum-core' ) . '</span><br />';
				echo sprintf( _x( 'Museum Core no longer supports custom CSS. Please use %1$sMy Custom CSS%2$s or %3$sJetpack%2$s to add custom CSS to your site. Your Custom CSS is displayed below.', '1: link to My Custom CSS, 2: closing <a> tag, 3: link to Jetpack', 'museum-core' ), '<a href="wordpress.org/plugins/my-custom-css/" target="_blank">', '</a>', '<a href="http://wordpress.org/plugins/jetpack" target="_blank">' );
				echo '<pre>';
				echo $options['css'];
				echo '</pre>';
				echo '</label>';
			}


		}

	}

		/* add sections */
		$wp_customize->add_section( 'ap_core_layout', array(

			'title' => __( 'Layout options', 'museum-core' ),
			'priority' => 35

		) );

		$wp_customize->add_section( 'ap_core_typography', array(

			'title' => __( 'Typography options', 'museum-core' ),
			'priority' => 36

		) );

		$wp_customize->add_section( 'ap_core_advanced', array(

			'title' => __( 'Advanced settings', 'museum-core' ),
			'priority' => 120

		) );


		/* add settings */
		$wp_customize->add_setting( 'ap_core_theme_options[sidebar]', array(

			'default' => $defaults['sidebar'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[excerpts]', array(

			'default' => $defaults['excerpts'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );


		$wp_customize->add_setting( 'ap_core_theme_options[archive-excerpt]', array(

			'default' => $defaults['archive-excerpt'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[site-title]', array(

			'default' => $defaults['site-title'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[post-author]', array(

			'default' => $defaults['post-author'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[heading]', array(

			'default' => $defaults['heading'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[body]', array(

			'default' => $defaults['body'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[alt]', array(

			'default' => $defaults['alt'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[alth1]', array(

			'default' => $defaults['alth1'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[font_subset]', array(

			'default' => $defaults['font_subset'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[link]', array(

			'default' => $defaults['link'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[hover]', array(

			'default' => $defaults['hover'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[author]', array(

			'default' => $defaults['author'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[footer]', array(

			'default' => $defaults['footer'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[favicon]', array(

			'default' => $defaults['favicon'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[presstrends]', array(

			'default' => $defaults['presstrends'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[generator]', array(

			'default' => $defaults['generator'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[css]', array(

			'capability' => 'edit_theme_options'

		) );

		/* add controls */
		$wp_customize->add_control( 'ap_core_theme_options[sidebar]', array(

			'label' => __( 'Sidebar', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[sidebar]',
			'type' => 'select',
			'choices' => ap_core_sidebar()

		) );

		$wp_customize->add_control( 'ap_core_theme_options[excerpts]', array(

			'label' => __( 'Full posts or excerpts on blog home?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[excerpts]',
			'type' => 'select',
			'choices' => ap_core_show_excerpts()

		) );

		$wp_customize->add_control( 'ap_core_theme_options[archive-excerpt]', array(

			'label' => __( 'Full posts or excerpts on archive pages?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[archive-excerpt]',
			'type' => 'select',
			'choices' => ap_core_show_excerpts()

		) );

		$wp_customize->add_control( 'ap_core_theme_options[site-title]', array(

			'label' => __( 'Show site title?', 'museum-core' ),
			'section' => 'title_tagline',
			'settings' => 'ap_core_theme_options[site-title]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[post-author]', array(

			'label' => __( 'Display post author?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[post-author]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[heading]', array(

			'label' => __( 'Heading font', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[heading]',
			'type' => 'select',
			'choices' => ap_core_fonts()

		) );

		$wp_customize->add_control( 'ap_core_theme_options[body]', array(

			'label' => __( 'Body font', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[body]',
			'type' => 'select',
			'choices' => ap_core_fonts()

		) );

		$wp_customize->add_control( 'ap_core_theme_options[alt]', array(

			'label' => __( 'Alternate font', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[alt]',
			'type' => 'select',
			'choices' => ap_core_fonts()

		) );

		$wp_customize->add_control( 'ap_core_theme_options[alth1]', array(

			'label' => __( 'Use alternate font for H1?', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[alth1]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[font_subset]', array(

			'label' => __( 'Font subset', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[font_subset]',
			'type' => 'select',
			'choices' => ap_core_font_subset()

		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[link]', array(

			'label' => __( 'Link color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[link]'

		) ) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[hover]', array(

			'label' => __( 'Hover color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[hover]'

		) ) );

		$wp_customize->add_control( 'ap_core_theme_options[author]', array(

			'label' => __( 'Use author meta tags?', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[author]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( new AP_Core_Textarea_Control( $wp_customize, 'ap_core_theme_options[footer]', array(

			'label' => __( 'Footer text', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[footer]',
			'type' => 'textarea'

		) ) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ap_core_theme_options[favicon]', array(

			'label' => __( 'Custom favicon', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[favicon]',

		) ) );

		$wp_customize->add_control( 'ap_core_theme_options[presstrends]', array(

			'label' => __( 'Send usage data?', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[presstrends]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[generator]', array(

			'label' => __( 'Debug mode active', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[generator]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( new AP_Core_Legacy_CSS_Control( $wp_customize, 'ap_core_theme_options[css]', array(

			'section' => 'ap_core_advanced'

		) ) );

		// adds live refresh on site title and tagline
		$wp_customize->get_setting('blogname')->transport='postMessage';
		$wp_customize->get_setting('blogdescription')->transport='postMessage';

		// adds live refresh business
		if ( $wp_customize->is_preview() && ! is_admin() )
    		add_action( 'wp_footer', 'ap_core_customize_preview', 21);

	}
	add_action( 'customize_register', 'ap_core_theme_customizer_init' );

}

/**
 * Customize preview
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * makes live-refreshing settings live refresh
 */
if ( !function_exists( 'ap_core_customize_preview' ) ) {

	function ap_core_customize_preview() {
		?>
		<script type="text/javascript">
			( function( $ ){
				wp.customize('ap_core_theme_options[footer]',function( value ) {
					value.bind(function(to) {
						$('footer .credit').html(to);
					});
				});
				wp.customize('blogname',function( value ) {
					value.bind(function(to) {
						$('.siteinfo h2').html(to);
					});
				});
				wp.customize('blogdescription',function( value ) {
					value.bind(function(to) {
						$('.siteinfo h3').html(to);
					});
				});
				wp.customize('ap_core_theme_options[link]',function( value ) {
					value.bind(function(to) {
						$('.content a, .sidebar a').css('color', to ? to : '');
					});
				});
				wp.customize('ap_core_theme_options[link]',function( value ) {
					value.bind(function(to) {
						$('.content a:hover, .sidebar a:hover').css('color', to ? to : '');
					});
				});
			} )( jQuery )
		</script>
		<?php
	}

}

// Start of PressTrends Magic
if (!function_exists('ap_core_presstrends')) {
	function ap_core_presstrends() {

	// PressTrends Account API Key
	$api_key = 'i93727o4eba1lujhti5bjgiwfmln5xm5o0iv';
	$plugin_name = ''; // sets the plugin_name varible with something to fix that not defined error...

	// Start of Metrics
	global $wpdb;
	$data = get_transient( 'presstrends_data' );
	if (!$data || $data == ''){
	$api_base = 'http://api.presstrends.io/index.php/api/sites/update/api/';
	$url = $api_base . $api_key . '/';
	$data = array();
	$count_posts = wp_count_posts();
	$count_pages = wp_count_posts('page');
	$comments_count = wp_count_comments();
	$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
	$plugin_count = count(get_option('active_plugins'));
	$all_plugins = get_plugins();
	foreach($all_plugins as $plugin_file => $plugin_data) {
	$plugin_name .= $plugin_data['Name'];
	$plugin_name .= '&';}
	$posts_with_comments = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}posts WHERE post_type='post' AND comment_count > 0");
	$comments_to_posts = number_format(($posts_with_comments / $count_posts->publish) * 100, 0, '.', '');
	$pingback_result = $wpdb->get_var('SELECT COUNT(comment_ID) FROM '.$wpdb->comments.' WHERE comment_type = "pingback"');
	$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
	$data['posts'] = $count_posts->publish;
	$data['pages'] = $count_pages->publish;
	$data['comments'] = $comments_count->total_comments;
	$data['approved'] = $comments_count->approved;
	$data['spam'] = $comments_count->spam;
	$data['pingbacks'] = $pingback_result;
	$data['post_conversion'] = $comments_to_posts;
	$data['theme_version'] = $theme_data['Version'];
	$data['theme_name'] = $theme_data['Name'];
	$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
	$data['plugins'] = $plugin_count;
	$data['plugin'] = urlencode($plugin_name);
	$data['wpversion'] = get_bloginfo('version');
	foreach ( $data as $k => $v ) {
	$url .= $k . '/' . $v . '/';}
	$response = wp_remote_get( $url );
	set_transient('presstrends_data', $data, 60*60*24);}
	}

	$options = get_option( 'ap_core_theme_options' );
	if ( $options['presstrends'] == true ) {
	add_action('admin_init', 'ap_core_presstrends');
	}
}

/**
 * Validate true/false
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
 * validates true/false options
 */
function ap_core_validate_true_false( $value ) {
	if ( ! array_key_exists( $value, ap_core_true_false() ) )
		$value = null;

	return $value;
}



/**
 * Validate options
 * completely rewritten @since 0.4.0
 */

	function ap_core_theme_options_validate( $value ) {

		$defaults = ap_core_get_theme_defaults();

		define('TYPE_WHITELIST', serialize(array(
		  'image/jpeg',
		  'image/jpg',
		  'image/png',
		  'image/gif',
		  'image/ico'
		  )));
	    if ( !isset( $value['sidebar'] ) || !in_array( $value['sidebar'], ap_core_sidebar() ) )
	    	$value['sidebar'] = $defaults['sidebar'];
		if ( !isset( $value['presstrends'] ) || !in_array( $value['presstrends'], array( true, false ) ) )
			$value['presstrends'] = $defaults['presstrends'];
		if ( !isset( $value['heading'] ) || !in_array( $value['heading'], ap_core_fonts() ) )
			$value['heading'] = $defaults['heading'];
		if ( !isset( $value['body'] ) || !in_array( $value['body'], ap_core_fonts() ) )
			$value['body'] = $defaults['body'];
		if ( !isset( $value['alt'] ) || !in_array( $value['alt'], ap_core_fonts() ) )
			$value['alt'] = $defaults['alt'];
		if ( !isset( $value['font_subset'] ) || !in_array( $value['font_subset'], ap_core_font_subsets() ) )
			$value['font_subset'] = $defaults['font_subset'];
		if ( !isset( $value['alth1'] ) || !in_array( $value['alth1'], array( true, false ) ) )
			$value['alth1'] = $defaults['alth1'];
		if ( !isset( $value['meta'] ) || !in_array( $value['meta'], array( true, false ) ) )
			$value['meta'] = $defaults['meta'];
		if ( !isset( $value['author'] ) || !in_array( $value['author'], array( true, false ) ) )
			$value['author'] = $defaults['author'];
		if ( !isset( $value['generator'] ) || !in_array( $value['generator'], array( true, false ) ) )
			$value['generator'] = $defaults['generator'];
		if ( !isset( $value['hovercards'] ) || !in_array( $value['hovercards'], array( true, false ) ) )
			$value['hovercards'] = $defaults['hovercards'];
		if ( !isset( $value['site-title'] ) || !in_array( $value['site-title'], array( true, false ) ) )
			$value['site-title'] = $defaults['site-title'];
		if ( !isset( $value['excerpts'] ) || !in_array( $value['excerpts'], ap_core_show_excerpts() ) )
			$value['excerpts'] = $defaults['excerpts'];
		if ( !isset( $value['archive-excerpt'] ) || !in_array( $value['archive-excerpt'], ap_core_show_excerpts() ) )
			$value['archive-excerpt'] = $defaults['archive-excerpt'];
		$value['link'] = wp_filter_nohtml_kses( $value['link'] );
		$value['hover'] = wp_filter_nohtml_kses( $value['hover'] );
		$value['footer'] = wp_filter_post_kses( stripslashes($value['footer']) );
		if ( $value['favicon'] ) {
			$favicon = $value['favicon'];
			$favicon = getimagesize($favicon);
			if (in_array($favicon['mime'], unserialize(TYPE_WHITELIST))) {
				$value['favicon'] = esc_url_raw( $value['favicon'] );
			} else { $value['favicon'] = ''; }
		}

	    return $value;
	}