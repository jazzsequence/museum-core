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
    register_setting( 'ap_core_options', 'ap_core_theme_options', 'ap_core_theme_options_validate' );
}

/**
 * Theme options page
 * @since 0.1
 * @author Chris Reynolds
 * this creates the admin page
 * this also calls the ap_core_admin_scripts() function and adds those scripts to admin_print_scripts for that page
 */
function ap_core_theme_options_add_page() {
    $page = add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'ap_core_theme_options_page' );
    add_action( 'admin_print_scripts-'.$page, 'ap_core_admin_scripts' );
}

/**
 * Load admin scripts
 * @since 0.4.5
 * @author Chris Reynolds
 * @link http://theme.fm/blog/2011/08/30/using-the-color-picker-in-your-wordpress-theme-options/
 * loads the farbtastic color picker on the theme options page
 */
function ap_core_admin_scripts() {
	wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic' );
    wp_enqueue_script( 'ap_core_color_picker', get_template_directory_uri() . '/js/color-picker.js', array( 'farbtastic', 'jquery' ) );
}

function ap_core_side_box() {
	?>
	<div id="side-info-column" class="inner-sidebar">
		<div id="side-sortables" class="meta-box-sortables ui-sortable">
			<div class="padding">
				<div class="infolinks">
					<?php
					echo '<h2 style="margin:0">' . __('What\'s new at Museum Themes', 'ap_core') . '</h2>';

					// Get RSS Feed(s)
					@wp_widget_rss_output('http://museumthemes.com/feed/', array('show_date' => 0, 'items' => 3));

					echo '<h2 style="margin:0">' . __('Follow us on Twitter', 'event_espresso') . '</h2>';
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
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Theme options page
 * @since 0.4.0
 * @author Chris Reynolds
 * this displays the actual options page
 */
function ap_core_theme_options_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	$load_css = '<style type="text/css">';
	$load_css .= '@import url( "'. get_bloginfo('template_directory') . '/fonts/fonts.css");';
	$load_css .= 'a#fdbk_tab { top: 19%; }';
	$load_css .= '</style>';
	echo $load_css;
	?>
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
  feedback_widget_options.color = "#222";
  feedback_widget_options.style = "question";

  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
</script>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'ap_core' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'ap_core' ); ?></strong></p></div>
		<?php endif; ?>
		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<?php ap_core_side_box(); ?>
			<div id="post-body">
				<div id="post-body-content">
					<form method="post" action="options.php">
						<?php settings_fields( 'ap_core_options' ); ?>
						<?php $options = get_option( 'ap_core_theme_options' ); ?>
						<?php $defaults = ap_core_get_theme_defaults(); ?>

						<table class="form-table">

							<?php
							/**
							 * Sidebar Settings
							 */
							?>
							<tr valign="top"><th scope="row"><?php _e( 'Sidebar', 'ap_core' ); ?></th>
								<td>
									<fieldset><legend class="screen-reader-text"><span><?php _e( 'Sidebar', 'ap_core' ); ?></span></legend>
									<?php
										if ( ! isset( $checked ) )
											$checked = '';
										foreach ( ap_core_sidebar() as $option ) {
											$selected = $options['sidebar'];

											if ( '' != $selected ) {
												if ( $options['sidebar'] == $option['value'] ) {
													$checked = "checked=\"checked\"";
												} else {
													$checked = '';
												}
											}
											?>
											<label class="description"><input type="radio" name="ap_core_theme_options[sidebar]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
											<?php
										}
									?>
									</fieldset>
								</td>
							</tr>
							<?php
							/**
							 * A Font Settings
							 */
							?>
							<tr valign="top"><th scope="row"><?php _e( 'Museum Core Fonts', 'ap_core' ); ?></th>
								<td>
									<fieldset>
										<legend class="screen-reader-text"><span><?php _e( 'Fonts', 'ap_core' ); ?></span></legend>
										<?php
											foreach ( ap_core_fonts() as $option ) {
												$label = $option['label'];
												$link = $option['link'];
												$value = $option['value']; ?>
										<label class="description"><span style="font-family: '<?php echo $value; ?>'; font-size: 1.7em; padding-right: 20px;"><?php echo $label; ?><span style="font-size: 10px; font-family: sans-serif;"> <a href="<?php echo $link; ?>" target="_blank">[link]</a></span></span></label>
										<?php } ?>
									</fieldset>
								</td>
							</tr>
							<tr valign="top"><th scope="row"><?php _e( 'Headings Font', 'ap_core' ); ?></th>
								<td>
									<select name="ap_core_theme_options[heading]">
										<?php
											$selected = $options['heading'];
											$checked = 'selected="selected"';
											$p = '';
											foreach ( ap_core_fonts() as $option ) {
												$label = $option['label'];
												$value = $option['value'];
												if ( $selected == $option['value'] ) {
													$p = '<option value="' . $value . '" ' . $checked . '>' . $label . '</option>';
												} else {
													$p = '<option value="' . $value . '">' . $label . '</option>';
												}
												echo $p;
											} ?>
									</select><br />
									<label class="description" for="ap_core_theme_options[heading]"><?php _e( 'Used for <code>&lt;h1&gt;</code>, <code>&lt;h2&gt;</code>, and <code>&lt;h3&gt;</code> tags.', 'ap_core' ); ?></label>
								</td>
							</tr>
							<tr valign="top"><th scope="row"><?php _e( 'Body Font', 'ap_core' ); ?></th>
								<td>
									<select name="ap_core_theme_options[body]">
										<?php
											$selected = $options['body'];
											$checked = 'selected="selected"';
											$p = '';
											foreach ( ap_core_fonts() as $option ) {
												$label = $option['label'];
												$value = $option['value'];
												if ( $selected == $option['value'] ) {
													$p = '<option value="' . $value . '" ' . $checked . '>' . $label . '</option>';
												} else {
													$p = '<option value="' . $value . '">' . $label . '</option>';
												}
												echo $p;
											} ?>
									</select><br />
									<label class="description" for="ap_core_theme_options[body]"><?php _e( 'Used for all body text.', 'ap_core' ); ?></label>
								</td>
							</tr>
							<tr valign="top"><th scope="row"><?php _e( 'Alternate Font', 'ap_core' ); ?></th>
								<td>
									<select name="ap_core_theme_options[alt]">
										<?php
											$selected = $options['alt'];
											$checked = 'selected="selected"';
											$p = '';
											foreach ( ap_core_fonts() as $option ) {
												$label = $option['label'];
												$value = $option['value'];
												if ( $selected == $option['value'] ) {
													$p = '<option value="' . $value . '" ' . $checked . '>' . $label . '</option>';
												} else {
													$p = '<option value="' . $value . '">' . $label . '</option>';
												}
												echo $p;
											} ?>
									</select><br />
									<label class="description" for="ap_core_theme_options[alt]"><?php _e( 'Used for dates, sub-headings, <code>&lt;h4&gt;</code>, <code>&lt;h5&gt;</code> and <code>&lt;h6&gt;</code> tags and anywhere the <code>.alt</code> class is used in a <code>&lt;span&gt;</code> or a <code>&lt;div&gt;</code>.', 'ap_core' ); ?></label>
								</td>
							</tr>
							<?php
							/**
							 * Link color
							 */
							?>
							<tr valign="top"><th scope="row"><?php _e( 'Link Color', 'ap_core' ); ?></th>
								<td><?php if ( !isset($options['link']) ) { $options['link'] == '#486D96'; } ?>
									<input class="medium-text" type="text" name="ap_core_theme_options[link]" value="<?php echo $options['link']; ?>" id="link-color" />
									<div id="colorpicker-link"></div>
									<br /><label class="description" for="ap_core_theme_options[link]"><?php _e( 'Set your desired link color.', 'ap_core' ); ?></label>
								</td>
							</tr>
							<tr valign="top"><th scope="row"><?php _e( 'Hover Color', 'ap_core' ); ?></th>
								<td><?php if ( !isset($options['hover']) ) { $options['hover'] == '#333333'; } ?>
									<input class="medium-text" type="text" name="ap_core_theme_options[hover]" value="<?php echo $options['hover']; ?>" id="hover-color" />
									<div id="colorpicker-hover"></div>
									<br /><label class="description" for="ap_core_theme_options[hover]"><?php _e( 'Set your desired link hover color.', 'ap_core' ); ?></label>
								</td>
							</tr>
							<?php
							/**
							 * PressTrends setting
							 */
							?>
							<tr valign="top"><th scope="row"><?php _e( 'Send usage data?', 'ap_core' ); ?></th>
								<td>
									<select name="ap_core_theme_options[presstrends]">
										<?php
											$selected = $options['presstrends'];
											$checked = 'selected="selected"';
											$p = '';
											foreach ( ap_core_presstrends() as $option ) {
												$label = $option['label'];
												$value = $option['value'];
												if ( $selected == $option['value'] ) {
													$p = '<option value="' . $value . '" ' . $checked . '>' . $label . '</option>';
												} else {
													$p = '<option value="' . $value . '">' . $label . '</option>';
												}
												echo $p;
											} ?>
									</select><br />
									<label class="description" for="ap_core_theme_options[presstrends]"><?php _e( 'For more information visit <a href="http://presstrends.io/faq">PressTrends</a>.', 'ap_core' ); ?></label>
								</td>
							</tr>
						</table>
						<?php /* debug */
						/* var_dump($options); ?><br /><?php var_dump($defaults); */ ?>
						<p class="submit">
							<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'ap_core' ); ?>" />
						</p>
					</form>
				</div><!-- closes post-body-content -->
			</div><!-- closes post-body -->
		</div><!-- closes poststuff -->
	</div><!-- closes wrap -->
	<?php
}

