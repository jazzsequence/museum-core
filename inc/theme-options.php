<?php

/**
 * Theme options init
 * @since 0.4.1
 * @author Chris Reynolds
 * @link http://themeshaper.com/2010/06/03/sample-theme-options/
 * adds the add_action lines to initialize the theme options and theme options page
 */
add_action ( 'admin_init', 'ap_core_theme_options_init' );
add_action ( 'admin_menu', 'ap_core_theme_options_add_page' );

/**
 * Register theme settings
 * @since 0.4.0
 * @author Chris Reynolds
 * registers the settings
 */
function ap_core_theme_options_init() {
    register_setting( 'AP_CORE_OPTIONS', 'ap_core_theme_options', 'ap_core_theme_options_validate' );
}

/**
 * Theme options page
 * @since 0.1
 * @author Chris Reynolds
 * this creates the admin page
 * this also calls the ap_core_admin_scripts() function and adds those scripts to admin_print_scripts for that page
 */
function ap_core_theme_options_add_page() {
    $page = add_theme_page( __('Theme Options','museum-core'), __('Theme Options','museum-core'), 'edit_theme_options', 'theme_options', 'ap_core_theme_options_page' );
    add_action( 'admin_print_scripts-'.$page, 'ap_core_admin_scripts' );
}

/**
 * Load admin scripts
 * @since 0.4.5
 * @author Chris Reynolds
 * @link http://theme.fm/blog/2011/08/30/using-the-color-picker-in-your-wordpress-theme-options/
 * loads the farbtastic color picker and other scripts and styles on the theme options page
 */
