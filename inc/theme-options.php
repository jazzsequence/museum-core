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
 */
function ap_core_theme_options_add_page() {
    add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'ap_core_theme_options_page' );
}

/**
 * Create arrays for our select and radio options
 */
$select_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Zero', 'ap_core' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'One', 'ap_core' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two', 'ap_core' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Three', 'ap_core' )
	),
	'4' => array(
		'value' => '4',
		'label' => __( 'Four', 'ap_core' )
	),
	'5' => array(
		'value' => '3',
		'label' => __( 'Five', 'ap_core' )
	)
);

$radio_options = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Yes', 'ap_core' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'No', 'ap_core' )
	),
	'maybe' => array(
		'value' => 'maybe',
		'label' => __( 'Maybe', 'ap_core' )
	)
);
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
	$load_css .= '</style>';
	echo $load_css;
	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'ap_core' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'ap_core' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'ap_core_options' ); ?>
			<?php $options = get_option( 'ap_core_theme_options' ); ?>
			<?php $defaults = ap_core_get_theme_defaults(); ?>

			<table class="form-table">

				<?php
				/**
				 * A sample checkbox option
				 */
				/*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'A checkbox', 'ap_core' ); ?></th>
					<td>
						<input id="sample_theme_options[option1]" name="sample_theme_options[option1]" type="checkbox" value="1" <?php checked( '1', $options['option1'] ); ?> />
						<label class="description" for="sample_theme_options[option1]"><?php _e( 'Sample checkbox', 'ap_core' ); ?></label>
					</td>
				</tr>

				<?php
				*/
				/**
				 * A sample text input option
				 */
				/*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Some text', 'ap_core' ); ?></th>
					<td>
						<input id="sample_theme_options[sometext]" class="regular-text" type="text" name="sample_theme_options[sometext]" value="<?php esc_attr_e( $options['sometext'] ); ?>" />
						<label class="description" for="sample_theme_options[sometext]"><?php _e( 'Sample text input', 'ap_core' ); ?></label>
					</td>
				</tr>

				<?php
				*/
				/**
				 * A sample select input option
				 */
				/*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Select input', 'ap_core' ); ?></th>
					<td>
						<select name="sample_theme_options[selectinput]">
							<?php
								$selected = $options['selectinput'];
								$p = '';
								$r = '';

								foreach ( $select_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="sample_theme_options[selectinput]"><?php _e( 'Sample select input', 'ap_core' ); ?></label>
					</td>
				</tr>

				<?php
				*/
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


				<?php
				/**
				 * A Font Settings
				 */
				?>
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
						</select>
					</td>
				</tr>
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

				<?php
				/**
				 * A sample textarea option
				 */
				/*
				?>
				<tr valign="top"><th scope="row"><?php _e( 'A textbox', 'ap_core' ); ?></th>
					<td>
						<textarea id="sample_theme_options[sometextarea]" class="large-text" cols="50" rows="10" name="sample_theme_options[sometextarea]"><?php echo esc_textarea( $options['sometextarea'] ); ?></textarea>
						<label class="description" for="sample_theme_options[sometextarea]"><?php _e( 'Sample text box', 'ap_core' ); ?></label>
					</td>
				</tr>
			*/ ?>
			</table>
			<?php /* debug */
			$options = get_option( 'ap_core_theme_options' ); var_dump($options); ?><br /><?php var_dump($defaults); ?>
			<?php /* end debug */ ?>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'ap_core' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

$options = get_option( 'ap_core_theme_options' );
if ( $options['presstrends'] != 'false' ) {
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

add_action('admin_init', 'presstrends');
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
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

    return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/