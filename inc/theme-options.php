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

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'ap_core' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'ap_core' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'ap_core_options' ); ?>
			<?php $options = get_option( 'ap_core_theme_options' ); ?>

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
				 * A sample of radio buttons
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Sidebar', 'ap_core' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Sidebar', 'ap_core' ); ?></span></legend>
						<?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( ap_core_sidebar() as $option ) {
								$selected_sidebar = $options['sidebar'];

								if ( '' != $selected_sidebar ) {
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
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'ap_core' ); ?>" />
			</p>
		</form>
	</div>
	<?php
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
    // We select the previous value of the field, to restore it in case an invalid entry has been given
    // We verify if the given value exists in the layouts array
    if ( !array_key_exists( $input['sidebar'], ap_core_sidebar() ) )
    $input['sidebar'] = $input['sidebar'];


    return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/