function ap_core_admin_scripts() {
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

/**
 * Side box
 * @since 0.4.5
 * @author Chris Reynolds
 * this adds some side boxes for news and twitter feed for the theme options page
 */
function ap_core_side_box() {
	if ( get_bloginfo('version') < '3.4' ) {
		$postbox_before = '	<div id="side-info-column" class="inner-sidebar">';
		$postbox_before .= '		<div id="side-sortables" class="meta-box-sortables ui-sortable">';
		$postbox_before .= '			<div class="padding">';
		$postbox_before .= '				<div class="infolinks">';
		$postbox_after = '					</div>';
		$postbox_after .= '				</div>';
		$postbox_after .= '			</div>';
		$postbox_after .= '	</div>';
	} else {
		$postbox_before = '	<div id="postbox-container-1" class="postbox-container">';
		$postbox_after = '	</div>';
	} bloginfo('version');
		echo $postbox_before;
					echo '<h2 style="margin:0">' . __('What\'s new at Museum Themes', 'museum-core') . '</h2>';

					// Get RSS Feed(s)
					@wp_widget_rss_output('http://museumthemes.com/feed/', array('show_date' => 0, 'items' => 3));

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

/**
 * Theme options page
 * @since 0.4.0
 * @author Chris Reynolds
 * this displays the actual options page
 */
function ap_core_theme_options_page() {
	global $pagenow;

	wp_nonce_field( 'ap-core-settings-page' );

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	$load_css = '<style type="text/css">';
	$load_css .= '@import url("http://fonts.googleapis.com/css?family=Droid+Sans|Lato|Ubuntu|PT+Serif|Inconsolata");';
	if ( false !== $_REQUEST['settings-updated'] ) {
	$load_css .= 'a#fdbk_tab { top: 300px; }';
	} else {
	$load_css .= 'a#fdbk_tab { top: 240px; }';
	}
	$load_css .= 'table.form-table { height: 475px; }';
	$load_css .= 'div.tab-wrap { height: 44px; border-bottom: 1px solid #ccc; width: 100%; position: relative; z-index: 0; }';
	$load_css .= 'ul.nav-tab-wrapper { margin: 0; float: left; }';
	$load_css .= 'ul.nav-tab-wrapper li { float: left; margin-bottom: 0; position: relative; z-index: 999; }';
	$load_css .= 'li.ui-state-active .nav-tab { border-bottom: 5px solid #fff!important; }';
	$load_css .= '#poststuff .nav-tab-wrapper h2 { margin-top: 8px; margin-bottom: 0; padding: 0 0 2px; }';
	$load_css .= 'li.ui-state-default a { color: #aaa; }';
	$load_css .= 'li.ui-state-active a { color: #464646; }';
	$load_css .= '</style>';
	echo $load_css;
	?>
	<script>
		jQuery(function() {
			jQuery( "#tabs" ).tabs({ fx: { opacity: 'toggle', duration:'fast'} });
		});
	</script>
	<div class="wrap">
		<h2><?php echo sprintf( __('%s Theme Options','museum-core'), get_current_theme() ); ?></h2>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'museum-core' ); ?></strong></p></div>
		<?php endif; ?>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<div id="post-body" class="metabox-holder columns-2">
			<?php ap_core_side_box(); ?>
				<div id="post-body-content">
					<form method="post" action="options.php">

						<?php settings_fields( 'AP_CORE_OPTIONS' ); ?>
						<?php $defaults = ap_core_get_theme_defaults(); ?>
						<?php $options = get_option( 'ap_core_theme_options', $defaults ); ?>

						<div id="tabs">
							<div class="tab-wrap">
								<ul class="nav-tab-wrapper">
									<li><?php screen_icon(); ?></li>
									<li><h2><a class="nav-tab" href="#tabs-1"><?php _e('General','museum-core'); ?></a></h2></li>
									<li><h2><a class="nav-tab" href="#tabs-2"><?php _e('Typography & Fonts','museum-core'); ?></a></h2></li>
									<li><h2><a class="nav-tab" href="#tabs-3"><?php _e('Advanced','museum-core'); ?></a></h2></li>
								</ul>
							</div>
							<?php
							/**
							 * General
							 */
							?>
							<table class="form-table" id="tabs-1">
								<?php
								/**
								 * Sidebar Settings
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Sidebar', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[sidebar]">
										<?php
											$selected = $options['sidebar'];
											foreach ( ap_core_sidebar() as $option ) {
												$label = $option['label'];
												$value = $option['value'];
												echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
											}
										?>
										</select>
									</td>
								</tr>
								<?php
								/**
								 * Show full posts or excerpts
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Full posts or excerpts?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[excerpts]">
											<?php
												$selected = $options['excerpts'];
												foreach ( ap_core_show_excerpts() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[excerpts]"><?php _e( 'Select whether you want full posts on the blog page or post excerpts with post thumbnails.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * Footer text
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Footer Text', 'museum-core' ); ?></th>
									<td>
										<textarea id="ap_core_theme_options[footer]" class="large-text" cols="50" rows="10" name="ap_core_theme_options[footer]" style="font-family: monospace;"><?php if ($options['footer'] != '') {
											echo wp_kses( $options['footer'], array('a' => array('href' => array(),'title' => array()),'br' => array(),'em' => array(),'strong' => array() ) );
										} else {
											echo $defaults['footer'];
										} ?></textarea>
										<label class="description" for="ap_core_theme_options[footer]"><?php _e( 'Add your own footer text or leave blank for no text in the footer.  Allowed HTML is <code>&lt;a&gt;</code>, <code>&lt;br&gt;</code>, <code>&lt;em&gt;</code> & <code>&lt;strong&gt;</code>', 'museum-core' ); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * PressTrends setting
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Send usage data?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[presstrends]">
											<?php
												$selected = $options['presstrends'];
												foreach ( ap_core_true_false() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[presstrends]"><?php _e( 'PressTrends allows theme developers to see how their themes are being used so they can better address the needs of their users. For more information visit <a href="http://presstrends.io/faq">PressTrends</a> or check out the <a href="http://wordpress.org/extend/plugins/presstrends/">plugin</a>.', 'museum-core' ); ?></label>
									</td>
								</tr>
							</table>
							<?php
							/**
							 * Typography
							 */
							?>
							<table class="form-table" id="tabs-2">
								<?php
								/**
								 * A Font Settings
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Museum Core Fonts', 'museum-core' ); ?></th>
									<td>
										<fieldset>
											<legend class="screen-reader-text"><span><?php _e( 'Fonts', 'museum-core' ); ?></span></legend>
											<?php
												foreach ( ap_core_fonts() as $option ) {
													$label = $option['label'];
													$link = $option['link'];
													$value = $option['value']; ?>
											<label class="description"><span style="font-family: '<?php echo $value; ?>'; font-size: 1.7em; padding-right: 20px;"><?php echo $label; ?><span style="font-size: 10px; font-family: sans-serif;"> <a href="<?php echo $link; ?>" target="_blank"><?php _e('[link]','museum-core'); ?></a></span></span></label>
											<?php } ?>
										</fieldset>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e( 'Headings Font', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[heading]">
											<?php
												$selected = $options['heading'];
												foreach ( ap_core_fonts() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[heading]"><?php _e( 'Used for <code>&lt;h1&gt;</code>, <code>&lt;h2&gt;</code>, and <code>&lt;h3&gt;</code> tags.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e( 'Body Font', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[body]">
											<?php
												$selected = $options['body'];
												foreach ( ap_core_fonts() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[body]"><?php _e( 'Used for all body text.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e( 'Alternate Font', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[alt]">
											<?php
												$selected = $options['alt'];
												foreach ( ap_core_fonts() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[alt]"><?php _e( 'Used for dates, sub-headings, <code>&lt;h4&gt;</code>, <code>&lt;h5&gt;</code> and <code>&lt;h6&gt;</code> tags and anywhere the <code>.alt</code> class is used in a <code>&lt;span&gt;</code> or a <code>&lt;div&gt;</code>.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e( 'Use alternate font for H1?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[alth1]">
											<?php
												$selected = $options['alth1'];
												foreach ( ap_core_true_false() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[alth1]"><?php _e( 'If set to "Yes", the alternate font will be used on the <code>&lt;h1&gt;</code> tag in the header and the heading font will be used for the description.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * Link color
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Link Color', 'museum-core' ); ?></th>
									<td><?php if ( !isset($options['link']) ) { $options['link'] == '#486D96'; } ?>
										<input class="medium-text" type="text" name="ap_core_theme_options[link]" value="<?php echo $options['link']; ?>" id="link-color" onfocus="if (this.value == '#'){this.value = '#';}" onblur="if (this.value == '') {this.value = '#';}" />
										<div id="colorpicker-link"></div>
										<br /><label class="description" for="ap_core_theme_options[link]"><?php _e( 'Set your desired link color.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e( 'Hover Color', 'museum-core' ); ?></th>
									<td><?php if ( !isset($options['hover']) ) { $options['hover'] == '#333333'; } ?>
										<input class="medium-text" type="text" name="ap_core_theme_options[hover]" value="<?php echo $options['hover']; ?>" id="hover-color" onfocus="if (this.value == '#'){this.value = '#';}" onblur="if (this.value == '') {this.value = '#';}" />
										<div id="colorpicker-hover"></div>
										<br /><label class="description" for="ap_core_theme_options[hover]"><?php _e( 'Set your desired link hover color.', 'museum-core' ); ?></label>
									</td>
								</tr>
							</table>
							<?php
							/**
							 * Advanced
							 */
							?>
							<table class="form-table" id="tabs-3">
								<?php
								/**
								 * favicon
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Custom favicon', 'museum-core' ); ?></th>
									<td>
										<input id="upload_image" type="text" size="36" name="ap_core_theme_options[favicon]" value="<?php esc_attr_e( $options['favicon'] ); ?>" />
										<input id="upload_image_button" type="button" class="button" value="<?php _e('Upload Image','museum-core'); ?>" />
										<br />
										<label class="description" for="ap_core_theme_options[favicon]"><?php _e( 'Use the uploader to upload a PNG or ICO file to use as a favicon for your site.  If left blank, no favicon will be used. (Other image formats will work but may not be browser-supported.)', 'museum-core' ); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * <meta> tags
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Use meta description?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[meta]">
											<?php
												$selected = $options['meta'];
												foreach ( ap_core_true_false() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[meta]"><?php _e( 'If Yes, meta tags for description will be loaded in the header (pulled from post excerpt for single posts and pages or from the description for tags and categories).  Use this if you don\'t plan on using an SEO plugin to handle your meta descriptions.','museum-core'); ?><br /><?php _e( 'If No, no meta description tags will be loaded.  Use this if you plan on using something to take care of your meta description.', 'museum-core' ); ?>  <a href="http://yoast.com/meta-description-seo-social/" target="_blank"><?php _e('More info','museum-core'); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * Author tag
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Use meta author?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[author]">
											<?php
												$selected = $options['author'];
												foreach ( ap_core_true_false() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[author]"><?php _e( 'If Yes, meta author tags will be used on all pages (except 404 pages).','museum-core'); ?><br /><?php _e( 'If No, meta author tags will be disabled.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * Generator tag
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Use meta generator tag?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[generator]">
											<?php
												$selected = $options['generator'];
												foreach ( ap_core_true_false() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[generator]"><?php _e( 'If Yes, the theme name and version will be added to a meta generator tag.  This is useful in identifying which version of the theme you are using for troubleshooting purposes.  This should be enabled if you need to contact us for support.','museum-core'); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * Show full posts or excerpts on archive pages
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Full posts or excerpts on archive pages?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[archive-excerpt]">
											<?php
												$selected = $options['archive-excerpt'];
												foreach ( ap_core_show_excerpts() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[archive-excerpt]"><?php _e( 'Select whether you want full posts on archive pages or excerpts with post thumbnails.', 'museum-core' ); ?></label>
									</td>
								</tr>
								<?php
								/**
								 * Use Twitter hovercards?
								 */
								?>
								<tr valign="top"><th scope="row"><?php _e( 'Use Twitter hovercards?', 'museum-core' ); ?></th>
									<td>
										<select name="ap_core_theme_options[hovercards]">
											<?php
												$selected = $options['hovercards'];
												foreach ( ap_core_true_false() as $option ) {
													$label = $option['label'];
													$value = $option['value'];
													echo '<option value="' . $value . '" ' . selected( $selected, $value ) . '>' . $label . '</option>';
												} ?>
										</select><br />
										<label class="description" for="ap_core_theme_options[hovercards]"><?php echo sprintf( __( 'Twitter hovercards display information about a particular Twitter user when the @ symbol is used.  See the %1$sTwitter developer documentation for more information%2$s', 'museum-core' ), '<a href="https://dev.twitter.com/docs/anywhere/welcome#hovercards" target="_blank">', '</a>' ); ?>
									</td>
							</table>
						</div>
						<p class="submit">
							<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'museum-core' ); ?>" />
							<input type="hidden" name="ap-core-settings-submit" value="Y" />
						</p>
					</form>
				</div><!-- closes post-body-content -->
			</div><!-- closes post-body -->
		</div><!-- closes poststuff -->
	</div><!-- closes wrap -->
	<?php
}

// Start of PressTrends Magic
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
if ( $options['presstrends'] == 'true' ) {
add_action('admin_init', 'ap_core_presstrends');
}

/**
 * Validate options
 * completely rewritten @since 0.4.0
 */
function ap_core_theme_options_validate( $input ) {

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
	if ( !array_key_exists( $input['excerpts'], ap_core_show_excerpts() ) )
	$input['excerpts'] = $input['excerpts'];
	if ( !array_key_exists( $input['archive-excerpt'], ap_core_show_excerpts() ) )
	$input['archive-excerpt'] = $input['archive-excerpt'];
	$input['link'] = wp_filter_nohtml_kses( $input['link'] );
	$input['hover'] = wp_filter_nohtml_kses( $input['hover'] );
	$input['footer'] = wp_filter_post_kses( stripslashes($input['footer']) );
	$input['favicon'] = wp_filter_nohtml_kses( $input['favicon'] );

    return $input;
}

?>