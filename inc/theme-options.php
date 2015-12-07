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
	add_action ( 'admin_init', 'ap_core_theme_options_init' );
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
				<textarea rows="10" style="width:100%; font-family: monospace;" <?php $this->link(); ?>><?php echo esc_textarea( stripslashes_deep( $this->value() ) ); ?></textarea>
			</label>
			<?php
		}

	}

		/* add sections */
		$wp_customize->add_section( 'ap_core_layout', array(

			'title' => __( 'Layout Options', 'museum-core' ),
			'priority' => 35

		) );

		$wp_customize->add_section( 'ap_core_typography', array(

			'title' => __( 'Typography Options', 'museum-core' ),
			'priority' => 36

		) );

		$wp_customize->add_section( 'ap_core_advanced', array(

			'title' => __( 'Advanced Settings', 'museum-core' ),
			'priority' => 120

		) );


		/* add settings */

		// site title & tagline
		$wp_customize->add_setting( 'ap_core_theme_options[site-title]', array(

			'default' => $defaults['site-title'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		// layout options
		$wp_customize->add_setting( 'ap_core_theme_options[sidebar]', array(

			'default' => $defaults['sidebar'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_sidebar'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[nav-menu]', array(

			'default' => $defaults['nav-menu'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[breadcrumbs]', array(

			'default' => $defaults['breadcrumbs'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[excerpts]', array(

			'default' => $defaults['excerpts'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_excerpts'

		) );


		$wp_customize->add_setting( 'ap_core_theme_options[archive-excerpt]', array(

			'default' => $defaults['archive-excerpt'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_excerpts'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[post-author]', array(

			'default' => $defaults['post-author'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		// typography options
		$wp_customize->add_setting( 'ap_core_theme_options[heading]', array(

			'default' => $defaults['heading'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_fonts'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[body]', array(

			'default' => $defaults['body'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_fonts'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[alt]', array(

			'default' => $defaults['alt'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_fonts'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[alth1]', array(

			'default' => $defaults['alth1'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[font_subset]', array(

			'default' => $defaults['font_subset'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_subset'

		) );

		// colors
		$wp_customize->add_setting( 'ap_core_theme_options[font-color]', array(

			'default' => $defaults['font-color'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[link]', array(

			'default' => $defaults['link'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[hover]', array(

			'default' => $defaults['hover'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[content-color]', array(

			'default' => $defaults['content-color'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[navbar-color]', array(

			'default' => $defaults['navbar-color'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[navbar-inverse]', array(

			'default' => $defaults['navbar-inverse'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[navbar-link]', array(

			'default' => $defaults['navbar-link'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option',
			'sanitize_callback' => 'sanitize_hex_color'

		) );

		// advanced options
		$wp_customize->add_setting( 'ap_core_theme_options[author]', array(

			'default' => $defaults['author'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[footer]', array(

			'default' => $defaults['footer'],
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_kses'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[favicon]', array(

			'default' => $defaults['favicon'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_favicon'

		) );

		$wp_customize->add_setting( 'ap_core_theme_options[generator]', array(

			'default' => $defaults['generator'],
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'type' => 'option',
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );


		/* add controls */

		// site title & tagline
		$wp_customize->add_control( 'ap_core_theme_options[site-title]', array(

			'label' => __( 'Show site title?', 'museum-core' ),
			'section' => 'title_tagline',
			'settings' => 'ap_core_theme_options[site-title]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		// layout options
		$wp_customize->add_control( 'ap_core_theme_options[sidebar]', array(

			'label' => __( 'Sidebar', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[sidebar]',
			'type' => 'select',
			'choices' => ap_core_sidebar(),
			'sanitize_callback' => 'ap_core_validate_sidebar'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[nav-menu]', array(

			'label' => __( 'Fixed nav menu?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[nav-menu]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[breadcrumbs]', array(

			'label' => __( 'Enable breadcrumbs?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[breadcrumbs]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[excerpts]', array(

			'label' => __( 'Full posts or excerpts on blog home?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[excerpts]',
			'type' => 'select',
			'choices' => ap_core_show_excerpts(),
			'sanitize_callback' => 'ap_core_validate_excerpts'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[archive-excerpt]', array(

			'label' => __( 'Full posts or excerpts on archive pages?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[archive-excerpt]',
			'type' => 'select',
			'choices' => ap_core_show_excerpts(),
			'sanitize_callback' => 'ap_core_validate_excerpts'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[post-author]', array(

			'label' => __( 'Display post author?', 'museum-core' ),
			'section' => 'ap_core_layout',
			'settings' => 'ap_core_theme_options[post-author]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );


		// typography options
		$wp_customize->add_control( 'ap_core_theme_options[heading]', array(

			'label' => __( 'Heading Font', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[heading]',
			'type' => 'select',
			'choices' => ap_core_fonts(),
			'sanitize_callback' => 'ap_core_validate_fonts'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[body]', array(

			'label' => __( 'Body Font', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[body]',
			'type' => 'select',
			'choices' => ap_core_fonts(),
			'sanitize_callback' => 'ap_core_validate_fonts'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[alt]', array(

			'label' => __( 'Alternate Font', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[alt]',
			'type' => 'select',
			'choices' => ap_core_fonts(),
			'sanitize_callback' => 'ap_core_validate_fonts'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[alth1]', array(

			'label' => __( 'Use alternate font for site title?', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[alth1]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$wp_customize->add_control( 'ap_core_theme_options[font_subset]', array(

			'label' => __( 'Font Subset', 'museum-core' ),
			'section' => 'ap_core_typography',
			'settings' => 'ap_core_theme_options[font_subset]',
			'type' => 'select',
			'choices' => ap_core_font_subset(),
			'sanitize_callback' => 'ap_core_validate_subset'

		) );

		// colors
		$font_color = new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[font-color]', array(

			'label' => __( 'Font Color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[font-color]',
			'sanitize_callback' => 'sanitize_hex_color'

		) );
		$wp_customize->add_control( $font_color );

		$link_color = new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[link]', array(

			'label' => __( 'Link Color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[link]',
			'sanitize_callback' => 'sanitize_hex_color'

		) );
		$wp_customize->add_control( $link_color );

		$hover_color = new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[hover]', array(

			'label' => __( 'Hover Color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[hover]',
			'sanitize_callback' => 'sanitize_hex_color'

		) );
		$wp_customize->add_control( $hover_color );

		$content_color = new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[content-color]', array(

			'label' => __( 'Content Background color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[content-color]',
			'sanitize_callback' => 'sanitize_hex_color'

		) );
		$wp_customize->add_control( $content_color );

		$navbar_color = new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[navbar-color]', array(

			'label' => __( 'Navbar (top) Background Color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[navbar-color]',
			'sanitize_callback' => 'sanitize_hex_color'

		) );
		$wp_customize->add_control( $navbar_color );

		$wp_customize->add_control( 'ap_core_theme_options[navbar-inverse]', array(

			'label' => __( 'Inverted navbar?', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[navbar-inverse]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$navbar_link = new WP_Customize_Color_Control( $wp_customize, 'ap_core_theme_options[navbar-link]', array(

			'label' => __( 'Navbar Link Color', 'museum-core' ),
			'section' => 'colors',
			'settings' => 'ap_core_theme_options[navbar-link]',
			'sanitize_callback' => 'sanitize_hex_color'

		) );
		$wp_customize->add_control( $navbar_link );

		// advanced options
		$wp_customize->add_control( 'ap_core_theme_options[author]', array(

			'label' => __( 'Use author meta tags?', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[author]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

		$footer_text = new AP_Core_Textarea_Control( $wp_customize, 'ap_core_theme_options[footer]', array(

			'label' => __( 'Footer Text', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[footer]',
			'type' => 'textarea',
			'sanitize_callback' => 'esc_textarea'

		) );
		$wp_customize->add_control( $footer_text );

		$favicon = new WP_Customize_Image_Control( $wp_customize, 'ap_core_theme_options[favicon]', array(

			'label' => __( 'Custom Favicon', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[favicon]',
			'sanitize_callback' => 'ap_core_validate_favicon'

		) );
		$wp_customize->add_control( $favicon );

		$wp_customize->add_control( 'ap_core_theme_options[generator]', array(

			'label' => __( 'Debug Mode Active', 'museum-core' ),
			'section' => 'ap_core_advanced',
			'settings' => 'ap_core_theme_options[generator]',
			'type' => 'select',
			'choices' => ap_core_true_false(),
			'sanitize_callback' => 'ap_core_validate_true_false'

		) );

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
				wp.customize('ap_core_theme_options[font-color]',function( value ) {
					value.bind(function(to) {
						$('body').css('color', to ? to : '');
					});
				});
				wp.customize('ap_core_theme_options[link]',function( value ) {
					value.bind(function(to) {
						$('.content a, .sidebar a').css('color', to ? to : '');
					});
				});
				wp.customize('ap_core_theme_options[content-color]',function( value ) {
					value.bind(function(to) {
						$('.container').css('background', to ? to : '');
					});
				});
				wp.customize('ap_core_theme_options[navbar-color]',function( value ) {
					value.bind(function(to) {
						$('.topnav').css('background', to ? to : '');
					});
				});
				wp.customize('ap_core_theme_options[navbar-link]',function( value ) {
					value.bind(function(to) {
						$('.topnav .navbar-nav>li>a').css('color', to ? to : '');
					});
				});
			} )( jQuery )
		</script>
		<?php
	}

}

/**
 * Validate true/false
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
 */
function ap_core_validate_true_false( $value ) {
	if ( ! array_key_exists( $value, ap_core_true_false() ) )
		$value = null;

	return $value;
}

/**
 * Validate font options
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
 */
function ap_core_validate_fonts( $value ) {
	if ( ! array_key_exists( $value, ap_core_fonts() ) )
		$value = null;

	return $value;
}

/**
 * Validate excerpts options
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
 */
function ap_core_validate_excerpts( $value ) {
	if ( !array_key_exists( $value, ap_core_show_excerpts() ) )
		$value = null;

	return $value;
}

/**
 * Validate sidebar options
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
 */
function ap_core_validate_sidebar( $value ) {
	if ( !array_key_exists( $value, ap_core_sidebar() ) )
		$value = null;

	return $value;
}

/**
 * Validate font subset
 * @since 2.0.0
 * @author Chris Reynolds
 * @link http://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
 */
function ap_core_validate_subset( $value ) {
	if ( !array_key_exists( $value, ap_core_font_subset() ) )
		$value = null;

	return $value;
}

/**
 * Validate favicon
 * @since 0.4.0
 * @author Chris Reynolds
 * @link http://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
 */
function ap_core_validate_favicon( $value ) {

	define('TYPE_WHITELIST', serialize(array(
		'image/jpeg',
		'image/jpg',
		'image/png',
		'image/gif',
		'image/ico'
	)));

	if ( isset( $value['favicon'] ) ) {
		$favicon = $value['favicon'];
		$favicon = getimagesize($favicon);
		if (in_array($favicon['mime'], unserialize(TYPE_WHITELIST))) {
			$value['favicon'] = esc_url_raw( $value['favicon'] );
		} else {
			$value['favicon'] = null;
		}
	}

    return $value;
}

/**
 * Runs the value through wp_kses_post for html validation.
 * @param  string $value The original value.
 * @return string        The sanitized string.
 */
function ap_core_kses( $value ) {
	return wp_kses_post( $value );
}