// Presstrends
function presstrends() {

// Add your PressTrends and Theme API Keys
$api_key = 'i93727o4eba1lujhti5bjgiwfmln5xm5o0iv';
$auth = '0o7g17t95klos03ovw79y5biocuyc3yu9';

// NO NEED TO EDIT BELOW
$data = get_transient( 'presstrends_data' );
if (!$data || $data == ''){
$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
$url = $api_base . $auth . '/api/' . $api_key . '/';
$data = array();
$count_posts = wp_count_posts();
$count_pages = wp_count_posts('page');
$comments_count = wp_count_comments();
$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
$plugin_count = count(get_option('active_plugins'));
$all_plugins = get_plugins();
foreach($all_plugins as $plugin_file => $plugin_data) {
$plugin_name .= $plugin_data['Name'];
$plugin_name .= '&';
}
$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
$data['posts'] = $count_posts->publish;
$data['pages'] = $count_pages->publish;
$data['comments'] = $comments_count->total_comments;
$data['approved'] = $comments_count->approved;
$data['spam'] = $comments_count->spam;
$data['theme_version'] = $theme_data['Version'];
$data['theme_name'] = $theme_data['Name'];
$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
$data['plugins'] = $plugin_count;
$data['plugin'] = urlencode($plugin_name);
$data['wpversion'] = get_bloginfo('version');
foreach ( $data as $k => $v ) {
$url .= $k . '/' . $v . '/';
}
$response = wp_remote_get( $url );
set_transient('presstrends_data', $data, 60*60*24);
}}

$options = get_option( 'ap_core_theme_options' );
if ( $options['presstrends'] != 'false' ) {
add_action('admin_init', 'presstrends');
//add_action('wp_head', function() { echo 'Presstrends is enabled'; });
}

/**
 * Validate options
 * completely rewritten @since 0.4.0
 */
function ap_core_theme_options_validate( $input ) {

    if ( !array_key_exists( $input['sidebar'], ap_core_sidebar() ) )
    $input['sidebar'] = $input['sidebar'];
	if ( !array_key_exists( $input['presstrends'], ap_core_presstrends() ) )
	$input['presstrends'] = $input['presstrends'];
	if ( !array_key_exists( $input['heading'], ap_core_fonts() ) )
	$input['heading'] = $input['heading'];
	if ( !array_key_exists( $input['body'], ap_core_fonts() ) )
	$input['body'] = $input['body'];
	if ( !array_key_exists( $input['alt'], ap_core_fonts() ) )
	$input['alt'] = $input['alt'];
	$input['link'] = wp_filter_nohtml_kses( $input['link'] );

    return $input;
}

?>